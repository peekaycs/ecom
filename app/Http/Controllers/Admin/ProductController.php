<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\AttributeGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductAttributeImage;
use Image;
use File;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.products',array('products' => $products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $attributeGroups = AttributeGroup::all();
        return view('admin.create-product',array('categories' => $categories,'subCategories' => $subCategories, 'attributeGroups' => $attributeGroups));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $this->validateProduct($request);
        $product_id = Str::uuid();
        $user_id = Auth::user()->uuid;
        // Product Image
        $productImage = $this->getProductImage($request->file('image'), $request->product);
        $product_id = Str::uuid();
        // product
        $product = Product::create(
            [
            'id' => $product_id,
            'user_id' => $user_id,
            'product' => $request->product,
            'category_id' =>    $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'published' => $request->status,
            'short_description' => $request->short_description,
            'featured'  => $request->featured,
            'order' => $request->order,
            'image' => $productImage['actualImage']
            ]
        );

        // product image

        $productImage = ProductImage::create(
            [
                'uuid'  => Str::uuid(),
                'product_id' => $product_id,
                'image' => $productImage['actualImage'],
            ]
        );

        $inputData = $request->all();
       
        $attribute_groups_count = $request->attribute_group_id;
        for($i = 0; $i < count($attribute_groups_count); $i++){
            $attribute_data[] = [
                'id' => Str::uuid(),
                'product_id' => $product_id,
                'attribute_group_id' => $inputData['attribute_group_id'][$i],
                'attribute_id' => $inputData['attribute'][$i],
                'price' => $inputData['attribute_price'][$i],
                'discount' => $inputData['attribute_discount'][$i],
                'order' => $inputData['attribute_order'][$i],
            ];
        }
        if($product){
            foreach($attribute_data as $key=>$attribute){
                $productAttribute = false;
                $productAttribute = ProductAttribute::create($attribute);
                if($productAttribute){
                    $attributeImage = $this->getProductImage($inputData['attribute_images'][$key], $request->product);
                    ProductAttributeImage::create(
                        [
                            'uuid'  => Str::uuid(),
                            'product_id' => $product_id,
                            'product_attribute_id'  => $attribute['id'],
                            'image' => $attributeImage['actualImage']
                        ]
                    );
                }
            }
            return redirect(route('create-product'))->with('success','Product saved successfully');
           }
           return redirect(route('create-product'))->with('error','Can\'t save product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $id)
    {
        //
        echo '<pre>';
        $product = Product::with('attributes')->get();
        foreach ($product as $p){
            print_r($p);
        }
        die;
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $attributeGroups = AttributeGroup::all();
        return view('admin.create-product',array('categories' => $categories,'subCategories' => $subCategories, 'attributeGroups' => $attributeGroups));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    private function validateProduct($request){
        $request->validate(
            [
                'product' => 'required',
            ]
        );
    }

    private function getProductImage($image, $name){
        if($image){
            $input['file'] = Str::lower($name.Str::random(10)).'.'.$image->getClientOriginalExtension();
            $thumbnail = '/images/products/thumbnails';
            $actualImage = '/images/products';
            $targetPath = public_path($thumbnail);
            if (!File::exists($targetPath)) {
                File::makeDirectory($targetPath);
            }
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($targetPath.'/'.$input['file']);
            $path['thumbnail'] = $thumbnail.'/'.$input['file'];

            $actualImage = '/images/products';
            $targetPath = public_path($actualImage);
            if (!File::exists($targetPath)) {
                File::makeDirectory($targetPath);
            }
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($targetPath.'/'.$input['file']);
            $path['actualImage'] = $actualImage.'/'.$input['file'];
            return $path;

        }
    }
}
