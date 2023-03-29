@extends('layouts.include_en')

@section('title')
الحجز
@endsection


@section('white')
bg-white
@endsection

@section('content')

<div class="container">
            <div class="user-fllow mt-5">
                <ul class="list-unstyled d-flex align-items-center justify-content-center flex-wrap ">
                    <li class="fllow-step"> <span class="complite">1</span>  </li>

                    <li class="fllow-step">  <span class="complite">2</span>  </li>

                    <li class="fllow-step"> <span class="complite">3</span>  </li>
                </ul>
            </div>
            <h3 class="text-main text-center mt-5">بيانات الدفع</h3>

            <div class="row mt-5" >
                <div class="col-lg-10 mx-auto">
                    <form action="">
                    <div class="user-details_cont bg-white rounded-max px-4 py-4 ">
                       
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="total__price d-flex align-items-center justify-content-between">
                                    <img src="./assets/images/Visa_Inc._logo.svg.png" class="img-fluid" alt="">
                                    <span>$1500</span>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                
                                <input class="form-control" type="text" placeholder="اسم صاحب البطاقة"/>
                            </div>

                            <div class="col-lg-6 mb-3">
                                 
                                <input class="form-control" type="email" placeholder="رقم البطاقة"/>
                            </div>

                            <div class="col-lg-3 mb-3 mb-lg-0">
                               
                                <input class="form-control" type="text" placeholder="تاريخ الانتهاء "/>
                            </div>

                            <div class="col-lg-3 mb-3 mb-lg-0">
                                
                                <input class="form-control" type="text" placeholder="CVV"/>
                            </div>
                            
                        </div>
                   
                    </div>
                    <div class="btn-submit mt-4 text-center">
                        <button class="btn px-5 bg-orange text-white pt-3 pb-2"  > ادفع الان  <span>$1500</span> </button>
                    </div>
                </form>
                </div>
            </div>
       </div>
         

@endsection
