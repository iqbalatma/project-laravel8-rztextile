<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name", "message", "customer_segmentation_id", "discount"];

    public function customer_segmentation()
    {
        return $this->belongsTo(CustomerSegmentation::class);
    }
}
