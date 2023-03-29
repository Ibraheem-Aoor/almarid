@extends('layouts.include_ar')

@section('title')
الشروط والأحكام
@endsection


@section('url')
  /en/condition
@endsection

@section('white')
bg-white

  @endsection
@section('content')

<div class="container">
           
           <h2 class="orange text-center mt-5 under__line">الشروط والأحكام</h2>

           <div class="termsPAge">
              
                   <div class="termshead d-flex align-items-center justify-content-between no-border">
                       <h3>الشروط والأحكام
                       </h3>
                       <button class="print " onclick="javascript:printDivCondition('printd')"><a href="#"> <i class="fal fa-print mr-2"></i>طباعة
                           </a></button>
                   </div>
                   <div class="row"   id="printd">
                     
                       <div class="col-12  ">
                           <div class="termsContSections">
                               <div class="termsText pt-0">
                              
   
                                   <p>{!!$condition->text!!}</p>
                               </div>
                         
                         
                           </div>
                       </div>
                   </div>
   
   
                
           </div>
      </div>
        

@endsection
