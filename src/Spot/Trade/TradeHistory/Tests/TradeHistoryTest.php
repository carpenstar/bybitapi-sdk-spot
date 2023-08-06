<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Overrides\TestTradeHistory;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Request\TradeHistoryRequest;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Response\TradeHistoryResponse;
use PHPUnit\Framework\TestCase;

class TradeHistoryTest extends TestCase
{
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
}