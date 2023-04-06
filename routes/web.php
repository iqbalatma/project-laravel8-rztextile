<?php

use App\Http\Controllers\AJAX\DashboardController as AJAXDashboardController;
use App\Http\Controllers\AJAX\DiscountVoucherController as AJAXDiscountVoucherController;
use App\Http\Controllers\AJAX\PromotionMessageController as AJAXPromotionMessageController;
use App\Http\Controllers\AJAX\SearchRollController as AJAXSearchRollController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CRM\PromotionMessageController;
use App\Http\Controllers\CRM\SuggestionController;
use App\Http\Controllers\DataMaster\CustomerController;
use App\Http\Controllers\Transactions\DashboardController;
use App\Http\Controllers\Transactions\InvoiceController;
use App\Http\Controllers\DataMaster\RoleController;
use App\Http\Controllers\DataMaster\RollController;

use App\Http\Controllers\Stock\SearchRollController;
use App\Http\Controllers\Transactions\ShoppingController;
use App\Http\Controllers\Stock\RollTransactionController;
use App\Http\Controllers\CRM\SegmentedCustomerController;
use App\Http\Controllers\DataMaster\UnitController;
use App\Http\Controllers\DataMaster\UserManagementController;
use App\Http\Controllers\CRM\WhatsappMessagingController;
use App\Http\Controllers\DataMaster\CustomerSegmentationController;
use App\Http\Controllers\DataMaster\DiscountVoucherController;
use App\Http\Controllers\DataMaster\PermissionController;
use App\Repositories\RollRepository;
use App\Statics\Permissions\PermissionPermission;
use App\Statics\Permissions\RolePermission;
use App\Statics\Permissions\UnitPermission;
use App\Statics\Permissions\UserPermission;
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
    return view("welcome");
});



Route::middleware("guest")
    ->group(function () {
        // REGISTRATION
        Route::group(
            [
                "controller" => RegistrationController::class,
                "prefix" => "/registration",
                "as" => "registration."
            ],
            function () {
                Route::get("/", "index")->name("index");
                Route::post("/", "store")->name("store");
            }
        );

        // FORGOT PASSWORd
        Route::group(
            [
                "controller" => ForgotPasswordController::class,
                "prefix" => "/forgot-password",
                "as" => "forgot.password."
            ],
            function () {
                Route::get("/", "forgot")->name("forgot");
                Route::get("/reset/{token}/{email}", "reset")->name("reset");
                Route::post("/", "sendResetLink")->name("sendResetLink");
                Route::post("/reset-password", "resetPassword")->name("resetPassword");
            }
        );

        // AUTH
        Route::group(
            [
                "controller" => AuthController::class,
                "as" => "auth."
            ],
            function () {
                Route::get("/login", "login")->name("login");
                Route::post("/authenticate", "authenticate")->name("authenticate");
                Route::post("/logout", "logout")->name("logout")->middleware("auth")->withoutMiddleware("guest");
            }
        );
    });


Route::group([
    "controller" => VerificationController::class,
    "prefix" => "/email",
    "as" => "verification."
], function () {
    Route::get("/verify", "show")->name("notice")->middleware("auth");
    Route::get("/verify/{id}/{hash}", "verify")->name("verify");
    Route::post("/resend", "resend")->name("resend")->middleware("auth");
});

Route::group([
    "controller" => SuggestionController::class,
    "prefix" => "/suggestions",
    "as" => "suggestions."
], function () {
    Route::get("/", "index")->name("index");
    Route::post("/", "store")->name("store");
});


Route::middleware(["auth", "verified"])
    ->group(function () {
        // ROLES
        Route::prefix("roles")->name("roles.")->controller(RoleController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . RolePermission::INDEX);
            Route::get("/create", "create")->name("create")->middleware("permission:" . RolePermission::CREATE);
            Route::get("/edit/{id}", "edit")->name("edit")->middleware("permission:" . RolePermission::EDIT);
            Route::post("/", "store")->name("store")->middleware("permission:" . RolePermission::STORE);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . RolePermission::DESTROY);
            Route::put("/{id}", "update")->name("update")->middleware("permission:" . RolePermission::UPDATE);
        });
        // PERMISSIONS
        Route::get("/permissions", PermissionController::class)->name("permissions.index")->middleware("permission:" . PermissionPermission::INDEX);

        // UNITS
        Route::prefix("units")->name("units.")->controller(UnitController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . UnitPermission::INDEX);
            Route::get("/edit/{id}", "edit")->name("edit")->middleware("permission:" . UnitPermission::EDIT);
            Route::get("/create", "create")->name("create")->middleware("permission:" . UnitPermission::CREATE);
            Route::patch("/{id}", "update")->name("update")->middleware("permission:" . UnitPermission::UPDATE);
            Route::post("/", "store")->name("store")->middleware("permission:" . UnitPermission::STORE);
            Route::delete("/{id}", "destroy")->name("destroy")->middleware("permission:" . UnitPermission::DESTROY);
        });

        Route::prefix("users")->name("users.")->controller(UserManagementController::class)->group(function () {
            Route::get("/", "index")->name("index")->middleware("permission:" . UserPermission::INDEX);
            Route::get("/create", "create")->name("create")->middleware("permission:" . UserPermission::CREATE);;
            Route::post("/", "store")->name("store")->middleware("permission:" . UserPermission::STORE);;
            Route::get("/edit/{id}", "edit")->name("edit")->middleware("permission:" . UserPermission::EDIT);;
            Route::patch("/{id}", "update")->name("update")->middleware("permission:" . UserPermission::UPDATE);;
            Route::put("/{id}", "changeStatusActive")->name("change.status.active")->middleware("permission:" . UserPermission::CHANGE_STATUS_ACTIVE);;
        });


        Route::middleware("role:administrator")->group(
            function () {
                // USER MANAGEMENT CONTROLLER


                // // REGISTRATION CREDENTIAL
                // Route::group(
                //     [
                //         "controller" => RegistrationCredentialController::class,
                //         "prefix" => "/registration-credentials",
                //         "as" => "registration.credentials."
                //     ],
                //     function () {
                //         Route::get("/", "index")->name("index");
                //         Route::get("/create", "create")->name("create");
                //         Route::post("/", "store")->name("store");
                //         Route::delete("/{id}", "destroy")->name("destroy");
                //         Route::put("/{id}", "update")->name("update");
                //     }
                // );
            }
        );



        // DASHBOARD
        Route::get("/dashboard", DashboardController::class)->name("dashboard.index");
        Route::get("/ajax/dashboard/sales-summary", AJAXDashboardController::class)->name("ajax.dashboard.sales.summary");

        // Roll Transaction
        Route::group(
            [
                "controller" => RollTransactionController::class,
                "prefix" => "/roll-transactions",
                "as" => "roll.transactions."
            ],
            function () {
                Route::get("/create", "create")->name("create");
                Route::post("/", "store")->name("store");
            }
        );


        // PROMOTION MESSAGE
        // Route::group(
        //     [
        //         "controller" => PromotionMessageController::class,
        //         "prefix" => "/promotion-messages",
        //         "as" => "promotion.messages."
        //     ],
        //     function () {
        //         Route::get("/", "index")->name("index");
        //         Route::get("/create", "create")->name("create");
        //         Route::post("/", "store")->name("store");
        //         Route::get("/{id}", "edit")->name("edit");
        //         Route::put("/", "update")->name("update");
        //         Route::delete("/{id}", "destroy")->name("destroy");
        //     }
        // );
        Route::get("/ajax/promotion-messages/{id}", [AJAXPromotionMessageController::class, "show"])->name("ajax.promotion.messages.show");
        Route::get("/ajax/promotion-messages/customer-segmentations/{id}", [AJAXPromotionMessageController::class, "getByCustomerSegmentation"])->name("ajax.promotion.messages.customer.segmentations");
        Route::get("/ajax/discount-vouchers/{code}", AJAXDiscountVoucherController::class)->name("ajax.discount.vouchers");

        // ROLE CONTROLLER
        Route::get("/discount-vouchers", DiscountVoucherController::class)->name("discount.vouchers.index");
        Route::get("/customer-segmentations", CustomerSegmentationController::class)->name("customer.segmentations.index");



        // ROLL
        Route::group(
            [
                "controller" => RollController::class,
                "prefix" => "/rolls",
                "as" => "rolls."
            ],
            function () {
                Route::get("/", "index")->name("index");
                Route::get("/create", "create")->name("create");
                Route::post("/", "store")->name("store")->middleware("role.prohibitted:owner");;
                Route::get("/edit/{id}", "edit")->name("edit");
                Route::patch("/{id}", "update")->name("update")->middleware("role.prohibitted:owner");;
                Route::get("/download/{qrcode}", "downloadQrcode")->name("downloadQrcode");
                Route::post("/print", "printQrcode")->name("printQrcode")->middleware("role.prohibitted:owner");;
            }
        );

        // Route::group(
        //     [
        //         "controller" => WhatsappMessagingController::class,
        //         "prefix" => "/whatsapp-messaging",
        //         "as" => "whatsapp.messaging."
        //     ],
        //     function () {
        //         Route::get("/", "index")->name("index");
        //         Route::post("/", "store")->name("store");
        //     }
        // );

        // Route::controller(ReportController::class)
        //     ->name("reports.")
        //     ->prefix("/reports")
        //     ->group(
        //         function () {
        //                         Route::get("/", "index")->name("index");
        //                         Route::post("/download", "download")->name("download");
        //                     }
        //     );




        Route::get("/segmented-customers", SegmentedCustomerController::class)->name("segmendted.customers.index");
        Route::get("/search-roll", SearchRollController::class)->name("search.roll.index");
        Route::get("/ajax/search-roll/{id}", AJAXSearchRollController::class)->name("ajax.search.roll.show");

        Route::controller(ShoppingController::class)
            ->name("shopping.")
            ->prefix("/shopping")
            ->group(
                function () {
                    Route::get("/", "index")->name("index");
                    Route::post("/purchase", "purchase")->name("purchase");
                }
            );

        Route::group(
            [
                "controller" => InvoiceController::class,
                "prefix" => "/report/invoices",
                "as" => "report.invoices."
            ],
            function () {
                Route::get("/", "index")->name("index");
                Route::get("/{type}/{id}", "invoicPdf")->name("invoicPdf");
            }
        );

        Route::get("/report/roll-trannsactions", [RollTransactionController::class, "index"])->name("report.roll.transactions.index");
        // Route::controller(PaymentController::class)
        //     ->name("payments.")
        //     ->prefix("/payments")
        //     ->group(
        //         function () {
        //             Route::get("/", "index")->name("index");
        //             Route::get("/create/{id}", "createByInvoiceId")->name("createByInvoiceId");
        //             Route::get("/create", "create")->name("create");
        //             Route::post("/", "store")->name("store");
        //         }
        //     );

        Route::group(
            [
                "controller" => CustomerController::class,
                "prefix" => "/customers",
                "as" => "customers."
            ],
            function () {
                Route::get("/", "index")->name("index");
                Route::get("/create", "create")->name("create");
                Route::get("/edit/{id}", "edit")->name("edit");
                Route::post("/", "store")->name("store")->middleware("role.prohibitted:owner");;
                Route::patch("/{id}", "update")->name("update")->middleware("role.prohibitted:owner");;
                Route::delete("/{id}", "destroy")->name("destroy")->middleware("role.prohibitted:owner");;
            }
        );
    });
