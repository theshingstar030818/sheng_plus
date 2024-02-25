@if($imagePath)
    <img src="{{ Storage::url($imagePath) }}" alt="Image" style="max-width: 200px; max-height: 200px;">
@endif