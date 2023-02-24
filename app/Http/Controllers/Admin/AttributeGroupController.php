<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeGroup;
use PhpParser\Node\AttributeGroup as NodeAttributeGroup;

class AttributeGroupController extends Controller
{
    //

    public function index(Request $request){
        $attributeGroups = AttributeGroup::paginate(env('PER_PAGE'))->withQueryString();
        return view('admin.attribute-groups',array('attributeGroups' => $attributeGroups));
    }

    public function create(Request $request){
        return view('admin.create-attribute-group');
    }

    public function store(Request $request){
        $request->validate( // validate attributes group
            [
                'name' => 'required|string|min:3|max:25|unique:attribute_groups',
            ]
        );

       // create attribute group
       $attributeGroup =  AttributeGroup::create(['name' => $request->name]);
       if($attributeGroup){
        return redirect(route('create-attribute-group'))->with('success','Attribute group saved successfully');
       }
       return redirect(route('create-attribute-group'))->with('error','Can\'t create attribute group');
    }
}
