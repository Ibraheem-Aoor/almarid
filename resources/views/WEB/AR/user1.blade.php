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

                    <li class="fllow-step">  <span>2</span>  </li>

                    <li class="fllow-step"> <span>3</span>  </li>
                </ul>
            </div>
            <h3 class="text-main text-center mt-5">بيانات صاحب الحجز</h3>

            <div class="row mt-5" >
                <div class="col-lg-10 mx-auto">
                    <form  action="{{route('order.store')}}"   method="POST">{{csrf_field()}}
                    <div class="user-details_cont bg-white rounded-max px-4 py-4 ">
                       
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                
                            <input class="form-control" type="hidden" name="product_id" value="{{$product->id}}"/>
                                <input class="form-control" type="text" name="name" placeholder="الإسم الأول"/>
                            </div>
                            <div class="col-lg-6 mb-3">
                                
                               <input class="form-control" type="text" name="last_name" placeholder=" الإسم الأخير"/>
                                </div>
                            <div class="col-lg-6 mb-3">
                                 
                                <input class="form-control" type="email" name="email" placeholder="بريدك الالكتروني"/>
                            </div>

                            <div class="col-lg-6 mb-3 mb-lg-0">
                               
                                <input class="form-control" type="text" name="mobile" placeholder="رقم الجوال"/>
                            </div>

                            <div class="col-lg-6 mb-3 mb-lg-0">
                                
                                <input class="form-control" type="text" name="address" placeholder="العنوان"/>
                            </div>
                            
                        </div>
                   
                    </div>
                    <div class="btn-submit mt-4 text-center">
                        <button type="submit" class="btn px-5 bg-orange text-white py-2"> التالي <i class="fas fa-chevron-left ml-2"></i>  </button>
                    </div>
                </form>
                </div>
            </div>
       </div>
         

 
@endsection
