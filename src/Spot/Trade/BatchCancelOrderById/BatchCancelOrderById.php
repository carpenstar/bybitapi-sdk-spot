<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Dto\BatchCancelOrderByIdDto;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Options\BatchCancelOrderByIdOptions;

class BatchCancelOrderById extends PrivateEndpoint implements  IPostEndpointInterface
{
    protected string $url = '/spot/v3/private/cancel-orders-by-ids';

    public function getRequestOptionsDTOClass(): string
    {
        return BatchCancelOrderByIdOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return BatchCancelOrderByIdDto::class;
    }
}