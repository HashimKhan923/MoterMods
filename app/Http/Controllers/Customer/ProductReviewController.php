<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class ProductReviewController extends Controller
{
    public function create(Request $request)
    {
        $check = ProductReview::where('user_id',$request->user_id)->first();

        if($check)
        {
            
        $response = ['status'=>true,"message" => "Already Reviewed!"];
        return response($response, 200);

        }

        $new = new ProductReview();
        $new->product_id = $request->product_id;
        $new->name = $request->name;
        $new->title = $request->title;
        $new->comment = $request->comment;
        $new->rating = $request->rating;
        $new->save();

        $response = ['status'=>true,"message" => "review Created Successfully!"];
        return response($response, 200);
    }

    // public function update(Request $request)
    // {
    //     $update = ProductReview::where('id',$request->id)->first();
    //     $update->name = $request->name;
    //     $update->title = $request->title;
    //     $update->comment = $request->comment;
    //     $update->rating = $request->rating;
    //     $update->save();

    //     $response = ['status'=>true,"message" => "review updated Successfully!"];
    //     return response($response, 200);
    // }

    // public function delete($id)
    // {
    //     ProductReview::find($id)->delete();

    //     $response = ['status'=>true,"message" => "review deleted Successfully!"];
    //     return response($response, 200);
    // }
}
