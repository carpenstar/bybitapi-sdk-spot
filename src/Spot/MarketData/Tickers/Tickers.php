<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Tickers;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Dto\TickersDto;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Options\TickersOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/public/tickers
 */
class Tickers extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/public/quote/ticker/24hr";

    public function getQueryBagClassName(): string
    {
        return TickersOptions::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return TickersDto::class;
    }
}