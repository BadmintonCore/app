<?php

//Autor(en): Lennart Moog

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\ProductReview;
use Vestis\Database\Repositories\QueryAbstraction;

class ReviewRepository
{
    /**
     * Erstellt eine neue Produktbewertung
     *
     * @param int $productId Die ID des Produkts
     * @param int $userId Die ID des Nutzers
     * @param int $rating Bewertung (1-5)
     * @param string $review Der Bewertungstext
     * @return ProductReview|null
     */
    public static function create(int $productId, int $userId, int $rating, string $review): ?ProductReview
    {
        return QueryAbstraction::executeReturning(
            ProductReview::class,
            "INSERT INTO product_reviews (product_id, user_id, rating, review) 
             VALUES (:product_id, :user_id, :rating, :review)",
            [
                'product_id' => $productId,
                'user_id' => $userId,
                'rating' => $rating,
                'review' => $review
            ]
        );
    }
    /**
     * Lädt alle Bewertungen eines Produkts
     *
     * @param int $productId Die ID des Produkts
     * @return ProductReview[]
     */
    public static function getAllReviews(int $productId): array
    {
        return QueryAbstraction::fetchManyAs(ProductReview::class, "SELECT * FROM product_reviews WHERE product_id = :productId ORDER BY created_at DESC", [
            'productId' => $productId
        ]);
    }

    public static function hasUserReviewed(int $productId, int $userId): int
    {
        $query = "SELECT COUNT(*) as count FROM product_reviews WHERE product_id = :productId AND user_id = :userId";
        $result = QueryAbstraction::fetchOneAs(null, $query, [
            'productId' => $productId,
            'userId' => $userId
        ]);
        return (int)($result['count'] ?? 0);
    }


}
//Autor(en): Lennart Moog
