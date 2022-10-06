<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;



 Route::group(['prefix' => 'filemanager', 'middleware'=>'checkAdmin' ], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });


//===================================Admin=======================================================//
  Route::get('auth/admin/login', [AuthController::class, 'index'])->name('admin.login');
  Route::post('auth/admin/login', [AuthController::class, 'store'])->name('admin.postLogin');
  Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(['prefix'=>'admin', 'middleware' => 'checkAdmin'], function(){
    Route::get('', [AuthController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::group(['prefix'=>'categories'], function(){
        Route::get('/', [CategoryController::class,'index'])->name('categories.view');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit&id={id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
    });

//  Customer

   Route::resource('customers', CustomerController::class);

//   User
   Route::resource('users', UserController::class);
    Route::resource('staffs', AdminController::class);



//    Products
    Route::group(['prefix' => 'products'], function(){
        Route::get('/', [ProductController::class, 'index'])->name('products.view');
        Route::get('/create', [ProductController::class, 'create'])->name('products.add');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');
        Route::post('/updateProductQuantity/{id}', [ProductController::class, 'updateQuantity'])->name('products.updateQuantity');


//    Cpu
        Route::group(['prefix' => 'cpus'], function(){
            Route::get('/', [CpuController::class, 'index'])->name('cpus.view');
            Route::get('/create', [CpuController::class, 'create'])->name('cpus.add');
            Route::post('/store', [CpuController::class, 'store'])->name('cpus.store');
            Route::get('/edit/{id}', [CpuController::class, 'edit'])->name('cpus.edit');
            Route::post('/update/{id}', [CpuController::class, 'update'])->name('cpus.update');
            Route::get('/delete/{id}', [CpuController::class, 'destroy'])->name('cpus.delete');
        });

//    Gpu
        Route::group(['prefix' => 'gpus'], function(){
            Route::get('/', [GpuController::class, 'index'])->name('gpus.view');
            Route::get('/create', [GpuController::class, 'create'])->name('gpus.add');
            Route::post('/store', [GpuController::class, 'store'])->name('gpus.store');
            Route::get('/edit/{id}', [GpuController::class, 'edit'])->name('gpus.edit');
            Route::post('/update/{id}', [GpuController::class, 'update'])->name('gpus.update');
            Route::get('/delete/{id}', [GpuController::class, 'destroy'])->name('gpus.delete');
        });
    });

//    Supplier

    Route::group(['prefix'=>'suppliers'], function(){
        Route::get('/', [SupplierController::class,'index'])->name('suppliers.view');
        Route::post('/store', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('/edit&id={id}', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::get('/delete/{id}', [SupplierController::class, 'destroy'])->name('suppliers.delete');
    });

//    Slider
    Route::group(['prefix'=>'sliders'], function(){
        Route::get('/', [SliderController::class,'index'])->name('sliders.view');
        Route::get('/create', [SliderController::class,'create'])->name('sliders.add');
        Route::post('/store', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/edit&id={id}', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('sliders.update');
        Route::get('/delete/{id}', [SliderController::class, 'destroy'])->name('sliders.delete');
    });

//    Blog
    Route::group(['prefix'=>'blogs'], function(){
        Route::get('/', [BlogController::class,'index'])->name('blogs.view');
        Route::get('/create', [BlogController::class,'create'])->name('blogs.add');
        Route::post('/store', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/edit&id={id}', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::post('/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
        Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blogs.delete');
    });

//    Coupon
    Route::group(['prefix'=>'coupons'], function(){
        Route::get('/', [CounponController::class,'index'])->name('coupons.view');
        Route::get('/create', [CounponController::class,'create'])->name('coupons.add');
        Route::post('/store', [CounponController::class, 'store'])->name('coupons.store');
        Route::get('/edit&id={id}', [CounponController::class, 'edit'])->name('coupons.edit');
        Route::post('/update/{id}', [CounponController::class, 'update'])->name('coupons.update');
        Route::get('/delete/{id}', [CounponController::class, 'destroy'])->name('coupons.delete');
    });

//    Order
    Route::resource('/orders', OrderController::class);
    Route::post('orders/change-status',[OrderController::class, 'changeStatus'])->name('order.changeStatus');
    Route::post('orders/complete/{id}',[OrderController::class, 'orderComplete'])->name('order.complete');
//    Print order
    Route::get('orders-print/{id}', [PrintController::class, 'getPrint'])->name('orders.print');

//    Setting
    Route::resource('settings', SettingController::class);

//    Comment
    Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('comments/approval-comment', [CommentController::class, 'ApprovalComment']);
});
