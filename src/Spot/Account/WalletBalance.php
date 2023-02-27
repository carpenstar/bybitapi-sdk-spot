<?php
namespace Carpenstar\ByBitAPI\Spot\Account;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

/**
 * https://bybit-exchange.github.io/docs/spot/wallet
 */
class WalletBalance extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/private/account";
}