<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;

use App\Http\Controllers\OptionController;

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

Route::get('/', function () {
    return view('auth.login');
});




Route::get('/dashboard', [ProjectController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::group(['prefix'=>'options'], function(){
        Route::get('/', [OptionController::class, 'index'])->name('options.index');
        Route::post('/', [OptionController::class, 'save'])->name('options.save');
    });

    Route::get('/help', function(){
        return view('help');
    })->name('help');

    Route::get('/support', function(){
        return view('support');
    })->name('support');

    Route::post('/support', [ProfileController::class, 'support'])->name('support-submit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix'=>'designers'], function(){
        Route::get('/', [ManagerController::class, 'index'])->name('managers');
        Route::get('/add', [ManagerController::class, 'add'])->name('managers-add');
        Route::get('/{manager}/edit', [ManagerController::class, 'edit'])->name('managers-edit');
        Route::delete('/{manager}', [ManagerController::class, 'delete'])->name('managers-delete');
        Route::post('/add', [ManagerController::class, 'create'])->name('managers-create');
        Route::post('/{manager}/edit', [ManagerController::class, 'save'])->name('managers-save');
    });

    Route::group(['prefix'=>'customers'], function(){
        Route::get('/', [CustomerController::class, 'index'])->name('customers');
        Route::get('/add', [CustomerController::class, 'add'])->name('customers-add');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customers-edit');
        Route::delete('/{customer}', [CustomerController::class, 'delete'])->name('customers-delete');
        Route::post('/add', [CustomerController::class, 'create'])->name('customers-create');
        Route::post('/{customer}/edit', [CustomerController::class, 'save'])->name('customers-save');
    });

    Route::group(['prefix'=>'projects'], function(){
        Route::get('/create', function(){
            return view('project-create');
        })->name('project-create');
        Route::get('/', [ProjectController::class, 'index'])->name('projects');
        Route::get('/{project}', [ProjectController::class, 'view'])->name('projects-view');
        Route::delete('/{project}', [ProjectController::class, 'delete'])->name('projects-delete');

        Route::get('take/{project}', [ProjectController::class, 'takeProject'])->name('projects-take');

        
    });

    Route::group(['prefix'=>'orders'], function(){
        Route::get('/', [OrderController::class, 'index'])->name('orders');
        Route::get('/{order}', [OrderController::class, 'view'])->name('orders-view');
        Route::delete('/{order}', [OrderController::class, 'delete'])->name('orders-delete');

        Route::get('/invoice/{order}', [OrderController::class, 'download_invoice'])->name('orders-download-invoice');
        Route::get('/invoice-send/{order}', [OrderController::class, 'send_invoice'])->name('orders-send-invoice');
        Route::get('/xls/{order}', [OrderController::class, 'download_xls'])->name('orders-export-xls');
    });

    Route::group(['prefix'=>'order-statuses'], function(){
        Route::get('/', [OrderStatusController::class, 'index'])->name('order-statuses');
        Route::get('/add', [OrderStatusController::class, 'add'])->name('order-statuses-add');
        Route::get('/{order_status}/edit', [OrderStatusController::class, 'edit'])->name('order-statuses-edit');
        Route::delete('/{order_status}', [OrderStatusController::class, 'delete'])->name('order-statuses-delete');
        Route::post('/add', [OrderStatusController::class, 'create'])->name('order-statuses-create');
        Route::post('/{order_status}/edit', [OrderStatusController::class, 'save'])->name('order-statuses-save');
    });

    Route::group(['prefix'=>'products'], function(){
        Route::get('/', [ProductsController::class, 'index'])->name('products');
        Route::get('/by-cat/{category}', [ProductsController::class, 'productByCategory'])->name('products-by-category');
        Route::get('/add-category', [ProductsController::class, 'addCategory'])->name('products-category-add');
        Route::get('/edit-category/{category}', [ProductsController::class, 'editCategory'])->name('products-category-edit');
        Route::post('/add-category', [ProductsController::class, 'createCategory'])->name('products-category-create');
        Route::post('/save-category/{category}', [ProductsController::class, 'saveCategory'])->name('products-category-save');
        Route::delete('/delete-category/{category}', [ProductsController::class, 'deleteCategory'])->name('products-category-delete');

        Route::get('/add-product', [ProductsController::class, 'add'])->name('products-add');
        Route::get('/edit-product/{product}', [ProductsController::class, 'edit'])->name('products-edit');
        Route::post('/add-product', [ProductsController::class, 'create'])->name('products-create');
        Route::post('/save-product/{product}', [ProductsController::class, 'save'])->name('products-save');
        Route::delete('/delete-product/{product}', [ProductsController::class, 'delete'])->name('products-delete');

        Route::get('/add-patronage', [ProductsController::class, 'addPatronage'])->name('products-patronage-add');
        Route::get('/edit-patronage/{patronage}', [ProductsController::class, 'editPatronage'])->name('products-patronage-edit');
        Route::post('/add-patronage', [ProductsController::class, 'createPatronage'])->name('products-patronage-create');
        Route::post('/save-patronage/{patronage}', [ProductsController::class, 'savePatronage'])->name('products-patronage-save');
        Route::delete('/delete-propatronageduct/{patronage}', [ProductsController::class, 'deletePatronage'])->name('products-patronage-delete');

    });
    
    Route::group(['prefix'=>'discounts'], function(){
        Route::get('/', [DiscountController::class, 'index'])->name('discounts');
        Route::get('/add', [DiscountController::class, 'add'])->name('discounts-add');
        Route::get('/{discount}/edit', [DiscountController::class, 'edit'])->name('discounts-edit');
        Route::delete('/{discount}', [DiscountController::class, 'delete'])->name('discounts-delete');
        Route::post('/add', [DiscountController::class, 'create'])->name('discounts-create');
        Route::post('/{discount}/edit', [DiscountController::class, 'save'])->name('discounts-save');
    });

    Route::group(['prefix'=>'json'], function(){
        Route::get('patronages', [ProductsController::class, 'jsonPatronages']);
        Route::get('categories', [ProductsController::class, 'jsonCategories']);

        Route::get('patronage', [ProductsController::class, 'jsonPatronage']);

        Route::get('customers', [CustomerController::class, 'json']);

        Route::get('project-pre-create', [ProjectController::class, 'ajaxCreate']);

        Route::post('upload', [UploadController::class, 'upload']);
        Route::delete('upload', [UploadController::class, 'unUpload']);
        Route::post('project', [ProjectController::class, 'jsonCreate']);
        Route::post('message', [ProjectController::class, 'jsonMessage']);
        Route::post('note', [ProjectController::class, 'jsonNote']);
        Route::post('code/{project}', [ProjectController::class, 'jsonCode']);
        Route::post('codeorder/{order}', [OrderController::class, 'jsonCode']);
        Route::post('order/{project}', [ProjectController::class, 'jsonOrder']);
        Route::get('project/{project}', [ProjectController::class, 'jsonProject']);
        Route::get('statuses', [OrderStatusController::class, 'json']);
        Route::get('status/{project}', [ProjectController::class, 'jsonOrderStatus']);
        Route::post('status/{project}', [ProjectController::class, 'jsonOrderChangeStatus']);

        Route::match(['get', 'post'], 'magic-upload-with-preview', [UploadController::class, 'magic_upload']);

    });
    

});

Route::get('/get-image/{projectId}', [UploadController::class, 'getImage']);

require __DIR__.'/auth.php';
