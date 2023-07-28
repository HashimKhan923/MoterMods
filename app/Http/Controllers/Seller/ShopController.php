<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index($id)
    {
       $data = Shop::where('seller_id',$id)->first();

       return response()->json(['data'=>$data]);
    }

    public function update(Request $request)
    {
        $update =Shop::where('id',$request->id)->first();
        $update->name = $request->shop_name;
        $update->address = $request->shop_address;
        if($request->file('banner'))
        {
                $file= $request->banner;
                $filename= date('YmdHis').$file->getClientOriginalName();
                $file->storeAs('public', $filename);
                $update->banner = $filename;
        }
        if($request->file('logo'))
        {
                $file= $request->logo;
                $filename= date('YmdHis').$file->getClientOriginalName();
                $file->storeAs('public', $filename);
                $update->logo = $filename;
        }
        $update->save();

        $response = ['status'=>true,"message" => "Shop Updated Successfully!"];
        return response($response, 200);
    }
}
