<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Storage;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $data = BlogCategory::all();

        return response()->json(['data'=>$data]);
    }

    public function create(Request $request)
    {
        $new = new BlogCategory();
        $new->name = $request->name;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file->storeAs('public', $filename);
            $new->image = $filename;
        }
        $new->slug = $request->slug;
        $new->save();

        $response = ['status'=>true,"message" => "Blog Category Created Successfully!"];
        return response($response, 200);
    }

    public function update(Request $request)
    {
        $update = BlogCategory::where('id',$request->id)->first();
        $update->name = $request->name;
        if($request->file('image')){

            $path2 = 'app/public'.$update->image;
            if (Storage::exists($path2)) {
                
                Storage::delete($path2);
            }

            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file->storeAs('public', $filename);
            $update->image = $filename;
        }
        $update->slug = $request->slug;
        $update->save();

        $response = ['status'=>true,"message" => "Blog Category Updated Successfully!"];
        return response($response, 200);
    }

    public function delete($id)
    {
        $delete = BlogCategory::find($id);

        $path2 = 'app/public'.$delete->image;
        if (Storage::exists($path2)) {
            
            Storage::delete($path2);
        }

        $delete->delete();

        $response = ['status'=>true,"message" => "Blog Category Deleted Successfully!"];
        return response($response, 200);
    }
}
