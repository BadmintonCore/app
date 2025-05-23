<?php

use Vestis\Controller\AboutUsController;
use Vestis\Controller\AuthController;
use Vestis\Controller\CategoriesController;
use Vestis\Controller\CustomerServiceController;
use Vestis\Controller\HomeController;
use Vestis\Controller\LegalController;
use Vestis\Controller\ProductController;
use Vestis\Controller\UserAreaController;
use Vestis\Controller\YourPurchaseController;

return [
    '/' => [HomeController::class, 'index'],
    '/categories' => [CategoriesController::class, 'index'],
    '/categories/clothes' => [CategoriesController::class, 'clothes'],
    '/categories/accesories' => [CategoriesController::class, 'accesories'],
    '/categories/product' => [ProductController::class, 'index'],
    '/about-us/about' => [AboutUsController::class, 'about'],
    '/about-us/jobs' => [AboutUsController::class, 'jobs'],
    '/about-us/press' => [AboutUsController::class, 'press'],
    '/about-us/responsibility' => [AboutUsController::class, 'responsibility'],
    '/auth/login' => [AuthController::class, 'login'],
    '/auth/logout' => [AuthController::class, 'logout'],
    '/auth/registration' => [AuthController::class, 'register'],
    '/auth/reset' => [AuthController::class, 'resetPassword'],
    '/customer-service/contact' => [CustomerServiceController::class, 'contact'],
    '/customer-service/faq' => [CustomerServiceController::class, 'faq'],
    '/customer-service/returns' => [CustomerServiceController::class, 'returns'],
    '/legal/gtc' => [LegalController::class, 'gtc'],
    '/legal/impress' => [LegalController::class, 'impress'],
    '/legal/privacypolicy' => [LegalController::class, 'privacy'],
    '/legal/revocation' => [LegalController::class, 'revocation'],
    '/user-area/shoppingCart' => [UserAreaController::class, 'shoppingCart'],
    '/user-area/user' => [UserAreaController::class, 'user'],
    '/user-area/wishlist' => [UserAreaController::class, 'wishlist'],
    '/your-purchase/order' => [YourPurchaseController::class, 'order'],
    '/your-purchase/paymentmethods' => [YourPurchaseController::class, 'paymentMethods'],
    '/your-purchase/shipment' => [YourPurchaseController::class, 'shipment'],
    '/your-purchase/vouchers' => [YourPurchaseController::class, 'vouchers'],
];
