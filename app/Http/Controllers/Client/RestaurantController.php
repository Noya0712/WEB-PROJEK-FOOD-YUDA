<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 
use App\Models\Menu;
use App\Models\Product;
use App\Models\City;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\Galery;


class RestaurantController extends Controller
{
    public function AllMenu(){
        $id = Auth::guard('client')->id();
        $menu = Menu::where('client_id',$id)->orderBy('id','desc')->get();
        return view('client.backend.menu.all_menu', compact('menu'));
    } 
    // End Method 

    public function AddMenu(){
        return view('client.backend.menu.add_menu');
    } 
    // End Method 

    public function StoreMenu(Request $request){
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/menu/'.
            $name_gen));
            $save_url = 'upload/menu/' .$name_gen;

            Menu::create([
                'menu_name' => $request->menu_name,
                'client_id' => Auth::guard('client')->id(),
                'image' => $save_url,
            ]);
        }
        $notification = array(
            'message' => 'Menu Inserted Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('all.menu')->with($notification);
    }
    //end method

    public function EditMenu($id){
        $menu = Menu::find($id);
        return view('client.backend.menu.edit_menu', compact('menu'));
    }
    //end method

    public function UpdateMenu(Request $request){

        $menu_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/menu/'.
            $name_gen));
            $save_url = 'upload/menu/' .$name_gen;

            Menu::find($menu_id)->update([
                'menu_name' => $request->menu_name,
                'image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Category Updated Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.menu')->with($notification);

        }else{

            Menu::find($menu_id)->update([
                'menu_name' => $request->menu_name,
            ]);
            $notification = array(
                'message' => 'Menu Updated Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.menu')->with($notification);

        }

    }
    //end method

    public function DeleteMenu($id){
        $item = Menu::find($id);
        $img = $item->image;
        unlink($img);

        Menu::find($id)->delete();

        $notification = array(
            'message' => 'Category Delete Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
    //end method

    ////ALL PRODUCT METHOD///////
    public function AllProduct(){
        $id = Auth::guard('client')->id();
        $product = Product::where('client_id',$id)->orderBy('id','desc')->get();
        return view('client.backend.product.all_product', compact('product'));
    } 
    // End Method 

    public function AddProduct(){
        $id = Auth::guard('client')->id();
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::where('client_id', $id)->latest()->get();
        return view('client.backend.product.add_product', compact('category', 'city', 'menu'));
    } 
    // End Method 

    public function StoreProduct(Request $request){

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
                'client_id' => Auth::guard('client')->id(),
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
        
        return redirect()->route('all.product')->with($notification);
    }
    //end method

    public function EditProduct($id){
        $cid = Auth::guard('client')->id();
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::where('client_id', $cid)->latest()->get();
        $product = Product::find($id);
        return view('client.backend.product.edit_product',
        compact('category', 'city', 'menu', 'product'));
    } 
    // End Method

    public function UpdateProduct(Request $request){

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
            
            return redirect()->route('all.product')->with($notification);

        }else{
            Product::find($pro_id)->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ','-',$request->name)),
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'menu_id' => $request->menu_id,
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
            
            return redirect()->route('all.product')->with($notification);
        }
    }
    //end method

    public function DeleteProduct($id){
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

    public function ChangeStatus(Request $request){
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => 'Status Change Successfully']);
    }


    /////////ALL GALERY METHOD START/////////////

    public function AllGalery(){
        $cid = Auth::guard('client')->id();
        $galery = Galery::where('client_id',$cid)->latest()->get();
        return view('client.backend.galery.all_galery', compact('galery'));
    }
    //end method

    public function AddGalery(){
        return view('client.backend.galery.add_galery');
    }
    //end method

    public function StoreGalery(Request $request){
        
        $images = $request->file('galery_img');

        foreach ($images as $gimg) {

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $gimg->getClientOriginalExtension();
            $img = $manager->read($gimg);
            $img->resize(850,500)->save(public_path('upload/galery/'.
            $name_gen));
            $save_url = 'upload/galery/' .$name_gen;

            Galery::insert([
                'client_id' => Auth::guard('client')->id(),
                'galery_img' => $save_url,
            ]);
        }//end foreach

        $notification = array(
            'message' => 'Galery Inserted Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('all.galery')->with($notification);

    }
    //end method

    public function EditGalery($id){
        $galery = Galery::find($id);
        return view('client.backend.galery.edit_galery', compact('galery'));
    }
    //end method

    public function UpdateGalery(Request $request){

        $galery_id = $request->id;

        if ($request->HasFile('galery_img')) {
            $image = $request->file('galery_img');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.
            $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(500,500)->save(public_path('upload/galery/'.
            $name_gen));
            $save_url = 'upload/galery/' .$name_gen;

            $galery = Galery::find($galery_id);
            if ($galery->galery_img) {
                $img = $galery->galery_img;
                unlink($img);
            }

            $galery->update([
                'galery_img' => $save_url,
            ]);

            $notification = array(
                'message' => 'Image Updated Succesfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.galery')->with($notification);

        }else{

            $notification = array(
                'message' => 'No Image Selected for Update',
                'alert-type' => 'warning'
            );
            
            return redirect()->back()->with($notification);

        }

    }
    //end method

    public function DeleteGalery($id){
        $item = Galery::find($id);
        $img = $item->galery_img;
        unlink($img);

        Galery::find($id)->delete();

        $notification = array(
            'message' => 'Galery Delete Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
    //end method

}