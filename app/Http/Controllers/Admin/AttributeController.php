<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeGroup;
use App\Models\Attribute;

class AttributeController extends Controller
{
    //

    public function index(Request $request){
        $attributes = Attribute::with('attributeGroup')->paginate(env('PER_PAGE'));
        return view('admin/attributes', array('attributes' => $attributes));
    }
    /**
     *  @Route("admin/create-attributes 
     */
    public function create(Request $request){
        $attributeGroups = AttributeGroup::all();
        return view('admin/create-attribute',array('attributeGroups' => $attributeGroups));
    }

    public function store(Request $request){
        $request->validate(
            [
                'name' => 'required|string|min:3|max:25',
                'group_id' => 'required|integer',
                'status' => 'required|integer'
            ]
        );

        // $validated = $request->safe()->all();
        $attribute = Attribute::create(
            [
                'group_id' => $request->group_id,
                'name' => $request->name,
                'status' => $request->status
            ]

        );

       return $attribute ? redirect(route('create-attribute'))->with('success', 'Attribute saved successfully') : redirect(route('create-attribute'))->with('error', 'Can\'t save attribute'); 
    }

    public function form(Request $request){
        $attributeGroups = AttributeGroup::all();

        echo view('admin.auxiliary.attribute-form', array('attributeGroups' => $attributeGroups));
    }

    public  function options(Request $request,$id){
        $attributes = Attribute::where('group_id',$id)->get();
        echo view('admin.auxiliary.attribute-options', array('attributes' => $attributes));
    }

    public function edit(Request $request, $id) {
        $attribute = Attribute::find($id);
        $attributeGroups = AttributeGroup::all();
        return view('admin.edit-attribute', array('attribute' => $attribute,'attributeGroups'=>$attributeGroups));
    }

    public function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|string|min:3|max:25',
                'group_id' => 'required|integer',
                'status' => 'required|integer'
            ]
        );

        $attribute = Attribute::find($id);

            $attribute->group_id = $request->group_id;
            $attribute->name = $request->name;
            $attribute->status = $request->status;            
            $saved = $attribute->save();
       return $saved ? redirect(route('edit-attribute',$id))->with('success', 'Attribute updated successfully') : redirect(route('edit-attribute',$id))->with('error', 'Can\'t update attribute'); 
    }
}
