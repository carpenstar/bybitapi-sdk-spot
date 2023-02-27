<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/public/recent-trade
 */
class PublicTradingRecords extends PublicEndpoint implements IGetEndpointInterface
{
    /**
     * @var string $url
     */
    protected string $url = "/spot/v3/public/quote/trades";
}