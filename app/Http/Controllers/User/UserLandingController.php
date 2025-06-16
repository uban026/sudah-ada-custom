<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserLandingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category')
            ->active()
            ->inStock();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->sort) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;

                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
        $products = $query->paginate(8);
        // Menambahkan parameter query ke URL pagination untuk mempertahankan filter dan pencarian saat navigasi halaman
        $products->appends($request->all());
        return view('landing.landing-page', compact('products', 'categories'));
    }


    public function product(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category')
            ->active()
            ->inStock();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->sort) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;

                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
        $products = $query->paginate(8);
        // Menambahkan parameter query ke URL pagination untuk mempertahankan filter dan pencarian saat navigasi halaman
        $products->appends($request->all());
        return view('landing.product', compact('products', 'categories'));
    }


    public function about(Request $request)
    {

        return view('landing.about');
    }
    public function service(Request $request)
    {

        return view('landing.service');
    }

    public function portofolio(Request $request)
    {

        return view('landing.portofolio');
    }


    public function showCustomBajuPage()
    {
        return view('landing.custom-baju');
    }

    public function customBajuContent()
    {
        return view('landing.custom-baju-content');
    }
}
