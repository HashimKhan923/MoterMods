<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\OneBanner;
use App\Models\TwoBanner;
use App\Models\ThreeBanner;
use App\Models\Shop;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $Products = Product::where('published',1)->get();
        $Categories = Category::where('is_active',1)->get();
        $Brands = Brand::where('is_active',1)->get();
        $Banners = Banner::where('status',1)->get();
        $OneBanner = OneBanner::first();
        $TwoBanners = TwoBanner::all();
        $ThreeBanners = ThreeBanner::all();
        $Shops = Shop::all();
        $LatestBlogs = Blog::latest()->limit(6)->get();

        return response()->json(['Products'=>$Products,'Categories'=>$Categories,'Brands'=>$Brands,'Banners'=>$Banners,'OneBanner'=>$OneBanner,'TwoBanners'=>$TwoBanners,'ThreeBanners'=>$ThreeBanners,'Shops'=>$Shops
        ,'LatestBlogs'=>$LatestBlogs]);
    }

    
}
