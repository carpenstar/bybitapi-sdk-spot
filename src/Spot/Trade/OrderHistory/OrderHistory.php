<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OrderHistory;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

class OrderHistory extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/private/history-orders";

    public function getQueryBagClassName(): string
    {
        return OHQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return OHResponse::class;
    }
}