
    @extends('layouts.include_ar')

@section('title')
تتبع الطلب
@endsection



@section('url')
  /en/tracking
@endsection

@section('white')
bg-white

  @endsection
@section('content')

       <div class="container">
  
            <h2 class="  text-center mt-5 orange"> تتبع طلبك</h2>

            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <form action="{{route('tracking')}}" class="mt-4    wow fadeInDown   " data-wow-delay="0.2s"  method="POST">{{csrf_field()}}
                        <div class="form-group mb-4"> 
                          <label for="">رقم التتبع</label>
                          <input class="form-control" name="tracking_number"  type="text" placeholder="رقم التتبع"/>
                        </div>
                  
                        <div class="form-group mb-4"> 
 <label for="">بريدك الالكتروني</label>
                          <input class="form-control" name="email" type="email" placeholder="بريدك الالكتروني"/>
                        </div>
                
                     
                        <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-sm hover-transform rounded w-100   mt-2   wow fadeInDown" data-wow-delay="0.2s" href="">تتبع طلبك </button>
                        
                        </div>
                      </form>
                </div>
            </div>
       </div>
         

@endsection
