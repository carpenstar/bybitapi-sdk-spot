<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Request;

use Carpenstar\ByBitAPI\Core\Objects\AbstractParameters;

class PublicTradingRecordsRequestOptions extends AbstractParameters
{
    /**
     * Name of the trading pair
     * @required true
     * @var string $symbol
     */
    protected string $symbol;

    /**
     * Limit for data size. [1, 60]. Default: 60
     * @required false
     * @var int $limit
     */
    protected int $limit = 60;

    public function __construct()
    {
        $this->setRequiredField('symbol');
    }

    /**
     * @param string $symbol
     * @return PublicTradingRecordsRequestOptions
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param int $limit
     * @return PublicTradingRecordsRequestOptions
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}