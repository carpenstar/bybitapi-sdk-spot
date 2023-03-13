<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/public/last-price
 */
class LastTradedPrice extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/public/quote/ticker/price";

    public function getQueryBagClassName(): string
    {
        return LTPQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return LTPResponse::class;
    }
}