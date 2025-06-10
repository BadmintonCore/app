<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\AccountRepository;
use Vestis\Database\Repositories\ProductRepository;

/**
 * Das Auftrag-Modell in der DB
 */
class Order
{
    public int $id;

    public int $accountId;

    public \DateTime $timestamp;

    public OrderStatus $status;

    public ?string $denialMessage;

    public ?string $discountMessage = "";

    public float $discount = 0.0;

    private ?Account $account = null;

    /**
     * @var array<int, Product>|null
     */
    private ?array $products = null;

    /**
     * @return array<int, Product>
     */



    public function getProducts(): array
    {
        if ($this->products !== null) {
            return $this->products;
        }
        $this->products = ProductRepository::findForOrder($this->id);
        return $this->products;
    }

    public function getDiscountedSum(): float
    {
        $orderSum = $this->getOrderSum();
        return $orderSum * (1 - $this->discount);
    }

    public function getOrderSum(): float
    {
        return array_reduce($this->getProducts(), function (float $sum, Product $product): float {
            return $sum + ($product->boughtPrice ?? 0);
        }, 0.0);
    }

    public function getAccount(): Account
    {
        if ($this->account !== null) {
            return $this->account;
        }
        $this->account = AccountRepository::findById($this->accountId);
        /** @phpstan-ignore-next-line Der Account ist immer !== null  */
        return $this->account;
    }
}
