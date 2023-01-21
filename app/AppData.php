<?php

namespace App;

class AppData
{
    public const COMPANY_NAME = "RZ TEXTILE";
    public const COMPANY_ADDRESS = "Jalan Raya Tegal Nomor 92";
    public const COMPANY_EMAIL = "cs@rztextile.com";
    public const COMPANY_PHONE = "+62895123123";
    public const DEFAULT_PERPAGE = 10;

    public const ROLE_ID_CUSTOMER = 4;
    public const ROLE_ID_CASHIER = 3;
    public const ROLE_ID_SUPERADMIN = 1;

    public const BARCODE_LENGTH = 8;

    public const TABLE_ROLL = "rolls";
    public const TABLE_USER = "users";
    public const TABLE_PROMOTION_MESSAGE = "promotion_messages";

    public const TRANSACTION_TYPE_RESTOCK = "restock";
    public const TRANSACTION_TYPE_SOLD = "sold";
    public const TRANSACTION_TYPE_BROKEN = "broken";

    public const CUSTOMER_SEGMENTS = [
        [
            "id" => 1,
            "key" => "mvc",
            "name" => "Most Valueable Customers",
        ],
        [
            "id" => 2,
            "key" => "mgc",
            "name" => "Most Growthable Customers",
        ],
        [
            "id" => 3,
            "key" => "m",
            "name" => "Migration Customer",
        ],
        [
            "id" => 4,
            "key" => "bz",
            "name" => "Bellow Zero Customer"
        ]
    ];
}
