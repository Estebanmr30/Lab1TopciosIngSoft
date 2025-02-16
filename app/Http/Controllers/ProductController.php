<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Mockery\Undefined;
use Illuminate\Http\RedirectResponse;


class ProductController extends Controller

{

    public static $products = [

        ["id" => "1", "name" => "TV", "description" => "Best TV", "price" => 90],

        ["id" => "2", "name" => "iPhone", "description" => "Best iPhone", "price" => 2000],

        ["id" => "3", "name" => "Chromecast", "description" => "Best Chromecast", "price" => 3000],

        ["id" => "4", "name" => "Glasses", "description" => "Best Glasses", "price" => 4000],

    ];


    public function index(): View

    {

        $viewData = [];

        $viewData["title"] = "Products - Online Store";

        $viewData["subtitle"] = "List of products";

        $viewData["products"] = ProductController::$products;

        return view('product.index')->with("viewData", $viewData);
    }


    public function show(string $id): View|RedirectResponse

    {
        if (!isset(ProductController::$products[$id - 1]) || ! ProductController::$products) {
            return redirect()->route('home.index');
        }

        $viewData = [];
        $product = ProductController::$products[$id - 1];

        $viewData["title"] = $product["name"] . " - Online Store";

        $viewData["subtitle"] = $product["name"] . " - Product information";

        $viewData["product"] = $product;

        $viewData["price"] = $product["price"];

        return view('product.show')->with("viewData", $viewData);
    }
    public function create(): View

    {

        $viewData = []; //to be sent to the view

        $viewData["title"] = "Create product";


        return view('product.create')->with("viewData", $viewData);
    }


    public function save(Request $request):RedirectResponse

    {

        $request->validate([

            "name" => "required",

            "price" => "required",

        ]);

        // dd($request->all());
        return redirect()->route('product.validation');

        //here will be the code to call the model and save it to the database

    }

    public function validation(): View

    {
        return view('product.validation');
    }
}
