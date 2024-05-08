<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','order_date','total_items','subtotal','tax','total_amount'];

    public function items(){
        return $this->hasMany("\App\Models\OrderItem","order_id","id");
    }

    public function customerInfo(){
        return $this->hasOne("\App\Models\User","id","customer_id");
    }
}
