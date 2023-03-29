@extends('layouts.include_ar')

@section('title')
الأسئلة الشائعة
@endsection



@section('url')
  /en/common-questions
@endsection


@section('white')
bg-white

  @endsection
@section('content')



<div class="container">
           
           <h2 class="orange text-center mt-5 under__line">الأسئلة الشائعة</h2>

           <div class="faqCon mt-5">
       
            
                   <div class="row">
                       <div class="col-lg-10 mx-auto">
                           <div class="accordion" id="accordionExample">
                             <?php $i=0;?>
                             @foreach($questions as $question)
                               <div class="card mb-3">
                                 <div class="card-header" id="heading{{$question->id}}">
                                   <h2 class="mb-0">
                                     <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$question->id}}" aria-expanded="true" aria-controls="collapse{{$question->id}}">
                                      {{$question->question}}
                                     </button>
                                   </h2>
                                 </div>
                             
                                 <div id="collapse{{$question->id}}" class="collapse @if($i==0) show @endif" aria-labelledby="heading{{$question->id}}" data-parent="#accordionExample">
                                   <div class="card-body">
                                   {!!$question->answer!!}
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
