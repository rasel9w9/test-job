<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','product_id','variant_id','quantity','price','tax','total'];

    public function variant(){
        return $this->hasOne("\App\Models\ProductVariant","id","variant_id");
    }

    public function product(){
        return $this->hasOne("\App\Models\Product","id","product_id");
    }
}
