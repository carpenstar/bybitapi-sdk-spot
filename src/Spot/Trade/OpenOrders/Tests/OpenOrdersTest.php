<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Overrides\TestOpenOrders;
use Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Request\OpenOrdersRequest;
use Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Response\OpenOrdersResponse;
use PHPUnit\Framework\TestCase;

class OpenOrdersTest extends TestCase
{
    static private string $openOrdersResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"accountId":"533287","symbol":"BTCUSDT","orderLinkId":"spotx004","orderId":"1210858291884732160","orderPrice":"23500","orderQty":"0.02","execQty":"0","cummulativeQuoteQty":"0","avgPrice":"0","status":"NEW","timeInForce":"GTC","orderType":"LIMIT_MAKER","side":"SELL","stopPrice":"0.0","icebergQty":"0.0","createTime":1659081556722,"updateTime":1659081556740,"isWorking":"1","blockTradeId":"","cancelType":"UNKNOWN","smpGroup":0,"smpOrderId":"","smpType":"None"}]},"retExtInfo": {},"time": 1659081570356}';

    public function testOpenOrdersDTOBuilder()
    {
        foreach (json_decode(self::$openOrdersResponse, true)['result']['list'] as $order) {
            $dto = ResponseDtoBuilder::make(OpenOrdersResponse::class, $order);
            $this->assertInstanceOf(OpenOrdersResponse::class, $dto);

            $this->assertNotNull($dto->getSide());
            $this->assertNotNull($dto->getAccountId());
            $this->assertNotNull($dto->getSymbol());
            $this->assertNotNull($dto->getOrderLinkId());
            $this->assertNotNull($dto->getOrderId());
            $this->assertNotNull($dto->getOrderPrice());
            $this->assertNotNull($dto->getOrderQty());
            $this->assertNotNull($dto->getExecQty());
            $this->assertNotNull($dto->getAvgPrice());
            $this->assertNotNull($dto->getCummulativeQuoteQty());
            $this->assertNotNull($dto->getStatus());
            $this->assertNotNull($dto->getTimeInForce());
            $this->assertNotNull($dto->getOrderType());
            $this->assertNotNull($dto->getStopPrice());
            $this->assertNotNull($dto->getCreateTime());
            $this->assertNotNull($dto->getUpdateTime());
            $this->assertNotNull($dto->getIsWorking());
        }
    }

    public function testOpenOrdersResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$openOrdersResponse, CurlResponseHandler::class, OpenOrdersResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testOpenOrdersEndpoint()
    {
        $endpoint = RestBuilder::make(TestOpenOrders::class, (new OpenOrdersRequest()));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$openOrdersResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        while (!empty($order = $body->fetch())) {
            $this->assertIsInt($order->getAccountId());
            $this->assertIsString($order->getSymbol());
            $this->assertIsString($order->getOrderLinkId());
            $this->assertIsInt($order->getOrderId());
            $this->assertIsFloat($order->getOrderPrice());
            $this->assertIsFloat($order->getOrderQty());
            $this->assertIsFloat($order->getExecQty());
            $this->assertIsFloat($order->getCummulativeQuoteQty());
            $this->assertIsFloat($order->getAvgPrice());
            $this->assertIsString($order->getStatus());
            $this->assertIsString($order->getTimeInForce());
            $this->assertIsString($order->getOrderType());
            $this->assertIsString($order->getSide());
            $this->assertIsFloat($order->getStopPrice());
            $this->assertInstanceOf(\DateTime::class, $order->getCreateTime());
            $this->assertInstanceOf(\DateTime::class, $order->getUpdateTime());
            $this->assertIsInt($order->getIsWorking());
            $this->assertIsInt($order->getOrderCategory());
            if (!is_null($order->getTriggerPrice())) {
                $this->assertIsFloat($order->getTriggerPrice());
            }
        }
    }
}