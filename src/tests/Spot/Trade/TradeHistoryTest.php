<?php
namespace Carpenstar\ByBitAPI\Tests\Trade;

use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Dto\TradeHistoryDto;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Options\TradeHistoryOptions;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\TradeHistory;
use PHPUnit\Framework\TestCase;

class TradeHistoryTest extends TestCase
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

    public function testTradeHistoryEndpoint()
    {
        $data = (new BybitAPI(self::$host, self::$apiKey, self::$secret))
            ->rest(TradeHistory::class, (new TradeHistoryOptions()));

        if ($data->getBody()->count() > 0) {
            /** @var TradeHistoryDto $historyItem */
            while (!empty($historyItem = $data->getBody()->fetch())) {
                $this->assertIsString($historyItem->getSymbol());
                $this->assertIsInt($historyItem->getId());
                $this->assertIsInt($historyItem->getOrderId());
                $this->assertIsInt($historyItem->getTradeId());
                $this->assertIsFloat($historyItem->getOrderPrice());
                $this->assertIsFloat($historyItem->getOrderQty());
                $this->assertIsFloat($historyItem->getExecFee());
                $this->assertIsInt($historyItem->getFeeTokenId());
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