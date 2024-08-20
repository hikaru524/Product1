<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsAPIController extends Controller
{
    public function page(Request $request, Product $product)
    {
        $param['id'] = $request->id ?? '';
        $param['product_name'] = $request->product_name ?? '';

        $product = $product->where('id', $param['id']);
        $product = $product_name->where('id', $param['product_name']);

        $contents = $product->pagenate(6);
        return response()->view(
            'product.list',
            compact('contents', 'param')
        );
    }
}
