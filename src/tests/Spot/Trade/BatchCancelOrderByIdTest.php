<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Core\Enums\EnumOrderType;
use Carpenstar\ByBitAPI\Core\Enums\EnumSide;
use Carpenstar\ByBitAPI\Core\Enums\EnumTimeInForce;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Options\TickersOptions;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Tickers;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\BatchCancelOrderById;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Options\BatchCancelOrderByIdOptions;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Dto\PlaceOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Options\PlaceOrderOptions;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\PlaceOrder;
use PHPUnit\Framework\TestCase;

class BatchCancelOrderByIdTest extends TestCase
{
    protected static $host;
    protected static $apiKey;
    protected static $secret;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        self::$host = getenv("HOST_NAME");
        self::$apiKey = getenv("API_KEY");
        self::$secret = getenv("SECRET_KEY");
    }

    public function testBatchCancelOrderByIdEndpoint()
    {
        $orderLinkIds = [];
        /** @var PlaceOrderDto $order */

        $api = (new BybitAPI(self::$host, self::$apiKey, self::$secret));

        for ($i = 0; $i < 5; $i++) {
           $response = $api->rest(PlaceOrder::class, (new PlaceOrderOptions())
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
            (new BatchCancelOrderByIdOptions())->setOrderIds(implode(',', $orderLinkIds))
        );

        $this->assertEquals(0, $response->getReturnCode());
    }
}