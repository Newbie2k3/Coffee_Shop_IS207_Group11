@props(['id', 'imgUrl', 'name', 'price', 'description'])

<?php
    $productDetail = URL::to('/product_detail/' . $id);
    $formattedPrice = number_format($price, 0, ',', '.') . 'đ';
?>

<div class="pricing-entry d-flex" data-aos="fade-up">
    <a href="{{ $productDetail }}">
        <div class="img" style="background-image: url({{ $imgUrl }});"></div>
    </a>
    <div class="desc pl-3">
        <div class="d-flex text align-items-center">
            <h3><span><a href="{{ $productDetail }}">{{ $name }}</a></span></h3>
            <span class="price">{{ $formattedPrice }}</span>
        </div>
        <div class="d-block">
            <p>{{ $description }}</p>
        </div>
    </div>
</div>
