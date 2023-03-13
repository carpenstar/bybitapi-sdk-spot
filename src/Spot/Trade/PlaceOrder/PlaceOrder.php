<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/trade/place-order
 */
class PlaceOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected string $url = '/spot/v3/private/order';

    public function getQueryBagClassName(): string
    {
        return POQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return POResponse::class;
    }
}