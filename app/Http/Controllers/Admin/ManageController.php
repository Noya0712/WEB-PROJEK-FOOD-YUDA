<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 
use App\Models\Menu;
use App\Models\Client;
use App\Models\Product;
use App\Models\City;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\Galery;
use App\Models\Banner;

class ManageController extends Controller
{
    public function AdminAllProduct(){
        $product = Product::orderBy('id','desc')->get();
        return view('admin.backend.product.all_product', compact('product'));
    } 
    // End Method

    public function AdminAddProduct(){
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::latest()->get();
        $client = Client::latest()->get();
        return view('admin.backend.product.add_product', compact('category', 'city', 'menu', 'client'));
    } 
    // End Method
    
    public function AdminStoreProduct(Request $request){

        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'code', 
        'length' => 5, 'prefix' => 'PC']);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/product/'.
            $name_gen));
            $save_url = 'upload/product/' .$name_gen;

            Product::create([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ','-',$request->name)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'code' => $pcode,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'client_id' => $request->client_id,
                'most_populer' => $request->most_populer,
                'best_seller' => $request->best_seller,
                'status' => 1,
                'created_at' => Carbon::now(),
                'image' => $save_url,
            ]);
        }
        $notification = array(
            'message' => 'Product Inserted Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('admin.all.product')->with($notification);
    }
    //end method

    public function AdminEditProduct($id){
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::latest()->get();
        $client = Client::latest()->get();
        $product = Product::find($id);
        return view('admin.backend.product.edit_product',
        compact('category', 'city', 'menu', 'product', 'client'));
    } 
    // End Method

    public function AdminUpdateProduct(Request $request){

        $pro_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/product/'.
            $name_gen));
            $save_url = 'upload/product/' .$name_gen;

            Product::find($pro_id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ','-',$request->name)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'client_id' => $request->client_id,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'most_populer' => $request->most_populer,
                'best_seller' => $request->best_seller,
                'created_at' => Carbon::now(),
                'image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Product Updated Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('admin.all.product')->with($notification);

        }else{
            Product::find($pro_id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ','-',$request->name)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
                'client_id' => $request->client_id,
                'qty' => $request->qty,
                'size' => $request->size,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'most_populer' => $request->most_populer,
                'best_seller' => $request->best_seller,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Updated Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('admin.all.product')->with($notification);
        }
    }
    //end method

    public function AdminDeleteProduct($id){
        $item = Product::find($id);
        $img = $item->image;
        unlink($img);

        Product::find($id)->delete();

        $notification = array(
            'message' => 'Product Delete Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
    //end method


    ///////////////FOR ALL PENDING AND APPROVE RESTAURANT METHOD////////////////////

    public function PendingRestaurant(){
        $client = Client::where('status', 0)->get();
        return view('admin.backend.restaurant.pending_restaurant', compact('client'));
    }
    //end method//

    public function ClientChangeStatus(Request $request){
        $client = Client::find($request->client_id);
        $client->status = $request->status;
        $client->save();
        return response()->json(['success' => 'Status Change Successfully']);
    }
    ////end method////

    public function ApproveRestaurant(){
        $client = Client::where('status', 1)->get();
        return view('admin.backend.restaurant.approve_restaurant', compact('client'));
    }
    ///end method////


    /////////////// ALL BANNER METHOD IN HERE///////////////////////

    public function AllBanner(){
        $banner = Banner::latest()->get();
        return view('admin.backend.banner.all_banner',compact('banner'));
    }
    ///end method////


    public function BannerStore(Request $request){
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(400,400)->save(public_path('upload/banner/'.
            $name_gen));
            $save_url = 'upload/banner/' .$name_gen;

            Banner::create([
                'url' => $request->url,
                'image' => $save_url,
            ]);
        }
        $notification = array(
            'message' => 'Banner Inserted Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
    //end method

    public function EditBanner($id){
        $banner = Banner::find($id);
        if ($banner) {
            $banner->image = asset($banner->image);
        }
        return response()->json($banner);
    }
    //end method


    public function BannerUpdate(Request $request){

        $banner_id = $request->banner_id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(400,400)->save(public_path('upload/banner/'.
            $name_gen));
            $save_url = 'upload/banner/' .$name_gen;

            Banner::find($banner_id)->update([
                'url' => $request->url,
                'image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Banner Updated Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.banner')->with($notification);

        }else{

            Banner::find($banner_id)->update([
                'url' => $request->url,
            ]);
            $notification = array(
                'message' => 'Banner Updated Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.banner')->with($notification);

        }

    }
    //end method

    public function DeleteBanner($id){
        $item = Banner::find($id);
        $img = $item->image;
        unlink($img);

        Banner::find($id)->delete();

        $notification = array(
            'message' => 'Banner Delete Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
    //end method

}