<?php

use App\Http\Livewire\AuthorComponent;
use App\Http\Livewire\BookComponent;
use App\Http\Livewire\StudentComponent;
use App\Http\Livewire\BorrowBookComponent;
use App\Http\Livewire\DissertationComponent;
use App\Http\Livewire\PublisherComponent;
use App\Http\Livewire\ReceiptComponent;
use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

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

//Route cho đăng nhập
Route::prefix('auth')->group(function () {
    //Thủ thư đăng nhập
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    //Sinh viên đăng nhập
    Route::get('/student-login', [AuthController::class, 'showStudentLogin'])->name('auth.student.login')->middleware('guest');
    Route::post('/student-login', [AuthController::class, 'studentLogin'])->name('auth.student.login.submit');
});

//Route cho sinh viên
Route::prefix('student')->group(function () {
    // Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    //quản lý thông tin cá nhân
    Route::get('/profile', [StudentController::class, 'profile'])->name('student.profile');
    // Route::get('/profile/edit', [StudentController::class, 'editProfile'])->name('student.profile.edit');
    Route::post('/profile/update', [StudentController::class, 'updateProfile'])->name('student.profile.update');
    //mượn sách
    Route::get('/borrow', [StudentController::class, 'showBorrowPage'])->name('student.borrow');
    Route::post('/borrow', [StudentController::class, 'borrowBook'])->name('student.borrow.submit');
});

//Route cho thủ thư
Route::middleware([CheckAuth::class])->group(function () {
    //trang chủ
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    //sách
    Route::prefix('book')->group(function () {
        //danh sách sách
        Route::get('/', BookComponent::class)->name('book.list');
        //mượn sách
        Route::get('/borrow_book', BorrowBookComponent::class)->name('book.borrow_book');
        //phiếu nhập sách
        Route::get('/receipt', ReceiptComponent::class)->name('book.receipt');
    });
    //sinh viên
    Route::get('/students', StudentComponent::class)->name('student.index');
    //luận văn
    Route::prefix('dissertation')->group(function () {
        Route::get('/', DissertationComponent::class)->name('dissertation.list');
    });
    //danh mục
    Route::prefix('directory')->group(function () {
        //quản lý tác giả
        Route::get('/author', AuthorComponent::class)->name('directory.author');
        //quản lý nhà xuất bản
        Route::get('/publisher', PublisherComponent::class)->name('directory.publisher');
    });
});
