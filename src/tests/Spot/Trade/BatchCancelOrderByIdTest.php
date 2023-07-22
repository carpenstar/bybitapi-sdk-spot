<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Core\Enums\EnumOrderType;
use Carpenstar\ByBitAPI\Core\Enums\EnumSide;
use Carpenstar\ByBitAPI\Core\Enums\EnumTimeInForce;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\BatchCancelOrderById;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Request\BatchCancelOrderByIdRequestOptions;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Response\PlaceOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Request\PlaceOrderRequestOptions;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\PlaceOrder;
use PHPUnit\Framework\TestCase;

class BatchCancelOrderByIdTest extends TestCase
{

    public function testBatchCancelOrderByIdEndpoint()
    {
        $orderLinkIds = [];
        $api = (new BybitAPI($_ENV["HOST_NAME"], $_ENV["API_KEY"], $_ENV["SECRET_KEY"]));

        for ($i = 0; $i < 5; $i++) {
           $response = $api->rest(PlaceOrder::class, (new PlaceOrderRequestOptions())
                    ->setSymbol("BTCUSDT")
                    ->setOrderType(EnumOrderType::LIMIT)
                    ->setSide(EnumSide::BUY)
                    ->setOrderLinkId(uniqid())
                    ->setOrderQty(0.001)
                    ->setOrderPrice(1000)
                    ->setTimeInForce(EnumTimeInForce::GOOD_TILL_CANCELED));

            $orderLinkIds[] = $response->getBody()->fetch()->getOrderId();
        }

        $response = $api->rest(BatchCancelOrderById::class,
            (new BatchCancelOrderByIdRequestOptions())->setOrderIds(implode(',', $orderLinkIds))
        );

        $this->assertEquals(0, $response->getReturnCode());
    }
}