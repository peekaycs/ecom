<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\BannerImage;
use Illuminate\Support\Str;
use Image;
use File;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banners = Banner::paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.banners',array('banners'=>$banners));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.create-banner');
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

        $request->validate([
            'name' => 'required|string',
            'type' => ['required','string',Rule::unique('banners')],
            'status' => 'required|boolean',
        ]);
        $inputData = $request->all();
        $id = Str::uuid();
        $banner = Banner::create(array_merge(['id' => $id ],$request->all()));
        if($banner){
            $images = $request->images ?? [];
            if($images){
                $bannerImage = new BannerImage;
                foreach($images as $key=>$image){
                    $imagePath = $this->getImage($inputData['images'][$key], $request->name);
                    if($imagePath){
                        $bannerImage->id = Str::uuid();
                        $bannerImage->banner_id = $id;
                        $bannerImage->title = $inputData['title'][$key];
                        $bannerImage->link = $inputData['link'][$key];
                        $bannerImage->image = $imagePath['thumbnail'];
                        $bannerImage->save();
                    }
                }
            }
            return redirect(route('create-banner'))->with('success','Banner created successfully');
        }else{
            return redirect(route('create-banner'))->with('error','Can\'t create banner');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $banner = Banner::with('bannerImages')->find($id);
        return view('admin.edit-banner', array('banner' => $banner));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(
            [
            'name' => 'required|string',
            'type' => ['required','string',Rule::unique('banners')->ignore($id)],           'status' => 'required|boolean',
            ]
        );
        $banner = Banner::find($id);
        $banner->name = $request->name;
        $banner->type = $request->type;
        $banner->status = $request->status;
        $isSaved = $banner->save();
        $inputData = $request->all();
        if($isSaved){
            $titles = $request->title ?? [];
            if($titles){
                
                foreach($titles as $key=>$title){
                    if(isset($inputData['old_image'][$key] ) && !empty($inputData['old_image'][$key])){
                        $bannerImage = BannerImage::find($inputData['old_image'][$key]);
                        if(!empty($inputData['images'][$key])){
                            $imagePath = $this->getImage($inputData['images'][$key], $request->name);
                            $bannerImage->image = $imagePath['thumbnail'];
                        }
                        if($bannerImage){
                            $bannerImage->title = $inputData['title'][$key];
                            $bannerImage->link = $inputData['link'][$key];
                            $bannerImage->save();
                        }
                    }else{
                        $bannerImage = new BannerImage;
                        if(!empty($inputData['images'][$key])){
                            $imagePath = $this->getImage($inputData['images'][$key], $request->name);
                            $bannerImage->image = $imagePath['thumbnail'];
                        }
                        if($imagePath){
                            $bannerImage->id = Str::uuid();
                            $bannerImage->banner_id = $id;
                            $bannerImage->title = $inputData['title'][$key];
                            $bannerImage->link = $inputData['link'][$key];
                            $bannerImage->save();
                        }
                    }
                }
            }
            return redirect(route('edit-banner',$id))->with('success','Banner updated successfully');
        }else{
            return redirect(route('edit-banner',$id))->with('error','Can\'t updated banner');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBannerImageForm(Request $request){
        echo view('admin.auxiliary.banner-image-form');
    }

    private function getImage($image, $name){
        if($image){
            $input['file'] = Str::lower($name.Str::random(10)).'.'.$image->getClientOriginalExtension();
            $thumbnail = '/images/banners/thumbnails';
            $actualImage = '/images/banners';
            $targetPath = public_path($thumbnail);
            if (!File::exists($targetPath)) {
                File::makeDirectory($targetPath,0755, true);
            }
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($targetPath.'/'.$input['file']);
            $path['thumbnail'] = $thumbnail.'/'.$input['file'];

            $actualImage = '/images/banners';
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

    public function delete(Request $request, $id){
        Banner::find($id)->delete();
        return redirect()->back()->with('success','Banner deleted successfully');
   }
}
