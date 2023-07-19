<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThreeBanner;

class ThreeBannerController extends Controller
{
    public function index()
    {
        $data = ThreeBanner::get();

        return response()->json(['data'=>$data]);
    }

    public function create(Request $request)
    {
        $data = ThreeBanner::count();

        if($data <= 3)
        {
            $data = new ThreeBanner();

            if($request->file('image'))
            {

                $image_path = 'app/public'.$data->image;
                if(Storage::exists($image_path))
                {
                    Storage::delete($image_path);
                }
    
                $file= $request->file('image');
                $filename= date('YmdHis').$file->getClientOriginalName();
                $file->storeAs('public', $filename);
                $data->image = $filename;
                $data->save();
    
            }

            $response = ['status'=>true,"message" => "Saved Successfully!"];
            return response($response, 200);
        }
        else
        {
            $response = ['status'=>true,"message" => "You Can't upload more than 3 Banners!"];
            return response($response, 200);

        }

        


    }

    public function update(Request $request)
    {
        $data = ThreeBanner::where('id',$request->id)->first();

        if($request->file('image'))
        {

            $image_path = 'app/public'.$data->image;
            if(Storage::exists($image_path))
            {
                Storage::delete($image_path);
            }

            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file->storeAs('public', $filename);
            $data->image = $filename;
            $data->save();

        }

        $response = ['status'=>true,"message" => "Saved Successfully!"];
        return response($response, 200);
    }

    public function delete($id)
    {
        $delete=ThreeBanner::find($id);

        $image_path = 'app/public'.$delete->logo;
        if(Storage::exists($image_path))
        {
            Storage::delete($image_path);
        }
  
        $delete->delete();
        $response = ['status'=>true,"message" => "Deleted Successfully!"];
        return response($response, 200);
    }
}
