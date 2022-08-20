<?php

use App\Http\Controllers\EmployeeController;
use App\Models\employee;
use Illuminate\Support\Facades\Route;
use controller\UmsController;

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

Route::get('/', function () {
    return view('pages.dashboard')->with([
        'emps' => employee::get()
    ]);
})->name('dash');

Route::get('create', function () {
    return view('pages.create');
});

Route::post("save-employee", [EmployeeController::class, 'saveEmployee'])->name('saveEMP');
Route::delete("delete-emp", [EmployeeController::class, 'deleteEmp'])->name('deleteEmp');
    