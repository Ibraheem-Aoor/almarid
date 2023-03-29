@extends('layouts.include_ar')

@section('title')
تفاصيل السيارة
@endsection



@section('url')
  /en/car/{{$product->id}}
@endsection


@section('white')
bg-white

  @endsection
@section('content')

<div class="container my-4">
            <div class="top-navLinks d-flex align-items-center justify-content-start">
            <a href="/">
                <i class="fad fa-home-alt mr-2"></i>
                الرئيسية</a>

                <i class="fas fa-long-arrow-left mx-3"></i>

                <a href="/cars"  >
                
                    قائمة السيارات</a>
                    <i class="fas fa-long-arrow-left mx-3"></i>

                    <a href="/car/{{$product->id}}" class="active">
                    
                    {{$product->name}}</a>
            </div></div>


            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                                 
                      <div class="tab-content">
                      <?php $p=0;?>
                             @foreach($product->web_colors as $c)
                        <div id="menu{{$p}}" class="tab-pane   @if($p==0) show in active  @else fade @endif">
                          <div class="single-carSlider owl-carousel owl_3 px-4 ">
                            @foreach($c->images as $image)
                            <img src="{{ asset('/uploads/products/'.$image->image) }}" alt="">
                            @endforeach
                        </div>
                        </div>
                        <?php $p++;?>
                        @endforeach
                      </div>
        
                        <div class="caro-details bg-white rounded-max px-4 py-4 mt-4 ">
                          <div class="car-name_price d-flex align-items-center justify-content-between flex-wrap">
                            <h3 class="mb-2 mb-lg-0">{{$product->name}} | {{$product->model->name}}</h3>
                            @if($product->is_offer ==1)
                            <h3 class="mb-2 mb-lg-0">{{$product->offer_price}} درهم  <br> <del class="text-secondary">{{$product->price}} درهم</del></h3>
                           @else
                           <h3 class="mb-2 mb-lg-0">{{$product->price}} درهم  </h3>
                           @endif
          
                          </div>
                           <hr class="line">
                           <div class="car_colors">
                             <h5>الالوان</h5>
                  

                             <ul class="nav nav-tabs color-plate d-flex align-items-center justify-content-start flex-wrap">
                              <?php $p=0;?>
                             @foreach($product->web_colors as $c)
                             @if($p==0)
                             <li class=""><a  class="active" data-toggle="tab" href="#menu{{$p}}"> <span class="active" style="background-color:{{$c->color->code}}"></span></a></li>
                             @else
                             <li><a data-toggle="tab" href="#menu{{$p}}"><span style="background-color:{{$c->color->code}}"></span></a></li>
                              
                             @endif
                             <?php $p++;?>
                             @endforeach 
                            </ul>
                           </div>
                            
                        </div>

                     
           







                        <div class="car-features bg-white rounded-max px-4 py-4 mt-4 ">
                          <div class="row">
                            @foreach($product->options as $o)
                            <div class="col-lg-2 col-md-3 col-6 mb-3  mb-lg-0  wow fadeInDown" data-wow-delay="0.6s">
                              <div class="single-car_feature text-center ">
                                <div class="feature-img rounded-max mb-3">
                                  <img src="{{ asset('/uploads/categories/'.$o->optionCategory->image) }}" class="img-fluid" alt="">
                                </div>
                                <div class="feature-text">
                                  <span>{{$o->optionCategory->name}}</span>
                                  <p>@if($o->option_id >0){{$o->option->name}} @else {{$o->other}}@endif</p>
                                </div>
                              </div>
                            </div>
                            @endforeach
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-4 mt-lg-0">
                      <div class="car-details bg-white rounded-max px-4 py-4 ">
                        <div class="car-details_text">
                          <h4>التفاصيل</h4>
                          <ul class="list-unstyled mt-3">
                            <hr class="line"> 
                            {!! $product->description!!}
                          </ul>
                        </div>

                      </div>
                    </div>
                </div>
            </div>
         

 
@endsection
