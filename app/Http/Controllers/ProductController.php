<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request): View
    // {
    //     $products = Product::paginate();
    //     $categories = Category::all();
    //     return view('product.index', compact('products'))
    //         ->with('i', ($request->input('page', 1) - 1) * $products->perPage());
    // }
    // public function index(Request $request): View
    // {
    //     $products = Product::paginate(3);
    //     $categoryController = new CategoryController();
    //     $categories = $categoryController->getAllCategories();

    //     return view('product.index', [
    //         'products' => $products,
    //         'categories' => $categories,
    //         'i' => ($request->input('page', 1) - 1) * $products->perPage(),
    //     ]);

    // }

    public function index(Request $request): View
    {
        $products = Product::paginate(3);
        $categoryController = new CategoryController();
        $categories = $categoryController->getAllCategories();

        // Get product count per category
        $productCounts = [];
        foreach ($categories as $category) {
            $productCounts[$category->id] = Product::where('category_id', $category->id)->count();
        }

        // Get total product count
        $totalProductCount = Product::count();

        return view('product.index', [
            'products' => $products,
            'categories' => $categories,
            'productCounts' => $productCounts,
            'totalProductCount' => $totalProductCount,
            'i' => ($request->input('page', 1) - 1) * $products->perPage(),
        ]);
    }


    public function showByCategory(Request $request): View
    {
        // Obtener el ID de la categoría seleccionada desde la solicitud
        $categoryId = $request->input('category');
        $categoryController = new CategoryController();
        $categories = $categoryController->getAllCategories();

        // Filtrar los productos por el ID de la categoría si se ha seleccionado una categoría
        $productsQuery = Product::query();
        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }

        // Obtener los productos paginados
        $products = $productsQuery->paginate(3);

        // Get product count per category
        $productCounts = [];
        foreach ($categories as $category) {
            $productCounts[$category->id] = Product::where('category_id', $category->id)->count();
        }

        // Get total product count
        $totalProductCount = Product::count();

        return view('product.index', [
            'products' => $products,
            'selectedCategory' => $categoryId,
            'categories' => $categories,
            'productCounts' => $productCounts,
            'totalProductCount' => $totalProductCount,
            'i' => ($request->input('page', 1) - 1) * $products->perPage(),
        ]);
    }



    // public function showByCategory(Request $request): View
    // {
    //     // Obtener el ID de la categoría seleccionada desde la solicitud
    //     $categoryId = $request->input('category');
    //     $categoryController = new CategoryController();
    //     $categories = $categoryController->getAllCategories();

    //     // Filtrar los productos por el ID de la categoría si se ha seleccionado una categoría
    //     $productsQuery = Product::query();
    //     if ($categoryId) {
    //         $productsQuery->where('category_id', $categoryId);
    //     }

    //     // Obtener los productos paginados
    //     $products = $productsQuery->paginate(3);

    //     return view('product.index', [
    //         'products' => $products,
    //         'selectedCategory' => $categoryId,
    //         'categories' => $categories,
    //         'i' => ($request->input('page', 1) - 1) * $products->perPage(3),
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $product = new Product();

        return view('product.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['picture'] = '/images/' . $imageName;
        }

        Product::create($data);
        
        return Redirect::route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('product.show', compact('product'));
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $product = Product::find($id);

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return Redirect::route('products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Product::find($id)->delete();

        return Redirect::route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
