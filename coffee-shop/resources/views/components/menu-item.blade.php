@props(['imgUrl', 'title', 'price', 'description'])

<div class="pricing-entry d-flex" data-aos="fade-up">
    <div class="img" style="background-image: url({{ $imgUrl }});"></div>
    <div class="desc pl-3">
        <div class="d-flex text align-items-center">
            <h3><span>{{ $title }}</span></h3>
            <span class="price">${{ $price }}</span>
        </div>
        <div class="d-block">
            <p>{{ $description }}</p>
        </div>
    </div>
</div>
