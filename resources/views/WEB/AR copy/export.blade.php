@extends('layouts.include_ar')

@section('title')
التصدير
@endsection


@section('url')
  /en/export
@endsection


@section('white')
bg-white

  @endsection
@section('content')
<div class="container my-4">
            <div class="top-navLinks d-flex align-items-center justify-content-start flex-wrap ">
              
            <a href="/">
                <i class="fad fa-home-alt mr-2"></i>
                الرئيسية</a>

                <i class="fas fa-long-arrow-left mx-3"></i>

                <a href="/export"  >
                
                  التصدير</a>
                    
          
          
          </div>

          <div class="container mt-5">
            <h2 class="orange text-center mt-5 under__line    wow fadeInUp  " data-wow-delay="0.2s">المارد للتصدير</h2>

            <div class="row my-5 align-items-center">
              <div class="col-lg-7">
                <div class="export__text   wow fadeInRight  " data-wow-delay="0.2s">
              <p>{{$settings->where('key','export_ar')->first()->value}}</p>
              </div>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0">
       
              <form action="{{route('ar.send.export')}}" class="" data-wow-delay="0.2s"  method="POST">{{csrf_field()}}
                <div class="form-group mb-4"> 
                  
                <input class="form-control" name="export_product_id" type="hidden" placeholder="الاسم"/>
                  <input class="form-control" name="name" type="text" placeholder="الاسم"/>
                </div>
                <div class="form-group mb-4"> 
                  
                    <input class="form-control" name="phonenumber"  type="text" placeholder="رقم الجوال"/>
                  </div>
                <div class="form-group mb-4"> 
               
                  <input class="form-control"  name="email" type="text" placeholder="بريدك الالكتروني"/>
                </div>
        
                <div class="form-group mb-4" > 
                   
                  <textarea class="form-control" name="message"  rows="4" placeholder="رسالتك"> </textarea>
                </div>
                <div class="text-right">
                <button type="submit" class="btn btn-primary btn-sm hover-transform rounded w-100   mt-2   wow fadeInDown" data-wow-delay="0.2s" href="">ارسال </button>
                
                </div>
              </form>
            </div>
            </div>
            <hr class="line">
            <div class="avilable__cars">
              <h2 class="orange text-center mt-5 under__line   wow fadeInUp  " data-wow-delay="0.2s">السيارات المتوفرة</h2>
              <div class="row mt-5">
                <div class="col-12 mb-3 ">
                  <div class="single_export__car px-4 py-4 bg-white border    wow fadeInDown   " data-wow-delay="0.2s">
                    <div class="row align-items-center">
                      <div class="col-lg-4">
                        <div class="main-img py-2">
                          <img src="./assets/images/mainCar.png" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="car__namePrice d-flex align-items-center justify-content-between flex-wrap">
                          <h3 class="mb-2 mb-md-0">كيـا سبورتـاج 2021 فل اوبشن لاين بلس</h3>
                        <p class="bg-dark px-4 pt-3 pb-2 text-white rounded">  <span>$45,000</span> | <span>90,000 درهم</span></p> 
                        </div>
                        <hr class="line">
                        <div class="car__feature_export">
                          <ul class="list-unstyled d-flex align-items-center justify-content-start flex-wrap ">
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/Icon_ feather-calendar.svg" alt=""></span>      <p class="mt-1 ml-3 "> 2013 SUV TEC 21019 118714 </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/steering-wheel.svg" alt=""></span>      <p class="mt-1 ml-3 "> أوتوماتيك </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/Icon-ionic-ios-color-fill.svg" alt=""></span>      <p class="mt-1 ml-3 "> سيلفر -  غطاء اسود </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/turbo-engine.svg" alt=""></span>      <p class="mt-1 ml-3 "> الامارات - الشارقة شارع 86 </p>
                            </li>
                          </ul>
                        </div>
                        <div class="car-btns d-flex align-items-center justify-content-start flex-wrap">
                          <button class="btn px-4 bg-main pt-2 pb-1 text-white mr-4" data-toggle="modal" data-target="#exportModal"> مهتـم </button>
                        <a href="#"> <button class="btn px-4 bg-orange pt-2 pb-1 text-white mr-4"> رؤية التفاصيل </button></a>  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 mb-3 ">
                  <div class="single_export__car px-4 py-4 bg-white border    wow fadeInDown   " data-wow-delay="0.2s">
                    <div class="row align-items-center">
                      <div class="col-lg-4">
                        <div class="main-img py-2">
                          <img src="./assets/images/mainCar.png" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="car__namePrice d-flex align-items-center justify-content-between flex-wrap">
                          <h3 class="mb-2 mb-md-0">كيـا سبورتـاج 2021 فل اوبشن لاين بلس</h3>
                        <p class="bg-dark px-4 pt-3 pb-2 text-white rounded">  <span>$45,000</span> | <span>90,000 درهم</span></p> 
                        </div>
                        <hr class="line">
                        <div class="car__feature_export">
                          <ul class="list-unstyled d-flex align-items-center justify-content-start flex-wrap ">
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/Icon_ feather-calendar.svg" alt=""></span>      <p class="mt-1 ml-3 "> 2013 SUV TEC 21019 118714 </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/steering-wheel.svg" alt=""></span>      <p class="mt-1 ml-3 "> أوتوماتيك </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/Icon-ionic-ios-color-fill.svg" alt=""></span>      <p class="mt-1 ml-3 "> سيلفر -  غطاء اسود </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/turbo-engine.svg" alt=""></span>      <p class="mt-1 ml-3 "> الامارات - الشارقة شارع 86 </p>
                            </li>
                          </ul>
                        </div>
                        <div class="car-btns d-flex align-items-center justify-content-start flex-wrap">
                          <button class="btn px-4 bg-main pt-2 pb-1 text-white mr-4"  data-toggle="modal" data-target="#exportModal">   مهتـم </button>
                        <a href="#"> <button class="btn px-4 bg-orange pt-2 pb-1 text-white mr-4"> رؤية التفاصيل </button></a>  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 mb-3 ">
                  <div class="single_export__car px-4 py-4 bg-white border    wow fadeInDown   " data-wow-delay="0.2s">
                    <div class="row align-items-center">
                      <div class="col-lg-4">
                        <div class="main-img py-2">
                          <img src="./assets/images/mainCar.png" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="car__namePrice d-flex align-items-center justify-content-between flex-wrap">
                          <h3 class="mb-2 mb-md-0">كيـا سبورتـاج 2021 فل اوبشن لاين بلس</h3>
                        <p class="bg-dark px-4 pt-3 pb-2 text-white rounded">  <span>$45,000</span> | <span>90,000 درهم</span></p> 
                        </div>
                        <hr class="line">
                        <div class="car__feature_export">
                          <ul class="list-unstyled d-flex align-items-center justify-content-start flex-wrap ">
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/Icon_ feather-calendar.svg" alt=""></span>      <p class="mt-1 ml-3 "> 2013 SUV TEC 21019 118714 </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/steering-wheel.svg" alt=""></span>      <p class="mt-1 ml-3 "> أوتوماتيك </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/Icon-ionic-ios-color-fill.svg" alt=""></span>      <p class="mt-1 ml-3 "> سيلفر -  غطاء اسود </p>
                            </li>
                            <li class="mb-3 d-flex align-items-center mr-3">
                              <span><img src="./assets/images/turbo-engine.svg" alt=""></span>      <p class="mt-1 ml-3 "> الامارات - الشارقة شارع 86 </p>
                            </li>
                          </ul>
                        </div>
                        <div class="car-btns d-flex align-items-center justify-content-start flex-wrap">
                          <button class="btn px-4 bg-main pt-2 pb-1 text-white mr-4" data-toggle="modal" data-target="#exportModal"> مهتـم </button>
                        <a href="#"> <button class="btn px-4 bg-orange pt-2 pb-1 text-white mr-4"> رؤية التفاصيل </button></a>  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          
        
        
        </div>

<!-- Button trigger modal -->
 
  <!-- Modal -->
  <div class="modal fade modal-filter" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">تواصل معنا</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="">

<div class="row">
    <div class="col-lg-12 mb-3">
      <div class="form-group"> 
   
        <input class="form-control" type="text" placeholder="الاسم كامل"/>
      </div>
    </div>
 
    <div class="col-lg-6 mb-3">
      <div class="form-group"> 
   
        <input class="form-control" type="text" placeholder="رقم الجوال"/>
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group"> 
   
        <input class="form-control" type="email" placeholder="البريد الالكتروني"/>
      </div>
    </div>
 
      <div class="col-12 mb-2">
        <div class="form-group"> 
   
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  ></textarea>
        </div>
      </div>
      
</div>
                
                
            </form>
            
        </div>
        <div class="modal-footer ">
           <button type="button" class="btn btn-primary w-100 rounded py-2">ارسال</button>
        </div>
      </div>
    </div>
  </div>

 

@endsection
