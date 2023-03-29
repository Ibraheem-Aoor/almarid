@extends('backend.layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/styles/contact.css') }}">
    <style type="text/css" media="screen">
        .inner-home{
            height:280px;
        }
        input,select{
            margin-top: 15px;
        }
        footer input{
            margin-top: 0px;
        }  
        .fillter_ads button{
            margin-top: 15px !important;
        }
        .form_submit_button{
            margin-top: 10px  !important;
            margin-bottom: 20px;
        }
    </style>
@endsection
@section('js')
    <script>
    $(document).ready(function() {
        $('body').on('change', '#province_id' ,function() {
            $('#city_id option').hide();
            $('#city_id option.province_'+this.value).show();            
            $('#city_id option.province_'+this.value+':first').prop("selected", "selected");            
        });
    });
    </script>
@endsection


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                الرئيسية
                <small>لوحة التحكم</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">لوحة التحكم</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">



            <!-- Small boxes (Stat box) -->
            <div class="row">

            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
            <div class="inner">
            <h3>{{ $data['cars'] }}</h3>

            <p>عدد السيارات</p>
            </div>
            <div class="icon">
            <i class="fa fa-car"></i>
            </div>
            <a class="small-box-footer"></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
            <div class="inner">
            <h3>{{ $data['orders'] }}</h3>
            <p>عدد الطلبات</p>
            </div>
            <div class="icon">
            <i class="fa fa-opencart"></i>
            </div>
            <a class="small-box-footer"></a>

            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
            <div class="inner">
            <h3>{{ $data['brands'] }}</h3>
            <p>عدد العلامات التجارية</p>
            </div>
            <div class="icon">
            <i class="fa fa-star"></i>
            </div>
            <a class="small-box-footer"></a>

            </div>
            </div>



                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                <div class="inner">
                <h3>{{ $data['models'] }}</h3>
                <p>عدد الموديلات</p>
                </div>
                <div class="icon">
                <i class="fa fa-calendar"></i>
                </div>
                <a class="small-box-footer"></a>

                </div>
                </div>


            </div>





            {{--<div class="row">--}}
                {{--<div class="col-lg-12 text-center">--}}
                    {{--<br/>--}}
                    {{--<br/>--}}
                    {{--<br/>--}}
                    {{--<img src="{{ asset('assets/frontend/img/logo.png') }}" class="" alt="{{ config('app.name', 'Laravel') }}" width="300px">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--{!! FORM::open([--}}
                {{--'url'=>url('admin'),--}}
                {{--'class'=>'form-horizontal',--}}
                {{--'files' => false,--}}
                {{--'role'=>'form',--}}
                {{--'id'=>'fillter_ads',--}}
                {{--'method'=>'get'--}}
                {{--]) !!}--}}
            {{--<div class="row">--}}

                {{--<div class="col-lg-3">--}}
                    {{--<select name="org_type_id"  id="org_type_id"  class="form_input"  >--}}
                        {{--<option selected  value="0"> -- نوع الجهة -- </option>--}}
                        {{--option--}}
                        {{--@if(isset($data['org_type']) && !empty($data['org_type']) && count($data['org_type']->toArray())  > 0)--}}
                            {{--@foreach($data['org_type'] as $key => $row)--}}
                                {{--<option @if(isset($_GET['org_type_id']) && intval($_GET['org_type_id']) == $row->id ) selected @endif value="{{ $row->id }}">{{ $row->name_ar }}</option>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3">--}}
                    {{--<select name="type"  id="type"  class="form_input"  >--}}
                        {{--<option selected value="0"> -- نوع الإعلان -- </option>--}}
                        {{--<option @if(isset($_GET['type']) && intval($_GET['type']) == 1 ) selected @endif value="1">فيديو موشن</option>--}}
                        {{--<option @if(isset($_GET['type']) && intval($_GET['type']) == 2 ) selected @endif value="2">فيديو مونتاج</option>--}}
                        {{--<option @if(isset($_GET['type']) && intval($_GET['type']) == 3 ) selected @endif value="3">تصميم انفوجرافيك</option>--}}
                        {{--<option @if(isset($_GET['type']) && intval($_GET['type']) == 4 ) selected @endif value="4">تصميم جرافيك</option>--}}
                        {{--<option @if(isset($_GET['type']) && intval($_GET['type']) == 5 ) selected @endif value="5">سيناريو</option>--}}
                        {{--<option @if(isset($_GET['type']) && intval($_GET['type']) == 6 ) selected @endif value="6">فكرة</option>--}}
                        {{--<option @if(isset($_GET['type']) && intval($_GET['type']) == 7 ) selected @endif value="7">منتج</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3">--}}
                     {{--<select name="province_id"  id="province_id"  class="form_input"  >--}}
                        {{--<option selected value="0"> -- المنطقة -- </option>--}}
                        {{--@if(isset($data['province']) && !empty($data['province']) && count($data['province']->toArray())  > 0)--}}
                            {{--@foreach($data['province'] as $key => $row)--}}
                                {{--<option @if(isset($_GET['province_id']) && intval($_GET['province_id']) == $row->id ) selected @endif value="{{ $row->id }}">{{ $row->name_ar }}</option>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</select>--}}
                {{--</div>--}}
{{----}}
                {{--<div class="col-lg-3">--}}
                    {{--<select name="city_id"  id="city_id"  class="form_input"  >--}}
                        {{--<option selected value="0"> -- المدينة -- </option>--}}
                        {{--@if(isset($data['city']) && !empty($data['city']) && count($data['city']->toArray())  > 0)--}}
                            {{--@foreach($data['city'] as $key => $row)--}}
                                {{--<option @if(isset($_GET['city_id']) && intval($_GET['city_id']) == $row->id ) selected @endif class="province_{{ $row->province_id }}" value="{{ $row->id }}">{{ $row->name_ar }}</option>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</select>--}}
                {{--</div>--}}
{{----}}

                {{--<div class="col-lg-3">--}}
                    {{--<button type="submit" class="form_submit_button">بحث</button>--}}
                {{--</div>--}}

            {{--</div>--}}
            {{--{!! FORM::close() !!}--}}


            {{--<!-- Small boxes (Stat box) -->--}}
            {{--<div class="row">--}}

                {{--<div class="col-lg-3 col-xs-6">--}}
                    {{--<!-- small box -->--}}
                    {{--<div class="small-box bg-aqua">--}}
                        {{--<div class="inner">--}}
                            {{--<h3>{{ $data['ads'] }}</h3>--}}

                            {{--<p>اجمالي الإعلانات</p>--}}
                        {{--</div>--}}
                        {{--<div class="icon">--}}
                            {{--<i class="ion ion-pie-graph"></i>--}}
                        {{--</div>--}}
                        {{--<a class="small-box-footer"></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- ./col -->--}}
                {{--<div class="col-lg-3 col-xs-6">--}}
                    {{--<!-- small box -->--}}
                    {{--<div class="small-box bg-yellow">--}}
                        {{--<div class="inner">--}}
                            {{--<h3>{{ $data['images'] }}</h3>--}}
                            {{--<p>عدد الصور</p>--}}
                        {{--</div>--}}
                        {{--<div class="icon">--}}
                            {{--<i class="ion ion-images"></i>--}}
                        {{--</div>--}}
                        {{--<a class="small-box-footer"></a>--}}

                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- ./col -->--}}
                {{--<div class="col-lg-3 col-xs-6">--}}
                    {{--<!-- small box -->--}}
                    {{--<div class="small-box bg-red">--}}
                        {{--<div class="inner">--}}
                           {{--<h3>{{ $data['videos'] }}</h3>--}}
                            {{--<p>عدد الفيديوهات</p>--}}
                        {{--</div>--}}
                        {{--<div class="icon">--}}
                            {{--<i class="fa fa-video-camera"></i>--}}
                        {{--</div>--}}
                        {{--<a class="small-box-footer"></a>--}}

                    {{--</div>--}}
                {{--</div>--}}



                {{--<!-- ./col -->--}}
                {{--<div class="col-lg-3 col-xs-6">--}}
                    {{--<!-- small box -->--}}
                    {{--<div class="small-box bg-red">--}}
                        {{--<div class="inner">--}}
                           {{--<h3>{{ $data['inactive'] }}</h3>--}}
                            {{--<p>عدد الغير مفعل</p>--}}
                        {{--</div>--}}
                        {{--<div class="icon">--}}
                            {{--<i class="fa fa-thumbs-o-down"></i>--}}
                        {{--</div>--}}
                        {{--<a class="small-box-footer"></a>--}}

                    {{--</div>--}}
                {{--</div>--}}

                 {{--<div class="col-lg-3 col-xs-6">--}}
                    {{--<!-- small box -->--}}
                    {{--<div class="small-box bg-green">--}}
                        {{--<div class="inner">--}}
                            {{--<h3>{{ $data['ads_error'] }}</h3>--}}
                            {{--<p>عدد به مشكلة</p>--}}
                        {{--</div>--}}
                        {{--<div class="icon">--}}
                            {{--<i class="fa fa-times"></i>--}}
                        {{--</div>--}}
                         {{--<a class="small-box-footer">لا يوجد صورة او فيديو مثلا ...</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{----}}
            {{--</div>--}}

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
