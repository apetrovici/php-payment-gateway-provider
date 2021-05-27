<?php
use GlobalPayments\PaymentGatewayProvider\Gateways\GpApiGateway;
use GlobalPayments\PaymentGatewayProvider\Requests\TransactionType;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../vendor/autoload.php';

$gateway = new GpApiGateway();

// configure gateway settings
$gateway->appId = 'hTmhwdnVgyX3ZtpGQNBCuYYTya0JQUqY';
$gateway->appKey = 'nAHMOvcl8Z3OsDhK';
$gateway->country = '826';
$gateway->isProduction = false;
$gateway->methodNotificationUrl = '';
$gateway->challengeNotificationUrl = '';
$gateway->paymentAction = TransactionType::AUTHORIZE;

// admin
try {
    $gateway->getFrontendGatewayOptions();
    $gateway->getBackendGatewayOptions();
    $gateway->getFirstLineSupportEmail();
    $gateway->securePaymentFieldsConfiguration();
    $gateway->securePaymentFieldHtmlFormat();
} catch (\Exception $e) {
    die($e->getMessage());
}
