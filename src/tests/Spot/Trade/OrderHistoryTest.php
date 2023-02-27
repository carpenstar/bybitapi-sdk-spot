<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Dto\OrderHistoryDto;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Options\OrderHistoryOptions;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\OrderHistory;
use PHPUnit\Framework\TestCase;

class OrderHistoryTest extends TestCase
{
    protected static $host;
    protected static $apiKey;
    protected static $secret;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        self::$host = getenv("HOST_NAME");
        self::$apiKey = getenv("API_KEY");
        self::$secret = getenv("SECRET_KEY");
    }

    public function testOrderHistory()
    {
        $response = (new BybitAPI(self::$host, self::$apiKey, self::$secret))
            ->rest(OrderHistory::class, (new OrderHistoryOptions()));

        if ($response->getBody()->count() > 0) {
            /** @var OrderHistoryDto $historyItem */
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