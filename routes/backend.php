<?php
    /*==========================================
    =   Author: Prajwal Rai                                 =
    =   Author URI: https://raiprajwal.com                  =
    =   Author GITHUB URI: https://github.com/prajwal100    =
    =   Copyright (c) 2023                                  =
    ==========================================*/

    Route::get('admin',function (){
        return redirect()->route('admin.login');
    });

// Admin auth
Route::group(['prefix'=>'admin'],function(){
    Route::get('/login',[\App\Http\Controllers\Auth\Admin\LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login',[\App\Http\Controllers\Auth\Admin\LoginController::class,'login'])->name('admin.login.submit');
    Route::post('/logout',[\App\Http\Controllers\Auth\Admin\LoginController::class,'logout'])->name('admin.logout');
});

Route::group(['prefix'=>'dashboard','middleware'=>['admin']],function(){

    //Media Manager
    Route::get('media',[\App\Http\Controllers\FilemanagerController::class,'media'])->name('media.index');

    // file manager
    Route::get('/filemanager', [\App\Http\Controllers\FilemanagerController::class,'index'])->name('filemanager');
    Route::post('/filemanager/upload', [\App\Http\Controllers\FilemanagerController::class,'upload_file'])->middleware('optimizeImages');
    Route::post('/filemanager/folder', [\App\Http\Controllers\FilemanagerController::class,'create_folder']);
    Route::post('/filemanager/delete',  [\App\Http\Controllers\FilemanagerController::class,'delete']);
    Route::post('/filemanager/permanent-delete',  [\App\Http\Controllers\FilemanagerController::class,'permanentDelete']);

    Route::get('/',[\App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');

    // Profile edit
    Route::resource('/profile',\App\Http\Controllers\ProfileController::class);

    // Profile edit
//    Route::get('/profile',[\App\Http\Controllers\AdminController::class,'profile'])->name('profile');
//    Route::post('/profile/{id}',[\App\Http\Controllers\AdminController::class,'profileUpdate'])->name('profile.update');

    // password Change
    Route::get('/password-change',[\App\Http\Controllers\AdminController::class,'changePassword'])->name('changePassword');
    Route::post('/password-change', [\App\Http\Controllers\AdminController::class,'changePasswordStore'])->name('update.password');

    /******** start banner section *********/

    Route::resource('/banner',\App\Http\Controllers\BannerController::class);
    Route::get('home-banner',[\App\Http\Controllers\BannerController::class,'homeBanner'])->name('home.banner');
    Route::get('popup-banner',[\App\Http\Controllers\BannerController::class,'popupBanner'])->name('popup.banner');
    Route::get('promo-banner',[\App\Http\Controllers\BannerController::class,'promoBanner'])->name('promo.banner');
    Route::delete('banner-delete-all',[\App\Http\Controllers\BannerController::class,'deleteAll'])->name('banner.delete.all');

    /******** end banner section *********/

    /******** start category section *********/

    Route::resource('categories',\App\Http\Controllers\CategoryController::class);
    Route::delete('category-delete-all',[\App\Http\Controllers\CategoryController::class,'deleteAll'])->name('category.delete.all');

    /******** end category section *********/

    /******** start product section *********/

    Route::resource('/attributes',\App\Http\Controllers\AttributeController::class);

    Route::resource('attribute_values', \App\Http\Controllers\AttributeValueController::class);


    Route::resource('/product',\App\Http\Controllers\ProductController::class);
    Route::post('/products/update/{id}',[\App\Http\Controllers\ProductController::class,'update'])->name('products.update');
    Route::post('product_status',[\App\Http\Controllers\ProductController::class,'productStatus'])->name('product.status');
    Route::post('product_featured',[\App\Http\Controllers\ProductController::class,'productFeatured'])->name('product.featured');
    Route::post('sku-combination', [\App\Http\Controllers\ProductController::class,'sku_combination'])->name('product.sku-combination');

    Route::delete('product-delete-all',[\App\Http\Controllers\ProductController::class,'deleteAll'])->name('product.delete.all');


    Route::group(['prefix' => 'product'], function () {
        Route::post('/new-option', [\App\Http\Controllers\ProductController::class,'new_option'])->name('product.new_option');
        Route::post('/get-option-choices', [\App\Http\Controllers\ProductController::class,'get_option_choices'])->name('product.get_option_choices');
        Route::post('/sku-combination', [\App\Http\Controllers\ProductController::class,'sku_combination'])->name('product.sku_combination');
    });


    Route::post('product/new-attribute', [\App\Http\Controllers\ProductController::class,'new_attribute'])->name('product.new_attribute');
    Route::post('product/get-attribute-value', [\App\Http\Controllers\ProductController::class,'get_attribute_values'])->name('product.get_attribute.values');
    Route::post('/products/add-more-choice-option',[\App\Http\Controllers\ProductController::class,'add_more_choice_option'])->name('products.add-more-choice-option');
    Route::post('/products/sku_combination_edit',[\App\Http\Controllers\ProductController::class,'sku_combination_edit'])->name('products.sku_combination_edit');

    /******** end product section *********/


    /******** start order section *********/

    Route::resource('/orders',\App\Http\Controllers\OrderController::class);
    Route::post('order-status',[\App\Http\Controllers\OrderController::class,'orderStatus'])->name('order.status');
    Route::get('/order/pending',[\App\Http\Controllers\OrderController::class,'pendingOrder'])->name('pending.order');
    Route::get('/order/process',[\App\Http\Controllers\OrderController::class,'processOrder'])->name('process.order');
    Route::get('/order/delivered',[\App\Http\Controllers\OrderController::class,'deliveredOrder'])->name('delivered.order');
    Route::get('/order/cancelled',[\App\Http\Controllers\OrderController::class,'cancelledOrder'])->name('cancelled.order');

    /******** end order section *********/


    /******** start customer section *********/

    Route::resource('/customers',\App\Http\Controllers\CustomerController::class);
    Route::get('customer-control/{id}',[\App\Http\Controllers\CustomerController::class,'customerControl'])->name('customer.control');
    Route::delete('customer-delete-all',[\App\Http\Controllers\CustomerController::class,'deleteAll'])->name('customers.delete.all');

    /******** end customer section *********/

//    // Category Section
//    Route::resource('/category',\App\Http\Controllers\CategoryController::class);
//    Route::post('category_status',[\App\Http\Controllers\CategoryController::class,'categoryStatus'])->name('category.status');
//    Route::post('/category/{id}/child',[\App\Http\Controllers\CategoryController::class,'getChildByParentID']);
//    Route::get('category-pdf',[\App\Http\Controllers\ProductBulkController::class,'pdf_category_download'])->name('pdf.category');
//
//    // Product Section
//    Route::resource('/product',\App\Http\Controllers\ProductController::class);
//    Route::post('/products/update/{id}',[\App\Http\Controllers\ProductController::class,'update'])->name('products.update');
//    Route::post('product_status',[\App\Http\Controllers\ProductController::class,'productStatus'])->name('product.status');
//    Route::post('product_featured',[\App\Http\Controllers\ProductController::class,'productFeatured'])->name('product.featured');
//    Route::post('sku-combination', [\App\Http\Controllers\ProductController::class,'sku_combination'])->name('product.sku-combination');
//
//    //Product Attribute new
//
//    Route::post('product/new-attribute', [\App\Http\Controllers\ProductController::class,'new_attribute'])->name('product.new_attribute');
//    Route::post('product/get-attribute-value', [\App\Http\Controllers\ProductController::class,'get_attribute_values'])->name('product.get_attribute.values');
//    Route::post('/products/add-more-choice-option',[\App\Http\Controllers\ProductController::class,'add_more_choice_option'])->name('products.add-more-choice-option');
//    Route::post('/products/sku_combination_edit',[\App\Http\Controllers\ProductController::class,'sku_combination_edit'])->name('products.sku_combination_edit');
//
//    //Product Import & Export
//    Route::get('product-export',[\App\Http\Controllers\ProductBulkController::class,'export'])->name('products.export');
//    Route::get('product-import',[\App\Http\Controllers\ProductBulkController::class,'index'])->name('product.bulk.index');
//    Route::post('product-import',[\App\Http\Controllers\ProductBulkController::class,'import'])->name('product.import');
//
//
//    // Product Attribute section
//    Route::resource('/attributes',\App\Http\Controllers\AttributeController::class);
//
//    Route::resource('attribute_values', \App\Http\Controllers\AttributeValueController::class);
//
//    Route::group(['prefix' => 'product'], function () {
//        Route::post('/new-option', [\App\Http\Controllers\ProductController::class,'new_option'])->name('product.new_option');
//        Route::post('/get-option-choices', [\App\Http\Controllers\ProductController::class,'get_option_choices'])->name('product.get_option_choices');
////
//        Route::post('/sku-combination', [\App\Http\Controllers\ProductController::class,'sku_combination'])->name('product.sku_combination');
////
////
////        Route::get('/{id}/edit', 'ProductController@edit')->name('product.edit');
////        Route::get('/duplicate/{id}', 'ProductController@duplicate')->name('product.duplicate');
////        Route::post('/update/{id}', 'ProductController@update')->name('product.update');
////        Route::post('/published', 'ProductController@updatePublished')->name('product.published');
////        Route::get('/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
////
////        Route::post('/get_products_by_subcategory', 'ProductController@get_products_by_subcategory')->name('product.get_products_by_subcategory');
//    });
//
////    Route::post('products/attributes',[\App\Http\Controllers\AttributeController1::class,'productAttributeSubmit'])->name('products.attribute.submit');
////    Route::patch('products/attribute/{id}',[\App\Http\Controllers\AttributeController1::class,'productAttributeUpdate'])->name('products.attribute.update');
////    Route::get('products/attribute/edit/{id}',[\App\Http\Controllers\AttributeController1::class,'productAttribute'])->name('products.attribute.edit');
//
////
////    Route::get('product-attribute-assign/{id}',[\App\Http\Controllers\AttributeController1::class,'productAttributeAssign'])->name('product.attribute.assign');
////    Route::post('product-attribute-assign/{id}/child',[\App\Http\Controllers\AttributeController1::class,'productAttributeAssignAjax']);
////    Route::post('assign-product-attribute-submit',[\App\Http\Controllers\AttributeController1::class,'productAttributeAssignSubmit'])->name('assign.product.attribute.submit');
//
//    //Product Colors
//    Route::get('product-colors',[\App\Http\Controllers\AttributeController::class,'productColors'])->name('product.colors');
//    Route::post('product-colors',[\App\Http\Controllers\AttributeController1::class,'productColorsSubmit'])->name('product.colors.submit');
//    Route::get('product-colors/edit/{id}',[\App\Http\Controllers\AttributeController1::class,'productColors'])->name('product.colors.edit');
//    Route::patch('product-colors-update/{id}',[\App\Http\Controllers\AttributeController1::class,'productColorsUpdate'])->name('product.colors.update');
//    Route::delete('product-colors-destroy/{id}',[\App\Http\Controllers\AttributeController1::class,'productColorsDestroy'])->name('product.colors.destroy');
//
//
//    Route::post('product-attribute-image',[\App\Http\Controllers\AttributeController1::class,'productAttributeImage'])->name('product.attribute.image.add');
//    Route::patch('product-attribute-image-update/{id}',[\App\Http\Controllers\AttributeController1::class,'productAttributeImageUpdate'])->name('product.attribute.image.update');
//    Route::get('product-attribute-image-edit/{id}',[\App\Http\Controllers\AttributeController1::class,'productAttributeImageEdit'])->name('product.attribute.image.edit');
//
//    Route::delete('product-attribute-delete/{id}',[\App\Http\Controllers\AttributeController1::class,'productAttributeDelete'])->name('products.attribute.destroy');
//
//    Route::post('silhouette/add',[\App\Http\Controllers\AttributeController1::class,'silhouetteAdd'])->name('silhouette.add');
//    Route::delete('silhouette/delete/{id}',[\App\Http\Controllers\AttributeController1::class,'silhouetteDelete'])->name('silhouette.delete');
//
//    Route::post('neckline/add',[\App\Http\Controllers\AttributeController1::class,'necklineAdd'])->name('neckline.add');
//    Route::delete('neckline/delete/{id}',[\App\Http\Controllers\AttributeController1::class,'necklineDelete'])->name('neckline.delete');
//
//    // User & admin Section
//    Route::resource('/user',\App\Http\Controllers\UserController::class);
//    Route::post('user_status',[\App\Http\Controllers\UserController::class,'userStatus'])->name('user.status');
//
//    Route::get('/all-admin',[\App\Http\Controllers\UserController::class,'admins'])->name('admins');
//    Route::post('admin_status',[\App\Http\Controllers\UserController::class,'adminStatus'])->name('admin.status');
//    Route::delete('/delete-admin/{id}',[\App\Http\Controllers\UserController::class,'deleteAdmin'])->name('admin.destroy');
//    // Coupon Section
//    Route::resource('/coupon',\App\Http\Controllers\CouponController::class);
//    Route::post('coupon_status',[\App\Http\Controllers\CouponController::class,'couponStatus'])->name('coupon.status');
//
//
//    Route::resource('/client',\App\Http\Controllers\ClientController::class);
//    Route::post('client_status',[\App\Http\Controllers\ClientController::class,'clientStatus'])->name('client.status');
//
//    //Currency section
//
//    Route::resource('/currency',\App\Http\Controllers\CurrencyController::class);
//    Route::post('currency_status',[\App\Http\Controllers\CurrencyController::class,'currencyStatus'])->name('currency.status');
//
//    // Shipping Section
//    Route::resource('/shipping',\App\Http\Controllers\ShippingController::class);
//    Route::post('shipping_status',[\App\Http\Controllers\ShippingController::class,'shippingStatus'])->name('shipping.status');
//
//    // Order section
//    Route::get('order-export',[\App\Http\Controllers\OrderController::class,'export'])->name('orders.export');
//    Route::resource('/orders',\App\Http\Controllers\OrderController::class);
//    Route::post('order-status',[\App\Http\Controllers\OrderController::class,'orderStatus'])->name('order.status');
//
//    /******** start staff roles section *********/
//
//    Route::resource('/roles',\App\Http\Controllers\RoleController::class);
//
//    /******** end staff roles section *********/
//
//    /******** start staff section *********/
//
//    Route::resource('/staff',\App\Http\Controllers\StaffController::class);
//
//    /******** end staff section *********/
//
//    // Review Section
//    Route::resource('reviews',\App\Http\Controllers\ProductReviewController::class);
//    Route::post('review-status',[\App\Http\Controllers\ProductReviewController::class,'reviewStatus'])->name('review.status');

    //why choose us
    Route::resource('why-choose-us',\App\Http\Controllers\WhyChooseController::class);
    Route::post('why-choose-us-status',[\App\Http\Controllers\WhyChooseController::class,'whyChooseUsStatus'])->name('why-choose-us.status');

    //About us
    Route::get('about-us',[\App\Http\Controllers\Frontend\SettingController::class,'aboutUs'])->name('about-us');
    Route::patch('about-us/update',[\App\Http\Controllers\Frontend\SettingController::class,'aboutUsUpdate'])->name('about.us.update');

    //Faq section
    Route::resource('faq',\App\Http\Controllers\FaqController::class);
    Route::post('faq_status',[\App\Http\Controllers\FaqController::class,'faqStatus'])->name('faq.status');

    Route::get('return-policy',[\App\Http\Controllers\Frontend\SettingController::class,'returnPolicy'])->name('return.policy');
    Route::patch('return-policy/update',[\App\Http\Controllers\Frontend\SettingController::class,'returnPolicyUpdate'])->name('return.policy.update');

    Route::get('privacy-policy',[\App\Http\Controllers\Frontend\SettingController::class,'privacyPolicy'])->name('privacy.policy');
    Route::patch('privacy-policy/update',[\App\Http\Controllers\Frontend\SettingController::class,'privacyPolicyUpdate'])->name('privacy.policy.update');

    Route::get('shipping-payment',[\App\Http\Controllers\Frontend\SettingController::class,'shippingPayment'])->name('shipping.payment');
    Route::patch('shipping-payment/update',[\App\Http\Controllers\Frontend\SettingController::class,'shippingPaymentUpdate'])->name('shipping.payment.update');

    Route::get('terms-conditions',[\App\Http\Controllers\Frontend\SettingController::class,'termsConditions'])->name('terms.conditions');
    Route::patch('terms-conditions/update',[\App\Http\Controllers\Frontend\SettingController::class,'termsConditionsUpdate'])->name('terms.conditions.update');

    Route::get('cancellation-policy',[\App\Http\Controllers\Frontend\SettingController::class,'cancellationPolicy'])->name('cancellation.policy');
    Route::patch('cancellation-policy/update',[\App\Http\Controllers\Frontend\SettingController::class,'cancellationPolicyUpdate'])->name('cancellation.policy.update');

    // Settings
    Route::get('/settings',[\App\Http\Controllers\Frontend\SettingController::class,'settings'])->name('settings');
    Route::patch('/settings',[\App\Http\Controllers\Frontend\SettingController::class,'settingsUpdate'])->name('settings.update');

    //Subscribers
    Route::get('subscribers',[\App\Http\Controllers\AdminController::class,'subscribes'])->name('subscribe.index');
    Route::delete('subscriber.destroy/{id}',[\App\Http\Controllers\AdminController::class,'subscribeDelete'])->name('subscribe.destroy');
    Route::delete('subscriber-delete-all',[\App\Http\Controllers\AdminController::class,'deleteAll'])->name('subscriber.delete.all');
    //Contact message
    Route::get('contact-message',[\App\Http\Controllers\ContactMessageController::class,'contactList'])->name('contact.message');
    Route::get('contact-message/view/{id}',[\App\Http\Controllers\ContactMessageController::class,'contactView'])->name('contact.view');
    Route::delete('contact-message/delete/{id}',[\App\Http\Controllers\ContactMessageController::class,'contactDelete'])->name('contact.destroy');
    Route::delete('contact-message-delete-all',[\App\Http\Controllers\ContactMessageController::class,'deleteAll'])->name('contact.message.delete.all');


    //Mail Settings
    Route::get('mail-setting',[\App\Http\Controllers\Frontend\SettingController::class,'smtpSetting'])->name('smtp.settings');
    Route::post('/env_key_update', [\App\Http\Controllers\Frontend\SettingController::class,'env_key_update'])->name('env_key_update.update');

    // Social-login
    Route::get('/social-login',[\App\Http\Controllers\Frontend\SettingController::class,'socialLogin'])->name('social.login');

    Route::get('/payment-method',[\App\Http\Controllers\Frontend\SettingController::class,'paymentMethod'])->name('payment.method');

    Route::post('/payment-method-update',[\App\Http\Controllers\Frontend\SettingController::class,'paymentMethodUpdate'])->name('payment.method.update');

});
