<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Dto\PublicTradingRecordsDto;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Options\PublicTradingRecordsOptions;

/**
 * https://bybit-exchange.github.io/docs/spot/public/recent-trade
 */
class PublicTradingRecords extends PublicEndpoint implements IGetEndpointInterface
{
    /**
     * @var string $url
     */
    protected string $url = "/spot/v3/public/quote/trades";

    public function getRequestOptionsDTOClass(): string
    {
        return PublicTradingRecordsOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return PublicTradingRecordsDto::class;
    }
}