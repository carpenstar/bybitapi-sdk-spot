<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\CancelOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Response\CancelOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Request\CancelOrderRequestOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/trade/cancel
 */
class CancelOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/private/cancel-order";
    }

    protected function getResponseClassname(): string
    {
        return CancelOrderResponse::class;
    }

    protected function getOptionsClassname(): string
    {
        return CancelOrderRequestOptions::class;
    }
}