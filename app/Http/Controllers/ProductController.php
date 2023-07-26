<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\NewPrice;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        //Insert into Products table
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');
    }


    public function manage(Request $request)
    {
        //All arrays of same length
        $prices = $request->input('price');
        $users = $request->input('user');
        $products = $request->input('product');
        //Merging all arrays
        $combinedArray = array_map(null, $prices, $products, $users);
        foreach ($combinedArray as [$price, $product, $user]) {
            //Check if a Product has already new price for a user or not
            $check = NewPrice::where('user_id', $user)
                ->where('product_id', $product)
                ->count();
            if ($check > 0) {
                //If already has a new price for a user then update that record
                NewPrice::where('user_id', $user)->where('product_id', $product)->update([
                    'product_id' => $product,
                    'user_id' => $user,
                    'newprice' => $price
                ]);
            } else {
                //Else insert a new record into new price table
                $insert = new NewPrice();
                $insert->user_id = $user;
                $insert->product_id = $product;
                $insert->newprice = $price;
                $insert->save();
            }
        }
        return redirect()->back()->with('success', 'Updated successfully!');
    }

    public function viewlist()
    {
        // Get the currently logged-in user ID
        $userId = Auth::user()->id;
        // Check if the user is authenticated
        if ($userId) {
            // Get all products along with their new prices and the old prices too for the logged-in user
            $products = Product::with(['newPrices' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])->get();
            return view('viewlist', compact('products'));
        }
    }
}
