<div class="header-action-icon-2">
    <a href="{{ route('wishlist') }}">
        <img class="svgInject" alt="Surfside Media" src="{{ asset('assets-front/imgs/theme/icons/icon-heart.svg') }}">
        <span class="pro-count blue">{{ Cart::instance('wishlist')->count() }}</span>
    </a>
</div>
