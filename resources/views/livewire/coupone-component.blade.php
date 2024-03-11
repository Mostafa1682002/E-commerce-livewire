<div class="total-amount">
    <div class="left">
        <div class="coupon">
            <form action="#" wire:submit.prevent="applyCouponCode">
                @if (session()->has('coupon'))
                    <div class="form-row row justify-content-center">
                        <div class="form-group col-lg-6">
                            <input class="font-medium" name="code" value="{{ session('coupon')['code'] }}" readonly>
                        </div>
                        <div class="form-group col-lg-6">
                            <button wire:click.prevent="removeCoupon" class="btn btn-sm"><i
                                    class="fi-rs-trash mr-10"></i>Remove
                                Coupon</button>
                        </div>
                    </div>
                @else
                    <div class="form-row row justify-content-center">
                        <div class="form-group col-lg-6">
                            <input class="font-medium" wire:model="code" name="code" placeholder="Enter Your Coupon">
                            @error('code')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <button type="submit" class="btn  btn-sm"><i class="fi-rs-label mr-10"></i>Apply</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>


@push('js')

    @if (session('coupon_error'))
        @script
            <script>
                toastr.error("{{ session('coupon_error') }}");
            </script>
        @endscript
    @endif
    @if (session('coupon_success'))
        @script
            <script>
                toastr.success("{{ session('coupon_success') }}");
            </script>
        @endscript
    @endif
@endpush
