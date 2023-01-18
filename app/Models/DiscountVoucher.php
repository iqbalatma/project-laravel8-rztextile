<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountVoucher extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "code", "is_valid", "promotion_message_id"
    ];


    public function promotion_message()
    {
        return $this->belongsTo(PromotionMessage::class);
    }
}
