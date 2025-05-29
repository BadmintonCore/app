<?php

namespace Vestis\Utility;

class PaginationUtility
{
    public static function getCurrentPage(): int
    {
        /** @var bool|float|int|string|null $pageParam */
        $pageParam = $_GET['page'] ?? 1;
        $page = intval($pageParam);
        if ($page < 1) {
            $page = 1;
        }
        return $page;
    }

    public static function generatePagination(int $total, int $perPage, int $currentPage, bool $useFormSubmit = false): void
    {
        $pages = ceil($total / $perPage);
        $pathname = PathUtility::getPathname();


        echo '<div class="pagination">';
        for ($i = 1; $i <= $pages; $i++) {
            if ($i === $currentPage) {
                if ($useFormSubmit) {
                    echo '<button class="page-link active" type="submit" name="pagination" value="' . $i .'">'.$i.'</button>';
                } else {
                    echo '<a class="page-link active" href="'.$pathname.'?'.self::generateSearchLink($i).'">'.$i.'</a>';
                }
            } else {
                if ($useFormSubmit) {
                    echo '<button class="page-link" type="submit" name="pagination" value="' . $i .'">'.$i.'</button>';
                } else {
                    echo '<a class="page-link" href="'.$pathname.'?'.self::generateSearchLink($i).'">'.$i.'</a>';
                }
            }
        }
        echo '</div>';
    }

    public static function generateSearchLink(int $page): string
    {
        $params = $_GET;
        $params['page'] = $page;
        return http_build_query($params);
    }

}
