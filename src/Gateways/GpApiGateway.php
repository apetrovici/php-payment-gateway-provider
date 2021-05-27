<?php

namespace GlobalPayments\PaymentGatewayProvider\Gateways;

use GlobalPayments\Api\Entities\Enums\Environment;
use GlobalPayments\Api\Entities\Enums\GatewayProvider;
use GlobalPayments\Api\Entities\Enums\GpApi\Channels;
use GlobalPayments\Api\Gateways\GpApiConnector;
use GlobalPayments\PaymentGatewayProvider\Data\Order;
use GlobalPayments\PaymentGatewayProvider\Requests;

class GpApiGateway extends AbstractGateway
{
    /**
     * First support e-mail
     */
    const FIRST_LINE_SUPPORT_EMAIL = 'api.integrations@globalpay.com';

    /**
     * SDK gateway provider
     *
     * @var string
     */
    public $gatewayProvider = GatewayProvider::GP_API;

    /**
     * App ID
     *
     * @var string
     */
    public $appId;

    /**
     * App Key
     *
     *
     * @var string
     */
    public $appKey;

    /**
     * Merchant country
     *
     * @var
     */
    public $country;

    /**
     * Should live payments be accepted
     *
     * @var bool
     */
    public $isProduction;

    /**
     * 3DS Method notification endpoint
     *
     * @var string
     */
    public $methodNotificationUrl;

    /**
     * 3DS Challenge notification endpoint
     *
     * @var string
     */
    public $challengeNotificationUrl;

    public function getFirstLineSupportEmail()
    {
        return self::FIRST_LINE_SUPPORT_EMAIL;
    }

    public function getFrontendGatewayOptions()
    {
        return array(
            'apiVersion'  => GpApiConnector::GP_API_VERSION,
            'accessToken' => $this->getAccessToken(),
            'env'         => $this->isProduction ? parent::ENVIRONMENT_PRODUCTION : parent::ENVIRONMENT_SANDBOX,
        );
    }

    public function getBackendGatewayOptions()
    {
        return array(
            'appId'                    => $this->appId,
            'appKey'                   => $this->appKey,
            'channel'                  => Channels::CardNotPresent,
            'country'                  => $this->country,
            'environment'              => $this->isProduction ? Environment::PRODUCTION : Environment::TEST,
            'methodNotificationUrl'    => $this->methodNotificationUrl,
            'challengeNotificationUrl' => $this->challengeNotificationUrl,
        );
    }

    protected function getAccessToken() {
        try {
            $request  = $this->prepareRequest(Requests\TransactionType::GET_ACCESS_TOKEN, new Order());
            $response = $this->submitRequest($request);

            return $response->token;
        } catch (\Exception $e) {
            die($e->getMessage());
            return null;
        }
    }
}
