<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Kline;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/public/kline
 */
class Kline extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/public/quote/kline";

    public function getQueryBagClassName(): string
    {
        return KQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return KResponse::class;
    }
}