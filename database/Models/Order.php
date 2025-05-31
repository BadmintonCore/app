<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\ProductRepository;

class Order
{
    public int $id;

    public int $accountId;

    public \DateTime $timestamp;

    public string $status;

    public function getProducts(): array
    {
        return ProductRepository::findForOrder($this->id);
    }
}