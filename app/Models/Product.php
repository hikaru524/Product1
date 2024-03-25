<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    public $table = 'products';

    /**
     * 
     * @param
     */
    public function getAll(){
        $products = DB::table($this->table)
        ->select(
            'products.*',
            'companies.id as company_id',
            'companies.company_name as company_name',
        )
        ->leftjoin('companies', 'products.company_id', '=', 'companies.id')
        ->get();

        return $products;
    }

    /**
     * 
     * 
     */
    public function insertProduct($data){
        DB::table($this->table)->insert([
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'company_id' => $data['company_id'],
            'comment' => $data['comment'],
            /*'img_path' => $data['img_path'],*/
        ]);
    }

}
