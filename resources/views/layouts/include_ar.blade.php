<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>  @yield('title')</title>
    <meta property="og:type" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=" "/>
    <meta property="og:image" content=""/>
    <meta property="og:image:width" content=""/>
    <meta property="og:image:height" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=" "/>
    <meta property="og:ttl" content=""/>
    <meta name="twitter:card" content=""/>
    <meta name="twitter:domain" content=""/>
    <meta name="twitter:site" content=""/>
    <meta name="twitter:creator" content=""/>
    <meta name="twitter:image:src" content=""/>
    <meta name="twitter:description" content=""/>
    <meta name="twitter:title" content=" "/>
    <meta name="twitter:url" content=""/>
    <meta name="description" content="  "/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
    <meta name="copyright" content=" "/>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/animate.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/swiper.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/ion.rangeSlider.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/jquery.fancybox.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/lightcase.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/owl.theme.default.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/bootstrap.rtl.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/bootstrap-select.css')}}"/>
      <link rel="stylesheet" href="{{ asset('web/assets/css/ion.rangeSlider.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css?v=0.001')}}"/>
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
  </head>
  <body><!-- begin:: Page -->
    <div class="main-wrapper">
      <div class="loader-page"><span></span><span></span></div>
      <div class="mobile-menu-overlay"></div><!-- begin:: top-header -->

      @yield('section')
      <header class="main-header transition @yield('white')">
        <div class="container-fluid px-sm-5">
          <div class="d-flex align-items-center">
            <div class="logo"><a href="/"><img src="{{ asset('uploads/settings/'.$settings->where('key','app_logo')->first()->value) }}" class=" wow fadeInRight" data-wow-delay="0.3s" alt=""/></a></div>
            <div class="menu--mobile mx-lg-auto">
              <div class="menu-container d-lg-none ">
                <div class="btn-close-header-mobile justify-content-end"><i class="fas fa-times"></i></div>
              </div>
              <div class="menu-container w-100">
                <ul class="main-menu list-main-menu d-lg-flex justify-content-start ml-xl-5" >
                  <li class="menu_item"><a class="menu_link active"    href="/about-us" data-scroll="about-us">عن الشركة</a></li>

                  <li class="menu_item"><a class="menu_link"   href="/cars" data-scroll="goal">المركبات</a></li>
                  <li class="menu_item"><a class="menu_link"    href="/kamaliat"  data-scroll="serv">الكماليات</a></li>
                  <li class="menu_item"><a class="menu_link"   href="/export"  data-scroll="why">التصدير </a></li>
                  <li class="menu_item"><a class="menu_link"    href="/evaluations"  data-scroll="partners">التقييمات</a></li>
                  <li class="menu_item"><a class="menu_link"    href="/learn"  data-scroll="partners">طريقة الشراء</a></li>
                  <li class="menu_item"><a class="menu_link"   href="/contact"  data-scroll="partners">تواصل معنا</a></li>
                   <li class="menu_item"><a class="menu_link d-md-none"   href="/tracking"  data-scroll="partners">تتبع طلبك</a></li>
                </ul>
              </div>
            </div>
            <div class="menu-container">
              <ul class="main-menu d-flex align-items-center">
                <li class="menu_item downlaod-app"><a class="btn btn-primary btn-sm  wow fadeInLeft scrollTo rounded px-3 "  data-wow-delay="0.3s"  target="_blank" href="{{$settings->where('key','google_play')->first()->value}}" data-scroll="contact"> <i class="fab fa-google-play pr-2"></i> حمل التطبيق</a></li

                          <li class="menu_item"><a class="btn btn-primary d-md-block d-none mx-2 btn-sm  wow fadeInLeft scrollTo rounded px-3 bg-tomato"  href="/tracking"> <i class="fab fa-searchengin pr-2"></i></i>تتبع طلبك</a></li>

                <li class="menu_item"><a class="btn btn-primary px-3 ml-2   btn-sm rounded   wow fadeInLeft scrollTo" data-wow-delay="0.3s" href="@yield('url')"   data-scroll="contact"> <img src="{{ asset('web/assets/images/usa.png') }}" alt=""> </a></li>

              </ul>
            </div>
            <div class="header-mobile__toolbar ml-3 d-lg-none fa-lg"><i class="fa fa-bars"></i></div>
          </div>
        </div>
      </header><!-- end:: Header -->


      @yield('content')








      <footer >
   <div class="container">
   <div class="row">

 <div class="col-lg-3">
   <div class="single-footer">
     <h3  class="mb-3">روابط سريعة</h3>
     <ul class="list-unstyled">
      <li><a href="/"><i class="fas fa-chevron-left pr-2"></i>الرئيسية</a> </li>
      <li><a href="/about-us" ><i class="fas fa-chevron-left pr-2"></i>عن الشركة</a> </li>
      <li><a href="/contact" ><i class="fas fa-chevron-left pr-2"></i>اتصل بنا</a> </li>
      <li><a href="/condition" ><i class="fas fa-chevron-left pr-2"></i> الشروط والأحكام</a> </li>
      <li><a href="/privacyPolicy.php" ><i class="fas fa-chevron-left pr-2"></i> سياسة الخصوصية</a> </li>
    </ul>

   </div>
 </div>
 <div class="col-lg-3">
   <div class="single-footer">
     <h3 class="mb-3">الفئـات</h3>
     <ul class="list-unstyled">
      <li><a href="/offers" ><i class="fas fa-chevron-left pr-2"></i>أخر العروض</a> </li>
      <li><a href="/cars"><i class="fas fa-chevron-left pr-2"></i>أحدث السيارات</a> </li>
      <li><a href="/common-questions" ><i class="fas fa-chevron-left pr-2"></i>الأسئلة الشائعة</a> </li>
    </ul>
   </div>
 </div>
  @foreach($addresses as $address)
<div class="col-lg-2">
  <div class="single-footer">
    <h3 class="mb-3">فرع  {{$address->branch}}</h3>
    <ul class="list-unstyled">
      <li><a href="#"><i class="fas fa-phone pr-2"></i>{{$address->fax}}</a> </li>
      <li><a href="#"><i class="fal fa-headset pr-2"></i>  {{$address->phonenumber}}</a></li>
      <li><a    target="_blank" href="{{$address->map}}"><i class="fal fa-map-marker-check pr-2"></i>{{$address->address}}</a> </li>
    </ul>
  </div>
</div>
 @endforeach
     </div>
   </div>
   <hr class="white-border">
   <div class="lastFooter py-3  container-fluid px-5 d-flex align-items-center justify-content-between ">
     <div class="socialFooter ">
      <ul class="list-unstyled d-flex align-items-center   flex-wrap">
        <li class="mr-4   wow fadeInDown" data-wow-delay="0.2s">
          <a  href="{{$settings->where('key','facebook')->first()->value}}"   target="_blank"> <i class="fab fa-facebook-f"></i> </a>
        </li>
        <li class="mr-4   wow fadeInDown" data-wow-delay="0.3s">
          <a href="{{$settings->where('key','twitter')->first()->value}}"   target="_blank"> <i class="fab fa-twitter"></i> </a>
        </li>
        <li class="mr-4   wow fadeInDown" data-wow-delay="0.4s">
          <a href="{{$settings->where('key','instagram')->first()->value}}"   target="_blank"> <i class="fab fa-instagram"></i> </a>
        </li>
      </ul>
      </div>


   </div>
 </footer>



 <div class="page-tolpar"> <a  target="_blank" href="https://wa.me/{{$settings->where('key','whatsapp')->first()->value}}">
  <svg id="whatsapp_3_" data-name="whatsapp(3)" xmlns="http://www.w3.org/2000/svg" width="39.99" height="39.99" viewBox="0 0 39.99 39.99">
    <path id="Path_29" data-name="Path 29" d="M20,0h-.01A19.982,19.982,0,0,0,3.807,31.714L1.315,39.142,9,36.686A19.991,19.991,0,1,0,20,0Z" fill="#4caf50"></path>
    <path id="Path_30" data-name="Path 30" d="M130.521,136.178c-.482,1.362-2.4,2.492-3.924,2.822-1.045.222-2.409.4-7-1.5-5.876-2.434-9.66-8.405-9.955-8.793s-2.374-3.162-2.374-6.031a6.383,6.383,0,0,1,2.044-4.866,2.905,2.905,0,0,1,2.044-.717c.247,0,.47.012.67.022.587.025.882.06,1.27.987.482,1.162,1.657,4.031,1.8,4.326a1.19,1.19,0,0,1,.085,1.082,3.455,3.455,0,0,1-.647.917c-.295.34-.575.6-.87.965-.27.317-.575.657-.235,1.245a17.747,17.747,0,0,0,3.244,4.031,14.7,14.7,0,0,0,4.689,2.892,1.264,1.264,0,0,0,1.41-.222,24.2,24.2,0,0,0,1.562-2.069,1.116,1.116,0,0,1,1.435-.435c.54.187,3.4,1.6,3.984,1.892s.975.435,1.117.682A4.98,4.98,0,0,1,130.521,136.178Z" transform="translate(-98.886 -107.943)" fill="#fafafa"></path>
  </svg></a></div>

    </div><!-- end:: Page -->



     <script src="{{ asset('web/assets/js/jquery.min.js') }}"></script>
     <script src="{{ asset('web/assets/js/bootstrap.bundle.min.js') }}"></script>
     <script src="{{ asset('web/assets/js/wow.min.js') }}"></script>
     <script src="{{ asset('web/assets/js/ion.rangeSlider.min.js') }}"></script>
     <script src="{{ asset('web/assets/js/lightcase.min.js') }}"></script>
     <script src="{{ asset('web/assets/js/owl.carousel.min.js') }}"></script>
     <script src="{{ asset('web/assets/js/owl-Function.js') }}"></script>
       <script src="{{ asset('web/assets/js/jquery.fancybox.min.js') }}"></script>

     <script src="{{ asset('web/assets/js/bootstrap-select.js') }}"></script>
     <script src="{{ asset('web/assets/js/ticker.js') }}"> </script>
     <script src="{{ asset('web/assets/js/ion.rangeSlider.min.js') }}"> </script>
     <script src="{{ asset('web/assets/js/function.js') }}"></script>
     <script src="{{asset('js/toastr.min.js')}}"></script>
     <script>
     @if(Session::has('success'))

     toastr.success("{{Session::get('success')}}");

     @endif

     @if(Session::has('info'))

     toastr.info("{{Session::get('info')}}");

     @endif
     @if(Session::has('error'))

     toastr.error("{{Session::get('error')}}");

     @endif
</script>

<script>
function printDivPrivacy(divID) {
    //Get the HTML of div

    var divElements = document.getElementById(divID).innerHTML;

    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;

    //Reset the pages HTML with divs HTML only

    document.body.innerHTML =

        "<html><head><title></title></head><body>" +
        divElements + "</body>";



    //Print Page
    window.print();

    //Restore orignal HTML
    window.location = "/privacyPolicy";

}

function printDivCondition(divID) {
    //Get the HTML of div

    var divElements = document.getElementById(divID).innerHTML;

    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;

    //Reset the pages HTML with divs HTML only

    document.body.innerHTML =

        "<html><head><title></title></head><body>" +
        divElements + "</body>";



    //Print Page
    window.print();

    //Restore orignal HTML
    window.location = "/condition";

}
</script>
     @yield('script')


   </body>
 </html>
