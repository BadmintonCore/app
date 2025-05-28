<?php

namespace Vestis\Utility;

class PaginationUtility
{

    public static function getCurrentPage(): int
    {
        $page = intval($_GET['page'] ?? 1);
        if ($page < 1) {
            $page = 1;
        }
        return $page;
    }

    public static function generatePagination(int $total, int $perPage, int $currentPage): void {
        $pages = ceil($total / $perPage);
        $pathname = PathUtility::getPathname();

        echo '<div class="pagination">';
        for ($i = 1; $i <= $pages; $i++) {
            if ($i == $currentPage) {
                echo '<a class="page-link active" href="'.$pathname.'?page='.$i.'">'.$i.'</a>';
            } else {
                echo '<a class="page-link" href="'.$pathname.'?page='.$i.'">'.$i.'</a>';
            }
        }
        echo '</div>';
    }

}