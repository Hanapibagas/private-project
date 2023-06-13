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
        <section class="store-review">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mt-3 mb-3">
                        <h5>Customer Review (3)</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <ul class="list-unstyled">
                            <li class="media">
                                <img src="/images/icons-testimonial-1.png" alt="" class="mr-3 rounded-circle" />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Hazza Risky</h5>
                                    I thought it was not good for living room. I really happy
                                    to decided buy this product last week now feels like
                                    homey.
                                </div>
                            </li>
                            <li class="media">
                                <img src="/images/icons-testimonial-2.png" alt="" class="mr-3 rounded-circle" />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Anna Sukkirata</h5>
                                    Color is great with the minimalist concept. Even I thought
                                    it was made by Cactus industry. I do really satisfied with
                                    this.
                                </div>
                            </li>
                            <li class="media">
                                <img src="/images/icons-testimonial-3.png" alt="" class="mr-3 rounded-circle" />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">Dakimu Wangi</h5>
                                    When I saw at first, it was really awesome to have with.
                                    Just let me know if there is another upcoming product like
                                    this.
                                </div>
                            </li>
                        </ul>
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