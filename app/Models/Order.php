<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','order_id','customer_name','sh_address','sh_city','sh_state','sh_zip_code','bl_address','bl_city','bl_state','bl_zip_code',
                            'mobile','cellphone','email','product','quantity','delivery_method','card_number','card_exp','card_cvv','amount','comment','company','tracking_id'];
}
