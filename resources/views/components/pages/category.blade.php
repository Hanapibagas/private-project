@extends('layouts.app')

@section('title')
Store Category Page
@endsection

@section('content')
@if (session('status'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text : "{{ session('status') }}",
    });
</script>
@endif
<div class="page-content page-home">
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Categories</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementCategory = 0 @endphp
                @foreach ( $kategory as $file )
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $incrementCategory+= 100 }}">
                    <a class="component-categories d-block">
                        <div class="categories-image">
                            {{-- <img src="{{ Storage::url($category->photo) }}" alt="" class="w-100" /> --}}
                        </div>
                        <p class="categories-text">
                            {{ $file->name }}
                        </p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Products</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementProduct = 0 @endphp
                @foreach ( $product as $file )
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct+= 100 }}">
                    <a href="{{ route('details_products', $file->id) }}" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="
                                    background-image: url('{{ Storage::url($file->photo) }}')
                            "></div>
                        </div>
                        <div class="products-text">
                            {{ $file->name }}
                        </div>
                        <div class="products-price">
                            Rp.{{ number_format($file->selling_price) }}
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    {{-- {{ $products->links() }} --}}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection