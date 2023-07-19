<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TwoBanner;

class TwoBannerController extends Controller
{
    public function index()
    {
        $data = TwoBanner::get();

        return response()->json(['data'=>$data]);
    }

    public function create(Request $request)
    {
        $data = TwoBanner::count();

        if($data <= 2)
        {
            $data = new TwoBanner();

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
            $response = ['status'=>true,"message" => "You Can't upload more than 2 Banners!"];
            return response($response, 200);

        }

        


    }

    public function update(Request $request)
    {
        $data = TwoBanner::where('id',$request->id)->first();

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
        $delete=TwoBanner::find($id);

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
