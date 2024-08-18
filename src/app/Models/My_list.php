<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class My_list extends Model
{
    use HasFactory;

    protected $fillable = ['item_id','user_id'];
}
