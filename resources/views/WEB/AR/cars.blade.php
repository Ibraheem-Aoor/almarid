@extends('layouts.include_ar')

@section('title')
    السيارات
@endsection

@section('url')
    /en/cars
@endsection

@section('white')
    bg-white
@endsection

<style>
    .car-label {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: #0A53A4;
        color: #fff;
        text-align: center;
        padding: 5px 10px;
        font-weight: bold;
        font-size: 14px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .car-label p {
        margin: 0;
        color: #ffff !important;
    }

    @media screen and (max-width: 767px) {
        .car-label {
            top: -15px;
            left: auto;
            right: 10px;
            font-size: 12px;
        }
    }
</style>

@section('content')
    <div class="container my-4">
        <div class="top-navLinks d-flex align-items-center justify-content-start">
            <a href="/">
                <i class="fad fa-home-alt mr-2"></i>
                الرئيسية</a>

            <i class="fas fa-long-arrow-left mx-3"></i>

            <a href="/cars" class="active">

                قائمة السيارات</a>
        </div>
    </div>


    <div class="box-search w-100 py-5 mt-5 bg-main">
        <div class="container">
            <div class="top-headSearch d-flex align-items-center justify-content-between">
                <h3>ابحث عن سيارة</h3>
                <div class="filter">
                    <button class="btn " data-toggle="modal" data-target="#exampleModal"> <i class="fal fa-filter"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('cars.search') }}" method="GET">
                {{ csrf_field() }}
                <div class="row mt-3">
                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                        <div class="single-filter">
                            <select class="selectpicker" name="category_id" title="نوع السيارة">
                                <option value="">--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $category_id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                        <div class="single-filter">
                            <select name="model_id" class="selectpicker" title="الموديل">


                                <option value="">--</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}" @if ($model->id == $model_id) selected @endif>
                                        {{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                        <div class="single-filter">
                            <select name="brand_id" class="selectpicker" title="الشركة">
                                <option value="">--</option>

                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @if ($brand->id == $brand_id) selected @endif>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 ">
                        <div class="single-filter">
                            <button type="submit" class="btn w-100  bg-white text-main'">بحث</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <section class="offers mt-5">
        <div class="container">

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 mb-4  col-md-6 wow fadeInDown" data-wow-delay="0.2s">
                        <a href="/car/{{ $product->id }}">
                            <div class="single-mainCar">
                                @if ($product->is_sold == 1)
                                    <div class="sold-out-label">
                                        <p>SOLD OUT</p>
                                    </div>
                                @endif
                                <div class="main-img py-2">
                                    <img src="{{ asset('/uploads/products/' . $product->image) }}" loading="lazy"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="maincar-title mb-2">
                                    <h5>{{ $product->name }}</h5>
                                </div>
                                <div class="options d-flex align-items-center justify-content-start">
                                    <p class="mr-2">{{ $product->model->name }} | </p>
                                    <p class="mr-2">{{ @$product->category->name }} | </p>
                                    <p class="mr-2">
                                        @if ($product->is_new == 1)
                                            جديد
                                        @endif
                                    </p>
                                </div>
                                <hr>
                                <div class="maincar-price d-flex align-items-center justify-content-between">
                                    <h5 class="color bold">{{ $product->offer_price ?? $product->price }} درهم</h5>
                                    @if ($product->offer_price)
                                        <del class="text-secondary">{{ $product->price }} درهم</del>
                                    @endif
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
                @foreach ($export_products as $product)
                    <div class="col-lg-3 mb-4  col-md-6 wow fadeInDown" data-wow-delay="0.2s">
                        <a href="/export/car/{{ $product->id }}">
                            <div class="single-mainCar">
                                <div class="main-img py-4">
                                    <img src="{{ asset('/uploads/products/' . $product->image) }}" alt=""
                                        class="img-fluid">
                                    <div class="car-label">
                                        <p>للتصدير</p>
                                    </div>
                                </div>
                                <div class="maincar-title mb-2">
                                    <h5>{{ $product->name_en }}</h5>
                                </div>
                                <div class="options d-flex align-items-center justify-content-start">
                                    <p class="mr-2">{{ $product->model }} </p>
                                    <p class="mr-2">| {{ $product->geer }} </p>
                                    <p class="mr-2">
                                        @if ($product->is_new == 1)
                                            جديد
                                        @endif
                                    </p>
                                </div>
                                <hr>
                                <div class="maincar-price d-flex align-items-center justify-content-between">
                                    <h5 class="color">{{ $product->price }} درهم </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </section>




    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade modal-filter" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">البحث والفلترة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('cars.search.advanced') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label> الإسم</label>
                                    <input class="form-control" name="name" type="text"
                                        value="{{ $name }}" placeholder="ابحث عن سيارة" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group group_RangeSlider">
                                    <label>الميزانية</label>
                                    <input class="form-control RangeSlider" name="current_price" type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="single-filter">
                                    <select class="selectpicker" name="category_id" title="نوع السيارة">
                                        <option value="">--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if ($category->id == $category_id) selected @endif>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="single-filter">
                                    <select class="selectpicker" name="fuel_id" title="الوقود">
                                        <option value="">--</option>
                                        @foreach ($fuels as $fuel)
                                            <option value="{{ $fuel->id }}"
                                                @if ($fuel->id == $fuel_id) selected @endif>{{ $fuel->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="single-filter">
                                    <select name="model_id" class="selectpicker" title="الموديل">


                                        <option value="">--</option>
                                        @foreach ($models as $model)
                                            <option value="{{ $model->id }}"
                                                @if ($model->id == $model_id) selected @endif>{{ $model->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="single-filter">
                                    <select class="selectpicker" name="brand_id" class="selectpicker" title="الشركة">
                                        <option value="">--</option>

                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                @if ($brand->id == $brand_id) selected @endif>{{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-primary w-100 rounded py-2">بحث</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#exampleModal').on('shown.bs.modal', function() {
            $('.group_RangeSlider').fadeIn()
            $(".RangeSlider").ionRangeSlider({
                min: {!! json_encode($min_price) !!},
                max: {!! json_encode($max_price) !!},
                from: {!! json_encode($current_min_price) !!},
                to: {!! json_encode($current_max_price) !!},
                type: "double",
                prefix: "درهم"
            });

            $('#current_min_price').val(from);
            $('#current_max_price').val(to);

        })
    </script>
@endsection
