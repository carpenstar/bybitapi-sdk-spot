<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Tickers;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Response\TickersResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Request\TickersRequestOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/public/tickers
 */
class Tickers extends PublicEndpoint implements IGetEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/public/quote/ticker/24hr";
    }

    protected function getResponseClassname(): string
    {
        return TickersResponse::class;
    }

    protected function getOptionsClassname(): string
    {
        return TickersRequestOptions::class;
    }
}