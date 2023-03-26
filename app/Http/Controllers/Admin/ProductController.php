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
use App\Models\Attribute;
use App\Models\Brand;
use Image;
use File;
use DB;

use Cart;
use Darryldecode\Cart\Facades\CartFacade;

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
        $products = Product::with(['brand'])->orderBy('updated_at','desc')->paginate(env('PER_PAGE'))->withQueryString();
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
        $brands = Brand::all();
        return view('admin.create-product',array('categories' => $categories,'subCategories' => $subCategories, 'attributeGroups' => $attributeGroups,'brands'=>$brands));
    
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
            'brand_id' => $request->brand_id,
            'category_id' =>    $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'comission' => $request->comission ?? 0,
            'shipping_cost' => $request->shipping_cost ?? 0,
            'quantity' => $request->quantity,
            'published' => $request->published,
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
        if($attribute_groups_count){
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
            }
        }
    if($product)
        return redirect(route('create-product'))->with('success','Product saved successfully');
    else
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
        
        $product = Product::find($id); 
        
        // all attributes
        $productAttributes = ProductAttribute::with('productAttributeImage')->where('product_id',$product->id)->get();
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id',$product->category_id)->get();
        $attributeGroups = AttributeGroup::all();
        $attributes = Attribute::all();
        $brands = Brand::all();
        return view('admin.edit-product',array('product'=>$product,'categories' => $categories,'subCategories' => $subCategories, 'attributeGroups' => $attributeGroups,'productAttributes' => $productAttributes,'attributes'=>$attributes,'brands'=>$brands));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        //
        $product = Product::find($id);

        // update product
        $product->product = $request->product;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->slug = $request->slug;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->comission = $request->comission ?? 0;
        $product->shipping_cost = $request->shipping_cost ?? 0;
        $product->quantity = $request->quantity;
        $product->published = $request->published;
        $product->short_description = $request->short_description;
        $product->featured = $request->featured;
        $product->order = $request->order;
        if(!empty($request->file('image'))){
            $productImage =  $this->getProductImage($request->file('image'),$request->product);
            $product->image = $productImage['actualImage'];
        }

        $product_saved = $product->save();
        // attributes
        $inputData = $request->all();
       
        $attribute_groups_count = $request->attribute_group_id;
        if($attribute_groups_count){
            for($i = 0; $i < count($attribute_groups_count); $i++){
                if(isset($inputData['old_attribute'][$i])){
                $productAttribute = ProductAttribute::where('id',$inputData['old_attribute'][$i])->first();
                if($productAttribute){
                        $productAttribute->attribute_group_id = $inputData['attribute_group_id'][$i];
                        $productAttribute->attribute_id  = $inputData['attribute'][$i];
                        $productAttribute->price = $inputData['attribute_price'][$i];
                        $productAttribute->discount = $inputData['attribute_discount'][$i];
                        $productAttribute->order = $inputData['attribute_order'][$i];
                        // echo $inputData['attribute_images'][$i];
                        // echo '>br>';
                        if(!empty($inputData['attribute_images'][$i])){
                            $productImage =  $this->getProductImage($inputData['attribute_images'][$i],$request->product);
                            if(isset($inputData['old_attribute_image'][$i]) && !empty($inputData['old_attribute_image'][$i]) ){
                                $productAttributeImage = ProductAttributeImage::find($inputData['old_attribute_image'][$i]);
                                $productAttributeImage->image = $productImage['actualImage'];
                                $productAttributeImage->save();
                            }
                        }
                        $productAttribute->save();
                }
                }else{
                    $productAttrbuteId = Str::uuid();
                    $new_attribute = [
                        'id' => $productAttrbuteId,
                        'product_id' => $id,
                        'attribute_group_id' => $inputData['attribute_group_id'][$i],
                        'attribute_id' => $inputData['attribute'][$i],
                        'price' => $inputData['attribute_price'][$i],
                        'discount' => $inputData['attribute_discount'][$i],
                        'order' => $inputData['attribute_order'][$i],
                    ];
                    ProductAttribute::create($new_attribute);
                    $newImage = $this->getProductImage($inputData['attribute_images'][$i],$request->product);
                    ProductAttributeImage::create([
                        'uuid'  => Str::uuid(),
                        'product_id' => $id,
                        'product_attribute_id' => $productAttrbuteId,
                        'image' => $newImage['actualImage']
                        ]
                    ); 
                }
            }
        }
          
        if($product_saved)
            return redirect(route('edit-product',$id))->with('success','Product updated successfully');
        else   
            return redirect(route('create-product',$id))->with('error','Can\'t update product');
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
                File::makeDirectory($targetPath,0755, true);
            }
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($targetPath.'/'.$input['file']);
            $path['thumbnail'] = $thumbnail.'/'.$input['file'];

            $actualImage = '/images/products';
            $targetPath = public_path($actualImage);
            if (!File::exists($targetPath)) {
                File::makeDirectory($targetPath,0755, true);
            }
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($targetPath.'/'.$input['file']);
            $path['actualImage'] = $actualImage.'/'.$input['file'];
            return $path;

        }
    }

    public function product()
    {
        //
        $data = [];
        $data['category'] = Category::All();
        return view('front.product', $data);
    }

    public function product_detail($slug)
    {
        //
        $data = [];
        $data['category'] = Category::All();
        $data['product'] = Product::WHERE('slug',$slug)->first();
        $data['popular_health'] = Product::All();

        $userId = 100; // or any string represents user identifier
        Cart::session($userId);
        $cartCollection = Cart::getContent();
        // count carts contents
        $data['count'] = $cartCollection->count();
        //$data['count'] = getTotalQuantity();

        return view('front.product_detail', $data);
    }

}
