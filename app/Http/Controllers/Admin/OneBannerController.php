<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OneBanner;
use Illuminate\Support\Facades\Storage;

class OneBannerController extends Controller
{
    public function index()
    {
        $data = OneBanner::first();

        return response()->json(['data'=>$data]);
    }

    public function createOrUpdate(Request $request)
    {
        $data = OneBanner::first();

        if($data)
        {
            if($request->file('image')){

                $image_path = 'app/public'.$data->image;
                if(Storage::exists($image_path))
                {
                    Storage::delete($image_path);
                }
    
                $file= $request->file('image');
                $filename= date('YmdHis').$file->getClientOriginalName();
                $file->storeAs('public', $filename);
                $data->image = $filename;
    
            }
        }
        else
        {
            $data = new OneBanner();

            if($request->file('image')){    
                $file= $request->file('image');
                $filename= date('YmdHis').$file->getClientOriginalName();
                $file->storeAs('public', $filename);
                $data->image = $filename;
    
            }

        }

        $data->save();

        $response = ['status'=>true,"message" => "Saved Successfully!"];
        return response($response, 200);
    }
}
