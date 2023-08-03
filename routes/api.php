<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//common routes start

// Route::post('/login', '\App\Http\Controllers\AuthController@login');
Route::post('/forgetPassword', '\App\Http\Controllers\AuthController@forgetpassword');
Route::post('/checktoken', '\App\Http\Controllers\AuthController@token_check');
Route::post('/resetPassword', '\App\Http\Controllers\AuthController@reset_password');
Route::get('/logout/{id}', 'App\Http\Controllers\AuthController@logout');


// common routes ends

/// admin Register
Route::post('/admin/login', '\App\Http\Controllers\Admin\AuthController@login');
Route::post('/admin/register', 'App\Http\Controllers\Admin\AuthController@register');

/// seller Register
Route::post('/seller/login', '\App\Http\Controllers\Seller\AuthController@login');
Route::post('/seller/register', 'App\Http\Controllers\Seller\AuthController@register');

/// marketing Register
Route::post('/marketing/login', '\App\Http\Controllers\Marketing\AuthController@login');
Route::post('/marketing/register', 'App\Http\Controllers\Marketing\AuthController@register');

/// customer Register
Route::post('/login', '\App\Http\Controllers\Customer\AuthController@login');
Route::post('/customer/register', 'App\Http\Controllers\Customer\AuthController@register');


Route::group(['middleware' => ['auth:api']], function(){

 

Route::middleware(['admin'])->group(function () {


    /////////////////////////////////// Admin Routes \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    Route::get('/admin/profile/view/{id}', 'App\Http\Controllers\Admin\AuthController@profile_view');
    Route::post('/admin/profile', 'App\Http\Controllers\Admin\AuthController@profile_update');
    Route::get('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('/admin/profile/check', 'App\Http\Controllers\Admin\AuthController@usercheck'); 
    Route::get('/admin/dashboard','App\Http\Controllers\Admin\DashboardController@index');



                                    /// Category \\\

     Route::group(['prefix' => '/admin/category/'], function() {
         Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
             Route::get('show','index');
             Route::post('create','create');
             Route::post('update','update');
             Route::get('delete/{id}','delete');
         });
     });


                                            /// Brand \\\

     Route::group(['prefix' => '/admin/brand/'], function() {
         Route::controller(App\Http\Controllers\Admin\BrandController::class)->group(function () {
             Route::get('show','index');
             Route::post('create','create');
             Route::post('update','update');
             Route::get('delete/{id}','delete');
         });
     });


                                                        /// Vehicle \\\

    Route::group(['prefix' => '/admin/vehicle/'], function() {
        Route::controller(App\Http\Controllers\Admin\VehicleController::class)->group(function () {
            Route::get('show','index');
            Route::post('create','create');
            Route::post('update','update');
            Route::get('delete/{id}','delete');
            Route::get('status/{id}','status');
        });
    }); 

                                                            /// Engine \\\

    Route::group(['prefix' => '/admin/engine/'], function() {
        Route::controller(App\Http\Controllers\Admin\EngineController::class)->group(function () {
            Route::get('show','index');
            Route::post('create','create');
            Route::post('update','update');
            Route::get('delete/{id}','delete');
            Route::get('status/{id}','status');
        });
    });  


                                                  /// Deal \\\

       Route::group(['prefix' => '/admin/deal/'], function() {
       Route::controller(App\Http\Controllers\Admin\DealController::class)->group(function () {
           Route::get('show','index');
           Route::post('create','create');
           Route::post('update','update');
           Route::get('delete/{id}','delete');
       });
   });



                                           /// Banner \\\

   Route::group(['prefix' => '/admin/banner/'], function() {
       Route::controller(App\Http\Controllers\Admin\BannerController::class)->group(function () {
           Route::get('show','index');
           Route::post('create','create');
           Route::post('update','update');
           Route::get('delete/{id}','delete');
       });
   });

                                               /// OneBanner \\\

   Route::group(['prefix' => '/admin/onebanner/'], function() {
       Route::controller(App\Http\Controllers\Admin\OneBannerController::class)->group(function () {
           Route::get('show','index');
           Route::post('createOrUpdate','createOrUpdate');
           Route::get('delete/{id}','delete');
       });
   });

                                                   /// TwoBanner \\\

   Route::group(['prefix' => '/admin/twobanner/'], function() {
       Route::controller(App\Http\Controllers\Admin\TwoBannerController::class)->group(function () {
           Route::get('show','index');
           Route::post('create','create');
           Route::post('update','update');
           Route::get('delete/{id}','delete');
       });
   });


                                                   /// ThreeBanner \\\

   Route::group(['prefix' => '/admin/threebanner/'], function() {
       Route::controller(App\Http\Controllers\Admin\ThreeBannerController::class)->group(function () {
           Route::get('show','index');
           Route::post('create','create');
           Route::post('update','update');
           Route::get('delete/{id}','delete');
       });
   });    


                                               /// Bolg Category \\\

   Route::group(['prefix' => '/admin/blog_category/'], function() {
       Route::controller(App\Http\Controllers\Admin\BlogCategoryController::class)->group(function () {
           Route::get('show','index');
           Route::post('create','create');
           Route::post('update','update');
           Route::get('delete/{id}','delete');
       });
   });

                                                   /// Bolg  \\\

   Route::group(['prefix' => '/admin/blog/'], function() {
       Route::controller(App\Http\Controllers\Admin\BlogController::class)->group(function () {
           Route::get('show','index');
           Route::post('create','create');
           Route::post('update','update');
           Route::get('delete/{id}','delete');
       });
   });





                                     /// Product \\\

     Route::group(['prefix' => '/admin/product/'], function() {
         Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
             Route::get('show','index');
             Route::get('admin_products','admin_products');
             Route::get('seller_products','seller_products');
             Route::post('create','create');
             Route::post('update','update');
             Route::get('delete/{id}','delete');
             Route::get('is_approved/{id}','is_approved');
             Route::get('is_featured/{id}','is_featured');
             Route::get('is_published/{id}','is_published');
         });
     });

                                           ///Wholesale Product \\\

   Route::group(['prefix' => '/admin/wholesale_product/'], function() {
       Route::controller(App\Http\Controllers\Admin\WholeSaleProductController::class)->group(function () {
           Route::get('show','index');
           Route::get('admin_products','admin_products');
           Route::get('seller_products','seller_products');
           Route::post('create','create');
           Route::post('update','update');
           Route::get('delete/{id}','delete');
           Route::get('is_approved/{id}','is_approved');
           Route::get('is_featured/{id}','is_featured');
           Route::get('is_published/{id}','is_published');
       });
   });

                                   /// Order \\\

   Route::group(['prefix' => 'order/'], function() {
       Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
           Route::get('show','index');
           Route::get('admin_orders/{id}','admin_orders');
           Route::get('seller_orders/{id}','seller_orders');
           Route::post('delivery_status','delivery_status');
           Route::post('payment_status','payment_status');
       });
   });

                                         /// Coupon \\\

       Route::group(['prefix' => '/admin/coupon/'], function() {
       Route::controller(App\Http\Controllers\Admin\CouponController::class)->group(function () {
           Route::get('show','index');
           Route::post('create','create');
           Route::post('update','update');
           Route::get('delete/{id}','delete');
       });
   });

                                             /// Refund \\\

       Route::group(['prefix' => '/admin/refund/'], function() {
       Route::controller(App\Http\Controllers\Admin\RefundController::class)->group(function () {
           Route::get('show','index');
           Route::get('approved','approved_refunds');
           Route::get('rejected','rejected_refunds');
           Route::post('status','change_status');
       });
   });

                                                 /// Refund Time \\\

       Route::group(['prefix' => '/admin/refund_time/'], function() {
       Route::controller(App\Http\Controllers\Admin\RefundTimeController::class)->group(function () {
           Route::get('show','index');
           Route::post('update','createOrupdate');
       });
   });


                                     /// Package \\\

     Route::group(['prefix' => '/admin/package/'], function() {
         Route::controller(App\Http\Controllers\Admin\PackageController::class)->group(function () {
             Route::get('show','index');
             Route::post('create','create');
             Route::post('update','update');
             Route::get('delete/{id}','delete');
         });
     });


                                           /// Customer \\\

       Route::group(['prefix' => '/admin/customer/'], function() {
           Route::controller(App\Http\Controllers\Admin\CustomerController::class)->group(function () {
               Route::get('show','index');
               Route::get('is_active/{id}','is_active');
               Route::get('delete/{id}','delete');
           });
       });


                                           /// Seller \\\

       Route::group(['prefix' => '/admin/seller/'], function() {
           Route::controller(App\Http\Controllers\Admin\SellerController::class)->group(function () {
               Route::get('show','index');
               Route::get('is_active/{id}','is_active');
               Route::get('delete/{id}','delete');
           });
       });


                                           /// Report \\\

        Route::group(['prefix' => '/admin/report/'], function() {
            Route::controller(App\Http\Controllers\Admin\ReportController::class)->group(function () {
                Route::post('admin_product_sale','admin_product_sale');
                Route::post('saller_product_sale','saller_product_sale');
                Route::post('product_stock','product_stock');
                Route::post('product_wishlist','product_wishlist');
            });
        });

});


    Route::middleware(['seller'])->group(function () {  
     
      /////////////////////////////////// Seller Routes \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

      Route::get('/seller/profile/view/{id}', 'App\Http\Controllers\Seller\AuthController@profile_view');
      Route::post('/seller/profile', 'App\Http\Controllers\Seller\AuthController@profile_update');
      Route::get('/logout', 'App\Http\Controllers\AuthController@logout');
      Route::get('/seller/profile/check', 'App\Http\Controllers\Seller\AuthController@usercheck'); 
      Route::get('/seller/dashboard','App\Http\Controllers\Seller\DashboardController@index');



                                       /// Product \\\

      Route::group(['prefix' => '/seller/product/'], function() {
          Route::controller(App\Http\Controllers\Seller\ProductController::class)->group(function () {
              Route::get('show/{id}','index');
              Route::post('create','create');
              Route::post('update','update');
              Route::get('delete/{id}','delete');
              Route::get('is_published/{id}','is_published');
          });
      });


                                                  ///Wholesale Product \\\

        Route::group(['prefix' => '/admin/wholesale_product/'], function() {
            Route::controller(App\Http\Controllers\Admin\WholeSaleProductController::class)->group(function () {
                Route::get('show/{id}','index');
                Route::post('create','create');
                Route::post('update','update');
                Route::get('delete/{id}','delete');
                // Route::get('is_approved/{id}','is_approved');
                // Route::get('is_featured/{id}','is_featured');
                Route::get('is_published/{id}','is_published');
            });
        });


                                              /// Order \\\

        Route::group(['prefix' => '/seller/order/'], function() {
            Route::controller(App\Http\Controllers\Seller\OrderController::class)->group(function () {
                Route::get('show/{id}','index');
                Route::post('delivery_status','delivery_status');
                Route::post('payment_status','payment_status');
            });
        });



                                      /// Package \\\

      Route::group(['prefix' => '/seller/package/'], function() {
          Route::controller(App\Http\Controllers\Seller\PackageController::class)->group(function () {
              Route::get('show','index');
              Route::post('subscribe','subscribe');

          });
      });

                                            /// Shop \\\

    Route::group(['prefix' => '/seller/shop/'], function() {
        Route::controller(App\Http\Controllers\Seller\ShopController::class)->group(function () {
            Route::get('show/{id}','index');
            Route::post('update','update');

        });
    });


                                            /// Payout \\\

        Route::group(['prefix' => '/seller/payout/'], function() {
            Route::controller(App\Http\Controllers\Seller\PayoutController::class)->group(function () {
                Route::get('show/{id}','index');
                Route::post('create','create');
                Route::get('delete/{id}','delete');
    
            });


        });

 

    });

    Route::middleware(['marketing'])->group(function () {  

              /////////////////////////////////// Marketing Routes \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

      Route::get('/marketing/profile/view/{id}', 'App\Http\Controllers\Marketing\AuthController@profile_view');
      Route::post('/marketing/profile', 'App\Http\Controllers\Marketing\AuthController@profile_update');
      Route::get('/logout', 'App\Http\Controllers\AuthController@logout');
      Route::get('/marketing/profile/check', 'App\Http\Controllers\Marketing\AuthController@usercheck'); 
      Route::get('/marketing/dashboard','App\Http\Controllers\Marketing\DashboardController@index');


                                                     /// Bolg Category \\\

                    Route::group(['prefix' => '/marketing/blog_category/'], function() {
                        Route::controller(App\Http\Controllers\Marketing\BlogCategoryController::class)->group(function () {
                            Route::get('show','index');
                            // Route::post('create','create');
                            // Route::post('update','update');
                            // Route::get('delete/{id}','delete');
                        });
                    });

                                                                    /// Bolg  \\\

                    Route::group(['prefix' => '/marketing/blog'], function() {
                        Route::controller(App\Http\Controllers\Marketing\BlogController::class)->group(function () {
                            Route::get('show/{id}','index');
                            Route::post('create','create');
                            Route::post('update','update');
                            Route::get('delete/{id}','delete');
                        });
                    });


                                                             /// Coupon \\\

                    Route::group(['prefix' => '/marketing/coupon/'], function() {
                        Route::controller(App\Http\Controllers\Marketing\CouponController::class)->group(function () {
                            Route::get('show/{id}','index');
                            Route::post('create','create');
                            Route::post('update','update');
                            Route::get('delete/{id}','delete');
                        });
                    });

    });    


});
         

        /////////////////////////////////// Customer Routes \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        Route::get('/customer/profile/view/{id}', 'App\Http\Controllers\Customer\AuthController@profile_view');
        Route::post('/customer/profile', 'App\Http\Controllers\Customer\AuthController@profile_update');
        Route::get('/logout', 'App\Http\Controllers\AuthController@logout');
        Route::get('/customer/profile/check', 'App\Http\Controllers\Customer\AuthController@usercheck'); 
        Route::get('/customer/dashboard','App\Http\Controllers\Customer\DashboardController@index');



                                    /// Home \\\

        Route::group(['prefix' => '/home'], function() {
            Route::controller(App\Http\Controllers\Customer\HomeController::class)->group(function () {
                Route::get('','index');
            });
        });


                                               /// Product \\\

      Route::group(['prefix' => '/product'], function() {
        Route::controller(App\Http\Controllers\Customer\ProductController::class)->group(function () {
            Route::get('show','index');
            Route::get('detail/{id}','detail');
        });
    });


                                          /// Wishlist \\\

        Route::group(['prefix' => '/wishlist'], function() {
        Route::controller(App\Http\Controllers\Customer\WhishlistController::class)->group(function () {
            Route::get('show/{id}','index');
            Route::post('create','create');
            Route::get('delete/{id}','delete');
        });
    });

                                              /// Review \\\

        Route::group(['prefix' => '/review'], function() {
        Route::controller(App\Http\Controllers\Customer\ProductReviewController::class)->group(function () {
            Route::post('create','create');
        });
    });


                                        /// Subscribe \\\

        Route::group(['prefix' => '/subscribe'], function() {
        Route::controller(App\Http\Controllers\Customer\SubscriberController::class)->group(function () {
            Route::post('create','create');     
        });
    });


                                        /// Order \\\

        Route::group(['prefix' => '/order'], function() {
        Route::controller(App\Http\Controllers\Customer\OrderController::class)->group(function () {
            Route::get('show/{id}','index');
            Route::post('create','create');
        });
    });


                                            /// Refund \\\

    Route::group(['prefix' => '/refund'], function() {
        Route::controller(App\Http\Controllers\Customer\RefundController::class)->group(function () {
            Route::get('show/{id}','index');
            Route::post('create','create');
            Route::get('delete/{id}','delete');
        });
    });

                                                /// Filter \\\

    Route::group(['prefix' => '/search'], function() {
        Route::controller(App\Http\Controllers\Customer\FilterController::class)->group(function () {
            Route::post('product','search');
            Route::post('multi_search','multiSearch');
        });
    });
