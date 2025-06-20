<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\AccountRepository;

class ProductReview
{
    public int $id;
    public int $product_id;
    public int $user_id;
    public int $rating;
    public string $review;
    public string $created_at;

    private ?Account $account = null;

    public function getUser(): Account
    {
        if ($this->account !== null) {
            return  $this->account;
        }
        $this->account = AccountRepository::findById($this->user_id);
        /** @phpstan-ignore-next-line Der Account ist immer !== null  */
        return $this->account;
    }
}
