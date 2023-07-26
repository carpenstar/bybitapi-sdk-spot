<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Core\Enums\EnumOrderType;
use Carpenstar\ByBitAPI\Core\Enums\EnumSide;
use Carpenstar\ByBitAPI\Core\Enums\EnumTimeInForce;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\BatchCancelOrder;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Response\BatchCancelOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Request\BatchCancelOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Request\PlaceOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\PlaceOrder;
use PHPUnit\Framework\TestCase;

class BatchCancelOrderTest extends TestCase
{

    public function testBatchCancelOrderEndpoint()
    {
        $api = (new BybitAPI($_ENV["HOST_NAME"], $_ENV["API_KEY"], $_ENV["SECRET_KEY"]));

        for ($i = 0; $i < 5; $i++) {
            $api
                ->rest(PlaceOrder::class, (new PlaceOrderRequest())
                    ->setSymbol('BTCUSDT')
                    ->setOrderType(EnumOrderType::LIMIT)
                    ->setSide(EnumSide::BUY)
                    ->setOrderLinkId(uniqid())
                    ->setOrderQty(0.001)
                    ->setOrderPrice(1000)
                    ->setTimeInForce(EnumTimeInForce::GOOD_TILL_CANCELED));
        }

        $response = $api->rest(BatchCancelOrder::class,
            (new BatchCancelOrderRequest())->setSymbol('BTCUSDT')
        );

        /** @var BatchCancelOrderResponse $data */
        $data = $response->getBody()->fetch();

        $this->assertIsBool($data->getSuccess());
        $this->assertEquals(true, $data->getSuccess());
    }
}