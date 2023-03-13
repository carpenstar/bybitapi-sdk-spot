<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;

class BatchCancelOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected string $url = '/spot/v3/private/cancel-orders';

    public function getQueryBagClassName(): string
    {
        return BCOQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return BCOResponse::class;
    }
}