<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Overrides\TestInstrumentInfo;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Response\InstrumentInfoResponse;
use PHPUnit\Framework\TestCase;

class InstrumentInfoTest extends TestCase
{
    private static string $instrumentInfoApiResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"name":"BTCUSDT","alias":"BTCUSDT","baseCoin":"BTC","quoteCoin":"USDT","basePrecision":"0.000001","quotePrecision":"0.00000001","minTradeQty":"0.00004","minTradeAmt":"1","maxTradeQty":"500","maxTradeAmt":"1200000","minPricePrecision":"0.01","category":"1","showStatus":"1","innovation":"0"},{"name":"ETHUSDT","alias":"ETHUSDT","baseCoin":"ETH","quoteCoin":"USDT","basePrecision":"0.00001","quotePrecision":"0.0000001","minTradeQty":"0.0005","minTradeAmt":"1","maxTradeQty":"100000000","maxTradeAmt":"1200000","minPricePrecision":"0.01","category":"1","showStatus":"1","innovation":"0"},{"name":"EOSUSDT","alias":"EOSUSDT","baseCoin":"EOS","quoteCoin":"USDT","basePrecision":"0.01","quotePrecision":"0.000001","minTradeQty":"0.01","minTradeAmt":"0.01","maxTradeQty":"90909.090909","maxTradeAmt":"10000","minPricePrecision":"0.0001","category":"1","showStatus":"1","innovation":"0"}]},"retExtInfo":{},"time":1683980087416}';

    public function testInstrumentInfoDTOBuilder()
    {
        foreach (json_decode(self::$instrumentInfoApiResponse, true)['result']['list'] as $dataItem) {
            $dto = ResponseDtoBuilder::make(InstrumentInfoResponse::class, $dataItem);
            $this->assertInstanceOf(InstrumentInfoResponse::class, $dto);
            $this->assertIsString($dto->getName());
            $this->assertIsString($dto->getAlias());
            $this->assertIsString($dto->getQuoteCoin());
            $this->assertIsString($dto->getBaseCoin());
            $this->assertIsFloat($dto->getBasePrecision());
            $this->assertIsFloat($dto->getQuotePrecision());
            $this->assertIsInt($dto->getInnovation());
            $this->assertIsInt($dto->getMaxTradeAmt());
            $this->assertIsFloat($dto->getMaxTradeQty());
            $this->assertIsFloat($dto->getMinTradeAmt());
            $this->assertIsFloat($dto->getMinTradeQty());
            $this->assertIsFloat($dto->getMinPricePrecision());
            $this->assertIsInt($dto->getCategory());
            $this->assertIsInt($dto->getShowStatus());
            $this->assertIsInt($dto->getInnovation());
        }
    }

    public function testInstrumentInfoResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$instrumentInfoApiResponse, CurlResponseHandler::class, InstrumentInfoResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testInstrumentInfoEndpoint()
    {
        $endpoint = RestBuilder::make(TestInstrumentInfo::class);

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$instrumentInfoApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $dataItem) {
            $dto = ResponseDtoBuilder::make(InstrumentInfoResponse::class, $dataItem);
            $this->assertInstanceOf(InstrumentInfoResponse::class, $dto);
            $this->assertIsString($dto->getName());
            $this->assertIsString($dto->getAlias());
            $this->assertIsString($dto->getQuoteCoin());
            $this->assertIsString($dto->getBaseCoin());
            $this->assertIsFloat($dto->getBasePrecision());
            $this->assertIsFloat($dto->getQuotePrecision());
            $this->assertIsInt($dto->getInnovation());
            $this->assertIsInt($dto->getMaxTradeAmt());
            $this->assertIsFloat($dto->getMaxTradeQty());
            $this->assertIsFloat($dto->getMinTradeAmt());
            $this->assertIsFloat($dto->getMinTradeQty());
            $this->assertIsFloat($dto->getMinPricePrecision());
            $this->assertIsInt($dto->getCategory());
            $this->assertIsInt($dto->getShowStatus());
            $this->assertIsInt($dto->getInnovation());
        }
    }
}