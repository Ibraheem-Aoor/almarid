@extends('layouts.include_en')

@section('title')
Export Car
@endsection


@section('url')
  /export/car/{{$product->id}}
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

                <a href="/en/export"  >
                
                    Export</a>
                    <i class="fas fa-long-arrow-left mx-3"></i>

                    <a href="/en/export/car/{{$product->id}}" class="active">
                    
                        {{$product->name_en}}</a>
            </div></div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                      <div class="tab-content">  <?php $p=0;?>
                             @foreach($product->web_colors as $c)
                        <div id="menu{{$p}}" class="tab-pane  @if($p==0) show in active  @else fade @endif">
                          <div class="single-carSlider owl-carousel owl_3 px-4 ">
                            @foreach($c->images as $image)
                            <a data-fancybox="gallery" href="{{ asset('/uploads/products/'.$image->image) }}" >
                            <img src="{{ asset('/uploads/products/'.$image->image) }}" alt="">
                           </a>
                            @endforeach
                           
                        </div>
                        </div>
                        <?php $p++;?>
                        @endforeach
                      </div>
        
                        <div class="caro-details bg-white rounded-max px-4 py-4 mt-4 ">
                          <div class="car-name_price d-flex align-items-center justify-content-between flex-wrap">
                            <h3 class="mb-2 mb-lg-0"> {{$product->name_en}}</h3>
                            <h3 class="mb-2 mb-lg-0">{{$product->price}} Dirham</h3>
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





                        <div class="caro-details bg-white rounded-max px-4 py-4 mt-4 ">
                            <h3 class="text-main" > Contact Info</h3>
                          <div class="car-name_price d-flex align-items-center justify-content-start flex-wrap mt-4">
                              @if(is_null($product->phone) &&is_null($product->phone1))
                              @foreach($addresses as $address)
                            <h4 class="mb-2 mb-lg-0 mr-4"> <i class="fas fa-map-marker-alt mr-2 orange"></i>  + {{$address->branch_en}} - {{$address->phonenumber}}</h4>
                            @endforeach
                            @endif
                              @if(!is_null($product->phone))
                            <h4 class="mb-2 mb-lg-0 mr-4"> <i class="fas fa-map-marker-alt mr-2 orange"></i> {{$product->phone}}</h4>
                            @endif
                            @if(!is_null($product->phone1 ))
                            <h4 class="mb-2 mb-lg-0 mr-4"> <i class="fas fa-map-marker-alt mr-2 orange"></i> {{$product->phone1}}</h4>
                            @endif
                          </div>
                      
                            
                        </div>
                        <div class="order-now mt-3">
                            <button  data-toggle="modal" data-target="#exportModal" class="btn pt-3 ob-2 bg-orange text-white rounded w-100">Interested</button>
                        </div>
                     
                    </div>
                    <div class="col-lg-4 mt-4 mt-lg-0">
                      <div class="car-details bg-white rounded-max px-4 py-4 ">
                        <div class="car-details_text">
                          <h4>Details</h4>
                          <ul class="list-unstyled mt-3">
                            <hr class="line"> 
                           <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                               <span>Name</span>
                               <span>{{$product->name_en}}</span>
                           </li>
                           <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Price</span>
                            <span>{{$product->price}} Dirham</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Price ($)</span>
                            <span>{{$product->price_dollar}} $</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Geer</span>
                            <span>{{$product->geer}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Wheel Drive</span>
                            <span>{{$product->wheel_drive}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Make</span>
                            <span>{{$product->make}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Year </span>
                            <span>{{$product->year}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Model </span>
                            <span>{{$product->model}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span> Body Style</span>
                            <span>{{$product->body_style}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Stack Number </span>
                            <span>{{$product->stack_number}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span> Mileage</span>
                            <span>{{$product->mileage}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Loaction </span>
                            <span>{{$product->loaction}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Engine </span>
                            <span>{{$product->engine}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Door </span>
                            <span>{{$product->door}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span> Warranty</span>
                            <span>{{$product->warranty}}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                            <span>Bhp </span>
                            <span>{{$product->bhp}}</span>
                        </li>
                          </ul>
                        </div>

                      </div>
                    </div>
                    <div class="col-12">
                        <div class="car-features bg-white rounded-max px-4 py-4 mt-4 ">
                            <h3  class="text-main" >   We can help you </h3>
                          <div class="row mt-4">
                              @foreach($product->services as $service)
                            <div class="col-lg-4 col-6   mb-3   wow fadeInDown" data-wow-delay="0.2s">
                              <div class="single-car_feature text-center ">
                                <div class="  rounded-max mb-3">
                                  <img src="{{ asset('/uploads/services/'.$service->export_service->image) }}" class="img-fluid" alt="">
                                </div>
                                <div class="feature-text">
                                  
                                  <p>{{$service->export_service->name_en}}</p>
                                </div>
                              </div>
                            </div>
                           @endforeach
                          </div>
                        </div>
                    </div>
                </div>
            </div>
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
          <form action="{{route('ar.send.export')}}" class="" data-wow-delay="0.2s"  method="POST">{{csrf_field()}}
                

<div class="row">  
<div class="col-lg-12 mb-3">
      <div class="form-group"> 
   
                <input class="form-control" name="export_product_id" value="{{$product->id}}"  type="hidden" />
                <input class="form-control" name="export_product_name" value="{{$product->name_en}}" disabled type="text" />
      </div>
    </div>
 
    <div class="col-lg-12 mb-3">
      <div class="form-group"> 
        <input class="form-control" type="text" name="name"  placeholder="الاسم كامل"/>
      </div>
    </div>
 
    <div class="col-lg-6 mb-3">
      <div class="form-group"> 
   
        <input class="form-control" type="text" name="phonenumber"  placeholder="رقم الجوال"/>
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group"> 
   
        <input class="form-control" type="email" name="email"  placeholder="البريد الالكتروني"/>
      </div>
    </div>
 
      <div class="col-12 mb-2">
        <div class="form-group"> 
   
          <textarea class="form-control" name="message"  id="exampleFormControlTextarea1" rows="3"  ></textarea>
        </div>
      </div>
      
</div>
                
                
          
            
        </div>
        <div class="modal-footer ">
           <button type="submit" class="btn btn-primary w-100 rounded py-2">ارسال</button> 
        </div> </form>
      </div>
    </div>
  </div>
 
@endsection
