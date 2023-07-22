<?php
namespace Carpenstar\ByBitAPI\Tests\Account;

use Carpenstar\ByBitAPI\Core\Auth\Credentials;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponse;
use Carpenstar\ByBitAPI\Spot\Account\WalletBalance\Response\WalletBalanceResponse;
use Carpenstar\ByBitAPI\Spot\Account\WalletBalance\WalletBalance;
use PHPUnit\Framework\TestCase;

class WalletBalanceTest extends TestCase
{
    static private string $walletResponse = '{"retCode":0,"retMsg":"OK","result":{"balances":[{"coin":"EOS","coinId":"EOS","total":"2000","free":"2000","locked":"0"},{"coin":"ETH","coinId":"ETH","total":"1","free":"1","locked":"0"},{"coin":"USDC","coinId":"USDC","total":"50000","free":"50000","locked":"0"},{"coin":"USDT","coinId":"USDT","total":"50000","free":"50000","locked":"0"},{"coin":"XRP","coinId":"XRP","total":"10000","free":"10000","locked":"0"}]},"retExtInfo":{},"time":1683973704401}';

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        Credentials::setHost('HOST');
        Credentials::setApiKey('API_KEY');
        Credentials::setSecret('SECRET');
    }

    public function testWalletRequest()
    {
        $walletBalanceEndpoint = RestBuilder::make(WalletBalance::class);

        $reflectionWalletEndpoint = new \ReflectionClass($walletBalanceEndpoint);
        $checkMethod = $reflectionWalletEndpoint->getMethod('getResponseClassname');
        $checkMethod->setAccessible(true);

        $checkMethodResult = $checkMethod->invokeArgs($walletBalanceEndpoint, []);
        $this->assertEquals(WalletBalanceResponse::class, $checkMethodResult);
    }

    public function testWalletResponse()
    {
        $walletResponseData = (new CurlResponse(self::$walletResponse))
            ->bindEntity(WalletBalanceResponse::class)
            ->handle(EnumOutputMode::MODE_ENTITY);

        $this->assertInstanceOf(EntityCollection::class, $walletResponseData->getBody());

        $this->assertNotEmpty($walletResponseData->getBody()->fetch());

        while(!empty($walletItem = $walletResponseData->getBody()->fetch())) {
            $this->assertInstanceOf(WalletBalanceResponse::class, $walletItem);
            $this->assertIsString($walletItem->getCoin());
            $this->assertIsFloat($walletItem->getFree());
            $this->assertIsFloat($walletItem->getTotal());
            $this->assertIsBool($walletItem->getLocked());
        }
    }

}