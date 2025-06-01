<?php

use Vestis\Controller\AboutUsController;
use Vestis\Controller\Admin\AdminCategoriesController;
use Vestis\Controller\Admin\AdminColorsController;
use Vestis\Controller\Admin\AdminCustomersController;
use Vestis\Controller\Admin\AdminDashboardController;
use Vestis\Controller\Admin\AdminImagesController;
use Vestis\Controller\Admin\AdminOrderController;
use Vestis\Controller\Admin\AdminProductController;
use Vestis\Controller\Admin\AdminProductTypesController;
use Vestis\Controller\Admin\AdminSizesController;
use Vestis\Controller\AuthController;
use Vestis\Controller\CategoriesController;
use Vestis\Controller\CustomerServiceController;
use Vestis\Controller\HomeController;
use Vestis\Controller\LegalController;
use Vestis\Controller\OrderController;
use Vestis\Controller\ProductController;
use Vestis\Controller\SystemController;
use Vestis\Controller\UserAreaController;
use Vestis\Controller\YourPurchaseController;
use Vestis\Controller\NewsletterController;

return [
    '/' => [HomeController::class, 'index'],
    '/categories' => [CategoriesController::class, 'index'],
    '/categories/product' => [ProductController::class, 'index'],
    '/about-us/about' => [AboutUsController::class, 'about'],
    '/about-us/jobs' => [AboutUsController::class, 'jobs'],
    '/about-us/press' => [AboutUsController::class, 'press'],
    '/about-us/responsibility' => [AboutUsController::class, 'responsibility'],
    '/auth/login' => [AuthController::class, 'login'],
    '/auth/logout' => [AuthController::class, 'logout'],
    '/auth/registration' => [AuthController::class, 'register'],
    '/auth/reset' => [AuthController::class, 'resetPassword'],
    '/auth/deleteConfirmation' => [AuthController::class, 'deleteConfirmation'],
    '/customer-service/contact' => [CustomerServiceController::class, 'contact'],
    '/customer-service/faq' => [CustomerServiceController::class, 'faq'],
    '/customer-service/returns' => [CustomerServiceController::class, 'returns'],
    '/legal/gtc' => [LegalController::class, 'gtc'],
    '/legal/impress' => [LegalController::class, 'impress'],
    '/legal/privacypolicy' => [LegalController::class, 'privacy'],
    '/legal/revocation' => [LegalController::class, 'revocation'],
    '/user-area' => [UserAreaController::class, 'index'],
    '/user-area/shoppingCart' => [UserAreaController::class, 'shoppingCart'],
    '/user-area/shoppingCart/purchase' => [UserAreaController::class, 'purchase'],
    '/user-area/shoppingCart/delete' => [UserAreaController::class, 'removeShoppingCartItem'],
    '/user-area/user' => [UserAreaController::class, 'user'],
    '/user-area/wishlist' => [UserAreaController::class, 'wishlist'],
    '/user-area/orders' => [OrderController::class, 'orders'],
    '/user-area/orders/view' => [OrderController::class, 'orderDetails'],
    '/user-area/orders/cancel' => [OrderController::class, 'cancelOrder'],
    '/your-purchase/order' => [YourPurchaseController::class, 'order'],
    '/your-purchase/paymentmethods' => [YourPurchaseController::class, 'paymentMethods'],
    '/your-purchase/shipment' => [YourPurchaseController::class, 'shipment'],
    '/your-purchase/vouchers' => [YourPurchaseController::class, 'vouchers'],
    '/newsletter/subscribe' => [NewsletterController::class, 'subscribe'],
    '/admin' => [AdminDashboardController::class, 'index'],
    '/admin/categories' => [AdminCategoriesController::class, 'index'],
    '/admin/categories/edit' => [AdminCategoriesController::class, 'edit'],
    '/admin/categories/create' => [AdminCategoriesController::class, 'create'],
    '/admin/categories/delete' => [AdminCategoriesController::class, 'delete'],
    '/admin/colors' => [AdminColorsController::class, 'index'],
    '/admin/colors/edit' => [AdminColorsController::class, 'edit'],
    '/admin/colors/create' => [AdminColorsController::class, 'create'],
    '/admin/colors/delete' => [AdminColorsController::class, 'delete'],
    '/admin/sizes' => [AdminSizesController::class, 'index'],
    '/admin/sizes/edit' => [AdminSizesController::class, 'edit'],
    '/admin/sizes/create' => [AdminSizesController::class, 'create'],
    '/admin/sizes/delete' => [AdminSizesController::class, 'delete'],
    '/admin/productTypes' => [AdminProductTypesController::class, 'index'],
    '/admin/productTypes/edit' => [AdminProductTypesController::class, 'edit'],
    '/admin/productTypes/create' => [AdminProductTypesController::class, 'create'],
    '/admin/productTypes/delete' => [AdminProductTypesController::class, 'delete'],
    '/admin/productTypes/assignImages' => [AdminProductTypesController::class, 'assignImages'],
    '/admin/productTypes/instances' => [AdminProductController::class, 'index'],
    '/admin/productTypes/instances/create' => [AdminProductController::class, 'create'],
    '/admin/images' => [AdminImagesController::class, 'index'],
    '/admin/images/create' => [AdminImagesController::class, 'create'],
    '/admin/images/delete' => [AdminImagesController::class, 'delete'],
    '/admin/images/view' => [AdminImagesController::class, 'view'],
    '/admin/orders' => [AdminOrderController::class, 'index'],
    '/admin/orders/view' => [AdminOrderController::class, 'details'],
    '/admin/orders/deny' => [AdminOrderController::class, 'deny'],
    '/admin/orders/confirmPayment' => [AdminOrderController::class, 'confirmPayment'],
    '/admin/orders/confirmShipment' => [AdminOrderController::class, 'confirmShipment'],
    '/admin/customers' => [AdminCustomersController::class, 'index'],
    '/admin/customers/toggleBlock' => [AdminCustomersController::class, 'toggleBlock'],
    '/system/exchangeRates' => [SystemController::class, 'getExchangeRates'],
];
