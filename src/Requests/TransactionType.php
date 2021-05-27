<?php

namespace GlobalPayments\PaymentGatewayProvider\Requests;

abstract class TransactionType
{
    // auth requests
    public const AUTHORIZE = 'authorize';
    public const SALE      = 'charge';
    public const VERIFY    = 'verify';

    // mgmt requests
    public const REFUND   = 'refund';
    public const REVERSAL = 'reverse';
    public const VOID     = 'void';
    public const CAPTURE  = 'capture';

    // transit requests
    public const CREATE_TRANSACTION_KEY = 'getTransactionKey';
    public const CREATE_MANIFEST        = 'createManifest';

    // report requests
    public const REPORT_TXN_DETAILS = 'transactionDetail';

    // gp-api requests
    public const GET_ACCESS_TOKEN = 'getAccessToken';

    // 3DS requests
    public const CHECK_ENROLLMENT        = 'checkEnrollment';
    public const INITIATE_AUTHENTICATION = 'initiateAuthentication';
}
