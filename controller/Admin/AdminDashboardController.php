<?php
/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Service\AuthService;

/**
 * Controller für das Dashboard
 */
class AdminDashboardController
{
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        require_once __DIR__.'/../../views/admin/dashboard.php';
    }

}
