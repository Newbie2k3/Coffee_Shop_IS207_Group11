@props(['imgUrl'])

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url({{ asset($imgUrl) }});">
        <div class="overlay"></div>
        <div class="container" data-aos="fade-up">
            <div class="row slider-text justify-content-center align-items-center">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
