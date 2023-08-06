<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Overrides\TestGetOrder;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Request\GetOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Response\GetOrderResponse;
use PHPUnit\Framework\TestCase;

class GetOrderTest extends TestCase
{
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
}