<option value=""></option>
@foreach($subCategories as $subCategory)
    <option value="{{$subCategory->uuid}}">{{$subCategory->subcategory}}</option>
@endforeach