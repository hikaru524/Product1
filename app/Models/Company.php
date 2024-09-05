<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;

    public $table = 'companies';

    /**
     * 
     * @param
     */
    public function getAll(){
        $companies = DB::table($this->table)->get();

        return $companies;
    }

    public function getPage(){
        $companies = DB::table($this->table)->get();

        return $companies;
    }
}
