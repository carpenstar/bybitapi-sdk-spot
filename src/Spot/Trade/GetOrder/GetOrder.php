<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\GetOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Dto\GetOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Options\GetOrderOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/trade/get-order
 */
class GetOrder extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = '/spot/v3/private/order';

    public function getRequestOptionsDTOClass(): string
    {
        return GetOrderOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return GetOrderDto::class;
    }
}