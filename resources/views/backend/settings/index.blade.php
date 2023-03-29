@extends('backend.layouts.app')
@section('js')
    <script>
    $(document).ready(function() {
        $('body').on('change', '.mostion' ,function() {        	
        	// alert(this.value);
        	$(".mostion option").show();
        	$(".mostion option[value=" + this.value + "]").hide();
        	$(this).find("option[value=" + this.value + "]").show();
        	$(this).find("option[value=" + this.value + "]").prop("selected", "selected");          
        });
    });
    </script>

    <?php $latitude = 31.406529; if(!empty(Cache::store('file')->get('settings.map_latitude'))) { $latitude = Cache::store('file')->get('settings.map_latitude'); } ?>
    <?php $longitude = 34.2529956; if(!empty(Cache::store('file')->get('settings.map_longitude'))) { $longitude = Cache::store('file')->get('settings.map_longitude'); } ?>
    <?php $zoom = 10; if(!empty(Cache::store('file')->get('settings.map_latitude')) && !empty(Cache::store('file')->get('settings.map_longitude'))) { $zoom = 18; } ?>
    <script>
        function initMap1() {
            var uluru = {lat: <?php echo (double)$latitude; ?>, lng: <?php echo (double)$longitude; ?> };
            var map = new google.maps.Map(document.getElementById('from_map'), {
                zoom: <?php echo intval($zoom); ?>,
                center: uluru
            });
            google.maps.event.addListener(map, 'click', function( event ){
                $('#map_latitude').val(event.latLng.lat());
                $('#map_longitude').val(event.latLng.lng());
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDxpf-cv4oGc2NuaK72f8516se1BRkRt8&callback=initMap1&language=ar">
    </script>
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <span>{{ $data['title'] }}</span>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/'.config('app.prefix','admin')) }}"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">{{ $data['title'] }}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div style="/*padding: 0 15px;*/">
                        <?php if (\Session::has('success')): ?>
                        <div class="alert alert-success">
                            <strong>نجاح !</strong>
                            {{\Session::get('success')}}
                        </div>
                        <?php endif ?>
                        <?php if (count($errors)): ?>
                        <div class="alert alert-danger">
                            <strong>خطأ !</strong>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 15px;">
                    <div class="panel panel-default">
                        <div class="panel-body form_view">

                            {{FORM::open([
                                        'files'=>'true',
                                        'class'=>"formular form-horizontal ls_form",
                                        'role'=>"form",
                                        'method'=>'post',
                                        'url'=>config('app.prefix','admin').'/settings/save'])}}

                            <div class="form-body">

                                @if(isset($data['settings']) && !empty($data['settings']) && count($data['settings']->toArray()) > 0)
                                    @foreach($data['settings'] as $row)
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ $row->name }}</label>
                                            <div class="col-md-9">
                                                @if($row->type == 'image')
                                                    <input type="file" name="{{ $row->key }}"> @if(!empty($row->value)) <img src="{{ asset('uploads/settings/'.$row->value) }}" width="80px" alt=""> @endif
                                                @else
                                                    <input type="text" name="{{ $row->key }}" value="{{ $row->value }}" class="form-control" placeholder="{{ $row->name }}">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif


                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">اليوتيوب</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="youtube" value="{{ Cache::store('file')->get('settings.youtube') }}" class="form-control" placeholder="Youtube">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">تويتر</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="twitter" value="{{Cache::store('file')->get('settings.twitter')}}" class="form-control" placeholder="Twitter">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">انستجرام</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="instagram" value="{{Cache::store('file')->get('settings.instagram')}}" class="form-control" placeholder="Instagram">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">لينكدان</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="linkedin" value="{{Cache::store('file')->get('settings.linkedin')}}" class="form-control" placeholder="linkedin">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<hr>--}}



                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">العنوان - لغة عربية</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="address_ar" value="{{Cache::store('file')->get('settings.address_ar')}}" class="form-control" placeholder="Address">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">العنوان - لغة انجليزية</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="address_en" value="{{Cache::store('file')->get('settings.address_en')}}" class="form-control" placeholder="Address">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">رقم الهاتف</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="phone" value="{{Cache::store('file')->get('settings.phone')}}" class="form-control" placeholder="phone">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">البريد الإلكتروني</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="email" value="{{Cache::store('file')->get('settings.email')}}" class="form-control" placeholder="E-mail">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">الايمل الذي ستصله رسائل اتصل بنا - عربي</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="contact_us_email" value="{{Cache::store('file')->get('settings.contact_us_email')}}" class="form-control" placeholder="E-mail">--}}
                                        {{--<span>اذا كان هناك اكثر من بريد الرجاء الفصل بنهم بفاصلة كهذه , </span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">الايمل الذي ستصله رسائل اتصل بنا - انجليزي</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="contact_us_email_en" value="{{Cache::store('file')->get('settings.contact_us_email_en')}}" class="form-control" placeholder="E-mail">--}}
                                        {{--<span>اذا كان هناك اكثر من بريد الرجاء الفصل بنهم بفاصلة كهذه , </span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<hr/>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">تفعيل فورم الإتصال</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<select name="contact_form" class="form-control">--}}
                                            {{--<option @if(Cache::store('file')->get('settings.contact_form') == 'YES') {{ ' selected ' }} @endif value="YES">نعم</option>--}}
                                            {{--<option @if(Cache::store('file')->get('settings.contact_form') == 'NO') {{ ' selected ' }} @endif value="NO">لا</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">تفعيل فورم القائمة البريدية</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<select name="maillist_form" class="form-control">--}}
                                            {{--<option @if(Cache::store('file')->get('settings.maillist_form') == 'YES') {{ ' selected ' }} @endif value="YES">نعم</option>--}}
                                            {{--<option @if(Cache::store('file')->get('settings.maillist_form') == 'NO') {{ ' selected ' }} @endif value="NO">لا</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<hr/>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">عنوان الاحصائية 1</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_1_text" value="{{Cache::store('file')->get('settings.number_1_text')}}" class="form-control" placeholder="عنوان الاحصائية 1">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">عنوان الاحصائية en 1</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_1_text_en" value="{{Cache::store('file')->get('settings.number_1_text_en')}}" class="form-control" placeholder="عنوان الاحصائية 1">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">قيمة الاحصائية 1</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_1" value="{{Cache::store('file')->get('settings.number_1')}}" class="form-control" placeholder="قيمة الاحصائية 1">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<hr/>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">عنوان الاحصائية 2</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_2_text" value="{{Cache::store('file')->get('settings.number_2_text')}}" class="form-control" placeholder="عنوان الاحصائية 2">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">en عنوان الاحصائية 2</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_2_text_en" value="{{Cache::store('file')->get('settings.number_2_text_en')}}" class="form-control" placeholder="عنوان الاحصائية 2">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">قيمة الاحصائية 2</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_2" value="{{Cache::store('file')->get('settings.number_2')}}" class="form-control" placeholder="قيمة الاحصائية 2">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<hr/>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">عنوان الاحصائية 3</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_3_text" value="{{Cache::store('file')->get('settings.number_3_text')}}" class="form-control" placeholder="عنوان الاحصائية 3">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">en عنوان الاحصائية 3</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_3_text_en" value="{{Cache::store('file')->get('settings.number_3_text_en')}}" class="form-control" placeholder="عنوان الاحصائية 3">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">قيمة الاحصائية 3</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_3" value="{{Cache::store('file')->get('settings.number_3')}}" class="form-control" placeholder="قيمة الاحصائية 3">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<hr/>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">عنوان الاحصائية 4</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_4_text" value="{{Cache::store('file')->get('settings.number_4_text')}}" class="form-control" placeholder="عنوان الاحصائية 4">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">عنوان الاحصائية en 4</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_4_text_en" value="{{Cache::store('file')->get('settings.number_4_text_en')}}" class="form-control" placeholder="عنوان الاحصائية 4">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">قيمة الاحصائية 4</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="number_4" value="{{Cache::store('file')->get('settings.number_4')}}" class="form-control" placeholder="قيمة الاحصائية 4">--}}
                                    {{--</div>--}}
                                {{--</div>--}}


                                {{--<hr/>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">فقرة المشاريع</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="portfolio_text" value="{{Cache::store('file')->get('settings.portfolio_text')}}" class="form-control" placeholder="فقرة المشاريع">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label"> فقرة المشاريع en</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="portfolio_text_en" value="{{Cache::store('file')->get('settings.portfolio_text_en')}}" class="form-control" placeholder="فقرة المشاريع">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">فقرة اراء العملاء</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="testimonials_text" value="{{Cache::store('file')->get('settings.testimonials_text')}}" class="form-control" placeholder="فقرة اراء العملاء">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">فقرة اراء العملاء en</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<input type="text" name="testimonials_text_en" value="{{Cache::store('file')->get('settings.testimonials_text_en')}}" class="form-control" placeholder="فقرة اراء العملاء">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<hr/>--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label">الخريطة: </label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<div id="from_map" style="width: 100%;height: 300px;"></div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}


                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-2 control-label">الخريطة: </label>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<input type="text" class="form-control" name="map_latitude"  value="{{Cache::store('file')->get('settings.map_latitude')}}"id="map_latitude">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<input type="text" class="form-control" name="map_longitude" value="{{Cache::store('file')->get('settings.map_longitude')}}"  id="map_longitude" >--}}
                                    {{--</div>--}}
                                {{--</div>--}}


                            </div>

                            <div class="form-actions">

                                <div class="row">

                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-primary">تعديل</button>
                                    </div>

                                </div>

                            </div>

                            {{FORM::close()}}

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection