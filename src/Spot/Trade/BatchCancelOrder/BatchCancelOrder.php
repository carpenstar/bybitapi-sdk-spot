<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Response\BatchCancelOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Request\BatchCancelOrderRequestOptions;

class BatchCancelOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/private/cancel-orders";
    }

    protected function getResponseClassname(): string
    {
        return BatchCancelOrderResponse::class;
    }

    protected function getRequestClassname(): string
    {
        return BatchCancelOrderRequestOptions::class;
    }
}