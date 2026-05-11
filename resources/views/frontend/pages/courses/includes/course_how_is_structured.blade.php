<div class="struct-grid">
    @foreach($data->course_how_is_structured()->get() as $item)
        <div class="struct-item">
            <div class="struct-check"><i class="fa-solid fa-check"></i></div>
            <span class="struct-label">{{ $item->title }}</span>
        </div>
    @endforeach
</div>
