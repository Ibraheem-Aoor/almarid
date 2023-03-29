@extends('layouts.include_ar')

@section('title')
الرئيسية
@endsection



@section('url')
  /en/
@endsection


@section('section')
<div class="social-fix">
  <ul class="list-unstyled">

 <li><a href="{{$settings->where('key','twitter')->first()->value}}" target="_blank">
          <i class="fab fa-twitter"></i>
      </a></li>

 <li><a href="{{$settings->where('key','instagram')->first()->value}}" target="_blank">
          <i class="fab fa-instagram"></i>
      </a></li>

   <li><a href="{{$settings->where('key','youtube')->first()->value}}" target="_blank">
          <i class="fab fa-youtube"></i>
      </a></li> 

  <li><a href="{{$settings->where('key','facebook')->first()->value}}" target="_blank">
          <i class="fab fa-facebook-f"></i>
      </a></li> 
    
      
      
      <li><a href="#" >
          <i class="fas fa-search"></i>
      </a></li> 
         
  
  
  </ul>
  
  </div>
<section class="main-section">
  <div class="main-section_content">

  @endsection
@section('content')

<div class="container">
<div class="content-wrap text-center wow fadeInUp" data-wow-delay="0.2s">
  <h1>افضل خيار لشراء سيارة احلامك</h1>
  <div class="search-field  ">
    <form action="">
    <input class="search" type="search" name="" id="" placeholder="ابحث عن سيارتك">
    <input class="sub ml-1 mt-2 mt-sm-0" type="submit" value="بحث">
  </form>
  </div>
</div></div>
  </div>
 </section>
 
<!-- begin:: section -->
<section class="section   how-work">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-7 mx-auto">
        <div class="text-center">
          <h2 class="sub-title-section color-2 wow fadeInDown" data-wow-delay="0.2s">تعرف معنا على</h2>
          <h2 class="title-section font-bold wow fadeInDown" data-wow-delay="0.3s"> منهجية العمل</h2>
        </div>
      </div>
    </div>
    <div class="row"> 
      <div class="col-12"> 
        <div class="list_stage">

          
          <?php $i=1;?>
      @foreach($methodologies as $methodology)
      <div class="widget__item-4 wow fadeInDown" data-wow-delay="0.2s">
            <div class="widget__item-icon"><img src="{{ asset('/uploads/methodologies/'.$methodology->img) }}" alt=""/>
              <div class="widget__item-number">{{$i}}</div>
            </div>
            <div class="widget__item-content">
              <h3 class="widget__item-title font-bold mb-2">{{$methodology->title}}</h3>
              <p class="widget__item-desc font-normal">{{$methodology->description}}</p>
            </div>
          </div>
          <?php $i++;?>
      @endforeach
        </div>
      </div>
    </div>
  </div>
</section><!-- end:: section -->

<section class="cars-types">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-7 mx-auto">
        <div class="text-center">
       
          <h2 class="title-section font-bold text-white wow fadeInDown" data-wow-delay="0.3s"> أنواع السيارت</h2>
        </div>
      </div>
    </div>
    <div class="cars-owl owl-carousel owl_1 wow fadeInDown" data-wow-delay="0.2s">
      <?php $c=1; ?>
    @foreach($categories as $category)
    
    <div class="single-car text-center   bg-white mx-2">
        <div class="car-img mb-4">
        <a href="/cars">  <img src="{{asset('/uploads/categories/'.$category->image)}}" alt=""></a>
        </div>
        <h3>{{$c}}</h3>
      </div>
      
      <?php $c++; ?>
      @endforeach
    </div>
  </div>
</section>



<section class="offers">
  <div class="container">
    <div class="top-tittle d-flex align-items-center justify-content-between">
      <h3 class="wow fadeInDown" data-wow-delay="0.2s">اخر العروض</h3>
      <a class="btn btn-primary btn-sm  wow fadeInLeft scrollTo rounded px-5"  data-wow-delay="0.3s" href="/offers"  >  المزيد</a>
    </div>
    <div class="row mt-5">
      
    @foreach($offers as $product)
      <div class="col-lg-4 col-md-6 mb-3 wow fadeInDown" data-wow-delay="0.2s">
        <a href="/car/{{$product->id}}">
        <div class="single-mainCar">
          <div class="main-img py-2">
            <img src="{{asset('/uploads/products/'.$product->image)}}" alt="" class="img-fluid">
          </div>
          <div class="maincar-title mb-2">
            <h5>{{$product->name}}</h5>
          </div>
          <div class="options d-flex align-items-center justify-content-start">
            <p class="mr-2">{{$product->model->name}} | </p > <p  class="mr-2">{{$product->category->name}} | </p>  <p  class="mr-2">@if($product->is_new == 1) جديد  @endif</p>
          </div>
          <hr>
          <div class="maincar-price d-flex align-items-center justify-content-between">
          <h5 class="color bold">{{$product->offer_price}} درهم <br> <del class="text-secondary">{{$product->price}} درهم</del></h5>
            <h5 class="orange">@if($product->quantity >0) متبقي {{$product->quantity}} من السيارات @else  نفذت الكمية@endif</h5>
          </div>
        </div>
      </a>
      </div>
@endforeach

    </div>
  </div>
</section>
<div class="container">
  <hr>
</div>
<section class="  latest-cars">
  <div class="container">
    <div class="top-tittle d-flex align-items-center justify-content-between">
      <h3 class="wow fadeInDown" data-wow-delay="0.2s">احدث السيارات</h3>
      <a class="btn btn-primary btn-sm  wow fadeInLeft scrollTo rounded px-5"  data-wow-delay="0.3s" href="/cars"  >  المزيد</a>
    </div>
    <div class="row mt-5">
      @foreach($products as $product)
      <div class="col-lg-4 col-md-6 mb-3 wow fadeInDown" data-wow-delay="0.2s">
         <a href="/car/{{$product->id}}">
        <div class="single-mainCar">
          <div class="main-img py-2">
            <img src="{{asset('/uploads/products/'.$product->image)}}" alt="" class="img-fluid">
          </div>
          <div class="maincar-title mb-2">
            <h5>{{$product->name}}</h5>
          </div>
          <div class="options d-flex align-items-center justify-content-start">
            <p class="mr-2">{{$product->model->name}} | </p >  <p  class="mr-2">{{$product->category->name}} | </p>  <p  class="mr-2">@if($product->is_new == 1) جديد  @endif</p>
          </div>
          <hr>
          <div class="maincar-price d-flex align-items-center justify-content-between">
          <h5 class="color ">{{$product->price}} درهم </h5>
            <h5 class="orange">@if($product->quantity >0) متبقي {{$product->quantity}} من السيارات @else  نفذت الكمية @endif</h5>
          </div>
        </div>
      </a>
      </div>
@endforeach
    </div>
  </div>
</section>
<section class="services" id="serv">
  <div class="container">
    <div class="widget__item-content text-center mx-auto">
      <h3 class="widget__item-title font-bold mb-2">مميزاتنـا</h3>
    </div> 
    <div class="row">
      @foreach($features as $feature)
      <div class="col-lg-3 col-md-6">
        <a href="/single-service/id">
        <div class="single-serv text-center  wow fadeInUp" data-wow-delay="0.2s">
          <div class="serv-icon mb-3 serv1">
            <img src="{{ asset('/uploads/features/'.$feature->img) }}" class="img-fluid" alt="">
          </div>
          <div class="serv-title mb-1">
            <h3>{{$feature->title}}</h3>
          </div>
          <div class="serv-text">
            <p>{{$feature->description}} </p>
          </div>
        </div>
      </a>
      </div>
      @endforeach
      
    </div>
  </div>
</section>

 



 

<section class="partners" id="partners">
  <div class="container   mt-2">
 
    <div class="js-ticker" id="gallery">
      
    @foreach($brands as $brand)
      <div class="widget__item-2 wow fadeInDown slide js-ticker-item" data-wow-delay="0.2s">
        <div class="widget__item-image">
          <a href="#"><img src="{{asset('/uploads/brands/'.$brand->image)}}" alt=""/></a></div>
      </div>
      @endforeach
 
    </div>
  </div>
</section>

<div class="testimonials">
  <div class="container">
    <div class="widget__item-content text-center mx-auto">
      <h3 class="widget__item-title font-bold mb-2">اراء عملاؤنـا</h3>
    </div> 
    <div class="testi-cont owl-carousel owl_2 mt-5">
    @foreach($evaluations as $evaluation)
            
      <div class="single-testi  ">
        <div class="top-head-testi d-flex align-items-center justify-content-start">
          <div class="name-rate">
            <h4>{{$evaluation->name}}</h4>
            <span class="stars px-2 py-2" data-rating="4">
            {{$evaluation->country->name}}
          </span>
          </div>
        </div>
        <hr>
        <p>{{$evaluation->message}}</p>
                @if(!is_null($evaluation->file))
                <div class="video ">
                  
                  <a  href="{{asset('/uploads/evaluations/'.$evaluation->file)}}" data-rel="lightcase:myCollection" class="d-flex align-items-center justify-content-start play-video">
                  <img src="{{asset('/web/assets/images/video.png')}}" class="mr-3" alt="">
                  شاهد 
                 </a>
                </div>
                @endif
      </div>
          @endforeach
      
    </div>
  </div>
</div>

<section class="contact" id="contact">
  <div class="container">
    <div class="row">
  
      <div class="col-lg-12">
        <h2 class="w-100 text-center">تواصل معنـا</h2>
        <form action="{{route('contact')}}" class="mt-4    wow fadeInDown   " data-wow-delay="0.2s"  method="POST">{{csrf_field()}}
                       
          <div class="row">
            <div class="col-lg-4">
          <div class="form-group mb-4"> 
           
          <input class="form-control" type="text" required name="name" placeholder="الاسم"/>
                       
          </div></div>
          <div class="col-lg-4">
            <div class="form-group mb-4"> 
              
            <input class="form-control" type="text" required name="phonenumber" placeholder="رقم الجوال"/>
                          </div></div>
          <div class="col-lg-4"> 
          <div class="form-group mb-4"> 
           
          <input class="form-control" type="text"  required name="email" placeholder="بريدك الالكتروني"/>
                       </div> </div>
          <div class="col-lg-12"> 
          <div class="form-group mb-4" > 
            
          <textarea class="form-control" rows="4" required  name="message"  placeholder="رسالتك"> </textarea>
                     </div> </div>
          <div class="text-center w-100">
          <button type="submit" class="btn btn-primary btn-sm hover-transform px-5 box-shadow rounded mx-auto   mt-3   wow fadeInDown" data-wow-delay="0.2s" href="">المزيد </button>
          
          </div></div>
        </form>
      </div>
    </div>
  </div>
</section>

<div class="googleRate container text-center w-100">
<img src="{{ asset('web/assets/images/rate.png') }}" alt="">
</div>


@endsection
