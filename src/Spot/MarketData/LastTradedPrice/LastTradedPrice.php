<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Request\LastTradedPriceRequestOptions;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Response\LastTradedPriceResponse;

/**
 * https://bybit-exchange.github.io/docs/spot/public/last-price
 */
class LastTradedPrice extends PublicEndpoint implements IGetEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/public/quote/ticker/price";
    }

    protected function getResponseClassname(): string
    {
        return LastTradedPriceResponse::class;
    }

    protected function getOptionsClassname(): string
    {
        return LastTradedPriceRequestOptions::class;
    }
}