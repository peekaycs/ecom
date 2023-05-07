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
use App\Models\ProductDetail;
use App\Rules\AlphaNumSpace;
use App\Helpers\Helper;
use App\Http\Classes\EcomController;
use Image;
use File;
use DB;

use Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Validation\Rule;

class ProductController extends EcomController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->with(['brand'])->orderBy('updated_at','desc')->paginate(env('PER_PAGE'))->withQueryString();
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
        $request->validate(
            [
                'product' => 'required',
                'slug'  => ['required',new AlphaNumSpace,Rule::unique('products')]
            ]
        );
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

        // product details
        ProductDetail::create(array_merge($request->all(),['id' => Str::uuid(),'product_id' => $product_id]));
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
        
        $product = Product::with('productDetail')->find($id); 
        // dd($product);
        // all attributes
        $productAttributes = ProductAttribute::with(['productAttributeImage'])->where('product_id',$product->id)->get();
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
        $request->validate(
            [
                'product' => 'required',
                'slug'  => ['required',new AlphaNumSpace,Rule::unique('products')->ignore($id)]
            ]
        );
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
                'slug'  => ['required','alpanumeric',Rule::unique('product')]
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

    public function productByCategory(Request $request, $slug)
    {
        $slug = Helper::destructSlug($slug);
        $data = [];
        $data['categories'] = $categories = Category::WHERE('slug', $slug)->first();
        //DB::enableQueryLog();
        $data['products'] = $products = Product::WHERE('category_id', $categories->uuid)->WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy('order','ASC')->orderBy('updated_at','desc')->paginate(env('PER_PAGE'))->withQueryString();
        //dd(DB::getQueryLog());
        $data['brands'] = $brands = Brand::all();
        $data['filter_categories'] = $filter_categories = $categories;
        return $this->createView('front.product', $data);
    }

    public function productBySubCategory(Request $request, $slug)
    {
        $slug = Helper::destructSlug($slug);
        $data['subcategories'] = $subcategories = SubCategory::WHERE('slug', $slug)->first();
        //DB::enableQueryLog();
        $data['products'] = $products = Product::WHERE('subcategory_id', $subcategories->uuid)->WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy('order','ASC')->orderBy('updated_at','DESC')->paginate(env('PER_PAGE'))->withQueryString();
        //dd(DB::getQueryLog());
        $data['brands'] = $brands = Brand::all();
        $data['filter_categories'] = $filter_categories = $subcategories->category;
        return $this->createView('front.product', $data);
    }

    public function productByBrand(Request $request)
    {
        $slug = $request->slug;
        $slug = Helper::destructSlug($slug);

        $brand = $order = '';
        if( isset( $request->brand ) && !empty( $request->brand ) ){
            if( $request->brand == 'ASC' || $request->brand == 'DESC' ){
                $order = $request->brand;
            }else{
                $brand = explode( ',', $request->brand );
            }
         }
            
        if( isset( $request->order ) && !empty( $request->order ) ){
            $order = $request->order;
        }
        $subcategories = SubCategory::WHERE('slug', $slug)->orderBy('order','ASC')->first();
        if(!isset($subcategories) || $subcategories->count() < 1 || empty($subcategories) ){
            $categories = Category::WHERE('slug', $slug)->orderBy('order','ASC')->first();
            $data['filter_categories'] = $filter_categories = $categories;
            $field_name = 'category_id';
            $field_value = $categories->uuid;
        }else{
            $data['filter_categories'] = $filter_categories = $subcategories->category;
            $field_name = 'subcategory_id';
            $field_value = $subcategories->uuid;
        }
        

        if(!empty($brand) && !empty($order)){
            //DB::enableQueryLog();
            $data['products'] = Product::WHERE($field_name, $field_value)->WHERE( 'status', 1 )->WHERE( 'published', 1 )->whereIn('brand_id', $brand)->orderBy('price', $order)->orderBy('order','ASC')->paginate(env('PER_PAGE'))->withQueryString();
            //dd(DB::getQueryLog());
        }elseif(!empty($brand)){
            //DB::enableQueryLog();
            $data['products'] = Product::WHERE($field_name, $field_value)->WHERE( 'status', 1 )->WHERE( 'published', 1 )->whereIn('brand_id', $brand)->orderBy('order','ASC')->orderBy('updated_at', 'DESC')->paginate(env('PER_PAGE'))->withQueryString();
            //dd(DB::getQueryLog());
        }elseif(!empty($order)){
            $data['products'] = Product::WHERE($field_name, $field_value)->WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy('price', $order)->orderBy('order','ASC')->paginate(env('PER_PAGE'))->withQueryString();
        }else{
            $data['products'] = Product::WHERE($field_name, $field_value)->WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy('updated_at', 'DESC')->orderBy('order','ASC')->paginate(env('PER_PAGE'))->withQueryString();
        }

        if( isset( $_GET['page'] ) ){
            $data['brands'] = Brand::all();
            return $this->createView('front.product', $data);
        }else{    
            echo view('front.tpl.brand-wise-product', $data);
        }    
    }

    public function productDetail(Request $request, $slug)
    {
        $slug = Helper::destructSlug($slug);
        $data['product'] = Product::WHERE('slug',$slug)->first();
        $data['popular_health'] = Product::WHERE( 'status', 1 )->WHERE( 'published', 1 )->orderBy('order','ASC')->get();

        return $this->createView('front.product_detail', $data);
    }

    public function delete(Request $request, $id){
        Product::find($id)->delete();
        return redirect()->back()->with('success','Product deleted successfully');
    }

    public function search(Request $request)
    {
        $term = $request->search_term;
        $filter_categories = [];
        $filter_categories['category'] = $term;
        $data['filter_categories'] = (object)$filter_categories;

        $data['products'] = $products = DB::table('products AS P') 
        ->leftJoin('categories AS C', 'C.uuid', '=', 'P.category_id')
        ->leftJoin('subcategories AS SC', 'SC.uuid', '=', 'P.subcategory_id')
        ->Where( 'P.status', 1 )
        ->Where( 'P.published', 1 )
        ->Where(function ($query) use ($term) {
            $query->Where('P.slug','LIKE',"%$term%")
                ->orWhere('C.slug','LIKE',"%$term%")
                ->orWhere('SC.slug','LIKE',"%$term%");
        })
        ->select('P.*')
        ->orderBy('P.order','DESC')
        ->paginate(env('PER_PAGE'))
        ->withQueryString();

        $data['brands'] = Brand::where('status',1)->orderBy('order','ASC')->get();
        return $this->createView('front.product', $data);
    }

    public function searchBy(Request $request)
    {
        $term = $request->search_term;
        $brand = $order = '';
        if( isset( $request->brand ) && !empty( $request->brand ) ){
            if( $request->brand == 'ASC' || $request->brand == 'DESC' ){
                $order = $request->brand;
            }else{
                $brand = explode( ',', $request->brand );
            }
         }
            
        if( isset( $request->order ) && !empty( $request->order ) ){
            $order = $request->order;
        }
        $filter_categories = [];
        $filter_categories['category'] = $term;
        $data['filter_categories'] = (object)$filter_categories;

        if(!empty($brand) && !empty($order)){
            //DB::enableQueryLog();
            $data['products'] = $products = DB::table('products AS P') 
            ->leftJoin('categories AS C', 'C.uuid', '=', 'P.category_id')
            ->leftJoin('subcategories AS SC', 'SC.uuid', '=', 'P.subcategory_id')
            ->Where( 'P.status', 1 )
            ->Where( 'P.published', 1 )
            ->whereIn('P.brand_id', $brand)
            ->Where(function ($query) use ($term) {
                $query->Where('P.slug','LIKE',"%$term%")
                    ->orWhere('C.slug','LIKE',"%$term%")
                    ->orWhere('SC.slug','LIKE',"%$term%");
            })
            ->select('P.*')
            ->orderBy('P.price', $order)
            ->paginate(env('PER_PAGE'))
            ->withQueryString();
            //dd(DB::getQueryLog());
        }elseif(!empty($brand)){
            //DB::enableQueryLog();
            $data['products'] = $products = DB::table('products AS P') 
            ->leftJoin('categories AS C', 'C.uuid', '=', 'P.category_id')
            ->leftJoin('subcategories AS SC', 'SC.uuid', '=', 'P.subcategory_id')
            ->Where( 'P.status', 1 )
            ->Where( 'P.published', 1 )
            ->whereIn('P.brand_id', $brand)
            ->Where(function ($query) use ($term) {
                $query->Where('P.slug','LIKE',"%$term%")
                    ->orWhere('C.slug','LIKE',"%$term%")
                    ->orWhere('SC.slug','LIKE',"%$term%");
            })
            ->select('P.*')
            ->orderBy('P.order','ASC')
            ->paginate(env('PER_PAGE'))
            ->withQueryString();
            //dd(DB::getQueryLog());
        }elseif(!empty($order)){
            //DB::enableQueryLog();
            $data['products'] = $products = DB::table('products AS P') 
            ->leftJoin('categories AS C', 'C.uuid', '=', 'P.category_id')
            ->leftJoin('subcategories AS SC', 'SC.uuid', '=', 'P.subcategory_id')
            ->Where( 'P.status', 1 )
            ->Where( 'P.published', 1 )
            ->Where(function ($query) use ($term) {
                $query->Where('P.slug','LIKE',"%$term%")
                    ->orWhere('C.slug','LIKE',"%$term%")
                    ->orWhere('SC.slug','LIKE',"%$term%");
            })
            ->select('P.*')
            ->orderBy('P.price', $order)
            ->paginate(env('PER_PAGE'))
            ->withQueryString();
            //dd(DB::getQueryLog());
        }else{
            $data['products'] = $products = DB::table('products AS P') 
            ->leftJoin('categories AS C', 'C.uuid', '=', 'P.category_id')
            ->leftJoin('subcategories AS SC', 'SC.uuid', '=', 'P.subcategory_id')
            ->Where( 'P.status', 1 )
            ->Where( 'P.published', 1 )
            ->Where(function ($query) use ($term) {
                $query->Where('P.slug','LIKE',"%$term%")
                    ->orWhere('C.slug','LIKE',"%$term%")
                    ->orWhere('SC.slug','LIKE',"%$term%");
            })
            ->select('P.*')
            ->orderBy('P.order','DESC')
            ->paginate(env('PER_PAGE'))
            ->withQueryString();
        }

        if( isset( $_GET['page'] ) ){
            $data['brands'] = Brand::all();
            return $this->createView('front.product', $data);
        }else{    
            echo view('front.tpl.brand-wise-product', $data);
        }    
    }

}
