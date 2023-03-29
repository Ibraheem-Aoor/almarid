@extends('layouts.include_ar')

@section('title')
تفاصيل سيارة التصدير
@endsection


@section('url')
  /en/export/car/{{$product->id}}
@endsection


@section('white')
bg-white

  @endsection
@section('content')
<div class="container my-4">
            <div class="top-navLinks d-flex align-items-center justify-content-start">
            <a href="#">
                <i class="fad fa-home-alt mr-2"></i>
                الرئيسية</a>

                <i class="fas fa-long-arrow-left mx-3"></i>

                <a href="#"  >
                
                    قائمة السيارات</a>
                    <i class="fas fa-long-arrow-left mx-3"></i>

                    <a href="#" class="active">
                    
                        اسم السيارة</a>
            </div></div>


            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="single-carSlider owl-carousel owl_3 px-4 ">
                            <img src="./assets/images/caro.png" alt="">
                            <img src="./assets/images/caro.png" alt="">
                            <img src="./assets/images/caro.png" alt="">
                            <img src="./assets/images/caro.png" alt="">
                            <img src="./assets/images/caro.png" alt="">
                        </div>
                        <div class="caro-details bg-white rounded-max px-4 py-4 mt-4 ">
                            <h3 class="text-main" >  بيانات التواصل</h3>
                          <div class="car-name_price d-flex align-items-center justify-content-start flex-wrap mt-4">
                            <h4 class="mb-2 mb-lg-0 mr-4"> <i class="fas fa-map-marker-alt mr-2 orange"></i>  + دبي - 9714 321 2290</h4>
                            <h4 class="mb-2 mb-lg-0  mr-4"> <i class="fas fa-map-marker-alt mr-2 orange"></i>  + دبي - 9714 321 2290</h4>
                          </div>
                      
                            
                        </div>
                        <div class="order-now mt-3">
                            <button class="btn pt-3 ob-2 bg-orange text-white rounded w-100">ااطلبـها الان</button>
                        </div>
                     
                    </div>
                    <div class="col-lg-4 mt-4 mt-lg-0">
                      <div class="car-details bg-white rounded-max px-4 py-4 ">
                        <div class="car-details_text">
                          <h4>التفاصيل</h4>
                          <ul class="list-unstyled mt-3">
                            <hr class="line"> 
                           <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                               <span>تاريخ الانتاج</span>
                               <span>2018</span>
                           </li>
                           <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>تاريخ الانتاج</span>
                            <span>2018</span>
                        </li>
                          </ul>
                        </div>

                      </div>
                    </div>
                    <div class="col-12">
                        <div class="car-features bg-white rounded-max px-4 py-4 mt-4 ">
                            <h3  class="text-main" >   يمكننا مساعدتك في</h3>
                          <div class="row mt-4">
                            <div class="col-lg-4 col-6   mb-3   wow fadeInDown" data-wow-delay="0.2s">
                              <div class="single-car_feature text-center ">
                                <div class="  rounded-max mb-3">
                                  <img src="./assets/images/settings.svg" class="img-fluid" alt="">
                                </div>
                                <div class="feature-text">
                                  
                                  <p>فحص المركبة</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4   mb-3 col-6    wow fadeInDown" data-wow-delay="0.2s">
                                <div class="single-car_feature text-center ">
                                  <div class="  rounded-max mb-3">
                                    <img src="./assets/images/settings.svg" class="img-fluid" alt="">
                                  </div>
                                  <div class="feature-text">
                                    
                                    <p>فحص المركبة</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-4 col-6   mb-3   wow fadeInDown" data-wow-delay="0.2s">
                                <div class="single-car_feature text-center ">
                                  <div class="  rounded-max mb-3">
                                    <img src="./assets/images/settings.svg" class="img-fluid" alt="">
                                  </div>
                                  <div class="feature-text">
                                    
                                    <p>فحص المركبة</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-4   mb-3 col-6    wow fadeInDown" data-wow-delay="0.2s">
                                  <div class="single-car_feature text-center ">
                                    <div class="  rounded-max mb-3">
                                      <img src="./assets/images/settings.svg" class="img-fluid" alt="">
                                    </div>
                                    <div class="feature-text">
                                      
                                      <p>فحص المركبة</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4 col-6   mb-3   wow fadeInDown" data-wow-delay="0.2s">
                                    <div class="single-car_feature text-center ">
                                      <div class="  rounded-max mb-3">
                                        <img src="./assets/images/settings.svg" class="img-fluid" alt="">
                                      </div>
                                      <div class="feature-text">
                                        
                                        <p>فحص المركبة</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-4   mb-3 col-6    wow fadeInDown" data-wow-delay="0.2s">
                                      <div class="single-car_feature text-center ">
                                        <div class="  rounded-max mb-3">
                                          <img src="./assets/images/settings.svg" class="img-fluid" alt="">
                                        </div>
                                        <div class="feature-text">
                                          
                                          <p>فحص المركبة</p>
                                        </div>
                                      </div>
                                    </div>  
                          </div>
                        </div>
                    </div>
                </div>
            </div>
         

 
@endsection
