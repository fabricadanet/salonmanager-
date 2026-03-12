<?php
require_once __DIR__ . '/../core/Router.php';

$router = new Router();

// Public Routes
$router->get('/', 'PublicController@index');
$router->get('/servicos', 'PublicController@services');
$router->get('/produtos', 'PublicController@products');
$router->get('/agendar', 'PublicController@book');
$router->post('/agendar', 'PublicController@processBooking');
$router->get('/contato', 'PublicController@contact');

// Auth Routes
$router->get('/login', 'AuthController@index');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');

// Admin Routes (Dashboard)
$router->get('/admin', 'DashboardController@index');

// Customers CRUD
$router->get('/admin/customers', 'CustomerController@index');
$router->get('/admin/customers/create', 'CustomerController@create');
$router->post('/admin/customers/store', 'CustomerController@store');
$router->get('/admin/customers/edit', 'CustomerController@edit');
$router->post('/admin/customers/update', 'CustomerController@update');
$router->post('/admin/customers/delete', 'CustomerController@delete');

// Administrativo - Website Admin
$router->get('/admin/website', 'WebsiteController@index');
$router->post('/admin/website', 'WebsiteController@update');

// Administrativo - Módulo Financeiro
$router->get('/admin/finance', 'FinanceController@index');
$router->get('/admin/finance/transactions', 'FinanceController@transactions');
$router->post('/admin/finance/transactions/store', 'FinanceController@storeTransaction');
$router->post('/admin/finance/transactions/delete', 'FinanceController@deleteTransaction');
$router->post('/admin/finance/transactions/pay', 'FinanceController@payTransaction');
$router->get('/admin/finance/categories', 'FinanceController@categories');
$router->post('/admin/finance/categories/store', 'FinanceController@storeCategory');
$router->post('/admin/finance/categories/delete', 'FinanceController@deleteCategory');

// Administrativo - Usuários (Acessos)
$router->get('/admin/users', 'UserController@index');
$router->get('/admin/users/create', 'UserController@create');
$router->post('/admin/users/store', 'UserController@store');
$router->get('/admin/users/edit', 'UserController@edit');
$router->post('/admin/users/update', 'UserController@update');
$router->post('/admin/users/delete', 'UserController@delete');

// Services CRUD
$router->get('/admin/services', 'ServiceController@index');
$router->get('/admin/services/create', 'ServiceController@create');
$router->post('/admin/services/store', 'ServiceController@store');
$router->get('/admin/services/edit', 'ServiceController@edit');
$router->post('/admin/services/update', 'ServiceController@update');
$router->post('/admin/services/delete', 'ServiceController@delete');

// Products CRUD
$router->get('/admin/products', 'ProductController@index');
$router->get('/admin/products/create', 'ProductController@create');
$router->post('/admin/products/store', 'ProductController@store');
$router->get('/admin/products/edit', 'ProductController@edit');
$router->post('/admin/products/update', 'ProductController@update');
$router->post('/admin/products/delete', 'ProductController@delete');

// Sales (PDV)
$router->get('/admin/sales', 'SaleController@index');
$router->get('/admin/sales/create', 'SaleController@create');
$router->post('/admin/sales/store', 'SaleController@store');

// Stock Management
$router->get('/admin/stock', 'StockController@index');
$router->get('/admin/stock/movement', 'StockController@movementForm');
$router->get('/admin/stock/history', 'StockController@history');
$router->post('/admin/stock/store', 'StockController@storeMovement');

// Professionals CRUD
$router->get('/admin/professionals', 'ProfessionalController@index');
$router->get('/admin/professionals/create', 'ProfessionalController@create');
$router->post('/admin/professionals/store', 'ProfessionalController@store');
$router->get('/admin/professionals/edit', 'ProfessionalController@edit');
$router->post('/admin/professionals/update', 'ProfessionalController@update');
$router->post('/admin/professionals/delete', 'ProfessionalController@delete');

// Appointments CRUD & Calendar
$router->get('/admin/appointments', 'AppointmentController@index');
$router->get('/admin/appointments/api', 'AppointmentController@apiEvents');
$router->post('/admin/appointments/store', 'AppointmentController@store');
$router->post('/admin/appointments/status', 'AppointmentController@updateStatus');
$router->post('/admin/appointments/delete', 'AppointmentController@delete');

// Website Content CRUD
$router->get('/admin/content', 'WebsiteContentController@index');
$router->post('/admin/content/update', 'WebsiteContentController@update');

// SEO & Tracking
$router->get('/admin/seo', 'WebsiteContentController@seo');
$router->post('/admin/seo/update', 'WebsiteContentController@updateSeo');

return $router;
