<?php

namespace App\Http\Controllers;

use App\Models\AccountVerification;
use Illuminate\Http\Request;

class PublicVerificationController extends Controller
{
    /**
     * Unified Verification Display.
     *
     * Accepts ?t={token} (Pubali format) and legacy ?ref={token} for backward compatibility.
     * Checks token against both certificate_token and statement_token columns.
     */
    public function displayVerificationInfo(Request $request)
    {
        // Support both ?t= (current) and ?ref= (legacy)
        $ref = $request->query('t') ?? $request->query('ref');

        if (!$ref) {
            abort(404, 'Verification reference token is missing.');
        }

        // 1. Check if token matches a Certificate
        $certVerification = AccountVerification::where('certificate_token', $ref)->first();
        if ($certVerification) {
            return $this->verifyCertificate($ref, 'certificate_token');
        }

        // 2. Check if token matches a Statement
        $stmtVerification = AccountVerification::where('statement_token', $ref)->first();
        if ($stmtVerification) {
            return $this->verifyStatement($ref, 'statement_token');
        }

        abort(404, 'Invalid or expired verification QR reference.');
    }

    /**
     * Public Verification Page for Account Certificate.
     */
    public function verifyCertificate(string $token, string $column = 'certificate_token')
    {
        $verification = AccountVerification::where($column, $token)->firstOrFail();

        return view('public.verify_certificate', [
            'certificate' => (object) [
                'account_no'              => $verification->formatted_account_no ?? $verification->account_no,
                'formatted_account_no'    => $verification->formatted_account_no,
                'account_name'            => $verification->account_name,
                'account_type'            => $verification->account_type,
                'formatted_balance'       => $verification->formatted_certificate_balance,
                'report_date_balance'     => $verification->certificate_balance,
                'certificate_id'          => $verification->certificate_id,
                'account_open_date'       => $verification->account_open_date,
                'formatted_generation_date' => $verification->formatted_generation_date,
                'formatted_generated_at'  => $verification->formatted_statement_generated_at,
                'report_generation_date'  => $verification->report_generation_date,
                'bank_name'               => $verification->bank_name,
                'branch_name'             => $verification->branch_name,
                'currency'                => $verification->currency,
                'equivalent_balance'      => $verification->equivalent_balance,
                'status'                  => $verification->status,
                'uuid'                    => $verification->certificate_token,
            ],
            'verification' => $verification,
        ]);
    }

    /**
     * Public Verification Page for Account Statement.
     */
    public function verifyStatement(string $token, string $column = 'statement_token')
    {
        $verification = AccountVerification::where($column, $token)->firstOrFail();

        return view('public.verify_statement', [
            'statement' => (object) [
                'account_no'               => $verification->formatted_account_no ?? $verification->account_no,
                'formatted_account_no'     => $verification->formatted_account_no,
                'account_name'             => $verification->account_name,
                'account_type'             => $verification->account_type,
                'formatted_opening_balance'=> $verification->formatted_opening_balance,
                'formatted_closing_balance'=> $verification->formatted_closing_balance,
                'opening_balance'          => $verification->opening_balance,
                'closing_balance'          => $verification->closing_balance,
                'certificate_id'           => $verification->certificate_id,
                'statement_period'         => $verification->statement_period,
                'statement_period_from'    => $verification->statement_period_from,
                'statement_period_to'      => $verification->statement_period_to,
                'formatted_generated_at'   => $verification->formatted_statement_generated_at,
                'formatted_generation_date'=> $verification->formatted_generation_date,
                'report_generation_date'   => $verification->report_generation_date,
                'bank_name'                => $verification->bank_name,
                'branch_name'              => $verification->branch_name,
                'currency'                 => $verification->currency,
                'status'                   => $verification->status,
                'uuid'                     => $verification->statement_token,
            ],
            'verification' => $verification,
        ]);
    }
}
