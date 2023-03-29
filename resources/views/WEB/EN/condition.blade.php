@extends('layouts.include_en')

@section('title')
Tearms and Conditions
@endsection


@section('url')
  /condition
@endsection

@section('white')
bg-white

  @endsection
@section('content')

<div class="container">
           
           <h2 class="orange text-center mt-5 under__line">Tearms and Conditions</h2>

           <div class="termsPAge">
              
                   <div class="termshead d-flex align-items-center justify-content-between no-border">
                       <h3>Tearms and Conditions
                       </h3>
                       <button class="print " onclick="javascript:printDivCondition('printd')"><a href="#"> <i class="fal fa-print mr-2"></i>Print
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
