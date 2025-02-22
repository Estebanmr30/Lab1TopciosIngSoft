<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {

        $viewData = [];

        $viewData['title'] = 'Products - Online Store';

        $viewData['subtitle'] = 'List of products';

        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        // if (!isset(ProductController::$products[$id - 1]) || ! ProductController::$products) {
        //     return redirect()->route('home.index');
        // }

        $viewData = [];
        $product = Product::findOrFail($id);

        $viewData['title'] = $product['name'].' - Online Store';

        $viewData['subtitle'] = $product['name'].' - Product information';

        $viewData['product'] = $product;

        $viewData['price'] = $product['price'];

        return view('product.show')->with('viewData', $viewData);
    }

    public function create(): View
    {

        $viewData = []; // to be sent to the view

        $viewData['title'] = 'Create product';

        return view('product.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {

        $request->validate([

            'name' => 'required',

            'price' => 'required',

        ]);
        // return redirect()->route('product.validation');

        Product::create($request->only(['name', 'price']));

        return back();
    }

    public function validation(): View
    {
        return view('product.validation');
    }
}
