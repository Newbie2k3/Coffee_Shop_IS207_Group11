@props(['id', 'imgUrl', 'name', 'price', 'buttonName', 'status'])

<?php
$productDetail = URL::to('/product_detail/' . $id);
$formattedPrice = number_format($price, 0, ',', '.') . ' ₫';
?>

<div class="card">
    <a href="{{ $productDetail }}"><img src="{{ asset($imgUrl) }}" onerror="replaceImage(this)" class="card-img-top"
            alt="{{ $name }}"></a>
    <input type="hidden" value="{{ $id }}" class="product_id_{{ $id }}" />
    <input type="hidden" value="1" class="product_qty_{{ $id }}">

    <div class="card-body">
        <div class="card-info">
            <a href="{{ $productDetail }}">
                <h5 class="card-title">{{ $name }}</h5>
            </a>
            <p class="card-price">{{ $formattedPrice }}</p>
        </div>
        @if ($status)
            <button type="button" class="btn btn-primary add-to-cart" name="add-to-cart" data-id={{ $id }}>
                {{ $buttonName }}
            </button>
        @else
        <button type="button" class="btn btn-error" disabled>
            Ngừng bán
        </button>
        @endif
    </div>
</div>
