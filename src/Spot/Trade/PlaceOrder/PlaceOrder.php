<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Response\PlaceOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Request\PlaceOrderRequestOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/trade/place-order
 */
class PlaceOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/private/order";
    }

    protected function getResponseClassname(): string
    {
        return PlaceOrderResponse::class;
    }

    protected function getRequestClassname(): string
    {
        return PlaceOrderRequestOptions::class;
    }
}