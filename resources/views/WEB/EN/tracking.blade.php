
    @extends('layouts.include_en')

@section('title')
Tracking Order
@endsection



@section('url')
  /tracking
@endsection

@section('white')
bg-white

  @endsection
@section('content')

       <div class="container">
  
            <h2 class="  text-center mt-5 orange"> Tracking Order </h2>

            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <form action="{{route('en.tracking')}}" class="mt-4    wow fadeInDown   " data-wow-delay="0.2s"  method="POST">{{csrf_field()}}
                        <div class="form-group mb-4"> 
                          <label for="">Tracking Number</label>
                          <input class="form-control" name="tracking_number"  type="text" placeholder="Tracking Number"/>
                        </div>
                  
                        <div class="form-group mb-4"> 
 <label for="">Email </label>
                          <input class="form-control" name="email" type="email" placeholder="Email "/>
                        </div>
                
                     
                        <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-sm hover-transform rounded w-100   mt-2   wow fadeInDown" data-wow-delay="0.2s" href="">Tracking </button>
                        
                        </div>
                      </form>
                </div>
            </div>
       </div>
         

@endsection
