<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;

class BatchCancelOrderById extends PrivateEndpoint implements  IPostEndpointInterface
{
    protected string $url = '/spot/v3/private/cancel-orders-by-ids';
}