@extends('layouts.include_ar')

@section('title')
تواصل معنا
@endsection


@section('url')
  /en/contact
@endsection

@section('white')
bg-white

  @endsection
@section('content')

       <div class="container">
           
           <h2 class="orange text-center mt-5 under__line">تواصل معنا</h2>

           <section class="contact" id="contact">
           
                 <div class="row">
                   <div class="col-lg-7   mb-lg-0">
                     <h2>اين تجـدنا</h2>
                     @foreach($addresses as $address)
                     <h3>{{$address->branch}} فرع</h3>
                     <div class="mapCon mt-4    wow fadeInRight    " data-wow-delay="0.2s">
                       <iframe class="rounded-max" src="https://maps.google.com/maps?q={{$address->lat}},{{$address->lng}}&hl=es;z=20&amp;output=embed" width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                     </div>
                      @endforeach
                   </div>
                   <div class="col-lg-5 mt-4 mt-lg-0">
                     <h2>تواصل معنـا</h2>
                     <form action="{{route('contact')}}" class="mt-4    wow fadeInDown   " data-wow-delay="0.2s"  method="POST">{{csrf_field()}}
                      <div class="form-group mb-4"> 
                         
                         <input class="form-control" type="text" required name="name"  placeholder="الاسم"/>
                       </div>
                       <div class="form-group mb-4"> 
                         
                           <input class="form-control" type="text"  required name="phonenumber" placeholder="رقم الجوال"/>
                         </div>
                       <div class="form-group mb-4"> 

                         <input class="form-control" type="text"   required name="email" placeholder="بريدك الالكتروني"/>
                       </div>
               
                       <div class="form-group mb-4" > 
                          
                         <textarea class="form-control" rows="4"  required  name="message"   placeholder="رسالتك"> </textarea>
                       </div>
                       <div class="text-right">
                       <button type="submit" class="btn btn-primary btn-sm hover-transform rounded w-100   mt-2   wow fadeInDown" data-wow-delay="0.2s" href="">ارسال </button>
                       
                       </div>
                     </form>
                   </div>
               
               </div>
             </section>
      </div>
        
@endsection


