
    @extends('layouts.include_ar')

@section('title')
تتبع الطلب
@endsection



@section('url')
  /en/
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
            <h3 class="text-main text-center mt-5">تأكيد البيانات</h3>

            <div class="row mt-5" >
                <div class="col-lg-10 mx-auto">
                    <form action="{{route('paid')}}"   method="POST">{{csrf_field()}}
                    <div class="user-details_cont bg-white rounded-max px-4 py-4 ">
                    <input class="form-control" type="hidden" name="order_id" value="{{$order->id}}"/>
                              
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
                                        <span class="mr-3"><i class="far fa-phone-alt"></i></span>
                                        <p class="mb-0 font-medium"> {{$order->mobile}}</p>
                                     </li>

                                     <li class="d-flex align-items-center car-icon__det mb-3"> 
                                        <span class="mr-3"><i class="far fa-envelope"></i></span>
                                        <p class="mb-0 font-medium"> {{$order->email}}</p>
                                     </li>

                                     <li class="d-flex align-items-center car-icon__det mb-3"> 
                                        <span class="mr-3"><i class="far fa-check-circle"></i></span>
                                        <p class="mb-0 font-medium"> {{$order->address}}</p>
                                     </li>
                                </ul>
                            </div>
                            <div class="col-lg-7">
                                <div class="car__img">
                                    <img src="{{asset('/uploads/products/'.$order->product->image)}}" class="img-fluid" alt="">
                                </div>
                            </div>
                            
                        </div>
                   
                    </div>
                    <div class="btn-submit mt-4 text-center">
                        <button type= "submit" class="btn px-5 bg-orange text-white py-2"> التالي <i class="fas fa-chevron-left ml-2"></i>  </button>
                    </div>
                </form>
                </div>
            </div>
       </div>
         
@endsection
