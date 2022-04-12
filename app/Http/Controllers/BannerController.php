<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index(){
        // dd(Carbon::now()->date);
        $categories = Category::all();
        return view('backend.banner.categoryIndex', compact('categories'));
    }

    public function create(){
        return view('backend.banner.bannerCreate');
    }

    public function store(Request $request){
  
        $validator = Validator::make($request->all(), [
            "category" => 'required|min:3|max:30',
            'prices' => 'required',
            'product_titles' => 'required'
        ]);

        if($validator->fails()){
            Session::flash('error', 'something went wrong!');
        }else{
            $category = new Category([
                'name' => $request->category
            ]);
            $category->save();

            $count = $count = count($request->links);
            $products = [];

            for($idx=0; $idx < $count; $idx++){
                if(isset($request->links[$idx])){
                    array_push(
                        $products,
                        [
                            'category_id' =>  $category->id,
                            'url' => $request->links[$idx], 
                            'price' => $request->prices[$idx], 
                            'title' => $request->product_titles[$idx],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]
                    ); // Pushed all data into product array
                }
                elseif($request->hasFile('images')){

                    $image_name = date('m-d-Y_hia')."_".$request->images[$idx]->getClientOriginalName();
                    Storage::disk('public')->put('banners/'.$image_name,  File::get($request->images[$idx]));
                    $image_path = 'uploads/banners/'. $image_name;

                    array_push(
                        $products,
                        [
                            'category_id' =>  $category->id,
                            'image_name' => $image_name,
                            'image_path' => $image_path, 
                            'price' => $request->prices[$idx], 
                            'title' => $request->product_titles[$idx],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                            // 'created_at' => Carbon::now()
                        ]
                    ); // Pushed all data into product array
                }
            }

            if(count($products) > 0){
                DB::table('products')->insert($products);
            }

            Session::flash('success', 'Banner has been created!');
            return redirect()->route('banner-list');
        }
    }

    public function show($id){

        $products = Product::where('category_id', $id)->get();
        $category = Category::find($id);
        $category->clicks = $category->clicks+1;
        $category->save();
        return view('backend.banner.bannerList', compact('products'));
    }

    public function edit($id){

        $category = Category::with('products')->find($id);
        return view('backend.banner.bannerEdit', compact('category'));
    }

    public function update(Request $request, $id){
        // $data = Category::find($id);
        // dd($data);
        // return $request->all();

        // $images = $request->images;
        // foreach(count($request->images) as $image){
        //     array_push($images, $request->hasFile($image) ?  $image : null);
        // }
        // $files = $request->file('images');

        // $count = $count = count($request->links);

        // for($idx=0; $idx < $count; $idx++){
        //     echo(isset($files[$idx]) ? 'yes ' : 'no ');
        // }

        //return $files;


        $validator = Validator::make($request->all(), [
            "category" => 'required|min:3|max:30',
            'prices' => 'required',
            'product_titles' => 'required'
        ]);

        if($validator->fails()){
            Session::flash('error', 'something went wrong!');
        }else{

            $category = Category::where('_id', $id)
                                ->update(['name' => $request->category]);

            // dd($category);

            $count = $count = count($request->links);
            $files = $request->file('images');
            $products = [];

            for($idx=0; $idx < $count; $idx++){
                $product_exist =  Product::where([
                                            ['_id', $request->product_ids[$idx]], 
                                            ['category_id', $id]
                                         ])->first();

                // dd($product_exist);

                if($product_exist){
                    if(isset($request->links[$idx])){
                        $product_exist->url = $request->links[$idx];
                    }elseif(isset($files[$idx])){
                        $image_name = date('m-d-Y_hia')."_".$files[$idx]->getClientOriginalName();
                        Storage::disk('public')->put('banners/'.$image_name,  File::get($files[$idx]));
                        $image_path = 'uploads/banners/'. $image_name;
                        $product_exist->image_name = $image_name;
                        $product_exist->image_path = $image_path; 
                    }

                    $product_exist->price = $request->prices[$idx];
                    $product_exist->title = $request->product_titles[$idx];
                    $product_exist->updated_at = date('Y-m-d H:i:s');
                    $product_exist->save();
                }else{
                    $product_new =  new Product;
                    if(isset($request->links[$idx])){
                        $product_new->url = $request->links[$idx];
                    }elseif(isset($files[$idx])){
                        $image_name = date('m-d-Y_hia')."_".$files[$idx]->getClientOriginalName();
                        Storage::disk('public')->put('banners/'.$image_name,  File::get($files[$idx]));
                        $image_path = 'uploads/banners/'. $image_name;
                        $product_new->image_name = $image_name;
                        $product_new->image_path = $image_path; 
                    }

                    $product_new->category_id = $id;
                    $product_new->price = $request->prices[$idx];
                    $product_new->title = $request->product_titles[$idx];
                    $product_new->updated_at = date('Y-m-d H:i:s');
                    $product_new->save();
                }

                
            }

            

            Session::flash('success', 'Banner updated!');
            return redirect()->route('banner-list');
        }

        return $request->all();
        $images = [];
        foreach($request->images as $image){
            array_push($images, $image);
        }
        dd($images);
       
        $category = Category::with('products')->find($id);
        // dd($category);
        return view('backend.banner.bannerEdit', compact('category'));
    }
}

