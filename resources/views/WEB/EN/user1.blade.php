@extends('layouts.include_en')

@section('title')
Reservation
@endsection


@section('white')
bg-white

  @endsection
@section('content')



<div class="container">
            <div class="user-fllow mt-5">
                <ul class="list-unstyled d-flex align-items-center justify-content-center flex-wrap ">
                    <li class="fllow-step"> <span class="complite">1</span>  </li>

                    <li class="fllow-step">  <span>2</span>  </li>

                    <li class="fllow-step"> <span>3</span>  </li>
                </ul>
            </div>
            <h3 class="text-main text-center mt-5">Reservation Information</h3>

            <div class="row mt-5" >
                <div class="col-lg-10 mx-auto">
                    <form action="/en/order/store" method="POST">
                        @csrf
                    <div class="user-details_cont bg-white rounded-max px-4 py-4 ">
                       
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                
                            <input class="form-control" type="hidden" name="product_id" value="{{$product->id}}"/>
                                <input class="form-control" type="text" name="name" placeholder="اFirst Name"/>
                            </div>
                            <div class="col-lg-6 mb-3">
                                
                               <input class="form-control" type="text" name="last_name" placeholder="Last Name"/>
                                </div>
                            <div class="col-lg-6 mb-3">
                                 
                                <input class="form-control" type="email" name="email" placeholder="E-mail"/>
                            </div>

                            <div class="col-lg-6 mb-3 mb-lg-0">
                               
                                <input class="form-control" type="text" name="mobile" placeholder="Mobile"/>
                            </div>

                            <div class="col-lg-6 mb-3 mb-lg-0">
                                
                                <input class="form-control" type="text" name="address" placeholder="Address"/>
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
