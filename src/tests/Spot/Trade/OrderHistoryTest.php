<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Response\OrderHistoryResponse;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Request\OrderHistoryRequest;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\OrderHistory;
use PHPUnit\Framework\TestCase;

class OrderHistoryTest extends TestCase
{

    public function testOrderHistory()
    {
        $response = (new BybitAPI($_ENV["HOST_NAME"], $_ENV["API_KEY"], $_ENV["SECRET_KEY"]))
            ->rest(OrderHistory::class, (new OrderHistoryRequest()));

        if ($response->getBody()->count() > 0) {
            /** @var OrderHistoryResponse $historyItem */
            while (!empty($historyItem = $response->getBody()->fetch())) {
                $this->assertIsInt($historyItem->getAccountId());
                $this->assertIsString($historyItem->getSymbol());
                $this->assertIsString($historyItem->getOrderLinkId());
                $this->assertIsInt($historyItem->getOrderId());
                $this->assertIsFloat($historyItem->getOrderPrice());
                $this->assertIsFloat($historyItem->getOrderQty());
                $this->assertIsFloat($historyItem->getExecQty());
                $this->assertIsFloat($historyItem->getCummulativeQuoteQty());
                $this->assertIsFloat($historyItem->getAvgPrice());
                $this->assertIsString($historyItem->getStatus());
                $this->assertIsString($historyItem->getTimeInForce());
                $this->assertIsString($historyItem->getOrderType());
                $this->assertIsString($historyItem->getSide());
                $this->assertIsFloat($historyItem->getStopPrice());
                $this->assertInstanceOf(\DateTime::class, $historyItem->getCreateTime());
                $this->assertInstanceOf(\DateTime::class, $historyItem->getUpdateTime());
                $this->assertIsInt($historyItem->getIsWorking());
                $this->assertIsInt($historyItem->getOrderCategory());
                if (!is_null($historyItem->getTriggerPrice())) {
                    $this->assertIsFloat($historyItem->getTriggerPrice());
                }
            }
        }

        $this->assertEquals($response->getReturnCode(), 0);
    }
}