@extends('layouts.include_en')

@section('title')
Ratings
@endsection


@section('url')
  /evaluations
@endsection

@section('white')
bg-white

  @endsection
@section('content')
<div class="container my-4">
            <div class="top-navLinks d-flex align-items-center justify-content-between flex-wrap ">
              <div class="nav-Links mb-3 mb-md-0">
            <a href="/en/">
                <i class="fad fa-home-alt mr-2"></i>
                Home</a>

                <i class="fas fa-long-arrow-left mx-3"></i>

                <a href="/en/evaluations"  >
                
                Ratings</a>
            </div>
            <div class="add-opinion">
              <button class="btn px-5 rounded bg-main text-white pt-2 pb-1" data-toggle="modal" data-target="#testimonialsModal"> <i class="fas fa-heart mr-2"></i> Add your Opinion</button>
            </div>
          </div>
        
        <div class="testimonialPage__cont mt-5">
          <div class="row">
            @foreach($evaluations as $evaluation)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="single-testi  ">
                <div class="top-head-testi d-flex align-items-center justify-content-start">
                  <div class="name-rate">
                    <h4>{{$evaluation->name}}</h4>
                    <span class="stars px-2 py-2" data-rating="4">
                      {{$evaluation->country->name_en}}
                  </span>
                  </div>
                </div>
                <hr>
                <p>{{$evaluation->message}}</p>
                @if(!is_null($evaluation->file))
                <div class="video ">
                  
                  <a  href="{{asset('/uploads/evaluations/'.$evaluation->file)}}" data-rel="lightcase:myCollection" class="d-flex align-items-center justify-content-start play-video">
                  <img src="{{asset('/web/assets/images/video.png')}}" class="mr-3" alt="">
                  View 
                 </a>
                </div>
                @endif
              </div>
            </div>
          @endforeach
          </div>
        </div>
        
        
        </div>

<!-- Button trigger modal -->
 

<!-- Modal -->
 
  <!-- Modal -->
  <div class="modal fade modal-filter" id="testimonialsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add your Opinion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <form action="{{route('evaluation')}}" data-wow-delay="0.2s"  method="POST"  enctype="multipart/form-data">{{csrf_field()}}
              <div class="modal-body">         

<div class="row">
    <div class="col-lg-6 mb-3">
      <div class="form-group"> 
   
        <input class="form-control" type="text" name="name" required placeholder="Full Name"/>
      </div>
    </div>
      <div class="col-lg-6  mb-3 ">
        <div class="single-filter">
          <select
          class="selectpicker" name="country_id" required title="Choose Country">
@foreach($countries as $country)
          <option value="{{$country->id}}">{{$country->name_en}}</option>
          @endforeach
      </select>
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group"> 
   
        <input class="form-control" type="text" name="phonenumber" required placeholder="Phone Number"/>
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group"> 
   
        <input class="form-control" type="email" name="email" required placeholder="Email"/>
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="picture-container d-flex">
        <div class="img-plus d-flex flex-wrap">
            <div class="container-plus"><label class="fas fa-plus" for="input-plus"> <span>Add Photo or Video</span> </label><input class="input-add" type="file" id="input-plus" name="image"></div>
        </div>
    </div>
    </div>
      <div class="col-12 mb-2">
        <div class="form-group"> 
   
          <textarea class="form-control" name="message" required id="exampleFormControlTextarea1" rows="3"  ></textarea>
        </div>
      </div>
      
</div>
                
                
            
            
        </div>
        <div class="modal-footer ">
           <button type="submit" class="btn btn-primary w-100 rounded py-2">Add</button>
        </div>
      </form>
      </div>
    </div>
  </div>
        

@endsection
