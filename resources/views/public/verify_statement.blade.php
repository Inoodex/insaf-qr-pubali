<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pubali Document Verification System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />

    <style>
        body {
            background: #eef5f1;
            padding-top: 75px;
            position: relative;
            left: -7px;
            overflow-x: hidden;
        }

        .top-bar {
            background-color: #0b6b3a;
            color: #fff;
            padding: 10px 0;
            z-index: 1030;
            position: fixed;
            left: -15px;
            right: 15px;
            width: calc(100% + 14px);
        }

        .brand-logo-svg {
            width: 140px;
            height: auto;
            filter: brightness(0) invert(1);
        }

        .badge-valid {
            background: linear-gradient(90deg, rgba(0, 188, 125, 0.10) 0%, rgba(0, 184, 219, 0.10) 100%);
            padding: 8px 15px;
            border-radius: 20px;
            border: 1px solid rgba(0, 188, 125, 0.20);
            color: #0b6b3a;
            font-weight: 600;
        }

        .website-link {
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.18) 0%, rgba(153, 153, 153, 0.13) 100%);
            box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.05);
            color: white !important;
            text-decoration: none !important;
            font-size: 0.875rem;
            padding: 6px 16px;
            white-space: nowrap;
            transition: all 0.2s ease-in-out;
        }

        .website-link:hover {
            background: rgba(255, 255, 255, 0.25);
            color: white !important;
            transform: translateY(-1px);
        }

        .card-box {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .footer {
            font-size: 0.875rem;
        }

        .footer-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 6px;
        }

        .footer-item svg {
            flex-shrink: 0;
            margin-top: 3px;
        }

        @media (min-width: 576px) {
            .brand-logo-svg {
                width: 160px;
            }
        }

        @media (min-width: 768px) {
            body {
                padding-top: 80px;
            }

            .brand-logo-svg {
                width: 184px;
            }

            .website-link {
                font-size: 0.95rem;
                padding: 7px 20px;
            }
        }

        @media (max-width: 575.98px) {
            body {
                left: 0 !important;
                padding-top: 70px;
            }

            .top-bar {
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                padding: 8.5px 0;
            }

            .top-bar-title {
                display: none;
            }

            .brand-logo-svg {
                width: 140px;
            }

            .website-link {
                font-size: 0.8rem;
                padding: 5px 14px;
            }

            .badge-valid {
                padding: 6px 15px;
                font-size: 0.84rem;
            }

            .card-box {
                padding: 1.1rem !important;
                border-radius: 12px;
            }

            .card-box h5 {
                font-size: 1.1rem !important;
            }

            .card-box small {
                font-size: 0.74rem;
            }

            .card-box span {
                font-size: 0.88rem;
            }

            .card-box .fs-6 {
                font-size: 0.96rem !important;
            }

            .confirmation-subtext {
                font-size: 0.74rem !important;
                line-height: 1.4;
            }

            .footer {
                font-size: 0.78rem;
            }

            .footer-item svg {
                width: 12px;
                height: 12px;
                margin-top: 3px;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="fixed-top top-bar shadow-sm">
        <div class="container px-3 px-sm-4">
            <div class="d-flex justify-content-between align-items-center gap-2">
                <!-- Left Section: Logo + System Title -->
                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <a href="https://www.pubalibangla.com" target="_blank" rel="noopener noreferrer" style="display: flex; align-items: center;">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Pubali Bank PLC" class="brand-logo-svg" />
                    </a>

                    <span class="top-bar-title fs-6 fs-md-5 text-white fw-normal border-start border-white border-opacity-75 ps-2 ps-md-3">
                        Document Verifier
                    </span>
                </div>

                <!-- Right Section: Action Button -->
                <div>
                    <span class="website-link btn btn-md">
                        Visit Website
                    </span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Dynamic Body -->
    <main class="flex-grow-1">
        <div class="container my-2 my-md-4 px-2 px-sm-3">

                <!-- Valid Statement Badge -->
                <div class="text-center mb-3">
                    <span class="badge-valid d-inline-flex align-items-center gap-2 flex-wrap justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20 13C20 18 16.5 20.5 12.34 21.95C12.1222 22.0238 11.8855 22.0203 11.67 21.94C7.5 20.5 4 18 4 13V5.99999C4 5.73478 4.10536 5.48042 4.29289 5.29289C4.48043 5.10535 4.73478 4.99999 5 4.99999C7 4.99999 9.5 3.79999 11.24 2.27999C11.4519 2.09899 11.7214 1.99954 12 1.99954C12.2786 1.99954 12.5481 2.09899 12.76 2.27999C14.51 3.80999 17 4.99999 19 4.99999C19.2652 4.99999 19.5196 5.10535 19.7071 5.29289C19.8946 5.48042 20 5.73478 20 5.99999V13Z"
                                  stroke="#009966" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 12L11 14L15 10"
                                  stroke="#009966" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Valid Statement</span>
                    </span>

                    <p class="mt-2 text-muted small px-2 mb-0 confirmation-subtext">
                        The following details are confirmed and digitally generated by Pubali Bank PLC.
                    </p>
                </div>

                <div class="row justify-content-center mb-4">
                    <div class="col-12 col-md-8 col-lg-7">
                        <div class="card shadow-sm p-3 p-sm-4 bg-white border-0 card-box">

                            <h5 class="text-center mb-3 mb-md-4 fw-bold text-dark fs-5">
                                Statement Summary
                            </h5>

                            <!-- Account Details Grid -->
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block text-uppercase">Account No:</small>
                                    <span class="fw-bold text-break text-dark">
                                        @php
                                            $rawAcc = (string)($statement->formatted_account_no ?? $statement->account_no);
                                            $cleanAcc = preg_replace('/[^0-9]/', '', $rawAcc);
                                            $displayAcc = strlen($cleanAcc) >= 8 
                                                ? substr($cleanAcc, 0, 4) . '-' . substr($cleanAcc, 4, 3) . '-' . substr($cleanAcc, 7)
                                                : (strlen($cleanAcc) > 4 ? substr($cleanAcc, 0, 4) . '-' . substr($cleanAcc, 4) : $rawAcc);
                                        @endphp
                                        {{ $displayAcc }}
                                    </span>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block text-uppercase">Account Type:</small>
                                    <span class="fw-bold text-break text-dark">{{ $statement->account_type ?: 'SAVINGS BANK ACCOUNT' }}</span>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block text-uppercase">Account Name:</small>
                                    <span class="fw-bold text-dark text-uppercase">{{ $statement->account_name }}</span>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block text-uppercase">Opening Balance:</small>
                                    <span class="text-success fw-bold fs-6">
                                        ৳{{ is_numeric(str_replace(',', '', (string)($statement->opening_balance ?? $statement->formatted_opening_balance))) ? number_format((float) str_replace(',', '', (string)($statement->opening_balance ?? $statement->formatted_opening_balance)), 2) : ltrim($statement->formatted_opening_balance, '৳ ') }}
                                    </span>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block text-uppercase">Closing Balance:</small>
                                    <span class="text-success fw-bold fs-6">
                                        ৳{{ is_numeric(str_replace(',', '', (string)($statement->closing_balance ?? $statement->formatted_closing_balance))) ? number_format((float) str_replace(',', '', (string)($statement->closing_balance ?? $statement->formatted_closing_balance)), 2) : ltrim($statement->formatted_closing_balance, '৳ ') }}
                                    </span>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block text-uppercase">Statement Period:</small>
                                    <span class="fw-normal text-dark text-nowrap">
                                        {{ $statement->statement_period }}
                                    </span>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block text-uppercase">Certificate ID:</small>
                                    <span class="fw-normal text-dark">{{ $statement->certificate_id ?? '' }}</span>
                                </div>
                            </div>

                            <div class="border-top pt-2 mt-3 text-muted small text-center text-sm-start">
                                <strong>STATEMENT GENERATED DATE:</strong> {{ $statement->formatted_generated_at }}
                            </div>

                        </div>
                    </div>
                </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="footer bg-white mt-auto py-3 border-top">
        <div class="container px-3 px-sm-4">
            <div class="row g-3">
                <!-- Column 1: Helplines -->
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="footer-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12" fill="none">
                            <g clip-path="url(#clip0_5_455)">
                                <path d="M11.0371 7.87663C10.3024 7.87663 9.58106 7.76172 8.89747 7.53581C8.5625 7.42156 8.15072 7.52638 7.94628 7.73634L6.597 8.75491C5.03222 7.91963 4.06834 6.95606 3.24447 5.40303L4.23306 4.08891C4.48991 3.83241 4.58203 3.45772 4.47166 3.10616C4.24478 2.41897 4.12953 1.69794 4.12953 0.962937C4.12956 0.431969 3.69759 0 3.16666 0H0.962906C0.431969 0 0 0.431969 0 0.962906C0 7.04884 4.95119 12 11.0371 12C11.5681 12 12 11.568 12 11.0371V8.8395C12 8.30859 11.568 7.87663 11.0371 7.87663Z" fill="#0A7E4A" />
                            </g>
                            <defs>
                                <clipPath id="clip0_5_455">
                                    <rect width="12" height="12" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Helpline: +8809660616253, 16253</span>
                    </div>

                    <div class="footer-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12" fill="none">
                            <path d="M6.06601 2.8648C8.08799 2.88464 9.35467 2.75883 9.52575 4.99998H11.9914C11.9914 1.52809 8.96348 1.06012 6.00182 1.06012C3.03992 1.06012 0.012207 1.52809 0.012207 4.99998H2.45875C2.64804 2.71612 4.06083 2.84519 6.06601 2.8648Z" fill="#0A7E4A" />
                            <path d="M1.23494 6.11611C1.83549 6.11611 2.33521 6.15206 2.44631 5.56131C2.46125 5.48102 2.46988 5.38999 2.46988 5.28473H2.44141H0C0 6.1635 0.552934 6.11611 1.23494 6.11611Z" fill="#0A7E4A" />
                            <path d="M9.54166 5.28473H9.51855C9.51855 5.39069 9.52766 5.48196 9.5447 5.56131C9.66187 6.10608 10.1609 6.07223 10.7593 6.07223C11.4446 6.07223 12.0001 6.11728 12.0001 5.28473H9.54166Z" fill="#0A7E4A" />
                            <path d="M8.33705 4.68626V4.33709C8.33705 4.18095 8.15709 4.17114 7.93489 4.17114H7.57195C7.34998 4.17114 7.17003 4.18095 7.17003 4.33709V4.63795V4.87135H4.60259V4.63795V4.33709C4.60259 4.18095 4.42263 4.17114 4.20066 4.17114H3.83749C3.61552 4.17114 3.43557 4.18095 3.43557 4.33709V4.68626V4.99109C2.85065 5.59888 0.936742 8.18616 0.867188 8.49939L0.868121 10.5895C0.868121 10.7825 1.0252 10.9396 1.21823 10.9396H10.5544C10.7474 10.9396 10.9045 10.7825 10.9045 10.5895V8.48888C10.8356 8.18476 8.92219 5.59864 8.33705 4.99086V4.68626ZM4.47608 8.78064C4.28819 8.78064 4.13578 8.62846 4.13578 8.44034C4.13578 8.25221 4.28819 8.10003 4.47608 8.10003C4.66397 8.10003 4.81638 8.25221 4.81638 8.44034C4.81638 8.62846 4.66397 8.78064 4.47608 8.78064ZM4.47608 7.61362C4.28819 7.61362 4.13578 7.46144 4.13578 7.27332C4.13578 7.08519 4.28819 6.93301 4.47608 6.93301C4.66397 6.93301 4.81638 7.08519 4.81638 7.27332C4.81638 7.46144 4.66397 7.61362 4.47608 7.61362ZM4.47608 6.44683C4.28819 6.44683 4.13578 6.29465 4.13578 6.10653C4.13578 5.91864 4.28819 5.76623 4.47608 5.76623C4.66397 5.76623 4.81638 5.91864 4.81638 6.10653C4.81638 6.29465 4.66397 6.44683 4.47608 6.44683ZM5.8765 8.78064C5.68861 8.78064 5.5362 8.62846 5.5362 8.44034C5.5362 8.25221 5.68861 8.10003 5.8765 8.10003C6.06463 8.10003 6.21681 8.25221 6.21681 8.44034C6.21681 8.62846 6.06463 8.78064 5.8765 8.78064ZM5.8765 7.61362C5.68861 7.61362 5.5362 7.46144 5.5362 7.27332C5.5362 7.08519 5.68861 6.93301 5.8765 6.93301C6.06463 6.93301 6.21681 7.08519 6.21681 7.27332C6.21681 7.46144 5.8765 7.61362 5.8765 7.61362ZM5.8765 6.44683C5.68861 6.44683 5.5362 6.29465 5.5362 6.10653C5.5362 5.91864 5.68861 5.76623 5.8765 5.76623C6.06463 5.76623 6.21681 5.91864 6.21681 6.10653C6.21681 6.29465 6.06463 6.44683 5.8765 6.44683ZM7.27693 8.78064C7.08881 8.78064 6.93663 8.62846 6.93663 8.44034C6.93663 8.25221 7.08881 8.10003 7.27693 8.10003C7.46505 8.10003 7.61723 8.25221 7.61723 8.44034C7.61723 8.62846 7.46505 8.78064 7.27693 8.78064ZM7.27693 7.61362C7.08881 7.61362 6.93663 7.46144 6.93663 7.27332C6.93663 7.08519 7.08881 6.93301 7.27693 6.93301C7.46505 6.93301 7.61723 7.08519 7.61723 7.27332C7.61723 7.46144 7.46505 7.61362 7.27693 7.61362ZM7.27693 6.44683C7.08881 6.44683 6.93663 6.29465 6.93663 6.10653C6.93663 5.91864 7.08881 5.76623 7.27693 5.76623C7.46505 5.76623 7.61723 5.91864 7.61723 6.10653C7.61723 6.29465 7.46505 6.44683 7.27693 6.44683Z" fill="#0A7E4A" />
                        </svg>
                        <span>PABX Number: +88 02223381614</span>
                    </div>

                    <div class="footer-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12" fill="none">
                            <g clip-path="url(#clip0_5_476)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.0797 8.29978C0.885211 8.29978 0.726562 8.14113 0.726562 7.94665V4.06219C0.726562 3.86768 0.885188 3.70905 1.0797 3.70905H10.9203C11.1148 3.70905 11.2735 3.86768 11.2735 4.06219V7.94665C11.2735 8.14113 11.1148 8.29978 10.9203 8.29978H9.74069V6.74599C9.74069 6.24106 9.33002 5.83038 8.82506 5.83038H3.17494C2.67 5.83038 2.25933 6.24106 2.25933 6.74599V8.29978H1.0797ZM9.17819 3.14655V1.86101C9.17819 1.75294 9.13458 1.65989 9.05149 1.59077L8.11059 0.807891C8.04483 0.753164 7.97128 0.726562 7.88573 0.726562H3.17339C2.97975 0.726562 2.82183 0.884484 2.82183 1.07812V3.14658L9.17819 3.14655ZM3.17494 6.39286C2.98045 6.39286 2.8218 6.55148 2.8218 6.74599V10.9203C2.8218 11.1148 2.98043 11.2734 3.17494 11.2734H8.82506C9.01957 11.2734 9.17819 11.1148 9.17819 10.9203V6.74599C9.17819 6.55151 9.01957 6.39286 8.82506 6.39286H3.17494ZM4.3673 7.95729H7.6327C7.78802 7.95729 7.91395 7.83136 7.91395 7.67604C7.91395 7.52072 7.78802 7.39479 7.6327 7.39479H4.3673C4.21198 7.39479 4.08605 7.52072 4.08605 7.67604C4.08605 7.83136 4.21198 7.95729 4.3673 7.95729ZM4.3673 10.2715C4.21198 10.2715 4.08605 10.1456 4.08605 9.99026C4.08605 9.83494 4.21198 9.70901 4.3673 9.70901H7.6327C7.78802 9.70901 7.91395 9.83494 7.91395 9.99026C7.91395 10.2715 7.78802 10.2715 7.6327 10.2715H4.3673ZM4.3673 9.1144C4.21198 9.1144 4.08605 8.98847 4.08605 8.83315C4.08605 8.67783 4.21198 8.5519 4.3673 8.5519H7.6327C7.78802 8.5519 7.91395 8.67783 7.91395 8.83315C7.91395 8.98847 7.78802 9.1144 7.6327 9.1144H4.3673Z" fill="#0A7E4A" />
                            </g>
                            <defs>
                                <clipPath id="clip0_5_476">
                                    <rect width="12" height="12" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Fax: 880-2-9564009</span>
                    </div>
                </div>

                <!-- Column 2: Address & Mail -->
                <div class="col-12 col-md-6 col-lg-7">
                    <div class="footer-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12" fill="none">
                            <path d="M7.00287 7.35219C6.70432 7.55122 6.35754 7.65643 6 7.65643C5.64248 7.65643 5.2957 7.55122 4.99716 7.35219L0.0798984 4.07391C0.0526172 4.05573 0.0260391 4.03677 0 4.01727V9.38907C0 10.005 0.499805 10.4938 1.10468 10.4938H10.8953C11.5112 10.4938 12 9.99395 12 9.38907V4.01724C11.9739 4.03679 11.9473 4.0558 11.9199 4.07401L7.00287 7.35219Z" fill="#0A7E4A" />
                            <path d="M0.469922 3.48885L5.38718 6.76715C5.57332 6.89125 5.78665 6.95329 5.99998 6.95329C6.21333 6.95329 6.42668 6.89123 6.61282 6.76715L11.5301 3.48885C11.8243 3.2928 12 2.96467 12 2.61053C12 2.0016 11.5046 1.50623 10.8957 1.50623H1.1043C0.495398 1.50625 0 2.00162 0 2.61112C0 2.96467 0.175687 3.2928 0.469922 3.48885Z" fill="#0A7E4A" />
                        </svg>
                        <span>Mail: info@pubalibankbd.com</span>
                    </div>

                    <div class="footer-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12" fill="none">
                            <g clip-path="url(#clip0_5_483)">
                                <path d="M6 0C3.89145 0 2.13281 1.69852 2.13281 3.86719C2.13281 4.69223 2.38073 5.42794 2.85654 6.11733L5.70405 10.5606C5.8422 10.7766 6.15809 10.7762 6.29595 10.5606L9.15581 6.10221C9.62138 5.44406 9.86719 4.67126 9.86719 3.86719C9.86719 1.73482 8.13237 0 6 0ZM6 5.625C5.03079 5.625 4.24219 4.8364 4.24219 3.86719C4.24219 2.89798 5.03079 2.10938 6 2.10938C6.96921 2.10938 7.75781 2.89798 7.75781 3.86719C7.75781 4.8364 6.96921 5.625 6 5.625Z" fill="#0A7E4A" />
                                <path d="M8.74837 8.0788L6.97812 10.8465C6.51989 11.5609 5.47755 11.5585 5.02153 10.8471L3.24839 8.07952C1.6883 8.44023 0.726562 9.101 0.726562 9.89063C0.726562 11.2608 3.44362 12 6 12C8.55638 12 11.2734 11.2608 11.2734 9.89063C11.2734 9.10044 10.3104 8.43931 8.74837 8.0788Z" fill="#0A7E4A" />
                            </g>
                            <defs>
                                <clipPath id="clip0_5_483">
                                    <rect width="12" height="12" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Address: Head Office, 26 Dilkusha Commercial Area, Dhaka 1000, Bangladesh</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>