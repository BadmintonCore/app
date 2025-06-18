<?php

namespace Vestis\Database\Models;

class ProductReview
{
    public int $id;
    public int $product_id;
    public int $user_id;
    public int $rating;
    public string $review;
    public string $created_at;
}
