<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sales;

class SalesController extends Controller
{
    public function index()
    {
        try {
             $version = Sales::first();
             $result = [
                 'result'      => true,
                 'version'     => $version->version,
                 'min_version' => $version->min_version
             ];
         } catch(\Exception $e){
             $result = [
                 'result' => false,
                 'error' => [
                     'messages' => [$e->getMessage()]
                 ],
             ];
             return $this->resConversionJson($result, $e->getCode());
         }
         return $this->resConversionJson($result);
     }
 
     private function resConversionJson($result, $statusCode=200)
     {
         if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
             $statusCode = 500;
         }
         return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
     }
    
    //jsonを返す
    public function json()
    {   
        $products_model = app()->make('App\Models\Product');
        $products = $products_model->getAll()->paginate(6);

        $company_model = app()->make('App\Models\Company');
        $companies = $company_model->getAll();
        
        return \Response::json([
            'products' => $products,
            'companies' => $companies,
        ]);
    }
    
    //ajax
    public function ajax()
    {   
        $page = $products->input('page');
        if(empty($page)) $page = 1;

        return view('product.ajax')->with('page', $page);
    }
}
