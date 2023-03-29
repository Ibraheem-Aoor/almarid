@extends('layouts.include_en')

@section('title')
Contact Us
@endsection


@section('url')
  /contact
@endsection

@section('white')
bg-white

  @endsection
@section('content')

       <div class="container">
           
           <h2 class="orange text-center mt-5 under__line">Contact Us</h2>

           <section class="contact" id="contact">
           
                 <div class="row">
                   <div class="col-lg-7   mb-lg-0">
                     <h2>اين تجـدنا</h2>
                     @foreach($addresses as $address)
                     <h3>{{$address->branch_en}} Branch</h3>
                     <div class="mapCon mt-4    wow fadeInRight    " data-wow-delay="0.2s">
                       <iframe class="rounded-max" src="https://maps.google.com/maps?q={{$address->lat}},{{$address->lng}}&hl=es;z=20&amp;output=embed" width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                     </div>
                      @endforeach
                   </div>
                   <div class="col-lg-5 mt-4 mt-lg-0">
                     <h2>Contact Us</h2>
                     <form action="{{route('en.contact')}}" class="mt-4    wow fadeInDown   " data-wow-delay="0.2s"  method="POST">{{csrf_field()}}
                      <div class="form-group mb-4"> 
                         
                         <input class="form-control" type="text" required name="name"  placeholder="Name"/>
                       </div>
                       <div class="form-group mb-4"> 
                         
                           <input class="form-control" type="text"  required name="phonenumber" placeholder="Phone Number "/>
                         </div>
                       <div class="form-group mb-4"> 

                         <input class="form-control" type="text"   required name="email" placeholder="Email"/>
                       </div>
               
                       <div class="form-group mb-4" > 
                          
                         <textarea class="form-control" rows="4"  required  name="message"   placeholder="Message"> </textarea>
                       </div>
                       <div class="text-right">
                       <button type="submit" class="btn btn-primary btn-sm hover-transform rounded w-100   mt-2   wow fadeInDown" data-wow-delay="0.2s" href="">Send </button>
                       
                       </div>
                     </form>
                   </div>
               
               </div>
             </section>
      </div>
        
@endsection


