
    @extends('layouts.include_ar')

@section('title')
تتبع الطلب
@endsection



@section('url')
  /en/status/2
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

                    <li class="fllow-step"> <span>3</span>  </li>
                </ul>
            </div>
            <h3 class="text-main text-center mt-5">حـالة الطلب</h3>

            <div class="row mt-5" >
                <div class="col-lg-10 mx-auto">
                    <div class="status_cont  bg-white rounded-max px-4 py-5">
                    <div class="img-status text-center">
                        <img src="{{ asset('/web/assets/images/undraw_in_progress_ql66.svg')}}" class="img-fluid" alt="">
                        <h3 class="mt-4">طلبك الآن في المرحلة الثانية لدى خدمات الزبائن</h3>
                    </div>
                </div>
                <div class="contact-quic text-center mt-4">
                    <a  href="/contact">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="120" viewBox="0 0 120 120">
                            <defs>
                              <filter id="Ellipse_2005" x="0" y="0" width="120" height="120" filterUnits="userSpaceOnUse">
                                <feOffset dy="10" input="SourceAlpha"/>
                                <feGaussianBlur stdDeviation="10" result="blur"/>
                                <feFlood flood-color="#0a53a4" flood-opacity="0.251"/>
                                <feComposite operator="in" in2="blur"/>
                                <feComposite in="SourceGraphic"/>
                              </filter>
                            </defs>
                            <g id="Group_10170" data-name="Group 10170" transform="translate(-665 -724)">
                              <g transform="matrix(1, 0, 0, 1, 665, 724)" filter="url(#Ellipse_2005)">
                                <g id="Ellipse_2005-2" data-name="Ellipse 2005" transform="translate(30 20)" fill="#0a53a4" stroke="#0a53a4" stroke-width="1">
                                  <circle cx="30" cy="30" r="30" stroke="none"/>
                                  <circle cx="30" cy="30" r="29.5" fill="none"/>
                                </g>
                              </g>
                              <path id="Icon_awesome-phone" data-name="Icon awesome-phone" d="M19.2.957,15.154.023a.94.94,0,0,0-1.07.541L12.215,4.923a.932.932,0,0,0,.269,1.09l2.358,1.93a14.423,14.423,0,0,1-6.9,6.9L6.016,12.48a.933.933,0,0,0-1.09-.269L.568,14.079a.945.945,0,0,0-.545,1.074L.957,19.2a.934.934,0,0,0,.911.724A18.055,18.055,0,0,0,19.925,1.868.933.933,0,0,0,19.2.957Z" transform="translate(715.038 764.038)" fill="#fff"/>
                            </g>
                          </svg>
                          
                    </a>
                    <a  target="_blank" href="https://wa.me/{{$settings->where('key','whatsapp')->first()->value}}"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="120" viewBox="0 0 120 120">
                        <defs>
                          <filter id="Ellipse_2006" x="0" y="0" width="120" height="120" filterUnits="userSpaceOnUse">
                            <feOffset dy="10" input="SourceAlpha"/>
                            <feGaussianBlur stdDeviation="10" result="blur"/>
                            <feFlood flood-color="#3acc6c" flood-opacity="0.251"/>
                            <feComposite operator="in" in2="blur"/>
                            <feComposite in="SourceGraphic"/>
                          </filter>
                        </defs>
                        <g id="Group_10171" data-name="Group 10171" transform="translate(-581 -724)">
                          <g transform="matrix(1, 0, 0, 1, 581, 724)" filter="url(#Ellipse_2006)">
                            <circle id="Ellipse_2006-2" data-name="Ellipse 2006" cx="30" cy="30" r="30" transform="translate(30 20)" fill="#3acc6c"/>
                          </g>
                          <g id="Group_9959" data-name="Group 9959" transform="translate(628.378 761.275)">
                            <path id="Path_1886" data-name="Path 1886" d="M13.7.015A12.627,12.627,0,0,0,3.064,18.355l-1.34,6.5a.491.491,0,0,0,.594.577l6.374-1.51A12.623,12.623,0,1,0,13.7.015Zm7.606,19.6A9.89,9.89,0,0,1,9.914,21.475l-.888-.442-3.908.926.823-3.993L5.5,17.109A9.892,9.892,0,0,1,7.324,5.634,9.883,9.883,0,1,1,21.3,19.611Z" transform="translate(-1.69 0)" fill="#fff"/>
                            <path id="Path_1887" data-name="Path 1887" d="M117.066,116.239l-2.445-.7a.911.911,0,0,0-.9.238l-.6.609a.891.891,0,0,1-.968.2,13.052,13.052,0,0,1-4.211-3.713.891.891,0,0,1,.07-.987l.522-.675a.911.911,0,0,0,.112-.926l-1.029-2.326a.912.912,0,0,0-1.424-.326,4.112,4.112,0,0,0-1.59,2.426c-.174,1.713.561,3.872,3.339,6.465,3.209,3,5.78,3.391,7.453,2.986a4.112,4.112,0,0,0,2.186-1.906A.912.912,0,0,0,117.066,116.239Z" transform="translate(-98.318 -100.879)" fill="#fff"/>
                          </g>
                        </g>
                      </svg>
                      </a>
                </div>
            </div>
            </div>
       </div>
         

@endsection
