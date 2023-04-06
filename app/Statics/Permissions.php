<?php

namespace App\Statics;

use App\Statics\Permissions\CustomerPermission;
use App\Statics\Permissions\IssuedTokenPermission;
use App\Statics\Permissions\PermissionPermission;
use App\Statics\Permissions\RolePermission;
use App\Statics\Permissions\UnitPermission;
use App\Statics\Permissions\UserPermission;

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
}
