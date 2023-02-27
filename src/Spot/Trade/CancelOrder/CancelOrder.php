<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\CancelOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Dto\CancelOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Options\CancelOrderOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/trade/cancel
 */
class CancelOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected string $url = '/spot/v3/private/cancel-order';

    public function getRequestOptionsDTOClass(): string
    {
        return CancelOrderOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return CancelOrderDto::class;
    }
}