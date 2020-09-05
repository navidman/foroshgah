@extends('layouts.app')

@section('content')
    <div class="container px-3 my-5 clearfix" style="direction: rtl!important; text-align: right;">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>سبد خرید</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                        <tr>
                            <!-- Set columns width -->
                            <th class="text-center py-3 px-4" style="min-width: 400px;">نام محصول</th>
                            <th class="text-right py-3 px-4" style="width: 150px;">قیمت واحد</th>
                            <th class="text-center py-3 px-4" style="width: 120px;">تعداد</th>
                            <th class="text-right py-3 px-4" style="width: 150px;">قیمت نهایی</th>
                            <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach(\Cart::all() as $cart)
                                @if(isset($cart['product']))
                                    @php
                                        $product = $cart['product']
                                    @endphp
                                    <tr>
                                        <td class="p-4">
                                            <div class="media align-items-center d-flex" style="text-align: right;">
                                                <div class="media-body">
                                                    <a href="#" class="d-block text-dark">{{ $product->title }}</a>
                                                    @if($product->attributes)
                                                        <small>
                                                        @foreach($product->attributes->take(3) as $attr)
                                                            <span class="text-muted">{{ $attr->name }}</span> {{ $attr->pivot->value->value }}
                                                        @endforeach
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">{{ $product->price }} تومان</td>
                                        <td class="align-middle p-4">
                                            <select name="" class="form-control text-center">
                                                @foreach(range(1, $product->inventory) as $item)
                                                    <option value="{{ $item }}" {{ $cart['quantity'] == $item ? 'selected' : '' }}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">تومان {{ $cart['quantity'] * $product->price }}</td>
                                        <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- / Shopping cart table -->
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <div class="mt-4"></div>
                    <div class="d-flex">
{{--                        <div class="text-right mt-4 mr-5">--}}
{{--                            <label class="text-muted font-weight-normal m-0">Discount</label>--}}
{{--                            <div class="text-large"><strong>$20</strong></div>--}}
{{--                        </div>--}}
                        <div class="text-right mt-4">
                            <label class="text-muted font-weight-normal m-0">قیمت کل</label>

                            @php
                                $totalPrice = Cart::all()->sum(function($cart) {
                                    return $cart['product']->price * $cart['quantity'];
                                });
                            @endphp

                            <div class="text-large"><strong>{{ $totalPrice }}</strong></div>
                        </div>
                    </div>
                </div>

                <div class="float-left">
                    <button type="button" class="btn btn-lg btn-primary mt-2">پرداخت</button>
                </div>

            </div>
        </div>
    </div>
@endsection
