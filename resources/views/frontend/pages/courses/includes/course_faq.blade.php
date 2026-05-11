@if(count($data->course_faqs) > 0)
<section class="faq-section">
    <div class="container">
        <div class="text-center mb-4">
            <span class="faq-eyebrow"><i class="fa-solid fa-circle-question me-1"></i> FAQ</span>
            <h2 class="faq-heading">সাধারণ জিজ্ঞাসা</h2>
            <p class="faq-sub">কোর্স সম্পর্কে যেকোনো প্রশ্নের উত্তর এখানে খুঁজে নিন।</p>
        </div>
        <div class="faq-list">
            @foreach($data->course_faqs as $faq)
            <div class="faq-item {{ $loop->first ? 'active' : '' }}">
                <div class="faq-q">
                    <div class="faq-q-num">{{ $loop->iteration }}</div>
                    <div class="faq-q-text">{{ $faq->title }}</div>
                    <div class="faq-chevron"><i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="faq-a" @if($loop->first) style="display:block;" @endif>
                    {{ $faq->description }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
document.querySelectorAll('.faq-q').forEach(function(q) {
    q.addEventListener('click', function() {
        const item = this.closest('.faq-item');
        const isOpen = item.classList.toggle('active');
        const answer = item.querySelector('.faq-a');
        const chevron = item.querySelector('.faq-chevron i');
        if (answer) answer.style.display = isOpen ? 'block' : 'none';
        if (chevron) chevron.style.transform = isOpen ? 'rotate(180deg)' : '';
    });
});
// Init first item chevron
const firstChevron = document.querySelector('.faq-item.active .faq-chevron i');
if (firstChevron) firstChevron.style.transform = 'rotate(180deg)';
</script>
@endif
