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
            $data = Product::where('name', 'LIKE', '%'.$request->searchValue.'%')
            ->where('category_id',$request->category_id)
            ->get();
        }
        else
        {
            $data = Product::where('name', 'LIKE', '%'.$request->searchValue.'%')->get();
        }

        return response()->json(['data'=>$data]);


    }



    public function multiSearch(Request $request)
    {
        $query = Product::query();
    
        // Apply filters based on user input
        if ($request->has('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }
    
        if ($request->has('min_price')) {
            $query->where('price','>=',$request->min_price)->where('price','<=',$request->max_price);
        }
    
    
        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->has('engine_id')) {
            $query->where('engine_id', $request->engine_id);
        }

        if ($request->has('condition')) {
            $query->where('condition', $request->condition);
        }
    
        $data = $query->get();
    
        return response()->json(['data'=>$data]);
    }
}
