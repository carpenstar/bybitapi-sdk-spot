<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Dto\MergedOrderBookDto;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Options\MergedOrderBookOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/public/merge-depth
 */
class MergedOrderBook extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/public/quote/depth/merged";

    public function getQueryBagClassName(): string
    {
        return MergedOrderBookOptions::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return MergedOrderBookDto::class;
    }
}