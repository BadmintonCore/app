<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\AccountRepository;

/**
 * Das Model für einen Warenkorb in der Datenbank
 */
class ShoppingCart
{

    public const int DEFAULT_CART_NUMBER = 1;

    public int $accId;

    public int $cartNumber;

    public ?string $name;

    public bool $isShared;

    public string $inviteSecret;

    private ?Account $account = null;

    public function getAccount(): Account
    {
        if ($this->account !== null) {
            return $this->account;
        }
        $this->account = AccountRepository::findById($this->accId);
        /** @phpstan-ignore-next-line Der Account ist immer !== null */
        return $this->account;
    }
}
