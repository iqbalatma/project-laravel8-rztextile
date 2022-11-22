<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestockController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\RollTransactionController;
use App\Http\Controllers\UnitController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)
    ->name("auth.")
    ->group(function (){
        Route::get("/login", "login")->name("login");
        Route::post("/authenticate", "authenticate")->name("authenticate");
        Route::post("/logout", "logout")->name("logout");
    });


Route::middleware("auth")
    ->group(function (){
        Route::controller(RestockController::class)
            ->name("restock.")
            ->prefix("/restock")
            ->group(function (){
                Route::get("/create", "create")->name("create");
                Route::post("/", "store")->name("store");
            });

        Route::controller(DashboardController::class)
            ->name("dashboard.")
            ->prefix("/dashboard")
            ->group(function (){
                Route::get("/", "index")->name("index");
            });
        
        
        Route::controller(UnitController::class)
            ->name("units.")
            ->prefix("/units")
            ->group(function (){
                Route::get("/", "index")->name("index");
                Route::get("/edit/{id}", "edit")->name("edit");
                Route::get("/create", "create")->name("create");
                Route::patch("/{id}", "update")->name("update");
                Route::post("/", "store")->name("store");
                Route::delete("/{id}", "destroy")->name("destroy");
            });
        
        Route::controller(RoleController::class)
            ->name("roles.")
            ->prefix("/roles")
            ->group(function (){
                Route::get("/", "index")->name("index");
            });
        
        Route::controller(CustomerController::class)
            ->name("customers.")
            ->prefix("/customers")
            ->group(function (){
                Route::get("/", "index")->name("index");
                Route::get("/create", "create")->name("create");
                Route::get("/edit/{id}", "edit")->name("edit");
                Route::post("/", "store")->name("store");
                Route::patch("/{id}", "update")->name("update");
                Route::delete("/{id}", "destroy")->name("destroy");
            });
        
        Route::controller(RollController::class)
            ->name("rolls.")
            ->prefix("/rolls")
            ->group(function (){
                Route::get("/", "index")->name("index");
                Route::get("/create", "create")->name("create");
                Route::post("/", "store")->name("store");
                Route::get("/edit/{id}", "edit")->name("edit");
                Route::patch("/{id}", "update")->name("update");
            });
        
        Route::controller(RollTransactionController::class)
            ->name("roll.transactions.")
            ->prefix("/roll-transactions")
            ->group(function (){
                Route::get("/", "index")->name("index");
                Route::get("/put-away", "putAway")->name("putAway");
                Route::post("/put-away", "putAwayTransaction")->name("putAwayTransaction");
            });
    });
