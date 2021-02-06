<div class="top-category d-flex justify-content-between">
    <span><i class="fas fa-medal mr-2"></i> ! {{App\Models\Category::find($category->category)->title }}</span>
    <span>{{ $category->glory }}</span>
</div>