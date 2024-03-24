<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FeeShipController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeControllder;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaticticalController;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Statistical;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ShipperController;

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

Route::get('/', [HomeController::class, 'index']);

Route::get('trang-chu', [HomeController::class, 'index']);



Route::get('admin', [AdminController::class, 'login']);
Route::get('admin_index', [StaticticalController::class, 'statistical']);
Route::post('login_admin', [AdminController::class, 'check_login']);
Route::get('logout_admin', [AdminController::class, 'logout_admin']);
// Category
Route::get('add_category_product', [CategoryProductController::class, 'add_category_product']);
Route::get('all_category_product', [CategoryProductController::class, 'all_category_product']);
Route::get('update_category/{id}', [CategoryProductController::class, 'update_category_product']);
Route::get('delete_category/{id}', [CategoryProductController::class, 'delete_category_product']);
Route::post('save_category_product', [CategoryProductController::class, 'save_category_product']);
Route::post('save_update_category_product/{id}', [CategoryProductController::class, 'save_update_category_product']);

Route::get('unactive_category_product/{id_category_product}', [CategoryProductController::class, 'unactive_category_product']);
Route::get('active_category_product/{id_category_product}', [CategoryProductController::class, 'active_category_product']);

Route::get('filter_status_category', [CategoryProductController::class, 'filter_status_category']);
Route::get('search_category', [CategoryProductController::class, 'search_category']);
// Brand

Route::get('add_brand_product', [BrandProductController::class, 'add_brand_product']);
Route::get('all_brand_product', [BrandProductController::class, 'all_brand_product']);
Route::get('update_brand/{id}', [BrandProductController::class, 'update_brand_product']);
Route::get('delete_brand/{id}', [BrandProductController::class, 'delete_brand_product']);
Route::post('save_brand_product', [BrandProductController::class, 'save_brand_product']);
Route::post('save_update_brand_product/{id}', [BrandProductController::class, 'save_update_brand_product']);

Route::get('unactive_brand_product/{id_brand_product}', [BrandProductController::class, 'unactive_brand_product']);
Route::get('active_brand_product/{id_brand_product}', [BrandProductController::class, 'active_brand_product']);

Route::get('filter_status_brand', [BrandProductController::class, 'filter_status_brand']);
Route::get('search_brand', [BrandProductController::class, 'search_brand']);

// Product
Route::get('add_product', [ProductController::class, 'add_product']);
Route::get('all_product', [ProductController::class, 'all_product']);
Route::post('save_product', [ProductController::class, 'save_product']);

Route::get('edit_product/{id_product}', [ProductController::class, 'edit_product']);
Route::get('delete_product/{id_product}', [ProductController::class, 'delete_product']);
Route::post('update_product/{id_product}', [ProductController::class, 'update_product']);

Route::get('unactive_product/{id_product}', [ProductController::class, 'unactive_product']);
Route::get('active_product/{id_product}', [ProductController::class, 'active_product']);

Route::get('search_product_admin', [ProductController::class, 'search_product_admin']);
Route::get('filter_search', [ProductController::class, 'filter_search']);

// Receipt
Route::get('add_receipt', [ReceiptController::class, 'add_receipt']);
Route::post('save_receipt', [ReceiptController::class, 'save_receipt']);
Route::get('add_detail_receipt', [ReceiptController::class, 'add_detail_receipt']);
Route::post('save_detail_receipt', [ReceiptController::class, 'save_detail_receipt']);
Route::get('all_receipts', [ReceiptController::class, 'all_receipts']);
Route::get('detail_receipt/{id}', [ReceiptController::class, 'detail_receipt']);
Route::post('update_status_receipt/{id}', [ReceiptController::class, 'update_status_receipt']);
Route::get('search_product_receipt_admin', [ReceiptController::class, 'search_product_receipt_admin']);

Route::get('filter_product_receipt_search', [ReceiptController::class, 'filter_product_receipt_search']);
Route::get('filter_receipt', [ReceiptController::class, 'filter_receipt']);


// Gallery product
Route::get('add_gallery/{id}', [GalleryController::class, 'add_gallery_product']);
Route::post('load_gallery', [GalleryController::class, 'load_gallery']);
Route::post('insert_gallery', [GalleryController::class, 'insert_gallery']);
Route::get('delete_gallery/{id}', [GalleryController::class, 'delete_gallery']);

// Comment
Route::post('load_comment', [CommentController::class, 'load_comment']);
Route::post('send_comment', [CommentController::class, 'send_comment']);

Route::get('list_comment', [CommentController::class, 'list_comment']);
Route::get('delete_comment/{id}', [CommentController::class, 'delete_comment']);

Route::get('search_comment_admin', [CommentController::class, 'search_comment_admin']);
// Rating
Route::post('add_rating', [CommentController::class, 'add_rating']);
Route::get('test', [ProductController::class, 'get_product']);


// Statistical
Route::get('statistical', [StaticticalController::class, 'statistical']);
Route::post('filter_day', [StaticticalController::class, 'filter_day']);
Route::post('filter_statistic', [StaticticalController::class, 'filter_statistic']);
Route::post('filter_30_day_auto', [StaticticalController::class, 'filter_30_day_auto']);

// Account users
Route::get('account_users', [UserController::class, 'account_users']);
Route::get('search_account_users', [UserController::class, 'search_account_users']);
Route::get('delete_account_user/{id}', [UserController::class, 'delete_account_user']);

// Account admin
Route::get('account_admins', [UserController::class, 'account_admins']);
Route::get('search_account_admins', [UserController::class, 'search_account_admins']);
Route::get('delete_account_admin/{id}', [UserController::class, 'delete_account_admin']);
Route::get('delete_account_shipper/{id}', [UserController::class, 'delete_account_shipper']);
Route::get('create_account', [AdminController::class, 'create_account']);
Route::post('save_account_by_admin', [AdminController::class, 'save_account_by_admin']);

// list order
Route::get('list_order', [OrderController::class, 'list_order']);
Route::get('order_detail1/{id}', [OrderController::class, 'order_detail']);
Route::get('delete_order/{id}', [OrderController::class, 'delete_order']);
Route::post('update_status_order/{id}', [OrderController::class, 'update_status_order']);

Route::get('filter_status_order', [OrderController::class, 'filter_status_order']);
Route::get('search_order', [OrderController::class, 'search_order']);

// list customer order
Route::get('list_customer_order', [ShippingController::class, 'list_customer_order']);
Route::get('delete_customer_order/{id}', [ShippingController::class, 'delete_customer_order']);
Route::get('filter_status_order_customer', [ShippingController::class, 'filter_status_order_customer']);

Route::get('search_customer', [ShippingController::class, 'search_customer']);

// slider
Route::get('manager_slider', [SliderController::class, 'manager_slider']);
Route::get('add_slider', [SliderController::class, 'add_slider']);
Route::post('save_slider', [SliderController::class, 'save_slider']);
Route::get('unactive_slider/{id_slider}', [SliderController::class, 'unactive_slider']);
Route::get('active_slider/{id_slider}', [SliderController::class, 'active_slider']);
Route::get('delete_slider/{id_slider}', [SliderController::class, 'delete_slider']);
Route::get('update_slider/{id}', [SliderController::class, 'update_slider']);

Route::post('save_update_slider/{id}', [SliderController::class, 'save_update_slider']);

Route::post('filter_status_slider', [SliderController::class, 'filter_status_slider']);
Route::post('search_slider', [SliderController::class, 'search_slider']);

// Fee ship
Route::get('add_fee_ship', [FeeShipController::class, 'add_fee_ship']);
Route::post('select_delivery', [FeeShipController::class, 'select_delivery']);
Route::post('save_fee_ship', [FeeShipController::class, 'save_fee_ship']);
Route::post('load_fee', [FeeShipController::class, 'load_fee']);
Route::post('update_fee', [FeeShipController::class, 'update_fee']);




// Front end
Route::get('search', [HomeController::class, 'search']);
Route::get('filter_home', [HomeController::class, 'filter_home']);
Route::get('category_product/{id}', [HomeController::class, 'get_product_by_cate']);
Route::get('brand_product/{id}', [HomeController::class, 'get_product_by_brand']);

Route::get('detail_product/{product_id}', [ProductController::class, 'show_detail_product']);

// Cart
Route::post('save_cart', [CartController::class, 'save_cart']);
Route::post('save_cart_and_checkout', [CartController::class, 'save_cart_and_checkout']);
Route::get('show_cart', [CartController::class, 'show_cart']);
Route::get('delete_product_cart/{row_id}', [CartController::class, 'delete_product_cart']);
Route::post('update_cart_qty', [CartController::class, 'update_qty']);

// Đăng kí đăng nhập
Route::get('login_customer', [UserController::class, 'login_customer_page']);
Route::get('regist', [UserController::class, 'regist']);
Route::post('add_customer', [UserController::class, 'add_customer']);
Route::post('login_customer', [UserController::class, 'login_customer']);
Route::get('logout', [UserController::class, 'logout_customer']);
// Checkout
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('login_checkout', [CheckoutController::class, 'login_checkout']);
Route::post('save_checkout', [CheckoutController::class, 'save_checkout']);
Route::post('select_address', [CheckoutController::class, 'select_address']);
Route::post('add_fee', [CheckoutController::class, 'add_fee']);

// send mail
Route::get('send_mail', [MailController::class, 'send_mail']);

// info customer
Route::get('info_customer/{id}', [UserController::class, 'info_customer']);
Route::get('my_list_order/{id}', [UserController::class, 'my_list_order']);
Route::post('filter_list_order', [UserController::class, 'filter_list_order']);
Route::get('update_info/{id}', [UserController::class, 'update_info']);
Route::post('save_update_info/{id}', [UserController::class, 'save_update_info']);
Route::post('cancel_order/{id}', [UserController::class, 'cancel_order']);

Route::get('test', function () {
    return view('mail');
});

// Shipper
Route::get('login_shipper', [ShipperController::class, 'login_shipper']);
Route::get('logout_shipper', [ShipperController::class, 'logout_shipper']);
Route::post('check_login_shipper', [ShipperController::class, 'check_login_shipper']);

Route::get('shipper_index', [ShipperController::class, 'shipper_index']);
Route::get('list_orders_success', [ShipperController::class, 'list_orders_success']);
Route::get('list_orders_remain', [ShipperController::class,  'list_orders_remain']);
Route::get('order_detail_shipper_screen/{id}', [ShipperController::class, 'order_detail_shipper_screen']);
Route::get('respond_delivery/{id}', [ShipperController::class, 'respond_delivery']);

Route::post('update_status_order_shipper/{id}', [ShipperController::class, 'update_status_order_shipper']);
Route::get('search_order_shipper', [ShipperController::class, 'search_order_shipper']);

Route::get('account_shipper', [UserController::class, 'account_shipper']);
