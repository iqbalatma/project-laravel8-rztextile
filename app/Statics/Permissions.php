<?php

namespace App\Statics;

use App\Statics\Permissions\IssuedTokenPermission;
use App\Statics\Permissions\RolePermission;

class Permissions
{
    public const ROLES = [
        ["name" => RolePermission::INDEX, "description" => "Permission to access roles index"],
        ["name" => RolePermission::CREATE, "description" => "Permission to access roles create"],
        ["name" => RolePermission::STORE, "description" => "Permission to access add new role"],
        ["name" => RolePermission::UPDATE, "description" => "Permission to access update role by id"],
        ["name" => RolePermission::DESTROY, "description" => "Permission to access delete role by id"],
    ];
}
