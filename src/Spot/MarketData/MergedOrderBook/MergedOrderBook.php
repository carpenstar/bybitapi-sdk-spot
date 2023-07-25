<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Request\MergedOrderBookRequestOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/public/merge-depth
 */
class MergedOrderBook extends PublicEndpoint implements IGetEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/public/quote/depth/merged";
    }

    protected function getResponseClassname(): string
    {
        return MergedOrderBookResponse::class;
    }

    protected function getRequestClassname(): string
    {
        return MergedOrderBookRequestOptions::class;
    }
}