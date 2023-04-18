<?php

namespace App\Providers;

use App\Statics\Permissions\CustomerPermission;
use App\Statics\Permissions\DashboardPermission;
use App\Statics\Permissions\DiscountVoucherPermission;
use App\Statics\Permissions\InvoicePermission;
use App\Statics\Permissions\PermissionPermission;
use App\Statics\Permissions\RolePermission;
use App\Statics\Permissions\RollPermission;
use App\Statics\Permissions\RollTransactionPermission;
use App\Statics\Permissions\ShoppingPermission;
use App\Statics\Permissions\UnitPermission;
use App\Statics\Permissions\UserPermission;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        viewShare([
            "customerPermissions" => CustomerPermission::class,
            "dashboardPermissions" => DashboardPermission::class,
            "invoicePermissions" => InvoicePermission::class,
            "permissionPermissions" => PermissionPermission::class,
            "rolePermissions" => RolePermission::class,
            "rollPermissions" => RollPermission::class,
            "rollTransactionPermissions" => RollTransactionPermission::class,
            "shoppingPermissions" => ShoppingPermission::class,
            "unitPermissions" => UnitPermission::class,
            "userPermissions" => UserPermission::class,
            "discountVoucherPermissions" => DiscountVoucherPermission::class,
        ]);
    }
}
