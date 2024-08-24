<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name','brand','img_path','comment','price','category_id','status_id','sell_flg','shipping_user_id','buy_user_id'];
}
