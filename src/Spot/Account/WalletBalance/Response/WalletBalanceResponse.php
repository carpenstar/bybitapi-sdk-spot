<?php
namespace Carpenstar\ByBitAPI\Spot\Account\WalletBalance\Response;

use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class WalletBalanceResponse extends ResponseEntity
{
    public static string $rootDataKey = 'balances';

    /**
     * Coin
     * @var string $coin
     */
    private string $coin;

    /**
     * Coin ID
     * @var string $coinId
     */
    private string $coinId;

    /**
     * Total equity
     * @var float
     */
    private float $total;

    /**
     * Available balance
     * @var float
     */
    private float $free;

    /**
     * Reserved for orders
     * @var bool
     */
    private bool $locked;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this
            ->setCoin($data['coin'])
            ->setCoinId($data['coinId'])
            ->setFree($data['free'])
            ->setTotal($data['total'])
            ->setLocked($data['locked']);
    }

    /**
     * @param string $coin
     * @return $this
     */
    private function setCoin(string $coin): self
    {
        $this->coin = $coin;
        return $this;
    }

    /**
     * @return string
     */
    public function getCoin(): string
    {
        return $this->coin;
    }

    /**
     * @param string $coinId
     * @return $this
     */
    private function setCoinId(string $coinId): self
    {
        $this->coinId = $coinId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCoinId(): string
    {
        return $this->coinId;
    }

    /**
     * @param float $total
     * @return $this
     */
    private function setTotal(float $total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $free
     * @return $this
     */
    private function setFree(float $free): self
    {
        $this->free = $free;
        return $this;
    }

    /**
     * @return float
     */
    public function getFree(): float
    {
        return $this->free;
    }

    /**
     * @param int $locked
     * @return $this
     */
    private function setLocked(int $locked): self
    {
        $this->locked = (bool)$locked;
        return $this;
    }

    /**
     * @return bool
     */
    public function getLocked(): bool
    {
        return $this->locked;
    }
}