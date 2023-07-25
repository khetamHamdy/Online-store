<form wire:submit.prevent="store_promoCode">
    <div class="cont-promo wow fadeInUp">

        <h5>Promo Code</h5>
        <p>Have a Promo Code? Use it here</p>
        <div class="form-group">
            <input type="text" class="form-control" name="promo_name"
                   wire:model.lazy="promo_name" @if(@$order->discount_price != null) disabled @endif>
            <br>
            <button class="  @if(@$order->discount_price != null) btn-not @else btn-site @endif"><span>
                    @if(@$order->discount_price != null)
                        Have Been Used
                    @else
                        Apply
                    @endif
                </span></button>
        </div>
    </div>
</form>
