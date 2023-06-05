@extends('layouts.app')

@section('title')
Store Details Page
@endsection

@section('content')
<div class="page-content page-details">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Product Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-gallery mb-3" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="zoom-in">
                    <transition name="slide-fade" mode="out-in">
                        <img style="width: 300px;" src="{{ Storage::url($product->photo) }}" class="" alt="" />
                    </transition>
                </div>
            </div>
        </div>
    </section>

    <div class=" store-details-container" data-aos="fade-up">
        <section class="store-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1>{{ $product->name }} </h1>
                        <div class="price">${{ number_format($product->selling_price) }}</div>
                        <p>{{ $product->product_code }}</p>
                    </div>
                    <div class="col-lg-2" data-aos="zoom-in">
                        <a href="{{ route('isi_form_pemesanan', AppHelper::transaction_code()) }}"
                            class="btn btn-success px-4 text-white btn-block mb-3">
                            Isi Form pemesanan
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-description">
            <div class="container">
                <div class="row" style="margin-top: -7px;">
                    <div class="col-12 col-lg-8">
                        {!! $product->deskripsi !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/frontend/vendor/vue/vue.js') }}"></script>
{{-- <script>
    var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach ($product->Gallery as $gallery)
            {
              url: "{{ Storage::url($gallery->name) }}",
            },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
</script> --}}
@endpush