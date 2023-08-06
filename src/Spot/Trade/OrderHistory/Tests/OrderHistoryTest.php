<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Overrides\TestOrderHistory;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Request\OrderHistoryRequest;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Response\OrderHistoryResponse;
use PHPUnit\Framework\TestCase;

class OrderHistoryTest extends TestCase
{
    static private string $orderHistoryResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"accountId":"533287","symbol":"BTCUSDT","orderLinkId":"spotx003","orderId":"1210856408331857664","orderPrice":"23800","orderQty":"0.02","execQty":"0","cummulativeQuoteQty":"0","avgPrice":"0","status":"REJECTED","timeInForce":"GTC","orderType":"LIMIT_MAKER","side":"BUY","stopPrice":"0.0","icebergQty":"0.0","createTime":1659081332185,"updateTime":1659081332225,"isWorking":"1","blockTradeId":"","cancelType":"UNKNOWN","smpGroup":0,"smpOrderId":"","smpType":"None"}]},"retExtInfo":{},"time":1659082630638}';

    public function testOrderHistoryDTOBuilder()
    {
        foreach (json_decode(self::$orderHistoryResponse, true)['result']['list'] as $order) {
            $dto = ResponseDtoBuilder::make(OrderHistoryResponse::class, $order);
            $this->assertInstanceOf(OrderHistoryResponse::class, $dto);
        }
    }

    public function testOrderHistoryResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$orderHistoryResponse, CurlResponseHandler::class, OrderHistoryResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testOrderHistoryEndpoint()
    {
        $endpoint = RestBuilder::make(TestOrderHistory::class, (new OrderHistoryRequest()));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$orderHistoryResponse);
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