<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Backend\Category;
use App\Models\Backend\Supplier;
use App\Services\ExportService;
use App\Services\ImportService;
use Milon\Barcode\Facades\DNS1DFacade;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('backend.products.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $request->validated();

        if (isset($product['image']))
            $product['image'] = ImageHelper::saveImage($product['image'], 'images/product-images');

        Product::create($product);

        $notification = array(
            'message' => 'Product created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $barcode = DNS1DFacade::getBarcodeHTML($product->code, 'C128');
        return view('backend.products.barcode', compact('product', 'barcode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('backend.products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->file('image')) {
            $data['image'] = ImageHelper::saveImage($data['image'], 'images/product-images');
            if ($product->image)
                ImageHelper::softDelete($product->image, $product->name);
        }

        $product->update($data);

        $notification = array(
            'message' => 'Product updated successfully',
            'alert-type' => 'success'
        );

        return to_route('products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->photo)
            ImageHelper::softDelete($product->photo, $product->name);

        $product->delete();

        $notification = array(
            'message' => 'Product deleted successfully.',
            'alert-type' => 'success'
        );

        return to_route('products.index')->with($notification);
    }

    public function importPage()
    {
        return view('backend.products.import-page');
    }

    public function export(ExportService $export)
    {
        $products = Product::select(['name', 'category_id', 'supplier_id', 'code', 'garage', 'image', 'store', 'buying_date', 'expire_date', 'buying_price', 'selling_price'])->get();

        return $export->toExcel($products, ['Column', 'Nullable', 'Description'], [
            ['Name', 'no', 'Product Name'],
            ['Category Id', 'no', 'Category ID based on the category name (ID must equal to the Category ID in the Category table)'],
            ['Supplier Id', 'no', 'Supplier ID based on the supplier name (ID must equal to the Supplier ID in the Supplier table)'],
            ['Code', 'yes', 'Product Code'],
            ['Garage', 'yes', 'Garage Stock For This Product'],
            ['Image', 'yes', 'Path of the image ex: C:\images\file_name.jpg'],
            ['Store', 'yes', 'Store Stock For This Product'],
            ['Buying Date', 'yes', 'Format: (YYYY-MM-DD) | ex: 2020-01-30'],
            ['Expire Date', 'yes', 'Format: (YYYY-MM-DD) | ex: 2020-01-30'],
            ['Buying Price', 'yes', 'Buying Price (This will be used for auto fill when make sales order/ invoice)'],
            ['Selling Price', 'yes', 'Selling Price (This will be used for auto fill when make Purchase order/ invoice)'],
        ]);
    }

    public function import(ImportService $import)
    {
        $import->importExcel(request()->file('import'), new Product(), [
            'Name' => 'name',
            'Category Id' => 'category_id',
            'Supplier Id' => 'supplier_id',
            'Code' => 'code',
            'Garage' => 'garage',
            'Image' => 'image',
            'Store' => 'store',
            'Buying Date' => 'buying_date',
            'Expire Date' => 'expire_date',
            'Buying Price' => 'buying_price',
            'Selling Price' => 'selling_price'
        ]);

        return to_route('products.index');
    }

    public function importSample(ImportService $import)
    {
        return $import->importSample(
            'products-sample',
            ['Column', 'Nullable', 'Description'],
            [
                ['Name', 'no', 'Product Name'],
                ['Category Id', 'no', 'Category ID based on the category name (ID must equal to the Category ID in the Category table)'],
                ['Supplier Id', 'no', 'Supplier ID based on the supplier name (ID must equal to the Supplier ID in the Supplier table)'],
                ['Code', 'yes', 'Product Code'],
                ['Garage', 'yes', 'Garage Stock For This Product'],
                ['Image', 'yes', 'Path of the image ex: C:\images\file_name.jpg'],
                ['Store', 'yes', 'Store Stock For This Product'],
                ['Buying Date', 'yes', 'Format: (YYYY-MM-DD) | ex: 2020-01-30'],
                ['Expire Date', 'yes', 'Format: (YYYY-MM-DD) | ex: 2020-01-30'],
                ['Buying Price', 'yes', 'Buying Price (This will be used for auto fill when make sales order/ invoice)'],
                ['Selling Price', 'yes', 'Selling Price (This will be used for auto fill when make Purchase order/ invoice)'],
            ],
            [
                [
                    'name' => 'Product 1',
                    'category_id' => '1',
                    'supplier_id' => '1',
                    'code' => 'P-001',
                    'garage' => 'A',
                    'image' => 'C:\images\file_name.jpg',
                    'store' => '100',
                    'buying_date' => '2020-01-01',
                    'expire_date' => '2020-01-01',
                    'buying_price' => '100',
                    'selling_price' => '200',
                ],
                [
                    'name' => 'Product 2',
                    'category_id' => '1',
                    'supplier_id' => '1',
                    'code' => 'P-002',
                ]
            ]
        );
    }
}
