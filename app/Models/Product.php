<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','sku','unit','unit_value','image','selling_price','purchase_price','discount','tax'];

    public function variants(){
        return $this->hasMany("\App\Models\ProductVariant","product_id","id");
    }
}
