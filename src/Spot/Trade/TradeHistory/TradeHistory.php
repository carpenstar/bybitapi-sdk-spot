<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\TradeHistory;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

class TradeHistory extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/private/my-trades";

    public function getQueryBagClassName(): string
    {
        return THQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return THResponse::class;
    }
}