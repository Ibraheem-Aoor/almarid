@extends('layouts.include_ar')

@section('title')
طريقة الشراء
@endsection



@section('url')
  /en/learn
@endsection


@section('white')
bg-white

  @endsection
@section('content')



<div class="container">
           
           <h2 class="orange text-center mt-5 under__line">طريقة الشراء</h2>

           <div class="faqCon mt-5">
       
            
                   <div class="row">
                       <div class="col-lg-10 mx-auto">
                           <div class="accordion" id="accordionExample">
                             <?php $i=0;?>
                             @foreach($learns as $learn)
                               <div class="card mb-3">
                                 <div class="card-header" id="heading{{$learn->id}}">
                                   <h2 class="mb-0">
                                     <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$learn->id}}" aria-expanded="true" aria-controls="collapse{{$learn->id}}">
                                      {{$learn->name}}
                                     </button>
                                   </h2>
                                 </div>
                             
                                 <div id="collapse{{$learn->id}}" class="collapse @if($i==0) show @endif" aria-labelledby="heading{{$learn->id}}" data-parent="#accordionExample">
                                   <div class="card-body">
                                   {!!$learn->text!!}
                                   @if($learn->file_type == 'YOUTUBE' && !is_null($learn->file))
                                   <div class="video mt-2">
                  
                  <a  href="{{$learn->file}}" data-rel="lightcase:myCollection" class="d-flex align-items-center justify-content-start play-video">
                  <img src="./assets/images/video.png" class="mr-3 pb-1" alt="">
                  شاهد الفيديو
                 </a>
                </div>
                @endif
                @if($learn->file_type == 'IMAGE' && !is_null($learn->file))
                                   <div class="video mt-2">
                  
                  <a  href="{{asset('/uploads/guides/'.$learn->file)}}" data-rel="lightcase:myCollection" class="d-flex align-items-center justify-content-start play-video">
                  <img src="./assets/images/video.png" class="mr-3 pb-1" alt="">
                  شاهد الصورة
                 </a>
                </div>
                @endif
                @if($learn->file_type == 'VIDEO' && !is_null($learn->file))
                                   <div class="video mt-2">
                  
                  <a  href="{{asset('/uploads/guides/'.$learn->file)}}" data-rel="lightcase:myCollection" class="d-flex align-items-center justify-content-start play-video">
                  <img src="./assets/images/video.png" class="mr-3 pb-1" alt="">
                  شاهد الفيديو
                 </a>
                </div>
                @endif
                                     </div>

                                 </div>
                               </div>
                             <?php $i=1;?>
                               @endforeach
                             </div>
                       </div>
              
               </div>
               </div>
      </div>
        


@endsection
