<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\AllAssetInfo;

final class TestAllAssetInfo extends AllAssetInfo
{
    use OverrideExecuteTrait;
}