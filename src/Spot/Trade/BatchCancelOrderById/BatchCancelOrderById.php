<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Response\BatchCancelOrderByIdResponse;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Request\BatchCancelOrderByIdRequestOptions;

class BatchCancelOrderById extends PrivateEndpoint implements  IPostEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/private/cancel-orders-by-ids";
    }

    protected function getResponseClassname(): string
    {
        return BatchCancelOrderByIdResponse::class;
    }

    protected function getOptionsClassname(): string
    {
        return BatchCancelOrderByIdRequestOptions::class;
    }
}