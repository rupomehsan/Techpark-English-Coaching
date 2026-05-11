{{-- Course Curriculum --}}
<div class="class_module">
    <div class="class_module_details">
        @if(isset($data) && is_object($data) && isset($data->milestones) && count($data->milestones) > 0)
            @foreach($data->milestones()->orderBy('milestone_no', 'asc')->get() as $milestone)
                @php
                    $moduleCount = $milestone->modules()->where('status', 'active')->count();
                @endphp
                <ul class="class_module_features">
                    <li class="milestone-item">

                        {{-- Milestone Header --}}
                        <div class="milestone-header">
                            <div class="milestone-left">
                                <div class="milestone-num-badge">
                                    <span class="m-label">M</span>
                                    <span class="m-num">{{ $milestone->milestone_no ?? $loop->iteration }}</span>
                                </div>
                                <div class="milestone-info">
                                    <div class="m-title">{{ $milestone->title }}</div>
                                    <div class="m-meta">
                                        <span><i class="fa-solid fa-cubes me-1"></i>{{ $moduleCount }} Modules</span>
                                    </div>
                                </div>
                            </div>
                            <div class="milestone-chevron">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        {{-- Milestone Content --}}
                        <div class="milestone-content">
                            @foreach($milestone->modules as $module)
                                @php
                                    $liveCount     = $module->classes()->where('type', 'live')->count();
                                    $recordedCount = $module->classes()->where('type', 'recorded')->count();
                                    $quizCount     = $module->quizes()->count();
                                @endphp
                                <ul class="class_module_features">
                                    <li class="module-item">

                                        {{-- Module Header --}}
                                        <div class="module-header">
                                            <div class="module-left">
                                                <span class="module-num-pill">Module {{ $module->module_no }}</span>
                                                <div class="module-info">
                                                    <div class="mod-title">{{ $module->title }}</div>
                                                    <div class="mod-stats">
                                                        @if($liveCount > 0)
                                                            <span class="mod-stat-pill mod-stat-live"><i class="fa-solid fa-circle-dot me-1"></i>{{ $liveCount }} Live</span>
                                                        @endif
                                                        @if($recordedCount > 0)
                                                            <span class="mod-stat-pill mod-stat-recorded"><i class="fa-solid fa-play me-1"></i>{{ $recordedCount }} Recorded</span>
                                                        @endif
                                                        @if($quizCount > 0)
                                                            <span class="mod-stat-pill mod-stat-quiz"><i class="fa-solid fa-pen-nib me-1"></i>{{ $quizCount }} Quiz</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="module-chevron">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </div>
                                        </div>

                                        {{-- Module Classes --}}
                                        <div class="class_module_feature_content">
                                            <div class="module-classes-wrap">
                                                @foreach($module->classes as $class)
                                                    @php $typeClass = $class->type === 'live' ? 'type-live' : 'type-recorded'; @endphp
                                                    <div class="module-class-group">
                                                        <div class="class-group-label">Class {{ $class->class_no }}</div>
                                                        <div class="class-row {{ $typeClass }}">
                                                            <div class="class-type-dot"></div>
                                                            <div class="class-type-icon">
                                                                @if($class->type === 'live')
                                                                    <i class="fa-solid fa-video"></i>
                                                                @else
                                                                    <i class="fa-solid fa-circle-play"></i>
                                                                @endif
                                                            </div>
                                                            <div class="class-body">
                                                                <span class="class-label-tag">{{ $class->type === 'live' ? 'Live Class' : 'Recorded' }}</span>
                                                                <div class="class-title">{{ $class->title }}</div>
                                                            </div>
                                                        </div>

                                                        @if($class->quizes && $class->quizes->count() > 0)
                                                            @foreach($class->quizes as $quiz)
                                                                <div class="quiz-row">
                                                                    <div class="quiz-icon"><i class="fa-solid fa-file-pen"></i></div>
                                                                    <span class="quiz-label">Quiz</span>
                                                                    <span class="quiz-title">{{ $quiz->quiz->title ?? '' }}</span>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                            @endforeach
                        </div>

                    </li>
                </ul>
            @endforeach
        @endif
    </div>
</div>

<script>
    document.querySelectorAll(".milestone-header").forEach(function(header) {
        header.addEventListener("click", function() {
            const item = this.closest('.milestone-item');
            const isOpen = item.classList.toggle('active');
            if (isOpen) {
                item.querySelectorAll('.module-item').forEach(function(mod) {
                    mod.classList.add('active');
                    const content = mod.querySelector('.class_module_feature_content');
                    if (content) content.style.display = 'block';
                    const icon = mod.querySelector('.module-chevron i');
                    if (icon) icon.style.transform = 'rotate(180deg)';
                });
            } else {
                item.querySelectorAll('.module-item').forEach(function(mod) {
                    mod.classList.remove('active');
                    const content = mod.querySelector('.class_module_feature_content');
                    if (content) content.style.display = 'none';
                    const icon = mod.querySelector('.module-chevron i');
                    if (icon) icon.style.transform = '';
                });
            }
        });
    });

    document.querySelectorAll(".module-header").forEach(function(header) {
        header.addEventListener("click", function(e) {
            e.stopPropagation();
            const item = this.closest('.module-item');
            const isOpen = item.classList.toggle('active');
            const content = item.querySelector('.class_module_feature_content');
            const icon = item.querySelector('.module-chevron i');
            if (content) content.style.display = isOpen ? 'block' : 'none';
            if (icon) icon.style.transform = isOpen ? 'rotate(180deg)' : '';
        });
    });
</script>
