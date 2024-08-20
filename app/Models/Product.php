<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable; // ソート機能

    const UPDATED_AT = null;
    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'img_path',
        'company_id',
        'comment'
    ];
    public $sortable = [
        'id',
        'product_name',
        'price',
        'stock',
        'company_id',
    ];

    public $table = 'products';

    /**
     * 
     * @param
     */
    public function getAll(){
        $products = Product::sortable($this->table)
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
        
        $products = Product::sortable($this->table)
        ->select(
            'products.*',
            'companies.id as company_id',
            'companies.company_name as company_name',
        )
        ->leftjoin('companies', 'products.company_id', '=', 'companies.id');

        /*検索-ワード */
        if(!empty($date['keyword'])){
            $keyword = $date['keyword'];
            $products->where(function ($products) use($keyword){
                $products->orwhere('product_name','like', '%'.$keyword.'%');
                $products->orwhere('comment','like', '%'.$keyword.'%');
            });
        }
        /*検索-会社*/
        if(!empty($date['company_id'])){
            $company_id = $date['company_id'];
            $products->where('company_id',$company_id);
        }
        /*検索-価格 */
        /*最小*/
        if(!empty($date['price_min'])){
            $price_min = $date['price_min'];
            $products->where(function ($products) use($price_min){
                $products->orwhere('price','>=', $price_min);
            });
        }
        /*最大*/        
        if(!empty($date['price_max'])){
            $price_max = $date['price_max'];
            $products->where(function ($products) use($price_max){
                $products->orwhere('price','<=', $price_max);
            });
        }

        /*検索-在庫 */
        /*最小*/
        if(!empty($date['stock_min'])){
            $stock_min = $date['stock_min'];
            $products->where(function ($products) use($stock_min){
                $products->orwhere('stock','>=', $stock_min);
            });
        }
        /*最大*/        
        if(!empty($date['stock_max'])){
            $stock_max = $date['stock_max'];
            $products->where(function ($products) use($stock_max){
                $products->orwhere('stock','<=', $stock_max);
            });
        }
        $products = $products->get();

        return $products;
    }
    
    /**
     * 
     * @param
     */
    public function sortDate($date){
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
            'img_path' => $data['img_path']->img_path,
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
}
