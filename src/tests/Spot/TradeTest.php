<?php
namespace Spot;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOrderType;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Enums\EnumSide;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestCancelOrder;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestGetOrder;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestOrderHistory;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestPlaceOrder;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestTradeHistory;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Request\CancelOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Response\CancelOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Request\GetOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Response\GetOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Request\OrderHistoryRequest;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Response\OrderHistoryResponse;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Request\PlaceOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Response\PlaceOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Request\TradeHistoryRequest;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Response\TradeHistoryResponse;
use PHPUnit\Framework\TestCase;

class TradeTest extends TestCase
{
    /**
     * SPOT - Trade
     * Place order
     */
    static private string $placeOrderResponse = '{"retCode":0,"retMsg":"OK","result":{"orderId":"1477137337600322304","orderLinkId":"64c7ef2bdf040","symbol":"BTCUSDT","createTime":"1690824492584","orderPrice":"1000","orderQty":"0.001","orderType":"LIMIT","side":"BUY","status":"NEW","timeInForce":"GTC","accountId":"1111837","execQty":"0","orderCategory":0,"smpType":"None"},"retExtInfo":{},"time":1690824492593}';

    public function testPlaceOrderDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(PlaceOrderResponse::class, json_decode(self::$placeOrderResponse, true)['result']);
        $this->assertInstanceOf(PlaceOrderResponse::class, $dto);
        $this->assertIsInt($dto->getOrderId());
        $this->assertIsString($dto->getOrderLinkId());
        $this->assertIsString($dto->getSymbol());
        $this->assertInstanceOf(\DateTime::class, $dto->getCreateTime());

        $this->assertIsFloat($dto->getOrderPrice());
        $this->assertNotEmpty($dto->getOrderPrice());

        $this->assertIsFloat($dto->getOrderQty());
        $this->assertNotEmpty($dto->getOrderQty());

        $this->assertIsString($dto->getSide());
        $this->assertNotEmpty($dto->getSide());

        $this->assertIsString($dto->getStatus());
        $this->assertNotEmpty($dto->getStatus());

        $this->assertIsString($dto->getTimeInForce());
        $this->assertNotEmpty($dto->getTimeInForce());

        $this->assertIsString($dto->getAccountId());
        $this->assertNotEmpty($dto->getAccountId());

        $this->assertIsInt($dto->getOrderCategory());
    }

    public function testPlaceOrderResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$placeOrderResponse, CurlResponseHandler::class, PlaceOrderResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testPlaceOrderEndpoint()
    {
        $endpoint = RestBuilder::make(TestPlaceOrder::class, (new PlaceOrderRequest())
            ->setSymbol("BTCUSDT")
            ->setOrderQty(0.001)
            ->setSide(EnumSide::BUY)
            ->setOrderType(EnumOrderType::MARKET)
        );

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$placeOrderResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $order) {
            $dto = ResponseDtoBuilder::make(PlaceOrderResponse::class, $order);
            $this->assertInstanceOf(PlaceOrderResponse::class, $dto);
            $this->assertIsInt($dto->getOrderId());
            $this->assertIsString($dto->getOrderLinkId());
            $this->assertIsString($dto->getSymbol());
            $this->assertInstanceOf(\DateTime::class, $dto->getCreateTime());

            $this->assertIsFloat($dto->getOrderPrice());
            $this->assertNotEmpty($dto->getOrderPrice());

            $this->assertIsFloat($dto->getOrderQty());
            $this->assertNotEmpty($dto->getOrderQty());

            $this->assertIsString($dto->getSide());
            $this->assertNotEmpty($dto->getSide());

            $this->assertIsString($dto->getStatus());
            $this->assertNotEmpty($dto->getStatus());

            $this->assertIsString($dto->getTimeInForce());
            $this->assertNotEmpty($dto->getTimeInForce());

            $this->assertIsString($dto->getAccountId());
            $this->assertNotEmpty($dto->getAccountId());

            $this->assertIsInt($dto->getOrderCategory());
        }
    }

    /**
     * SPOT - Trade
     * Get order
     */
    static private string $getOrderResponse = '{"retCode":0,"retMsg":"OK","result":{"accountId":"1111837","symbol":"BTCUSDT","orderLinkId":"64c7ef2bdf040","orderId":"1477137337600322304","orderPrice":"1000","orderQty":"0.001","execQty":"0","cummulativeQuoteQty":"0","avgPrice":"0","status":"NEW","timeInForce":"GTC","orderType":"LIMIT","side":"BUY","stopPrice":"0.0","icebergQty":"0.0","createTime":"1690824492584","updateTime":"1690824492595","isWorking":"1","locked":"1","orderCategory":0,"blockTradeId":"","smpType":"None","cancelType":"UNKNOWN","smpGroup":0,"smpOrderId":""},"retExtInfo":{},"time":1690834565801}';

    public function testGetOrderDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(GetOrderResponse::class, json_decode(self::$getOrderResponse, true)['result']);
        $this->assertInstanceOf(GetOrderResponse::class, $dto);

        $this->assertIsInt($dto->getAccountId());
        $this->assertIsString($dto->getSymbol());
        $this->assertIsString($dto->getOrderLinkId());
        $this->assertIsInt($dto->getOrderId());
        $this->assertIsFloat($dto->getOrderPrice());
        $this->assertIsFloat($dto->getOrderQty());
        $this->assertIsFloat($dto->getExecQty());
        $this->assertIsFloat($dto->getCummulativeQuoteQty());
        $this->assertIsFloat($dto->getAvgPrice());
        $this->assertIsString($dto->getStatus());
        $this->assertIsString($dto->getTimeInForce());
        $this->assertIsString($dto->getOrderType());
        $this->assertIsString($dto->getSide());
        $this->assertIsFloat($dto->getStopPrice());
        $this->assertInstanceOf(\DateTime::class, $dto->getCreateTime());
        $this->assertInstanceOf(\DateTime::class, $dto->getUpdateTime());
        $this->assertIsInt($dto->getIsWorking());
        $this->assertIsFloat($dto->getLocked());
    }

    public function testGetOrderResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$getOrderResponse, CurlResponseHandler::class, GetOrderResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testGetOrderEndpoint()
    {
        $endpoint = RestBuilder::make(TestGetOrder::class, (new GetOrderRequest())->setOrderId('1477137337600322304'));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$getOrderResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $dto = $body->fetch();

        $this->assertIsInt($dto->getAccountId());
        $this->assertIsString($dto->getSymbol());
        $this->assertIsString($dto->getOrderLinkId());
        $this->assertIsInt($dto->getOrderId());
        $this->assertIsFloat($dto->getOrderPrice());
        $this->assertIsFloat($dto->getOrderQty());
        $this->assertIsFloat($dto->getExecQty());
        $this->assertIsFloat($dto->getCummulativeQuoteQty());
        $this->assertIsFloat($dto->getAvgPrice());
        $this->assertIsString($dto->getStatus());
        $this->assertIsString($dto->getTimeInForce());
        $this->assertIsString($dto->getOrderType());
        $this->assertIsString($dto->getSide());
        $this->assertIsFloat($dto->getStopPrice());
        $this->assertInstanceOf(\DateTime::class, $dto->getCreateTime());
        $this->assertInstanceOf(\DateTime::class, $dto->getUpdateTime());
        $this->assertIsInt($dto->getIsWorking());
        $this->assertIsFloat($dto->getLocked());
    }


    /**
     * SPOT - Trade
     * Get order
     */
    static private string $cancelOrderResponse = '{"retCode":0,"retMsg":"OK","result":{"orderId":"1477137337600322304","orderLinkId":"64c7ef2bdf040","symbol":"BTCUSDT","createTime":"1690824492584","orderPrice":"1000","orderQty":"0.001","orderType":"LIMIT","side":"BUY","status":"NEW","timeInForce":"GTC","accountId":"1111837","execQty":"0","orderCategory":0,"smpType":"None"},"retExtInfo":{},"time":1690824492593}';

    public function testCancelOrderDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(CancelOrderResponse::class, json_decode(self::$cancelOrderResponse, true)['result']);
        $this->assertInstanceOf(CancelOrderResponse::class, $dto);

        $this->assertIsInt($dto->getOrderId());
        $this->assertIsString($dto->getOrderLinkId());
        $this->assertIsString($dto->getSymbol());
        $this->assertIsString($dto->getStatus());
        $this->assertIsInt($dto->getAccountId());
        $this->assertIsFloat($dto->getOrderPrice());
        $this->assertInstanceOf(\DateTime::class, $dto->getCreateTime());
        $this->assertIsFloat($dto->getOrderQty());
        $this->assertIsFloat($dto->getExecQty());
        $this->assertIsString($dto->getTimeInForce());
        $this->assertIsString($dto->getOrderType());
        $this->assertIsString($dto->getSide());

    }

    public function testCancelOrderResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$cancelOrderResponse, CurlResponseHandler::class, CancelOrderResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testCancelOrderEndpoint()
    {
        $endpoint = RestBuilder::make(TestCancelOrder::class, (new CancelOrderRequest())->setOrderId('1477137337600322304'));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$cancelOrderResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $dto = $body->fetch();

        $this->assertIsInt($dto->getOrderId());
        $this->assertIsString($dto->getOrderLinkId());
        $this->assertIsString($dto->getSymbol());
        $this->assertIsString($dto->getStatus());
        $this->assertIsInt($dto->getAccountId());
        $this->assertIsFloat($dto->getOrderPrice());
        $this->assertInstanceOf(\DateTime::class, $dto->getCreateTime());
        $this->assertIsFloat($dto->getOrderQty());
        $this->assertIsFloat($dto->getExecQty());
        $this->assertIsString($dto->getTimeInForce());
        $this->assertIsString($dto->getOrderType());
        $this->assertIsString($dto->getSide());
    }


    /**
     * SPOT - Trade
     * Trade History
     */
    static private string $tradeHistoryResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"symbol":"BTCUSDT","id":"1210346127973428992","orderId":"1210073515485572864","tradeId":"2100000000001769786","orderPrice":"20500","orderQty":"0.02","execFee":"0.00002","feeTokenId":"BTC","creatTime":"1659020488738","isBuyer": "0","isMaker":"0", "matchOrderId":"1210346015893229312","makerRebate":"0","executionTime":"1659020502026","blockTradeId":""},{"symbol":"BTCUSDT","id":"1208702504949264128","orderId":"1208702504731160320","tradeId":"2100000000001753197","orderPrice":"20240","orderQty":"0.009881","execFee":"0.000009881","feeTokenId":"BTC","creatTime":"1658824566874","isBuyer":"0","isMaker":"1","matchOrderId":"1208677465155702529","makerRebate":"0","executionTime":"1658824566893","blockTradeId":""}]}, "retExtMap": {},"retExtInfo": {},"time":1659084254366}';

    public function testTradeHistoryDTOBuilder()
    {
        foreach (json_decode(self::$tradeHistoryResponse, true)['result']['list'] as $trade) {
            $dto = ResponseDtoBuilder::make(TradeHistoryResponse::class, $trade);
            $this->assertInstanceOf(TradeHistoryResponse::class, $dto);
        }
    }

    public function testTradeHistoryResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$tradeHistoryResponse, CurlResponseHandler::class, TradeHistoryResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testTradeHistoryEndpoint()
    {
        $endpoint = RestBuilder::make(TestTradeHistory::class, (new TradeHistoryRequest()));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$tradeHistoryResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        while (!empty($trade = $body->fetch())) {
            $this->assertIsString($trade->getSymbol());
            $this->assertIsInt($trade->getId());
            $this->assertIsInt($trade->getOrderId());
            $this->assertIsInt($trade->getTradeId());
            $this->assertIsFloat($trade->getOrderPrice());
            $this->assertIsFloat($trade->getOrderQty());
            $this->assertIsFloat($trade->getExecFee());
            $this->assertIsString($trade->getFeeTokenId());
            $this->assertInstanceOf(\DateTime::class, $trade->getCreatTime());
            $this->assertIsInt($trade->getIsBuyer());
            $this->assertIsInt($trade->getIsMaker());
            $this->assertIsInt($trade->getMatchOrderId());
            $this->assertIsInt($trade->getMakerRebate());
            $this->assertInstanceOf(\DateTime::class, $trade->getExecutionTime());
        }
    }

    /**
     * SPOT - Trade
     * Order History
     */
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

