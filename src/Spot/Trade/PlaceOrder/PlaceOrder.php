<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Dto\PlaceOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Options\PlaceOrderOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/trade/place-order
 */
class PlaceOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected string $url = '/spot/v3/private/order';

    public function getRequestOptionsDTOClass(): string
    {
        return PlaceOrderOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return PlaceOrderDto::class;
    }
}