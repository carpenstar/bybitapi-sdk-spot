<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OrderHistory;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Response\OrderHistoryResponse;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Request\OrderHistoryRequestOptions;

class OrderHistory extends PrivateEndpoint implements IGetEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/private/history-orders";
    }

    protected function getResponseClassname(): string
    {
        return OrderHistoryResponse::class;
    }

    protected function getRequestClassname(): string
    {
        return OrderHistoryRequestOptions::class;
    }
}