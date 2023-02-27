<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\OrderBook;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Dto\OrderBookDto;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Options\OrderBookOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/public/depth
 */
class OrderBook extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = '/spot/v3/public/quote/depth';

    public function getRequestOptionsDTOClass(): string
    {
        return OrderBookOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return OrderBookDto::class;
    }
}