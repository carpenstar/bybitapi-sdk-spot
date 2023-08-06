<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\PurchaseRedeemHistory\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\LeverageToken\PurchaseRedeemHistory\PurchaseRedeemHistory;

final class TestPurchaseRedeemHistory extends PurchaseRedeemHistory
{
    use OverrideExecuteTrait;
}