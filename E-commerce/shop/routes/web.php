<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginC;
use App\Http\Controllers\admin\DashboardC;
use App\Http\Controllers\admin\CategoryC;
use App\Http\Controllers\admin\SubCategoryC;
use App\Http\Controllers\admin\BrandC;
use App\Http\Controllers\admin\ProductC;
use App\Http\Controllers\admin\ShippingC;
use App\Http\Controllers\admin\DiscountCodeC;
use App\Http\Controllers\admin\OrderC;
use App\Http\Controllers\admin\TempImagesC;
use App\Http\Controllers\admin\ProductImageC;
use App\Http\Controllers\admin\UserC;
use App\Http\Controllers\admin\PageC;
use App\Http\Controllers\admin\SettingC;
use Illuminate\Http\Request;

use App\Http\Controllers\FrontC;
use App\Http\Controllers\ShopC;
use App\Http\Controllers\CartC;
use App\Http\Controllers\AuthC;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//Route::get('/test',function(){
 //orderEmail(13);
//});
/*Frontend*/


Route::get('/',[FrontC::class,'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopC::class,'index'])->name('front.shop');
Route::get('/product/{slug}',[ShopC::class,'product'])->name('front.product');


Route::get('/cart',[CartC::class,'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartC::class,'addToCart'])->name('front.addToCart');
Route::post('/update-cart',[CartC::class,'updateCart'])->name('front.updateCart');
Route::post('/delete-item',[CartC::class,'deleteItem'])->name('front.deleteItem.cart');

Route::get('/checkout',[CartC::class,'checkout'])->name('front.checkout');
Route::post('/process-checkout',[CartC::class,'processCheckout'])->name('front.processCheckout');

Route::get('/thanks/{orderId}',[CartC::class,'thankyou'])->name('front.thanks');

Route::post('/get-order-summary',[CartC::class,'getOrderSummary'])->name('front.getOrderSummary');

Route::post('/apply-discount',[CartC::class,'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount',[CartC::class,'removeCoupon'])->name('front.removeCoupon');

Route::post('/add-to-wishlist',[FrontC::class,'addToWishlist'])->name('front.addToWishlist');

Route::get('/page/{slug}',[FrontC::class,'page'])->name('front.page');

Route::post('/send-contact-email',[FrontC::class,'sendContactEmail'])->name('front.sendContactEmail');



Route::get('/forgot-password',[AuthC::class,'forgotPassword'])->name('front.forgotPassword');
Route::post('/process-forgot-password',[AuthC::class,'processForgotPassword'])->name('front.processForgotPassword');
Route::get('/reset-password/{token}',[AuthC::class,'resetPassword'])->name('front.resetPassword');
Route::post('/process-reset-password',[AuthC::class,'processResetPassword'])->name('front.processResetPassword');
Route::post('/save-rating/{productId}',[ShopC::class,'saveRating'])->name('front.saveRating');

/*User Account*/

Route::group(['prefix' => 'account'],function(){
    Route::group(['middleware' => 'guest'], function(){

        Route::get('/login',[AuthC::class,'login'])->name('account.login');
        Route::post('/login',[AuthC::class,'authenticate'])->name('account.authenticate');

        Route::get('/register',[AuthC::class,'register'])->name('account.register');
        Route::post('/process-register',[AuthC::class,'processRegister'])->name('account.processRegister');


    });

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/profile',[AuthC::class,'profile'])->name('account.profile');
        Route::post('/update-profile',[AuthC::class,'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address',[AuthC::class,'updateAddress'])->name('account.updateAddress');
        Route::get('/my-orders',[AuthC::class,'orders'])->name('account.orders');
        Route::get('/my-wishlist',[AuthC::class,'wishlist'])->name('account.wishlist');
        Route::post('/remove-product-from-wishlist',[AuthC::class,'removeProductFromWishlist'])->name('account.removeProductFromWishlist');
        Route::get('/order-detail/{orderId}',[AuthC::class,'orderDetail'])->name('account.orderDetail');
        Route::get('/change-password',[AuthC::class,'changePasswordForm'])->name('account.changePasswordForm');
        Route::post('/process-change-password',[AuthC::class,'changePassword'])->name('account.changePassword');
        Route::get('/logout',[AuthC::class,'logout'])->name('account.logout');


    });

});

/*Backend*/


Route::group(['prefix' => 'admin'],function(){

    Route::group(['middleware' => 'admin.guest'], function(){
        Route::get('/login', [AdminLoginC::class,'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginC::class,'authenticate'])->name('admin.authenticate');

    });

    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('/dashboard', [DashboardC::class,'index'])->name('admin.dashboard');
        Route::get('/logout', [DashboardC::class,'logout'])->name('admin.logout');

        Route::resource('category', CategoryC::class);
        Route::resource('subcat', SubCategoryC::class);
        Route::resource('brand', BrandC::class);
        Route::get('/rating', [ProductC::class,'productRating'])->name('product.productRating');
        Route::get('/change-rating-status', [ProductC::class,'changeRatingStatus'])->name('product.changeRatingStatus');
        Route::resource('product', ProductC::class);
        Route::resource('shipping', ShippingC::class);
        Route::resource('coupons', DiscountCodeC::class);
        Route::get('/order/{id}', [OrderC::class,'detail'])->name('order.detail');
        Route::post('/order/send-email/{id}', [OrderC::class,'sendInvoiceEmail'])->name('order.sendInvoiceEmail');
        Route::resource('order', OrderC::class);
        Route::resource('user', UserC::class);
        Route::resource('page', PageC::class);
        //Route::get('/detail', [OrderC::class,'detail'])->name('order.detail');

        Route::get('/get-products', [ProductC::class,'getProducts'])->name('product.getProducts');

        Route::post('/upload-temp-image', [TempImagesC::class,'create'])->name('temp-images.create');

        Route::post('/product-images/update', [ProductImageC::class,'update'])->name('product-images.update');
        Route::delete('/product-images', [ProductImageC::class,'destroy'])->name('product-images.destroy');
        
        
        //Setting
        Route::get('/change-password', [SettingC::class,'changePasswordForm'])->name('admin.changePasswordForm');
        Route::post('/process-change-password',[SettingC::class,'changePassword'])->name('admin.changePassword');


        Route::get('/getSlug',function(Request $request)
        {
            $slug='';
            if (!empty($request->title)){
            $slug = Str::slug($request->title);
        }

        return response()->json([
            'status' =>true,
            'slug' => $slug
        ]);
        })->name('getSlug');

    });

});