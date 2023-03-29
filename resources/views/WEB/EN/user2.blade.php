@extends('layouts.include_en')

@section('title')
Reservation Confimration
@endsection


@section('white')
bg-white

  @endsection
@section('content')



<div class="container">
            <div class="user-fllow mt-5">
                <ul class="list-unstyled d-flex align-items-center justify-content-center flex-wrap ">
                    <li class="fllow-step"> <span class="complite">1</span>  </li>

                    <li class="fllow-step">  <span class="complite">2</span>  </li>

                    <li class="fllow-step"> <span>3</span>  </li>
                </ul>
            </div>
            <h3 class="text-main text-center mt-5">Reservation Confimration</h3>

            <div class="row mt-5" >
                <div class="col-lg-10 mx-auto">
                    <form action="/en/paid" method="POST">
                        @csrf
                    <div class="user-details_cont bg-white rounded-max px-4 py-4 ">
                       
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                  <ul class="list-unstyled">
                                    <li class="d-flex align-items-center car-icon__det mb-3"> 
                                        <span class="mr-3"><i class="far fa-check-circle"></i></span>
                                        <p class="mb-0 font-medium"> {{$order->product->name}}</p>
                                     </li>

                                     <li class="d-flex align-items-center car-icon__det mb-3"> 
                                        <span class="mr-3"><i class="far fa-user"></i></span>
                                        <p class="mb-0">{{$order->name}} {{$order->last_name}}</p>
                                     </li>

                                     <li class="d-flex align-items-center car-icon__det mb-3"> 
                                        <span class="mr-3"><i class="fa fa-phone"></i></span>
                                        <p class="mb-0 font-medium"> {{$order->mobile}}</p>
                                     </li>

                                     <li class="d-flex align-items-center car-icon__det mb-3"> 
                                        <span class="mr-3"><i class="far fa-envelope"></i></span>
                                        <p class="mb-0 font-medium"> {{$order->email}}</p>
                                     </li>

                                     <li class="d-flex align-items-center car-icon__det mb-3"> 
                                        <span class="mr-3"><i class="fa fa-map-marker"></i></span>
                                        <p class="mb-0 font-medium"> {{$order->address}}</p>
                                     </li>
                                </ul>
                            </div>
                            <div class="col-lg-7">
                                <div class="car__img">
                                    <img src="./assets/images/caro.png" class="img-fluid" alt="">
                                </div>
                            </div>
                            
                        </div>
                   
                    </div>
                    <div class="btn-submit mt-4 text-center">
                        <button class="btn px-5 bg-orange text-white py-2"> NEXT <i class="fas fa-chevron-left ml-2"></i>  </button>
                    </div>
                </form>
                </div>
            </div>
       </div>
         
@endsection
