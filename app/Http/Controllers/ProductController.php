<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
    public function list(Request $request)
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->getAll()->paginate(6);

        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getAll();

        $page = $request->page;
        if(empty($page)) $page = 1;
        
        return view('product.list', [
            'products' => $products,
            'companies' => $companies,
        ])->with([
            'products'=> $products,
            'page'=> $page
        ]);
    }
    
    /*一覧画面-検索*/
    public function search(Request $request)
    {   
        $date = $request->all();
        
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->searchDate($date)->paginate(6);
        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getAll();        
        $pager = $products;

        return response()->json([
            'products' => $products,
            'companies' => $companies,
        ]);
        
    }

    /*一覧画面-ソート */
    public function sort(Request $request)
    {   
        $sort = $request->sort;
        $order = $request->order;
	    //パラメータが無い場合（デフォルト）はidの降順（desc）を設定
        if (is_null($sort) && is_null($order)) {
            $sort = 'id';
            $order = 'desc';
        }

        $orderpram = "desc";
	    //設定されたデータの並びがdescの場合、viewのリンクパラメータ$orderに昇順（asc）を設定
        if($order=="desc"){
            $orderpram="asc";
        }

	    //idのソートデータを20件取得
        $listpages = Product::orderBy($sort, $order)->paginate(20);
        
        return view('product.list', [
            'products' => $products,
            'companies' => $companies,
            'order' => $orderpram,
        ]);
        
    }

    /*一覧画面-削除 */
    public function destroy(Request $request)
    {   
        $products = Product::findOrfail($request->id);
        $products->delete();
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
    /*登録画面-更新 */
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
    /*商品編集画面-更新 */
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

    /*API-ページネーション-送信 */
    public function jsonpage()
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->getPage()->paginate(6);
        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getPage();

        return response()->json([
            'products' => $products,
            'companies' => $companies,
        ]);
    }
    /*API-ページネーション-適用 */
    public function jsonajax(Request $request)
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->getPage()->paginate(6);
        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getPage();

        return view('product.list', [
            'products' => $products,
            'companies' => $companies,
        ])->with([
            'products'=> $products,
        ]);
    }

}
