<div class="form-group @error('images') has-error @enderror">
<label for="exampleFormControlFile" class="placeholder">Banner Image</label>
    <input type="file" class="form-control input-border-bottom" name="images[]" id="images"  required>
    @error('banner_images')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group @error('title') has-error @enderror">
<label for="exampleFormControlFile" class="placeholder">Title</label>
    <input type="text" class="form-control input-border-bottom" name="title[]" id="title"  >
    @error('title')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group @error('link') has-error @enderror">
<label for="exampleFormControlFile" class="placeholder">Banner Link</label>
    <input type="url" class="form-control input-border-bottom" name="link[]" id="title"  >
    @error('link')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group" style="border-bottom: 2px solid #000;"></div>