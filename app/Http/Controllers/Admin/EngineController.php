<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Engine;

class EngineController extends Controller
{
    public function index()
    {
        $data = Engine::where('status',1)->get();

        return response()->json(['data'=>$data]);
    }

    public function create(Request $request)
    {
        $new = new Engine();
        $new->name = $request->name;
        $new->save();

        $response = ['status'=>true,'message'=>'New Engine Added Successfully'];

        return response($response,200);

    }

    public function update(Request $request)
    {
        $update = Engine::where('id',$request->id)->first();
        $update->name = $request->name;
        $update->save();

        $response = ['status'=>true,'message'=>'Engine Updated Successfully'];

        return response($response,200);

    }

    public function delete($id)
    {
        Engine::find($id)->delete();

        $response = ['status'=>true,'message'=>'Engine Deleted Successfully'];

        return response($response,200);
    }

    public function status($id)
    {
        $status = Engine::where('id',$id)->first();

        if($status->status == 0)
        {
            $status->status = 1;
        }
        else
        {
            $status->status = 0;
        }

        $status->save();

        $response = ['status'=>true,"message" => "Status Changed Successfully!"];
        return response($response, 200);
    }
}
