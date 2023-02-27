<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Core\Enums\EnumOrderType;
use Carpenstar\ByBitAPI\Core\Enums\EnumSide;
use Carpenstar\ByBitAPI\Core\Enums\EnumTimeInForce;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\CancelOrder;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Dto\CancelOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Options\CancelOrderOptions;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Dto\GetOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\GetOrder;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Options\GetOrderOptions;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Options\PlaceOrderOptions;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\PlaceOrder;
use PHPUnit\Framework\TestCase;

class PlaceGetAndCancelOrderTest extends TestCase
{
    public BybitAPI $api;

    protected static $host;
    protected static $apiKey;
    protected static $secret;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->api = new BybitAPI(self::$host, self::$apiKey, self::$secret);
        self::$host = getenv("HOST_NAME");
        self::$apiKey = getenv("API_KEY");
        self::$secret = getenv("SECRET_KEY");
    }


    public function testPlaceOrderEndpoint()
    {
        $data = $this->api
            ->rest(PlaceOrder::class, (new PlaceOrderOptions())
                ->setSymbol('BTCUSDT')
                ->setOrderType(EnumOrderType::LIMIT)
                ->setSide(EnumSide::BUY)
                ->setOrderLinkId(uniqid())
                ->setOrderQty(0.001)
                ->setOrderPrice(1000)
                ->setTimeInForce(EnumTimeInForce::GOOD_TILL_CANCELED))
            ->getBody()->fetch();

        $this->assertNotNull($data);

        return $data->getOrderLinkId();
    }

    /**
     * @depends testPlaceOrderEndpoint
     */
    public function testGetOrderEndpoint($orderLinkId)
    {
        /**
         * @var GetOrderDto $data
         */
        $data = $this->api->rest(GetOrder::class, (new GetOrderOptions())
            ->setOrderLinkId($orderLinkId))->getBody()->fetch();

        $this->assertIsInt($data->getAccountId());
        $this->assertIsString($data->getSymbol());
        $this->assertIsString($data->getOrderLinkId());
        $this->assertIsInt($data->getOrderId());
        $this->assertIsFloat($data->getOrderPrice());
        $this->assertIsFloat($data->getOrderQty());
        $this->assertIsFloat($data->getExecQty());
        $this->assertIsFloat($data->getCummulativeQuoteQty());
        $this->assertIsFloat($data->getAvgPrice());
        $this->assertIsString($data->getStatus());
        $this->assertIsString($data->getTimeInForce());
        $this->assertIsString($data->getOrderType());
        $this->assertIsString($data->getSide());
        $this->assertIsFloat($data->getStopPrice());
        $this->assertInstanceOf(\DateTime::class, $data->getCreateTime());
        $this->assertInstanceOf(\DateTime::class, $data->getUpdateTime());
        $this->assertIsInt($data->getIsWorking());
        $this->assertIsFloat($data->getLocked());

        return $orderLinkId;
    }

    /**
     * @depends testGetOrderEndpoint
     */
    public function testCancelOrderEndpoint($orderLinkId)
    {
        /**
         * @var CancelOrderDto $data
         */
        $data = $this->api->rest(CancelOrder::class, (new CancelOrderOptions())
            ->setOrderLinkId($orderLinkId))->getBody()->fetch();

        $this->assertIsInt($data->getOrderId());
        $this->assertIsString($data->getOrderLinkId());
        $this->assertIsString($data->getSymbol());
        $this->assertIsString($data->getStatus());
        $this->assertIsInt($data->getAccountId());
        $this->assertIsFloat($data->getOrderPrice());
        $this->assertInstanceOf(\DateTime::class, $data->getCreateTime());
        $this->assertIsFloat($data->getOrderQty());
        $this->assertIsFloat($data->getExecQty());
        $this->assertIsString($data->getTimeInForce());
        $this->assertIsString($data->getOrderType());
        $this->assertIsString($data->getSide());
    }
}