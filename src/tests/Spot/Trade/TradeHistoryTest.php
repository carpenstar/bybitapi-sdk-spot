<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Response\TradeHistoryResponse;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Request\TradeHistoryRequestOptions;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\TradeHistory;
use PHPUnit\Framework\TestCase;

class TradeHistoryTest extends TestCase
{

    public function testTradeHistoryEndpoint()
    {
        $data = (new BybitAPI($_ENV["HOST_NAME"], $_ENV["API_KEY"], $_ENV["SECRET_KEY"]))
            ->rest(TradeHistory::class, (new TradeHistoryRequestOptions()));

        if ($data->getBody()->count() > 0) {
            /** @var TradeHistoryResponse $historyItem */
            while (!empty($historyItem = $data->getBody()->fetch())) {
                $this->assertIsString($historyItem->getSymbol());
                $this->assertIsInt($historyItem->getId());
                $this->assertIsInt($historyItem->getOrderId());
                $this->assertIsInt($historyItem->getTradeId());
                $this->assertIsFloat($historyItem->getOrderPrice());
                $this->assertIsFloat($historyItem->getOrderQty());
                $this->assertIsFloat($historyItem->getExecFee());
                $this->assertIsString($historyItem->getFeeTokenId());
                $this->assertInstanceOf(\DateTime::class, $historyItem->getCreatTime());
                $this->assertIsInt($historyItem->getIsBuyer());
                $this->assertIsInt($historyItem->getIsMaker());
                $this->assertIsInt($historyItem->getMatchOrderId());
                $this->assertIsInt($historyItem->getMakerRebate());
                $this->assertInstanceOf(\DateTime::class, $historyItem->getExecutionTime());
            }
        }

        $this->assertEquals($data->getReturnCode(), 0);
    }
}