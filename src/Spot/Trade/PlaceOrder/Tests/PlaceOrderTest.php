<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOrderType;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Enums\EnumSide;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Overrides\TestPlaceOrder;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Request\PlaceOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Response\PlaceOrderResponse;
use PHPUnit\Framework\TestCase;

class PlaceOrderTest extends TestCase
{
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
}