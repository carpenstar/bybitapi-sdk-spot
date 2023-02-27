<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\GetOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/trade/get-order
 */
class GetOrder extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = '/spot/v3/private/order';
}