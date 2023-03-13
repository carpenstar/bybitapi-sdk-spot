<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\CancelOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/trade/cancel
 */
class CancelOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected string $url = '/spot/v3/private/cancel-order';

    public function getQueryBagClassName(): string
    {
        return COQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return COResponse::class;
    }
}