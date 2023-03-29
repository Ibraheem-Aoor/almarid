@extends('backend.layouts.app')
@section('css')
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var TABLE = $('#objects_table');
        var Add_Form = $('#add_object_form');
        var Modal_add = $('#add_object');
        TABLE.DataTable({
            processing: true,
            serverSide: true,
            "aaSorting": [ [0,'desc'] ],
            "language": {
                "sProcessing":   "جارٍ التحميل...",
                "sLengthMenu":   "أظهر _MENU_ مدخلات",
                "sZeroRecords":  "لم يعثر على أية سجلات",
                "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix":  "",
                "sSearch":       "ابحث:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "الأول",
                    "sPrevious": "السابق",
                    "sNext":     "التالي",
                    "sLast":     "الأخير"
                }
            },
            ajax: '{!! url(config('app.prefix','admin').'/'.$data['route'].'/data') !!}',
            columns: [
                {className: 'text-center', data: 'name', name: 'name', searchable: true,orderable: true},
                {className: 'text-center', data: 'status', name: 'status', searchable: false,orderable: true},
                {className: 'text-center', data: 'edit_action',name: 'edit_action',orderable: false,searchable: false},
                {className: 'text-center', data: 'delete_action', name: 'delete_action', orderable: false, searchable: false}
            ]
        });

        $('.add_object').click(function(e){
            e.preventDefault();
            postData(Add_Form);
        });
        Modal_add.on('shown.bs.modal',function(e){
            validateForm(Add_Form);
        });

        $('body').on('click','.edit_object',function(e){
            e.preventDefault();
            postEditableData();
        });

    });

    function validateForm(Form_ID){
        Form_ID.bootstrapValidator({
            message: '',
            live: true,
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                name: {
                    message: 'الاسم',
                    validators: {
                        notEmpty: {
                            message: 'هذا الحقل مطلوب'
                        },
                        stringLength: {
                            min: 2,
                            max: 50,
                            message: 'يجب ان يكون الاسم من حرفين و حتى خمسين حرف'
                        }
                    }
                }
            }
        });
        Form_ID.bootstrapValidator('resetForm');
    }

    function showModal(id){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        if(id == null){
            $('#add_object .modal-title').html('إضافة جديد ');
            $('#add_object').modal('show', {backdrop: 'static'});
//            $('.textarea').wysihtml5();
        }
        else{
            $.post('{{ url(config('app.prefix','admin').'/'.$data['route'].'/show')}}', {'id':id,'_token':'{!! csrf_token() !!}'} , function(data) {
                if(data.success) {
                    $('#edit_object').html(data.page).modal('show');
                    $('.textarea').wysihtml5();
                    $('#edit_object .modal-title').html('تعديل البيانات ');
                    validateForm($('#edit_object_form'));
                }else{
                    showAlertMessage('alert-danger', 'خطأ !', 'خطأ في الصفحة');
                }
            }, 'json');
        }
    }

    function postData(form){
        form.data('bootstrapValidator').validate();
        if(!form.data('bootstrapValidator').isValid()){
            return;
        }
        //var data = form.serializeArray();
        var data = new FormData( form[0] );
        if (!("FormData" in window)) {
            console.log('FormData not supported.');
        }
        $.ajax({
            url : '{{ url(config('app.prefix','admin').'/'.$data['route'].'/add') }}',
            data : data,
            processData: false,
            contentType: false,
            type: "POST",
            success:function(data) {
                if(data.success){
                    $('#add_object').modal('hide');
                    form[0].reset();
                    $('#objects_table > tbody > tr:first').before(data.object);
                    showAlertMessage('alert-success', 'تمت الاضافة بنجاح');
                }else{
                    showAlertMessage('alert-danger', ' حدث خطا أثناء الاضافة ! حاول مجددا');
                }
            },
            error:function(data) {
                console.log(data);
            } ,
            statusCode: {
                500: function(data) {
                    console.log(data);
                }
            }
        });
    }

    function postEditableData(){
        $('#edit_object_form').data('bootstrapValidator').validate();
        if(!$('#edit_object_form').data('bootstrapValidator').isValid()){
            return;
        }
        //var data = form.serializeArray();
        var data = new FormData( $('#edit_object_form')[0] );
        if (!("FormData" in window)) {
            console.log('FormData not supported.');
        }
        $.ajax({
            url : '{{ url(config('app.prefix','admin').'/'.$data['route'].'/update') }}',
            data : data,
            processData: false,
            contentType: false,
            type: "POST",
            success:function(data) {
                if(data.success){
                    $('#edit_object').modal('hide');
                    $('#edit_object_form')[0].reset();
                    $('#'+data.id).closest('tr').replaceWith(data.object_row);
                    showAlertMessage('alert-success', 'تم تعديل البيانات بنجاح');
                }else{
                    showAlertMessage('alert-danger',' حدث خطا أثناء التعديل ! حاول مجددا');
                }
            },
            error:function(data) {
                console.log(data);
            } ,
            statusCode: {
                500: function(data) {
                    console.log(data);
                }
            }
        });
    }

    function deleteThis(id){
        if(!confirm('هل انت متاكد من عملية الحذف ؟')){
            return false;
        }else {
            $.ajax({
                url: '{{url(config('app.prefix','admin').'/'.$data['route'].'/delete')}}',
                data: {id: id, _token: '{!! csrf_token() !!}'},
                type: "POST",
                success: function (data, textStatus, jqXHR) {
                    var id = data.restaurant_id;
                    $('#'+id).closest('tr').remove();
                    showAlertMessage('alert-success', 'تم حذف العنصر بنجاح');
                },
                error: function (data, textStatus, jqXHR) {
                    console.log(data);
                },
                statusCode: {
                    500: function (data) {
                        console.log(data);
                    }
                }
            });
        }
    }

    function ch_st(id){
        $.ajax({
            url : '{{url(config('app.prefix','admin').'/'.$data['route'].'/change_status')}}',
            data : {id:id,_token : '{!! csrf_token() !!}' },
            type: "POST",
            success:function(data, textStatus, jqXHR) {
                var status = data.status;
                var str = '<span class="inc"></span><span class="check"></span><span class="box"></span>'+status;

                if(status === 'مفعل'){
                    $('#label_status_'+id).removeClass('btn-danger');
                    $('#label_status_'+id).addClass('btn-success');
                }else{
                    $('#label_status_'+id).addClass('btn-danger');
                    $('#label_status_'+id).removeClass('btn-success');
                }
                setTimeout(function(){$('#label_status_'+id).html(str)},0);


            },
            error:function(data, textStatus, jqXHR) {
                console.log(data);
            } ,
            statusCode: {
                500: function(data) {
                    console.log(data);
                }
            }
        });
    }

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

                    <div class="modal fadeIn" id="edit_object" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                    <div class="modal fadeIn" id="add_object" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width:760px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- BEGIN SAMPLE FORM PORTLET-->
                                            <div class="portlet light bordered">
                                                {!! FORM::open(['url'=>url(config('app.prefix','admin').'/'.$data['route'].'/add'),'class'=>'form-horizontal','file' => true,'role'=>'form','id'=>'add_object_form']) !!}
                                                <div class="portlet-body form">
                                                    <div class="col-md-12">
                                                        <div class="form-body">
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="name">العنوان</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="name" id="name" placeholder="العنوان">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="name_en">العنوان انجليزي</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="name_en" id="name_en" placeholder="العنوان انجليزي">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="category_id">نوع الخيار</label>
                                                                        <div class="col-md-10">
                                                                            <select name="category_id" class="form-control">
                                                                                @if(isset($data['categories']) && !empty($data['categories']) && count($data['categories']->toArray()) > 0 )
                                                                                    @foreach($data['categories'] as $row)
                                                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label" for="image">صورة</label>
                                                                        <div class="col-md-8">
                                                                            <input type="file" class="form-control" name="image" id="image">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                {!! FORM::close() !!}
                                            </div>
                                            <!-- END SAMPLE FORM PORTLET-->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary add_object">حفظ التغييرات</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-default">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a onclick="showModal()" class="btn btn-info btn-flat pull-left">
                        <i class="fa fa-plus"></i> إضافة جديد
                    </a>
                    <form action="" method="get" class="pull-left" style="margin-right: 30px;">
                        <select name="type" class="pull-left form-control" style="width: 120px;padding: 0;margin-left: 5px;">
                            @if(isset($data['categories']) && !empty($data['categories']) && count($data['categories']->toArray()) > 0 )
                                @foreach($data['categories'] as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <input type="submit" value="فلترة" class="pull-left btn btn-info btn-flat">
                    </form>
                </div>
                <div class="col-xs-12" style="margin-top: 15px;">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-striped table-bordered table-hover" id="objects_table">
                                <thead>
                                <tr>
                                    <th class="text-center" width="50%">العنوان</th>
                                    <th class="text-center" width="20%">الحالة</th>
                                    <th class="text-center" width="15%">تعديل</th>
                                    <th class="text-center" width="15%">حذف</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection