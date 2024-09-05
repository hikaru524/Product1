<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        // リクエストから必要なデータを取得する
        $id = $request->input('product_id'); 
        $quantity = $request->input('quantity', 1); 
        
        // データベースから対象の商品を検索・取得
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->searchId($id);

        // 商品が存在しない、または在庫が不足している場合のバリデーションを行う
        if (!$products) {
            return response()->json(['message' => '商品が存在しません'], 404);
        }
        if ($products < $quantity) {
            return response()->json(['message' => '商品が在庫不足です'], 400);
        }
        
        // 在庫を減少させる
        $products -= $quantity; // $quantityは購入数を指し、デフォルトで1が指定されている
        $stock = $products;
        $products = Product::find($id);
        $products->update([
            "stock" => $stock
        ]);

        // Salesテーブルに商品IDと購入日時を記録する
        $sales_model = app()->make('App\Models\Sales');
        $sales = $sales_model->updateStock($id);
        // レスポンスを返す
        return response()->json(['message' => '購入成功']);
    }
}
