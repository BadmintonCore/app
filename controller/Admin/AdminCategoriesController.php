<?php

namespace Vestis\Controller\Admin;

class AdminCategoriesController
{

    public function index(): void
    {
        require_once __DIR__.'/../../views/admin/categories/list.php';
    }

}