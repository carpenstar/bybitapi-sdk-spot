<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Kline;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Dto\KlineDto;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Options\KlineOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/public/kline
 */
class Kline extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/public/quote/kline";

    public function getQueryBagClassName(): string
    {
        return KlineOptions::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return KlineDto::class;
    }
}