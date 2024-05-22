<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
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

    /**一覧画面
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list()
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->paginate(6);

        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getAll();

        return view('product.list', [
            'products' => $products,
            'companies' => $companies
        ]);
    }

    /*
    
    /*一覧画面-検索*/
    public function search(Request $request)
    {   
        $date = $request->all();

        $products_model = app()->make('App\Models\Product');
        $products = $products_model->searchDate($date)->paginate(6);

        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getAll();

        return view('product.list', [
        'products' => $products,
        'companies' => $companies
        ]);
    }

    /*一覧画面-削除 */
    public function destroy($id)
    {   
        $products_del = Product::destroy($id);
        
        return redirect('list');
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

        return view('product.product_create', [
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
        $request->validate([
            'product_name' => 'required', 
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'nullable', 
            'img_path' => 'nullable|image',
        ]);
        
        $data = $request->all();
        
        DB::beginTransaction();
        try {
            if($request->hasFile('img_path')){
                $filename = $request->img_path->getClientOriginalName();
                $filePath = $request->img_path->storeAs('products', $filename, 'public');
                $data['img_path']->img_path = '/storage/' . $filePath;
            }
            
            $products_model = app()->make('App\Models\Product');
            $products = $products_model->InsertProduct($data);  
            
        } catch (\Exception $e) {
            dd($data);
            DB::rollback();
        } 
        DB::commit();

        
        return redirect('create');
    }


    /*商品詳細画面 */
    public function productshow($id)
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->getOneDate($id);

        return view('product.product_show', compact('products'));
    }


    /*商品編集画面 */
    public function productedit($id)
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->getOneDate($id);

        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getAll();

        return view('product.product_edit',compact('products'),[
            'products' => $products,
            'companies' => $companies
        ]
        );
    }
    /*商品編集画面-更新 */
    public function productupdate(Request $request)
    {   
        $products = Product::find($request->id);
        $products->update([
            "product_name" => $request->product_name,
            "price" => $request->price,
            "stock" => $request->stock,
            "company_id" => $request->company_id,
            "comment" => $request->comment,
        ]);
        
        return back();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request)
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
}
