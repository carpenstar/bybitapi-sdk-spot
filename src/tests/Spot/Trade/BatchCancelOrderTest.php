<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Core\Enums\EnumOrderType;
use Carpenstar\ByBitAPI\Core\Enums\EnumSide;
use Carpenstar\ByBitAPI\Core\Enums\EnumTimeInForce;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\BatchCancelOrder;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Dto\BatchCancelOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Options\BatchCancelOrderOptions;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Options\PlaceOrderOptions;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\PlaceOrder;
use PHPUnit\Framework\TestCase;

class BatchCancelOrderTest extends TestCase
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

    public function testBatchCancelOrderEndpoint()
    {
        $api = (new BybitAPI(self::$host, self::$apiKey, self::$secret));

        for ($i = 0; $i < 5; $i++) {
            $api
                ->rest(PlaceOrder::class, (new PlaceOrderOptions())
                    ->setSymbol('BTCUSDT')
                    ->setOrderType(EnumOrderType::LIMIT)
                    ->setSide(EnumSide::BUY)
                    ->setOrderLinkId(uniqid())
                    ->setOrderQty(0.001)
                    ->setOrderPrice(1000)
                    ->setTimeInForce(EnumTimeInForce::GOOD_TILL_CANCELED));
        }

        $response = $api->rest(BatchCancelOrder::class,
            (new BatchCancelOrderOptions())->setSymbol('BTCUSDT')
        );

        /** @var BatchCancelOrderDto $data */
        $data = $response->getBody()->fetch();

        $this->assertIsBool($data->getSuccess());
        $this->assertEquals(true, $data->getSuccess());
    }
}