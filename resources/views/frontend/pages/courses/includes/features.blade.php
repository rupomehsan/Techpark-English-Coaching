@php
$featSections = [
    [
        'title' => 'এই কোর্সে আপনি কী শিখবেন?',
        'icon'  => 'fa-solid fa-lightbulb',
        'color' => '#fff9e6',
        'icolor'=> '#c07800',
        'items' => $data->course_you_will_learn()->where('status','active')->get(),
    ],
    [
        'title' => 'এই কোর্স কাদের জন্য?',
        'icon'  => 'fa-solid fa-users',
        'color' => '#eef5ff',
        'icolor'=> '#0057b3',
        'items' => $data->course_for_whom()->where('status','active')->get(),
    ],
    [
        'title' => 'কেন আমাদের কাছ থেকে শিখবেন?',
        'icon'  => 'fa-solid fa-star',
        'color' => '#f0fff6',
        'icolor'=> '#00a651',
        'items' => $data->course_why_you_learn_from_us()->where('status','active')->get(),
    ],
    [
        'title' => 'কোর্সে আপনি কী পাবেন?',
        'icon'  => 'fa-solid fa-gift',
        'color' => '#fff0f8',
        'icolor'=> '#c0006e',
        'items' => $data->course_what_you_will_get()->where('status','active')->get(),
    ],
];
@endphp

<ul class="feat-list">
    @foreach($featSections as $idx => $section)
        @if($section['items']->count() > 0)
        <li class="feat-item {{ $idx === 0 ? 'active' : '' }}">
            <div class="feat-trigger">
                <div class="feat-ico" style="background:{{ $section['color'] }}; color:{{ $section['icolor'] }};">
                    <i class="{{ $section['icon'] }}"></i>
                </div>
                <span class="feat-name">{{ $section['title'] }}</span>
                <span style="font-size:0.7rem; color:#999; margin-right:8px; white-space:nowrap;">{{ $section['items']->count() }} টি</span>
                <div class="feat-arrow"><i class="fa-solid fa-chevron-down"></i></div>
            </div>
            <div class="feat-body">
                <ul class="feat-ul">
                    @foreach($section['items'] as $item)
                        <li>
                            <i class="fa-regular fa-circle-check ck"></i>
                            <span>{{ $item->title }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
        @endif
    @endforeach
</ul>

<script>
document.querySelectorAll('.feat-trigger').forEach(function(trigger) {
    trigger.addEventListener('click', function() {
        const item = this.closest('.feat-item');
        const isOpen = item.classList.toggle('active');
        const arrow = item.querySelector('.feat-arrow i');
        if (arrow) arrow.style.transform = isOpen ? 'rotate(180deg)' : '';
    });
});
// Init already-active items
document.querySelectorAll('.feat-item.active .feat-arrow i').forEach(function(i) {
    i.style.transform = 'rotate(180deg)';
});
</script>
