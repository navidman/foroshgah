@extends('layouts.app')


@section('content')
    <div class="container" style="direction:rtl!important;text-align:right!important">
        <div class="row">
            <div class="col-md-12">
                @foreach($products->chunk(4) as $row)
                    <div class="row">
                        @foreach($row as $product)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->title }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <a href="/product/{{ $product->id }}" class="btn btn-primary">جزيیات محصول</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
