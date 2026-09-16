<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'certificate_token',
        'statement_token',
        'account_no',
        'account_name',
        'certificate_balance',
        'opening_balance',
        'closing_balance',
        'certificate_id',
        'account_open_date',
        'statement_period_from',
        'statement_period_to',
        'statement_generated_at',
        'report_generation_date', // Solvency issue date
        'currency',
        'equivalent_balance',
        'bank_name',
        'branch_name',
        'account_type',
        'status',
    ];

    protected $casts = [
        'account_open_date'      => 'date',
        'statement_period_from'  => 'date',
        'statement_period_to'    => 'date',
        'statement_generated_at' => 'datetime',
        'report_generation_date' => 'date',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * Owner user relationship.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // -------------------------------------------------------------------------
    // Token Generation
    // -------------------------------------------------------------------------

    /**
     * Generate a 64-character SHA-256 hex token (cryptographically secure).
     * Used for both certificate_token and statement_token QR payloads.
     */
    public static function generateToken(): string
    {
        return hash('sha256', random_bytes(32));
    }

    // -------------------------------------------------------------------------
    // Model Lifecycle Hooks
    // -------------------------------------------------------------------------

    protected static function booted(): void
    {
        static::creating(function ($verification) {
            if (empty($verification->user_id) && auth()->check()) {
                $verification->user_id = auth()->id();
            }
            if (empty($verification->certificate_token)) {
                $verification->certificate_token = static::generateToken();
            }
            if (empty($verification->statement_token)) {
                $verification->statement_token = static::generateToken();
            }
        });
    }

    // -------------------------------------------------------------------------
    // Balance & Account Accessors
    // -------------------------------------------------------------------------

    public function getFormattedAccountNoAttribute(): string
    {
        $clean = preg_replace('/[^0-9]/', '', (string) $this->account_no);
        if (strlen($clean) >= 8) {
            return substr($clean, 0, 4) . '-' . substr($clean, 4, 3) . '-' . substr($clean, 7);
        } elseif (strlen($clean) > 4) {
            return substr($clean, 0, 4) . '-' . substr($clean, 4);
        }
        return (string) $this->account_no;
    }

    public function getFormattedCertificateBalanceAttribute(): string
    {
        if (is_numeric($this->certificate_balance)) {
            return number_format((float) $this->certificate_balance, 2);
        }
        return (string) $this->certificate_balance;
    }

    public function getFormattedOpeningBalanceAttribute(): string
    {
        if (is_numeric($this->opening_balance)) {
            return number_format((float) $this->opening_balance, 2);
        }
        return (string) $this->opening_balance;
    }

    public function getFormattedClosingBalanceAttribute(): string
    {
        if (is_numeric($this->closing_balance)) {
            return number_format((float) $this->closing_balance, 2);
        }
        return (string) $this->closing_balance;
    }

    // -------------------------------------------------------------------------
    // Date / DateTime Accessors
    // -------------------------------------------------------------------------

    /**
     * Statement period as a human-readable range string.
     * e.g. "19-08-2026 TO 08-09-2026"
     */
    public function getStatementPeriodAttribute(): string
    {
        if ($this->statement_period_from && $this->statement_period_to) {
            return $this->statement_period_from->format('d-m-Y')
                . ' TO '
                . $this->statement_period_to->format('d-m-Y');
        }
        // Fallback: show report_generation_date if no period set (legacy records)
        return $this->formatted_generation_date;
    }

    /**
     * Full datetime when the bank document was generated.
     * e.g. "9/8/2026 1:02:07 PM"
     */
    public function getFormattedStatementGeneratedAtAttribute(): string
    {
        if ($this->statement_generated_at) {
            return $this->statement_generated_at->format('n/j/Y g:i:s A');
        }
        return $this->formatted_generation_date;
    }

    /**
     * Legacy accessor — kept for backward compatibility with certificate view.
     */
    public function getFormattedGenerationDateAttribute(): string
    {
        if ($this->report_generation_date) {
            return $this->report_generation_date->format('d-M-Y');
        }
        if ($this->statement_generated_at) {
            return $this->statement_generated_at->format('d-M-Y');
        }
        return '';
    }

    // -------------------------------------------------------------------------
    // Public Verification URL Accessors (uses http://domain:PORT/?t=*** format)
    // -------------------------------------------------------------------------

    public function getCertificateVerificationUrlAttribute(): string
    {
        return $this->buildVerificationUrl($this->certificate_token);
    }

    public function getStatementVerificationUrlAttribute(): string
    {
        return $this->buildVerificationUrl($this->statement_token);
    }

    /**
     * Working URL to directly open verification page in local/current browser.
     */
    public function getDirectCertificateUrlAttribute(): string
    {
        return url('/?t=' . $this->certificate_token);
    }

    /**
     * Working URL to directly open statement verification page in local/current browser.
     */
    public function getDirectStatementUrlAttribute(): string
    {
        return url('/?t=' . $this->statement_token);
    }

    /**
     * Build verification URL:
     * - If VERIFY_DOMAIN is set in .env (e.g. http://verify.pubalibankbd.net), uses that domain.
     * - Otherwise uses active server URL (e.g. http://127.0.0.1:8000 or live domain).
     */
    public function buildVerificationUrl(?string $token): string
    {
        if (empty($token)) {
            return '';
        }

        // 1. Explicit VERIFY_DOMAIN set in .env (e.g. http://verify.pubalibankbd.net)
        if ($configuredDomain = env('VERIFY_DOMAIN')) {
            $scheme = str_starts_with($configuredDomain, 'https://') ? 'https://' : 'http://';
            $cleanDomain = preg_replace('#^https?://#', '', $configuredDomain);
            return rtrim("{$scheme}{$cleanDomain}", '/') . '/?t=' . $token;
        }

        // 2. Exact URL from active server running in terminal or live hosting
        return rtrim(url('/'), '/') . '/?t=' . $token;
    }

    public function getVerificationPort(?string $key = null): int
    {
        $uniqueAccountKey = (string) ($key ?? ($this->account_no ?: ($this->id ?: 'pubali_account')));
        return 1000 + (hexdec(substr(md5($uniqueAccountKey), 0, 4)) % 9000);
    }

    // -------------------------------------------------------------------------
    // QR Payload Accessors (direct URL for QR encoding)
    // -------------------------------------------------------------------------

    public function getCertificateQrPayloadAttribute(): string
    {
        return $this->certificate_verification_url;
    }

    public function getStatementQrPayloadAttribute(): string
    {
        return $this->statement_verification_url;
    }
}
