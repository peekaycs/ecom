<div class="form-group form-floating-label  @error('attribute') has-error @enderror">
    <select id="" name="attribute_group_id[]"   class="form-control input-border-bottom" onchange="fetchAttributeOptions(this)" required>
        <option value=""></option>
        @foreach($attributeGroups as $attributeGroup)
            <option value="{{$attributeGroup->id}}" href="{{route('get-attribute-options',$attributeGroup->id)}}">{{$attributeGroup->name}}</option>
        @endforeach
    </select>
    <label for="inputFloatingLabel" class="placeholder">Attribute Group</label>
    @error('attribute_group')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group form-floating-label  @error('attribute') has-error @enderror">
    <select  name="attribute[]"   class="form-control input-border-bottom dynamic-attribute" required>
        <option value=""></option>
        
    </select>
    <label for="inputFloatingLabel" class="placeholder">Attribute</label>
    @error('attribute')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group form-floating-label @error('attribute_price') has-error @enderror">
    <input type="number" class="form-control input-border-bottom" name="attribute_price[]" id="attribute_price" min=0 step=.01 required>
    <label for="inputFloatingLabel" class="placeholder">Attribute Price</label>
    @error('attribute_price')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group form-floating-label @error('attribute_discount') has-error @enderror">
    <input type="number" class="form-control input-border-bottom" name="attribute_discount[]" id="attribute_discount" min=0 step=.01 required>
    <label for="inputFloatingLabel" class="placeholder">Attribute discount</label>
    @error('attribute_discount')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group form-floating-label @error('attribute_order') has-error @enderror">
    <input type="number" class="form-control input-border-bottom" name="attribute_order[]" id="attribute_order" min=0 step=1 required>
    <label for="inputFloatingLabel" class="placeholder">Attribute Order</label>
    @error('attribute_order')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group @error('attribute_images') has-error @enderror">
<label for="exampleFormControlFile" class="placeholder">Attribute Image</label>
    <input type="file" class="form-control input-border-bottom" name="attribute_images[]" id="attribute_images"  required>
    @error('attribute_images')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group" style="border-bottom: 2px solid #000;"></div>