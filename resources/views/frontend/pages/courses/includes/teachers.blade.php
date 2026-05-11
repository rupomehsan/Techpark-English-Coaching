@foreach($data->course_instructors as $teacher)
<div class="instr-card">
    @if($teacher->image)
        <img class="instr-avatar" src="{{ asset($teacher->image) }}" alt="{{ $teacher->full_name }}">
    @else
        <div class="instr-avatar-placeholder">{{ strtoupper(substr($teacher->full_name, 0, 1)) }}</div>
    @endif
    <div style="flex:1; min-width:0;">
        <div class="instr-name">{{ $teacher->full_name }}</div>
        @if($teacher->designation)
            <div class="instr-desig">{{ $teacher->designation }}</div>
        @endif
        @if($teacher->short_description)
            <div class="instr-bio">{!! $teacher->short_description !!}</div>
        @endif
        <div class="instr-social">
            @if($teacher->twitter)
                <a href="{{ $teacher->twitter }}" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a>
            @endif
            @if($teacher->facebook)
                <a href="{{ $teacher->facebook }}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
            @endif
            @if($teacher->linkedin)
                <a href="{{ $teacher->linkedin }}" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>
            @endif
            @if($teacher->instagram)
                <a href="{{ $teacher->instagram }}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
            @endif
        </div>
    </div>
</div>
@endforeach
