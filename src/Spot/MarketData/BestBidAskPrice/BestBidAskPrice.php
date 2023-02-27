<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/public/bid-ask
 */
class BestBidAskPrice extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/public/quote/ticker/bookTicker";
}