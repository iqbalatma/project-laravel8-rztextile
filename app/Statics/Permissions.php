<?php

namespace App\Statics;

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
use App\Statics\Permissions\UserProfilePermission;

class Permissions
{
    public const ROLES = [
        ["name" => RolePermission::INDEX, "description" => "Permission to access roles index"],
        ["name" => RolePermission::CREATE, "description" => "Permission to access roles create"],
        ["name" => RolePermission::EDIT, "description" => "Permission to access roles edit"],
        ["name" => RolePermission::STORE, "description" => "Permission to access add new role"],
        ["name" => RolePermission::UPDATE, "description" => "Permission to access update role by id"],
        ["name" => RolePermission::DESTROY, "description" => "Permission to access delete role by id"],
    ];
    public const PERMISSIONS = [
        ["name" => PermissionPermission::INDEX, "description" => "Permission to access permissions index"],
    ];

    public const UNITS = [
        ["name" => UnitPermission::INDEX, "description" => "Permission to access unit index"],
        ["name" => UnitPermission::CREATE, "description" => "Permission to access unit create"],
        ["name" => UnitPermission::EDIT, "description" => "Permission to access unit edit"],
        ["name" => UnitPermission::STORE, "description" => "Permission to access add new unit"],
        ["name" => UnitPermission::UPDATE, "description" => "Permission to access update unit by id"],
        ["name" => UnitPermission::DESTROY, "description" => "Permission to access delete unit by id"],
    ];
    public const USERS = [
        ["name" => UserPermission::INDEX, "description" => "Permission to access users index"],
        ["name" => UserPermission::CREATE, "description" => "Permission to access users create"],
        ["name" => UserPermission::EDIT, "description" => "Permission to access users edit"],
        ["name" => UserPermission::STORE, "description" => "Permission to access add new users"],
        ["name" => UserPermission::UPDATE, "description" => "Permission to access update users by id"],
        ["name" => UserPermission::CHANGE_STATUS_ACTIVE, "description" => "Permission to access delete users by id"],
    ];
    public const CUSTOMERS = [
        ["name" => CustomerPermission::INDEX, "description" => "Permission to access customers index"],
        ["name" => CustomerPermission::CREATE, "description" => "Permission to access customers create"],
        ["name" => CustomerPermission::EDIT, "description" => "Permission to access customers edit"],
        ["name" => CustomerPermission::STORE, "description" => "Permission to access add new customers"],
        ["name" => CustomerPermission::UPDATE, "description" => "Permission to access update customers by id"],
        ["name" => CustomerPermission::DESTROY, "description" => "Permission to access delete customers by id"],
    ];
    public const ROLLS = [
        ["name" => RollPermission::SEARCH_INDEX, "description" => "Permission to access roll search index"],
        ["name" => RollPermission::INDEX, "description" => "Permission to access roll index"],
        ["name" => RollPermission::CREATE, "description" => "Permission to access roll create"],
        ["name" => RollPermission::STORE, "description" => "Permission to access roll store"],
        ["name" => RollPermission::EDIT, "description" => "Permission to access roll edit"],
        ["name" => RollPermission::UPDATE, "description" => "Permission to access roll update"],
        ["name" => RollPermission::DOWNLOAD_QRCODE, "description" => "Permission to access roll download qrcode"],
        ["name" => RollPermission::PRINT_QRCODE, "description" => "Permission to access roll print qrcode"],
    ];
    public const ROLLS_TRANSACTIONS = [
        ["name" => RollTransactionPermission::INDEX, "description" => "Permission to access roll transaction index"],
        ["name" => RollTransactionPermission::CREATE, "description" => "Permission to access roll transaction create"],
        ["name" => RollTransactionPermission::STORE, "description" => "Permission to access roll transaction store"],
    ];
    public const INVOICES = [
        ["name" => InvoicePermission::INDEX, "description" => "Permission to access invoice index"],
        ["name" => InvoicePermission::PDF, "description" => "Permission to access invoice pdf"],
    ];
    public const SHOPPING = [
        ["name" => ShoppingPermission::INDEX, "description" => "Permission to access shopping index"],
        ["name" => ShoppingPermission::PURCHASE, "description" => "Permission to access shopping purchaseing"],
    ];
    public const DASHBOARD = [
        ["name" => DashboardPermission::INDEX, "description" => "Permission to access dashboard index"],
    ];
    public const USER_PROFILES = [
        ["name" => UserProfilePermission::EDIT, "description" => "Permission to access user profile edit"],
        ["name" => UserProfilePermission::UPDATE, "description" => "Permission to access user profile update"],
    ];
    public const DISCOUNT_VOUCHERS = [
        ["name" => DiscountVoucherPermission::INDEX, "description" => "Permission to access discount voucher index"],
        ["name" => DiscountVoucherPermission::CREATE, "description" => "Permission to access discount voucher create"],
        ["name" => DiscountVoucherPermission::STORE, "description" => "Permission to access add new discount voucher"],
        ["name" => DiscountVoucherPermission::CHANGE_VALIDATE_STATUS, "description" => "Permission to access change validate status discount voucher by id"],
    ];
}
