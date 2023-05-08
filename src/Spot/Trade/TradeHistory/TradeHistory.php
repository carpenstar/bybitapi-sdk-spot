<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\TradeHistory;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Dto\TradeHistoryDto;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Options\TradeHistoryOptions;

class TradeHistory extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/private/my-trades";

    public function getQueryBagClassName(): string
    {
        return TradeHistoryOptions::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return TradeHistoryDto::class;
    }
}