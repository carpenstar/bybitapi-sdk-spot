<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Overrides\TestCancelOrder;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Request\CancelOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Response\CancelOrderResponse;
use PHPUnit\Framework\TestCase;

class CancelOrderTest extends TestCase
{
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
}