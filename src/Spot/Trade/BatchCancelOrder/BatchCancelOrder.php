<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IPostEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Dto\BatchCancelOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Options\BatchCancelOrderOptions;

class BatchCancelOrder extends PrivateEndpoint implements IPostEndpointInterface
{
    protected string $url = '/spot/v3/private/cancel-orders';

    public function getRequestOptionsDTOClass(): string
    {
        return BatchCancelOrderOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return BatchCancelOrderDto::class;
    }
}