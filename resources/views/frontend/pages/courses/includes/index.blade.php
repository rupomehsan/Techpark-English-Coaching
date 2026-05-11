@if($data->what_is_this_course)
<div class="co-section">
    <h3 class="co-heading">{{ $data->title }} কী?</h3>
    <div class="co-text">{!! $data->what_is_this_course !!}</div>
</div>
@endif

@if($data->why_is_this_course)
<div class="co-section">
    <h3 class="co-heading">এই কোর্স আপনাকে কীভাবে সাহায্য করবে?</h3>
    <div class="co-text">
        <style>.co-text>ul{padding-left:22px;} .co-text>ul li{list-style:disc; margin-bottom:4px;}</style>
        {!! $data->why_is_this_course !!}
    </div>
</div>
@endif
