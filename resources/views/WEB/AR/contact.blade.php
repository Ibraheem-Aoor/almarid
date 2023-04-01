@extends('layouts.include_ar')

@section('title')
    تواصل معنا
@endsection


@section('url')
    /en/contact
@endsection

@section('white')
    bg-white
@endsection
@push('css')
    <style>
        .fs-20 {
            font-size: 20px !important;
        }
    </style>
@endpush
@section('content')
    <div class="container">

        <h2 class="orange text-center mt-5 under__line mb-5">تواصل معنا</h2>
        <div class="row phone-numbers">
            <div class="col-sm-3">
                <div class="text-info"><a class="text-info" href="tel:00971508010737" target="_blank"><i class="fa fa-phone"></i>
                        00971508010737</a></div>
                <div class="text-success"><a class="text-success" href="https://wa.me/971508010737" target="_blank"><i
                            class="fab fa-whatsapp fs-20"></i> 00971508010737</a></div>
            </div>
            {{-- ------- --}}
            <div class="col-sm-3">
                <div class="text-info"><a class="text-info" href="tel:00971567000709" target="_blank"><i
                            class="fa fa-phone"></i>
                        00971567000709</a></div>
                <div class="text-success"><a class="text-success" href="https://wa.me/971567000709" target="_blank"><i
                            class="fab fa-whatsapp fs-20"></i> 00971567000709</a></div>
            </div>
            {{-- ------- --}}
            <div class="col-sm-3">
                <div class="text-info"><a class="text-info" href="tel:00971581100058" target="_blank"><i
                            class="fa fa-phone"></i>
                        00971581100058</a></div>
                <div class="text-success"><a class="text-success" href="https://wa.me/971581100058" target="_blank"><i
                            class="fab fa-whatsapp fs-20"></i> 00971581100058</a></div>
            </div>
            {{-- ------- --}}
            <div class="col-sm-3">
                <div class="text-info"><a class="text-info" href="tel:00971509777299" target="_blank"><i
                            class="fa fa-phone"></i>
                        00971509777299</a></div>
                <div class="text-success"><a class="text-success" href="https://wa.me/971509777299" target="_blank"><i
                            class="fab fa-whatsapp fs-20"></i> 00971509777299</a></div>
            </div>

        </div>
        <section class="contact" id="contact">

            <div class="row">
                <div class="col-lg-7   mb-lg-0">
                    <h2>اين تجـدنا</h2>
                    @foreach ($addresses as $address)
                        <h3>{{ $address->branch }}</h3>
                        <div class="mapCon mt-4    wow fadeInRight    " data-wow-delay="0.2s">
                            <iframe class="rounded-max"
                                src="https://maps.google.com/maps?q={{ $address->lat }},{{ $address->lng }}&hl=es;z=20&amp;output=embed"
                                width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <h2>تواصل معنـا</h2>
                    <form action="{{ route('contact') }}" class="mt-4    wow fadeInDown   " data-wow-delay="0.2s"
                        method="POST">{{ csrf_field() }}
                        <div class="form-group mb-4">

                            <input class="form-control" type="text" required name="name" placeholder="الاسم" />
                        </div>
                        <div class="form-group mb-4">

                            <input class="form-control" type="text" required name="phonenumber"
                                placeholder="رقم الجوال" />
                        </div>
                        <div class="form-group mb-4">

                            <input class="form-control" type="text" required name="email"
                                placeholder="بريدك الالكتروني" />
                        </div>

                        <div class="form-group mb-4">

                            <textarea class="form-control" rows="4" required name="message" placeholder="رسالتك"> </textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit"
                                class="btn btn-primary btn-sm hover-transform rounded w-100   mt-2   wow fadeInDown"
                                data-wow-delay="0.2s" href="">ارسال </button>

                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
