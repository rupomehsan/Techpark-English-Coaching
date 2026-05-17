@extends('frontend.layouts.layout')

@push('styles')
<style>
/* ===== Base ===== */
.quiz-wrap { background: #f0f4fb; min-height: 100vh; padding-bottom: 60px; }

/* ===== Header ===== */
.quiz-header {
    background: linear-gradient(135deg, #001830 0%, #002d5c 60%, #003b7a 100%);
    padding: 28px 0 0;
    position: sticky; top: 0; z-index: 200;
    box-shadow: 0 4px 24px rgba(0,0,0,0.22);
}
.quiz-header-inner { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; padding-bottom: 16px; }
.quiz-back-btn {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.18);
    color: #fff; font-size: 0.8rem; font-weight: 600; padding: 8px 16px;
    border-radius: 50px; text-decoration: none; transition: all 0.25s; white-space: nowrap;
}
.quiz-back-btn:hover { background: rgba(255,255,255,0.2); color: #fab005; }
.quiz-title-block { flex: 1; min-width: 0; }
.quiz-label { font-size: 0.68rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #fab005; margin-bottom: 4px; }
.quiz-title { font-size: 1.15rem; font-weight: 800; color: #fff; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.quiz-stats { display: flex; gap: 20px; flex-shrink: 0; }
.quiz-stat { text-align: center; }
.quiz-stat-val { font-size: 1.2rem; font-weight: 800; color: #fab005; line-height: 1; }
.quiz-stat-lbl { font-size: 0.65rem; color: rgba(255,255,255,0.55); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px; }

/* Progress bar */
.quiz-progress-bar { height: 4px; background: rgba(255,255,255,0.12); }
.quiz-progress-fill { height: 4px; background: linear-gradient(90deg, #fab005, #ffd444); transition: width 0.4s ease; }

/* ===== Question Cards ===== */
.quiz-body { padding: 32px 0; }
.q-card {
    background: #fff; border-radius: 18px; margin-bottom: 24px;
    box-shadow: 0 2px 16px rgba(0,33,71,0.07); border: 1px solid #e8eef8;
    overflow: hidden;
}
.q-card-head {
    background: linear-gradient(135deg, #f7faff, #eef3fc);
    padding: 18px 22px 14px; border-bottom: 1px solid #e4ecf8;
    display: flex; align-items: flex-start; gap: 14px;
}
.q-num {
    width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, #002147, #003b7a);
    color: #fff; font-size: 0.8rem; font-weight: 800;
    display: flex; align-items: center; justify-content: center; margin-top: 1px;
}
.q-text { font-size: 0.97rem; font-weight: 700; color: #1a2640; line-height: 1.5; flex: 1; }
.q-type-chip {
    font-size: 0.62rem; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;
    padding: 3px 10px; border-radius: 50px; white-space: nowrap; flex-shrink: 0;
}
.q-type-single { background: rgba(0,33,71,0.1); color: #002147; }
.q-type-multi  { background: rgba(250,176,5,0.15); color: #b87a00; }

.q-card-body { padding: 18px 22px; }

/* Option buttons */
.opt-label {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 16px; border-radius: 12px; margin-bottom: 10px;
    border: 2px solid #e4ecf5; background: #f9fbff;
    cursor: pointer; transition: all 0.2s; user-select: none;
}
.opt-label:hover { border-color: #002147; background: #eef3fc; }
.opt-label input[type="radio"],
.opt-label input[type="checkbox"] { display: none; }
.opt-marker {
    width: 22px; height: 22px; border-radius: 50%; flex-shrink: 0;
    border: 2px solid #c5d2e8; background: #fff; display: flex;
    align-items: center; justify-content: center; transition: all 0.2s; font-size: 0.7rem;
}
.opt-label.is-checkbox .opt-marker { border-radius: 6px; }
.opt-text { font-size: 0.9rem; color: #2d3a4a; font-weight: 500; line-height: 1.4; flex: 1; }

/* Selected state (JS-driven) */
.opt-label.selected { border-color: #002147; background: #eef3fc; }
.opt-label.selected .opt-marker { background: #002147; border-color: #002147; color: #fff; }

/* ===== Results: Option States ===== */
.opt-label.res-correct { border-color: #22c55e; background: #f0fdf4; }
.opt-label.res-correct .opt-marker { background: #22c55e; border-color: #22c55e; color: #fff; }
.opt-label.res-correct .opt-text { color: #15803d; font-weight: 700; }

.opt-label.res-wrong { border-color: #ef4444; background: #fff5f5; }
.opt-label.res-wrong .opt-marker { background: #ef4444; border-color: #ef4444; color: #fff; }
.opt-label.res-wrong .opt-text { color: #b91c1c; }

.opt-label.res-missed { border-color: #f59e0b; background: #fffbeb; }
.opt-label.res-missed .opt-text { color: #92400e; }

/* ===== Submit Button ===== */
.quiz-submit-wrap { text-align: center; padding: 10px 0 20px; }
.btn-quiz-submit {
    background: linear-gradient(135deg, #002147, #003b7a);
    color: #fff; font-size: 1rem; font-weight: 800;
    padding: 15px 52px; border-radius: 50px; border: none;
    cursor: pointer; transition: all 0.3s; letter-spacing: 0.5px;
    box-shadow: 0 8px 28px rgba(0,33,71,0.25);
}
.btn-quiz-submit:hover { background: linear-gradient(135deg, #003b7a, #005ab5); transform: translateY(-2px); box-shadow: 0 12px 36px rgba(0,33,71,0.35); }

/* ===== Results Score Card ===== */
.score-card {
    background: linear-gradient(135deg, #001830, #002d5c);
    border-radius: 24px; padding: 40px 32px; text-align: center;
    margin-bottom: 36px; position: relative; overflow: hidden;
}
.score-card::before { content: ''; position: absolute; top: -60px; right: -60px; width: 200px; height: 200px; border-radius: 50%; background: rgba(250,176,5,0.07); }
.score-ring {
    width: 120px; height: 120px; border-radius: 50%; margin: 0 auto 20px;
    border: 6px solid rgba(250,176,5,0.3);
    background: rgba(250,176,5,0.08);
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; position: relative; z-index: 1;
}
.score-num { font-size: 2rem; font-weight: 900; color: #fab005; line-height: 1; }
.score-denom { font-size: 0.8rem; color: rgba(255,255,255,0.5); }
.score-pct { font-size: 2.2rem; font-weight: 900; color: #fff; margin-bottom: 6px; position: relative; z-index: 1; }
.score-label { font-size: 0.9rem; color: rgba(255,255,255,0.6); position: relative; z-index: 1; }
.score-badges { display: flex; gap: 14px; justify-content: center; margin-top: 20px; flex-wrap: wrap; position: relative; z-index: 1; }
.score-badge { padding: 7px 18px; border-radius: 50px; font-size: 0.78rem; font-weight: 700; }
.score-badge-correct { background: rgba(34,197,94,0.2); color: #4ade80; border: 1px solid rgba(34,197,94,0.3); }
.score-badge-wrong { background: rgba(239,68,68,0.2); color: #f87171; border: 1px solid rgba(239,68,68,0.3); }
.score-badge-skip { background: rgba(250,176,5,0.15); color: #fbbf24; border: 1px solid rgba(250,176,5,0.3); }

/* Review section */
.review-header { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #6b7a90; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
.review-header::after { content: ''; flex: 1; height: 1px; background: #e4ecf5; }

/* Q card result state indicator */
.q-result-badge { font-size: 0.72rem; font-weight: 700; padding: 3px 11px; border-radius: 50px; flex-shrink: 0; }
.q-result-correct { background: rgba(34,197,94,0.15); color: #15803d; }
.q-result-wrong   { background: rgba(239,68,68,0.15); color: #b91c1c; }

@media (max-width: 576px) {
    .quiz-header-inner { padding-bottom: 12px; }
    .quiz-title { font-size: 1rem; }
    .quiz-stats { gap: 12px; }
}
</style>
@endpush

@section('contents')
<div class="quiz-wrap">

    {{-- ===== Sticky Header ===== --}}
    <div class="quiz-header">
        <div class="container">
            <div class="quiz-header-inner">
                <a href="{{ session('return_to_module', url()->previous()) }}"
                   onclick="event.preventDefault(); clearReturnToModule();"
                   class="quiz-back-btn">
                    <i class="fa-solid fa-arrow-left"></i> Back to Course
                </a>
                <div class="quiz-title-block">
                    <div class="quiz-label"><i class="fa-solid fa-pen-to-square me-1"></i>Quiz</div>
                    <div class="quiz-title">{{ $quiz->title }}</div>
                </div>
                <div class="quiz-stats">
                    <div class="quiz-stat">
                        <div class="quiz-stat-val">{{ count($topic) }}</div>
                        <div class="quiz-stat-lbl">Questions</div>
                    </div>
                    @if(session('user_answers'))
                    <div class="quiz-stat">
                        <div class="quiz-stat-val" style="color:#4ade80;">{{ session('score') }}</div>
                        <div class="quiz-stat-lbl">Correct</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @php $pct = session('user_answers') ? round(session('score') / max(count($topic),1) * 100) : 0; @endphp
        <div class="quiz-progress-bar">
            <div class="quiz-progress-fill" style="width:{{ session('user_answers') ? $pct : 0 }}%"></div>
        </div>
    </div>

    {{-- ===== Body ===== --}}
    <div class="quiz-body">
        <div class="container">

            @if(session('user_answers'))
            {{-- ============================================================ --}}
            {{-- RESULTS VIEW --}}
            {{-- ============================================================ --}}
            @php
                $totalQ   = count($topic);
                $correct  = session('score', 0);
                $wrong    = 0;
                foreach ($topic as $i => $q) {
                    $ua = session('user_answers')[$i] ?? [];
                    if ($q->quizQuestion->is_multiple) {
                        $selected = $ua['selected_options'] ?? [];
                        $correctIds = $q->quizQuestion->options->where('is_correct', true)->pluck('id')->toArray();
                        if (sort($selected) !== sort($correctIds)) $wrong++;
                    } else {
                        $sel = $ua['selected_option'] ?? null;
                        $correctOpt = $q->quizQuestion->options->firstWhere('is_correct', true);
                        if ($sel && $correctOpt && $sel != $correctOpt->id) $wrong++;
                    }
                }
                $scorePct = $totalQ > 0 ? round($correct / $totalQ * 100) : 0;
            @endphp

            {{-- Score Card --}}
            <div class="score-card">
                <div class="score-ring">
                    <div class="score-num">{{ $correct }}</div>
                    <div class="score-denom">/ {{ $totalQ }}</div>
                </div>
                <div class="score-pct">{{ $scorePct }}%</div>
                <div class="score-label">
                    @if($scorePct >= 80) Excellent work! Keep it up.
                    @elseif($scorePct >= 60) Good effort! Review the wrong ones.
                    @else Keep practicing — you'll get there!
                    @endif
                </div>
                <div class="score-badges">
                    <span class="score-badge score-badge-correct"><i class="fa-solid fa-circle-check me-1"></i>{{ $correct }} Correct</span>
                    <span class="score-badge score-badge-wrong"><i class="fa-solid fa-circle-xmark me-1"></i>{{ $wrong }} Wrong</span>
                    <span class="score-badge score-badge-skip"><i class="fa-solid fa-minus me-1"></i>{{ $totalQ - $correct - $wrong }} Skipped</span>
                </div>
            </div>

            {{-- Review --}}
            <div class="review-header"><i class="fa-solid fa-list-check"></i> Question Review</div>

            <div class="row g-4">
            @foreach ($topic as $index => $question)
                @php
                    $ua = session('user_answers')[$index] ?? [];
                    if ($question->quizQuestion->is_multiple) {
                        $selectedIds = $ua['selected_options'] ?? [];
                        $correctIds  = $question->quizQuestion->options->where('is_correct', true)->pluck('id')->toArray();
                        $isRight     = !array_diff($correctIds, $selectedIds) && !array_diff($selectedIds, $correctIds);
                    } else {
                        $selectedId  = $ua['selected_option'] ?? null;
                        $correctOpt  = $question->quizQuestion->options->firstWhere('is_correct', true);
                        $isRight     = $correctOpt && $selectedId == $correctOpt->id;
                    }
                @endphp
                <div class="col-lg-6">
                    <div class="q-card">
                        <div class="q-card-head">
                            <div class="q-num">{{ $index + 1 }}</div>
                            <div class="q-text">{{ $question->quizQuestion->title }}</div>
                            <span class="q-result-badge {{ $isRight ? 'q-result-correct' : 'q-result-wrong' }}">
                                <i class="fa-solid {{ $isRight ? 'fa-check' : 'fa-xmark' }} me-1"></i>{{ $isRight ? 'Correct' : 'Wrong' }}
                            </span>
                        </div>
                        <div class="q-card-body">
                            @if ($question->quizQuestion->is_multiple)
                                @foreach ($question->quizQuestion->options as $option)
                                    @php
                                        $wasSelected = in_array($option->id, $ua['selected_options'] ?? []);
                                        $cls = '';
                                        if ($option->is_correct && $wasSelected) $cls = 'res-correct';
                                        elseif ($option->is_correct && !$wasSelected) $cls = 'res-missed';
                                        elseif (!$option->is_correct && $wasSelected) $cls = 'res-wrong';
                                    @endphp
                                    <div class="opt-label is-checkbox {{ $cls }}" style="cursor:default;">
                                        <div class="opt-marker">
                                            @if($cls === 'res-correct') <i class="fa-solid fa-check"></i>
                                            @elseif($cls === 'res-wrong') <i class="fa-solid fa-xmark"></i>
                                            @elseif($cls === 'res-missed') <i class="fa-solid fa-star" style="color:#f59e0b;font-size:0.6rem;"></i>
                                            @endif
                                        </div>
                                        <span class="opt-text">{{ $option->title }}</span>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($question->quizQuestion->options as $option)
                                    @php
                                        $wasSelected = isset($ua['selected_option']) && $ua['selected_option'] == $option->id;
                                        $cls = '';
                                        if ($option->is_correct && $wasSelected) $cls = 'res-correct';
                                        elseif ($option->is_correct && !$wasSelected) $cls = 'res-missed';
                                        elseif (!$option->is_correct && $wasSelected) $cls = 'res-wrong';
                                    @endphp
                                    <div class="opt-label {{ $cls }}" style="cursor:default;">
                                        <div class="opt-marker">
                                            @if($cls === 'res-correct') <i class="fa-solid fa-check"></i>
                                            @elseif($cls === 'res-wrong') <i class="fa-solid fa-xmark"></i>
                                            @elseif($cls === 'res-missed') <i class="fa-solid fa-star" style="color:#f59e0b;font-size:0.6rem;"></i>
                                            @endif
                                        </div>
                                        <span class="opt-text">{{ $option->title }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            <div class="quiz-submit-wrap" style="margin-top:32px;">
                <a href="{{ session('return_to_module', url()->previous()) }}"
                   onclick="event.preventDefault(); clearReturnToModule();"
                   class="btn-quiz-submit" style="text-decoration:none; display:inline-block;">
                    <i class="fa-solid fa-arrow-left me-2"></i>Return to Course
                </a>
            </div>

            @else
            {{-- ============================================================ --}}
            {{-- QUIZ FORM --}}
            {{-- ============================================================ --}}
            <form action="{{ route('quiz.submit') }}" method="POST" id="quizForm">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                <input type="hidden" name="course_id" value="{{ $courseId }}">
                <input type="hidden" name="class_id" value="{{ $classId }}">

                <div class="row g-4">
                    @foreach ($topic as $index => $question)
                    <div class="col-lg-6">
                        <div class="q-card" id="qcard-{{ $index }}">
                            <div class="q-card-head">
                                <div class="q-num">{{ $index + 1 }}</div>
                                <div class="q-text">{{ $question->quizQuestion->title }}</div>
                                <span class="q-type-chip {{ $question->quizQuestion->is_multiple ? 'q-type-multi' : 'q-type-single' }}">
                                    {{ $question->quizQuestion->is_multiple ? 'Multi-select' : 'Single' }}
                                </span>
                            </div>
                            <div class="q-card-body">
                                @if ($question->quizQuestion->is_multiple)
                                    @foreach ($question->quizQuestion->options as $optionKey => $option)
                                    <label class="opt-label is-checkbox"
                                           onclick="toggleCheck(this, event)"
                                           data-qindex="{{ $index }}">
                                        <input type="checkbox"
                                               name="answers[{{ $index }}][selected_options][]"
                                               value="{{ $option->id }}"
                                               id="q{{ $question->id }}o{{ $optionKey }}">
                                        <div class="opt-marker"><i class="fa-solid fa-check" style="display:none;font-size:0.65rem;"></i></div>
                                        <span class="opt-text">{{ $option->title }}</span>
                                    </label>
                                    @endforeach
                                @else
                                    @foreach ($question->quizQuestion->options as $optionKey => $option)
                                    <label class="opt-label"
                                           onclick="selectRadio(this, {{ $index }})"
                                           data-qindex="{{ $index }}">
                                        <input type="radio"
                                               name="answers[{{ $index }}][selected_option]"
                                               value="{{ $option->id }}"
                                               id="q{{ $question->id }}o{{ $optionKey }}">
                                        <div class="opt-marker"></div>
                                        <span class="opt-text">{{ $option->title }}</span>
                                    </label>
                                    @endforeach
                                @endif
                                <input type="hidden" name="answers[{{ $index }}][question_id]"
                                       value="{{ $question->id }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="quiz-submit-wrap">
                    <button type="submit" class="btn-quiz-submit" onclick="return confirmSubmit()">
                        <i class="fa-solid fa-paper-plane me-2"></i>Submit Quiz
                    </button>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>
@endsection

<script>
function selectRadio(label, qIndex) {
    // Deselect all in this question
    document.querySelectorAll('[data-qindex="' + qIndex + '"]').forEach(function(el) {
        el.classList.remove('selected');
        var marker = el.querySelector('.opt-marker');
        if (marker) marker.innerHTML = '';
    });
    // Select clicked
    label.classList.add('selected');
    var input = label.querySelector('input[type="radio"]');
    if (input) input.checked = true;
    var marker = label.querySelector('.opt-marker');
    if (marker) marker.innerHTML = '<i class="fa-solid fa-circle" style="font-size:0.5rem;"></i>';
    updateProgress();
}

function toggleCheck(label, event) {
    event.preventDefault();
    var input = label.querySelector('input[type="checkbox"]');
    var marker = label.querySelector('.opt-marker i');
    var nowChecked = !input.checked;
    input.checked = nowChecked;
    if (nowChecked) {
        label.classList.add('selected');
        if (marker) marker.style.display = '';
    } else {
        label.classList.remove('selected');
        if (marker) marker.style.display = 'none';
    }
    updateProgress();
}

function updateProgress() {
    var total = {{ count($topic) }};
    var answered = 0;
    for (var i = 0; i < total; i++) {
        var radios = document.querySelectorAll('[name="answers[' + i + '][selected_option]"]:checked');
        var checks = document.querySelectorAll('[name="answers[' + i + '][selected_options][]"]:checked');
        if (radios.length > 0 || checks.length > 0) answered++;
    }
    var pct = Math.round(answered / total * 100);
    var bar = document.querySelector('.quiz-progress-fill');
    if (bar) bar.style.width = pct + '%';
}

function confirmSubmit() {
    var total = {{ count($topic) }};
    var answered = 0;
    for (var i = 0; i < total; i++) {
        var radios = document.querySelectorAll('[name="answers[' + i + '][selected_option]"]:checked');
        var checks = document.querySelectorAll('[name="answers[' + i + '][selected_options][]"]:checked');
        if (radios.length > 0 || checks.length > 0) answered++;
    }
    var unanswered = total - answered;
    if (unanswered > 0) {
        return confirm(unanswered + ' question(s) unanswered. Submit anyway?');
    }
    return true;
}

function clearReturnToModule() {
    fetch("{{ route('clear.return.to.module') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
    }).then(function(response) {
        if (response.ok) window.location.href = "{{ session('return_to_module', url()->previous()) }}";
    }).catch(function(e) { console.error(e); });
}
</script>
