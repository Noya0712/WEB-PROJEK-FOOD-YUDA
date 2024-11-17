<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Menu;
use App\Models\Galery;
use App\Models\Wishlist;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function RestaurantDetails($id){
        $client = Client::find($id);
        $menus = Menu::where('client_id',$client->id)->get()->filter(function($menu){
            return $menu->products->isNotEmpty();
        });
        $galerys = Galery::where('client_id',$id)->get();
        return view('frontend.details_page', compact('client','menus','galerys'));
    }
    //end method

    public function AddWishList(Request $request, $id){
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('client_id',$id)->first();
            if (!$exists) {
                Wishlist::insert([
                    'user_id'=> Auth::id(),
                    'client_id' => $id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Your Wishlist Addedd Succesfully']);
            } else {
                return response()->json(['error' => 'This Product Already on Your account']);
            }

        }else {
            return response()->json(['error' => 'First Login Your Account']);
        }
    }
    //end method


    public function AllWishlist(){
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.dashboard.all_wishlist', compact('wishlist'));
    }
    //end method

    public function RemoveWishlist($id){
        Wishlist::find($id)->delete();

        $notification = array(
            'message' => 'Wishlist Deleted Succesfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
    //end method

}
