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
        // $image = 
        $product_id = Str::uuid();
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
            'image' => $request->file('file')
            ]
        );
        $input_data = $request->all();
        $attribute_groups_count = $request->attribute_group_id;
        for($i = 0; $i < count($attribute_groups_count); $i++){
            $attribute_data[] = [
                'id' => Str::uuid(),
                'product_id' => $product_id,
                'attribute_group_id' => $input_data['attribute_group_id'][$i],
                'attribute_id' => $input_data['attribute'][$i],
                'price' => $input_data['attribute_price'][$i],
                'discount' => $input_data['attribute_discount'][$i],
                'order' => $input_data['attribute_order'][$i],
            ];
        }
        if($product){
            foreach($attribute_data as $attribute){
                ProductAttribute::create($attribute);
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
    public function edit(Product $product)
    {
        //
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
}
