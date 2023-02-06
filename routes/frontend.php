<?php


//Route::post('forgot-password',[\App\Http\Controllers\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');

//Social login
Route::get('login/{provider}', [\App\Http\Controllers\Frontend\SocialController::class,'redirect']);
Route::get('login/{provider}/callback',[\App\Http\Controllers\Frontend\SocialController::class,'Callback']);

Route::get('/',[\App\Http\Controllers\Frontend\IndexController::class,'home'])->name('home');
Route::get('view-all/{key}',[\App\Http\Controllers\Frontend\ProductManagerController::class,'viewAllProducts'])->name('viewAllProducts');
Route::get('search-products',[\App\Http\Controllers\Frontend\ProductManagerController::class,'searchedProducts'])->name('search.products');
Route::get('category/{slug}',[\App\Http\Controllers\Frontend\ProductManagerController::class,'productCategory'])->name('product.category');
Route::get('category/{slug}/{cat_slug}',[\App\Http\Controllers\Frontend\IndexController::class,'productSubCategory'])->name('product.subcategory');
Route::get('product-detail/{slug}/',[\App\Http\Controllers\Frontend\ProductManagerController::class,'productDetail'])->name('product.detail');
Route::get('/get-product-price/{id}',[\App\Http\Controllers\ProductController::class,'filterPriceWithSize']);
Route::get('products',[\App\Http\Controllers\Frontend\IndexController::class,'products'])->name('products');
Route::get('product-filter',[\App\Http\Controllers\Frontend\ProductManagerController::class,'productFilter'])->name('product.filter');
Route::post('product-sub-filter/{slug}/{cat_slug}',[\App\Http\Controllers\Frontend\IndexController::class,'productSubFilter'])->name('product.subfilter');
Route::post('product-review/{slug}',[\App\Http\Controllers\ProductReviewController::class,'productReview'])->name('product.review');
//ajax load more reviews
Route::get('product-more-reviews/{id}',[\App\Http\Controllers\ProductReviewController::class,'loadReviews'])->name('load.reviews');

// product customization
Route::post('product-customize/{id}',[\App\Http\Controllers\Frontend\IndexController::class,'productCustomize'])->name('product.customize');
//Product search
Route::get('search',[\App\Http\Controllers\Frontend\ProductManagerController::class,'search'])->name('search');
//Cart section
Route::get('cart',[\App\Http\Controllers\Frontend\CartController::class,'cart'])->name('cart');
Route::post('single/cart/store',[\App\Http\Controllers\Frontend\CartController::class,'singleCartStore'])->name('single.cart.store');
Route::post('cart/delete',[\App\Http\Controllers\Frontend\CartController::class,'cartDelete'])->name('cart.delete');
Route::post('cart/update',[\App\Http\Controllers\Frontend\CartController::class,'cartUpdate'])->name('cart.update');

Route::post('variant_price',[\App\Http\Controllers\Frontend\CartController::class,'variant_price'])->name('variant_price');
Route::post('cart/add',[\App\Http\Controllers\Frontend\CartController::class,'cartAdd'])->name('add.to.cart');

//coupon section
Route::post('coupon/add',[\App\Http\Controllers\Frontend\CartController::class,'couponAdd'])->name('coupon.add');
Route::post('comment/add',[\App\Http\Controllers\Frontend\CartController::class,'commentAdd'])->name('comment.add');

//wishlist section
Route::get('wishlist',[\App\Http\Controllers\Frontend\WishlistController::class,'wishlist'])->name('wishlist');
Route::post('wishlist/store',[\App\Http\Controllers\Frontend\WishlistController::class,'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/move-to-cart',[\App\Http\Controllers\Frontend\WishlistController::class,'moveToCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete',[\App\Http\Controllers\Frontend\WishlistController::class,'wishlistDelete'])->name('wishlist.delete');

//Checkout Section
Route::get('checkout',[\App\Http\Controllers\Frontend\CheckoutController::class,'checkout'])->name('checkout')->middleware('auth');
Route::post('checkout',[\App\Http\Controllers\Frontend\CheckoutController::class,'checkoutStore'])->name('checkout.store');
Route::get('complete/{order}',[\App\Http\Controllers\Frontend\CheckoutController::class,'complete'])->name('complete');

//set shipping method
Route::get('set-shipping-method',[\App\Http\Controllers\ShippingController::class,'setShippingMethod'])->name('set.shipping.method');

//Order status
Route::get('order-status',[\App\Http\Controllers\Frontend\IndexController::class,'orderStatus'])->name('order-status');

Route::post('order-track',[\App\Http\Controllers\Frontend\IndexController::class,'orderTrack'])->name('order.track');

//search product & autosearch product
Route::get('autosearch',[\App\Http\Controllers\Frontend\IndexController::class,'autoSearch'])->name('autosearch');
Route::get('search',[\App\Http\Controllers\Frontend\IndexController::class,'search'])->name('search');

//contact page
Route::get('contact-us',[\App\Http\Controllers\Frontend\IndexController::class,'contactUs'])->name('contact.us');
Route::post('contact-us',[\App\Http\Controllers\ContactMessageController::class,'contactMessage'])->name('contact.submit');

//about us
Route::get('about-us',function (){
    return view('frontend.pages.inner.about');
})->name('about.us');

//Return Policy
Route::get('return-policy',function (){
    return view('frontend.pages.inner.return-policy');
})->name('frontend.return.policy');

//Shipping Payment
Route::get('shipping-payment',function (){
    return view('frontend.pages.inner.shipping-payment');
})->name('frontend.shipping.payment');

//Privacy Policy
Route::get('privacy-policy',function (){
    return view('frontend.pages.inner.privacy-policy');
})->name('frontend.privacy.policy');

//Terms & Conditions
Route::get('terms-conditions',function (){
    return view('frontend.pages.inner.terms-conditions');
})->name('frontend.terms.conditions');

//Cancellation & Policy
Route::get('cancellation-policy',function (){
    return view('frontend.pages.inner.cancellation-policy');
})->name('frontend.cancellation.policy');

//Cancellation & Policy
Route::get('site-map',function (){
    return view('frontend.pages.inner.site-map');
})->name('frontend.site-map');


//FAQ pages
Route::get('faq',function (){
    return view('frontend.pages.inner.faqs');
})->name('frontend.faq');

//Subscribers
Route::post('subscribe',[\App\Http\Controllers\Frontend\UserManagerController::class,'subscribe'])->name('subscribe');

//Razor payment
Route::get('razorpay', [\App\Http\Controllers\RazorpayController::class, 'razorpay'])->name('razorpay');
Route::post('razorpaypayment', [\App\Http\Controllers\RazorpayController::class, 'payment'])->name('payment');

//Paypal payment
//Paypal START
Route::get('/paypal/payment/done', [\App\Http\Controllers\PaypalController::class,'getDone'])->name('payment.done');
Route::get('/paypal/payment/cancel', [\App\Http\Controllers\PaypalController::class,'getCancel'])->name('payment.cancel');

//Place Order
Route::get('order-confirmed',function (){
    $order=\App\Models\Order::findOrFail(session()->get('order_id'));
    return view('frontend.pages.checkout.complete',compact('order'));
})->name('order.complete');

//Invoice Created
Route::get('invoice/{order_id}', [\App\Http\Controllers\OrderController::class,'invoiceDownload'])->name('invoice.download');

