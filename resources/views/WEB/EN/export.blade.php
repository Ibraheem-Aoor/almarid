@extends('layouts.include_en')

@section('title')
    Export
@endsection


@section('url')
    /export
@endsection


@section('white')
    bg-white
@endsection
@section('content')
    <div class="container my-4">
        <div class="top-navLinks d-flex align-items-center justify-content-start flex-wrap ">

            <a href="/en/">
                <i class="fad fa-home-alt mr-2"></i>
                Home</a>

            <i class="fas fa-long-arrow-left mx-3"></i>

            <a href="/en/export">

                Export</a>



        </div>

        <div class="container mt-5">
            <h2 class="orange text-center mt-5 under__line    wow fadeInUp  " data-wow-delay="0.2s">Almarid for Export</h2>

            <div class="row my-5 align-items-center">
                <div class="col-lg-7">
                    <div class="export__text   wow fadeInRight  " data-wow-delay="0.2s">

                        <p>{{ $settings->where('key', 'export_en')->first()->value }}</p>
                        <p class="text-danger">* Important note *</p>
                        <p> In this section, the prices of cars for export
                            Including tax and customs</p>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">

                    <form action="{{ route('en.send.export') }}" class="    wow fadeInDown   " data-wow-delay="0.2s">
                        <div class="form-group mb-4">

                            <input class="form-control" name="export_product_id" type="hidden" placeholder="Name" />
                            <input class="form-control" name="name" type="text" placeholder="Name" />
                        </div>
                        <div class="form-group mb-4">

                            <input class="form-control" name="phonenumber" type="text" placeholder="Phone Number" />
                        </div>
                        <div class="form-group mb-4">

                            <input class="form-control" name="email" type="text" placeholder="Email" />
                        </div>

                        <div class="form-group mb-4">


                            <textarea class="form-control" name="message" rows="4" placeholder="Message"> </textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit"
                                class="btn btn-primary btn-sm hover-transform rounded w-100   mt-2   wow fadeInDown"
                                data-wow-delay="0.2s" href="">Send </button>

                        </div>
                    </form>
                </div>
            </div>
            <hr class="line">
            <div class="avilable__cars">
                <h2 class="orange text-center mt-5 under__line   wow fadeInUp  " data-wow-delay="0.2s">Avilable Cars</h2>
                <div class="row mt-5">
                    @foreach ($products as $product)
                        <div class="col-12 mb-3 ">
                            <div class="single_export__car px-4 py-4 bg-white border    wow fadeInDown   "
                                data-wow-delay="0.2s">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <div class="main-img py-2">
                                            <img src="{{ asset('/uploads/products/' . $product->image) }}" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div
                                            class="car__namePrice d-flex align-items-center justify-content-between flex-wrap">
                                            <h3 class="mb-2 mb-md-0">{{ $product->name_en }}</h3>
                                            <p class="bg-dark px-4 pt-3 pb-2 text-white rounded">
                                                @isset($product->price_dollar)
                                                    <span>${{ $product->price_dollar }}</span> |
                                                @endisset
                                                <span>{{ $product->price }}
                                                    Dirham</span>
                                            </p>
                                        </div>
                                        <hr class="line">
                                        <div class="car__feature_export">
                                            <ul
                                                class="list-unstyled d-flex align-items-center justify-content-start flex-wrap ">
                                                @isset($product->model)
                                                    <li class="mb-3 d-flex align-items-center mr-3">
                                                        <span><img
                                                                src="{{ asset('web/assets/images/Icon_ feather-calendar.svg') }}"
                                                                alt=""></span>
                                                        <p class="mt-1 ml-3 "> {{ $product->model }}</p>
                                                    </li>
                                                @endisset
                                                @isset($product->geer)
                                                    <li class="mb-3 d-flex align-items-center mr-3">
                                                        <span><img src="{{ asset('web/assets/images/steering-wheel.svg') }}"
                                                                alt=""></span>
                                                        <p class="mt-1 ml-3 "> {{ $product->geer }} </p>
                                                    </li>
                                                @endisset
                                                @isset($product->wheel_drive)
                                                    <li class="mb-3 d-flex align-items-center mr-3">
                                                        <span><img src="{{ asset('web/assets/images/steering-wheel.svg') }}"
                                                                alt=""></span>
                                                        <p class="mt-1 ml-3 "> {{ $product->wheel_drive }} </p>
                                                    </li>
                                                @endisset
                                                @isset($product->loaction)
                                                    <li class="mb-3 d-flex align-items-center mr-3">
                                                        <span><img src="{{ asset('web/assets/images/turbo-engine.svg') }}"
                                                                alt=""></span>
                                                        <p class="mt-1 ml-3 "> {{ $product->loaction }}</p>
                                                    </li>
                                                @endisset
                                            </ul>
                                        </div>
                                        <div class="car-btns d-flex align-items-center justify-content-start flex-wrap">
                                            <button class="btn px-4 bg-main pt-2 pb-1 text-white mr-4 open-AddBookDialog "
                                                data-name="{{ $product->name_en }}" data-id="{{ $product->id }}"
                                                data-toggle="modal" href="#exportModal"> Interested </button>
                                            <a href="/en/export/car/{{ $product->id }}"> <button
                                                    class="btn px-4 bg-orange pt-2 pb-1 text-white mr-4">More
                                                    Details</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>




    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade modal-filter" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('en.send.export') }}" class="" data-wow-delay="0.2s" method="POST">
                        {{ csrf_field() }}


                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <div class="form-group">

                                    <input class="form-control" name="export_product_id" id="export_product_id"
                                        value="" type="hidden" />
                                    <input class="form-control" name="export_product_name" id="export_product_name"
                                        value="" disabled type="text" />
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="Full Name" />
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="form-group">

                                    <input class="form-control" type="text" name="phonenumber"
                                        placeholder="Phone Number" />
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">

                                    <input class="form-control" type="email" name="email" placeholder="Email" />
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">

                                    <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                        </div>




                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary w-100 rounded py-2">Send</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on("click", ".open-AddBookDialog", function() {
            var myId = $(this).data('id');
            var myName = $(this).data('name');
            $(".modal-body #export_product_id").val(myId);
            $(".modal-body #export_product_name").val(myName);
            // As pointed out in comments,
            // it is unnecessary to have to manually call the modal.
            // $('#addBookDialog').modal('show');
        });
    </script>
@endsection
