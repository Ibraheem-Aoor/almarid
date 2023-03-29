@extends('layouts.include_ar')

@section('title')
عن الشركة
@endsection


@section('url')
  /en/about-us
@endsection


@section('white')
bg-white

  @endsection
@section('content')

<div class="container my-4">
            <div class="top-navLinks d-flex align-items-center justify-content-between flex-wrap ">
              <div class="nav-Links mb-3 mb-md-0">
            <a href="/">
                <i class="fad fa-home-alt mr-2"></i>
                الرئيسية</a>

                <i class="fas fa-long-arrow-left mx-3"></i>

                <a href="/about-us" class="active" >
                
                عن الشركة</a>
              
            </div>
            
          </div>
          
      <div class="about-company mt-5 ">
          <div class="row">
              <div class="col-12">
                <h2 class="text-main mb-3">  عن الشركة</h2>
                <p>
            {{$settings->where('key','about')->first()->value}}
                  
                  </p>
              </div>
            </div>
          <hr>
            <div class="row align-items-center mt-5">
                <div class="col-lg-8">    
                    <h2 class="text-main mb-3">  رؤيتنا</h2>
           <p>
            {{$settings->where('key','vision')->first()->value}}
 
         </p>
       </div>
       <div class="col-lg-4 text-right">
           <img src="{{asset('web/assets/images/focus.png')}}" alt="">
       </div>

            </div>
            <hr>
 <div class="row align-items-center mt-5">
        <div class="col-lg-8">
            <h2 class="text-main mb-3">  رسالتنا</h2>
            <p>
            {{$settings->where('key','message')->first()->value}}
            </p>
        </div>

        <div class="col-lg-4 text-right">
            <img src="{{asset('web/assets/images/message.png')}}" alt="">
        </div>
    </div>
<hr>
        <div class="row align-items-center mt-5">
        <div class="col-lg-8">
           
            <h2 class="text-main mb-3">  خدماتنا</h2>
            <p>
            {{$settings->where('key','service')->first()->value}}
            
            
            </p>                   
        </div>

        <div class="col-lg-4 text-right">
            <img src="{{asset('web/assets/images/customer-support.png')}}" alt="">
        </div>
    </div>
     
     
    </div>

        </div>

 
        
        <section class="partners mb-0" id="partners">
            <div class="container   mt-2">
           
              <div class="js-ticker" id="gallery">
               
  @foreach($brands as $brand)
      <div class="widget__item-2 wow fadeInDown slide js-ticker-item" data-wow-delay="0.2s">
        <div class="widget__item-image">
          <a href="/cars/search?brand_id={{$brand->id}}"><img src="{{asset('/uploads/brands/'.$brand->image)}}" alt=""/></a></div>
      </div>
      @endforeach
              </div>
            </div>
          </section>
 

@endsection
