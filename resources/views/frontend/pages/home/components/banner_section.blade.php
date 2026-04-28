<section class="banner_part" style="position: relative; overflow: hidden;">
    <div class="owl-carousel" style="position: relative;">
            @foreach ($banners as $banner)
                <div class="py-3">
                    <img class="rounded rounded-sm" src="{{ assetHelper(optional($banner)->image) }}"
                        alt="techpark english banner" style="width: 100%;" loading="lazy">
                </div>
            @endforeach
        </div>
</section>
