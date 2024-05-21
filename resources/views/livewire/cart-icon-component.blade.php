<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{ route('cart') }}">
        <img alt="Surfside Media" src="{{ asset('assets-front/imgs/theme/icons/icon-cart.svg') }}">
        <span class="pro-count blue">{{ Cart::instance('cart')->count() }}</span>
    </a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @forelse (Cart::instance('cart')->content() as $item)
                <li>
                    <div class="shopping-cart-img">
                        <a href="{{ route('product.details', $item->id) }}"><img alt="{{ $item->name }}"
                                src="{{ $item->model->main_image_1 }}"></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="{{ route('product.details', $item->id) }}">{{ $item->name }}</a>
                        </h4>
                        <h4><span>{{ $item->qty }} ×
                            </span>${{ $item->price }}
                        </h4>
                    </div>
                    <div class="shopping-cart-delete">
                        <a href="#" wire:click.prevent="removeCart('{{ $item->rowId }}')"><i
                                class="fi-rs-cross-small"></i></a>
                    </div>
                </li>
            @empty
                <p class="text-center">No Item In Cart</p>
            @endforelse

        </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Total
                    <span>${{ Cart::instance('cart')->total() }}</span>
                </h4>
            </div>
            <div class="shopping-cart-button">
                <a wire:navigate href="{{ route('cart') }}" class="outline">View cart</a>
                <a wire:navigate href="{{ route('checkout') }}">Checkout</a>
            </div>
        </div>
    </div>
</div>

@push('js')
    @if (session('success_icon_cart'))
        @script
            <script>
                toastr.success("{{ session('success_icon_cart') }}");
            </script>
        @endscript
    @endif
@endpush
