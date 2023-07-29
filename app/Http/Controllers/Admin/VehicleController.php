<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $data = Vehicle::where('status',1)->get();

        return response()->json(['data'=>$data]);
    }

    public function create(Request $request)
    {
        $new = new Vehicle();
        $new->name = $request->name;
        $new->save();

        $response = ['status'=>true,'message'=>'New Vechile Added Successfully'];

        return response($response,200);

    }

    public function update(Request $request)
    {
        $update = Vehicle::where('id',$request->id)->first();
        $update->name = $request->name;
        $update->save();

        $response = ['status'=>true,'message'=>'Vechile Updated Successfully'];

        return response($response,200);

    }

    public function delete($id)
    {
        Vehicle::find($id)->delete();

        $response = ['status'=>true,'message'=>'Vechile Deleted Successfully'];

        return response($response,200);
    }

    public function status($id)
    {
        $status = Vehicle::where('id',$id)->first();

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
