<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sales extends Model
{
    protected $table = 'sales';
    protected $dates =  ['created_at', 'updated_at'];
    protected $fillable = ['id', 'product_id'];
}

