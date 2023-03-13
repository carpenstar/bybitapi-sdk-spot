<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\OrderBook;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/public/depth
 */
class OrderBook extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = '/spot/v3/public/quote/depth';

    public function getQueryBagClassName(): string
    {
        return OBQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return OBResponse::class;
    }
}