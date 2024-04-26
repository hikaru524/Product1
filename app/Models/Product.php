<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    const UPDATED_AT = null;
    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment'
    ];

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
        ->orderBy('id','asc')
        ->get();

        return $products;
    }

    /**
     * 
     * @param
     */
    public function searchDate($date){
        $products = DB::table($this->table)
        ->select(
            'products.*',
            'companies.id as company_id',
            'companies.company_name as company_name',
        )
        ->leftjoin('companies', 'products.company_id', '=', 'companies.id');

        if(!empty($date['keyword'])){
            $keyword = $date['keyword'];
            $products->where(function ($products) use($keyword){
                $products->orwhere('product_name','like', '%'.$keyword.'%');
                $products->orwhere('comment','like', '%'.$keyword.'%');
            });
        }

        if(!empty($date['company_id'])){
            $company_id = $date['company_id'];
            $products->where('company_id',$company_id);
        }

        $products->orderBy('id','asc');
        $products = $products->get();

        return $products;
    }

    /**
     * 
     * @param
     */
    public function getOneDate($id){
        $products = DB::table($this->table)
        ->select(
            'products.*',
            'companies.id as company_id',
            'companies.company_name as company_name',
        )
        ->leftjoin('companies', 'products.company_id', '=', 'companies.id')
        ->where('products.id',$id)
        ->first();

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

    /**
     * 更新処理
     */
    public function updateProduct($request, $products)
    {
        $update = $products->fill([
            'product_name' => $request->product_name
        ])->save();

        return $update;
    }

    /*一覧画面-削除 */
    public function deleteBookById($id)
    {
        $products_del->destroy($id);
    }

}
