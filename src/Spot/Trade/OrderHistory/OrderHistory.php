<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OrderHistory;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Dto\OrderHistoryDto;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Options\OrderHistoryOptions;

class OrderHistory extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/private/history-orders";

    public function getRequestOptionsDTOClass(): string
    {
        return OrderHistoryOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return OrderHistoryDto::class;
    }
}