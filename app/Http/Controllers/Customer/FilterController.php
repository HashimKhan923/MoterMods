<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FilterController extends Controller
{



    public function search(Request $request)
    {

        if($request->category_id != null)
        {
            $data = Product::with('user','category','brand','stock','discount','tax','shipping','deal.deal_product','vehicle','engine')->where('name', 'LIKE', '%'.$request->searchValue.'%')
            ->where('category_id',$request->category_id)
            ->get();
        }
        else
        {
            $data = Product::with('user','category','brand','stock','discount','tax','shipping','deal.deal_product','vehicle','engine')->where('name', 'LIKE', '%'.$request->searchValue.'%')->get();
        }

        return response()->json(['data'=>$data]);


    }



    public function multiSearch(Request $request)
    {
        $query = Product::query();
    
        // Apply filters based on user input
        if ($request->vehicle_id != null) {
            $query->where('vehicle_id', $request->vehicle_id);
        }
    

        if ($request->min_price != null && $request->max_price != null) {
            $query->where('price', '>=', $request->min_price)->where('price', '<=', $request->max_price);
        } elseif ($request->min_price != null) {
            $query->where('price', '>=', $request->min_price);
        } elseif ($request->man_price != null) {
            $query->where('price', '<=', $request->max_price);
        }
    
        if ($request->brand_id != null) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->engine_id != null) {
            $query->where('engine_id', $request->engine_id);
        }

        if ($request->condition != null) {
            $query->where('condition', $request->condition);
        }
    
        $data = $query::with('user','category','brand','stock','discount','tax','shipping','deal.deal_product','vehicle','engine')->where('published',1)->get();
    
        return response()->json(['data'=>$data]);
    }
}
