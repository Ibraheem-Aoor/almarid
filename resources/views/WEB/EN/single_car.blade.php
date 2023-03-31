
    @extends('layouts.include_en')

@section('title')
Car
@endsection



@section('url')
  /car/{{$product->id}}
@endsection

@section('white')
bg-white

  @endsection
@section('content')
<div class="container my-4">
            <div class="top-navLinks d-flex align-items-center justify-content-start">
            <a href="/en/">
                <i class="fad fa-home-alt mr-2"></i>
                Home</a>

                <i class="fas fa-long-arrow-left mx-3"></i>

                <a href="/en/cars"  >

                    Cars</a>
                    <i class="fas fa-long-arrow-left mx-3"></i>

                    <a href="/en/car/{{$product->id}}" class="active">

                    {{$product->name_en}}</a>
            </div></div>


            <div class="container">
                <div class="row">
                    <div class="col-lg-8">

                      <div class="tab-content">

                      <?php $p=0;?>
                             @foreach($product->web_colors as $c)
                        <div id="menu{{$p}}" class="tab-pane  @if($p==0) show in active  @else fade @endif">
                          <div class="single-carSlider owl-carousel owl_3 px-4 ">
                            @foreach($c->images as $image)
                            <a data-fancybox="gallery" href="{{ asset('/uploads/products/'.$image->image) }}" >
                            <img src="{{ asset('/uploads/products/'.$image->image) }}" loading="lazy" alt="">
                           </a>
                            @endforeach

                        </div>
                        </div>
                        <?php $p++;?>
                        @endforeach

                      </div>

                        <div class="caro-details bg-white rounded-max px-4 py-4 mt-4 ">
                          <div class="car-name_price d-flex align-items-center justify-content-between flex-wrap">
                            <h3 class="mb-2 mb-lg-0"> {{$product->name_en}} | {{$product->model->name}}</h3>
                            @if($product->is_offer ==1)
                            <h3 class="mb-2 mb-lg-0 text-primary">{{$product->offer_price}} Dirham  <br> <del class="text-secondary">{{$product->price}} Dirham</del></h3>
                            @else
                           <h3 class="mb-2 mb-lg-0">{{$product->price}} Dirham  </h3>
                           @endif
                          </div>
                           <hr class="line">
                           <div class="car_colors">
                             <h5>Colors</h5>


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
                            <div class="col-lg-2 col-md-3 col-6 mb-3 mb-lg-0  wow fadeInDown" data-wow-delay="0.2s">
                              <div class="single-car_feature text-center ">
                                <div class="feature-img rounded-max mb-3">
                                  <img src="{{ asset('/uploads/categories/'.$o->optionCategory->image) }}" loading="lazy" class="img-fluid" alt="">
                                </div>
                                <div class="feature-text">
                                  <span>{{$o->optionCategory->name_en}}</span>
                                  <p>@if($o->option_id >0){{$o->option->name_en}} @else {{$o->other}}@endif</p>
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
                          <h4>Details</h4>
                          <ul class="list-unstyled mt-3">
                              <li>
                            <hr class="line">
                            {!! $product->description_en!!}
                            </li>
                          </ul>
                          <div class="text-right">
                            <a class="btn btn-primary btn-sm hover-transform rounded w-100   mt-2   wow fadeInDown" data-wow-delay="0.2s" href="/en/order/{{$product->id}}">Reserve Now </a>

                            </div>
                        </div>

                      </div>
                    </div>
                </div>
            </div>

@endsection


