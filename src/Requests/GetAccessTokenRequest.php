<?php

namespace GlobalPayments\PaymentGatewayProvider\Requests;

use GlobalPayments\PaymentGatewayProvider\Data\Order;

class GetAccessTokenRequest extends AbstractRequest
{
    public function __construct(Order $order, $config)
    {
        parent::__construct($order, $config);
        $this->data[RequestArg::SERVICES_CONFIG]['permissions'] = array(
            'PMT_POST_Create_Single',
        );
    }

    public function getTransactionType()
    {
        return TransactionType::GET_ACCESS_TOKEN;
    }

    /**
     * @return string[]
     */
    public function getArgumentList()
    {
        return array();
    }
}
