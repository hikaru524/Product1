<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list()
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->getAll();
        return view('product.list', [
        'products' => $products

        ]);
    }


    /*登録画面*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createShow()
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->getAll();
        
        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getAll();

        return view('product.create-show', [
            'companies' => $companies

        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {   
        $data = $request->all();
        
        DB::beginTransaction();
        try {
            $products_model = app()->make('App\Models\Product');
            $products = $products_model->InsertProduct($data);
        } catch (\Exception $e) {
            DB::rollback();
        } 
        DB::commit();

        
        return redirect('create');
    }


    /*商品詳細画面 */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productshow()
    {   
        
        return view('product.product-show');
    }


    /*商品編集画面 */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productedit()
    {   

        return view('product.product-edit');
    }
}
