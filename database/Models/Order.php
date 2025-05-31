<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\AccountRepository;
use Vestis\Database\Repositories\ProductRepository;

class Order
{
    public int $id;

    public int $accountId;

    public \DateTime $timestamp;

    public OrderStatus $status;

    private ?Account $account = null;

    public function getProducts(): array
    {
        return ProductRepository::findForOrder($this->id);
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