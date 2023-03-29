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
                {className: 'text-center', data: 'car', name: 'car', searchable: true,orderable: true},
                {className: 'text-center', data: 'name', name: 'name', searchable: true,orderable: true},
                {className: 'text-center', data: 'email', name: 'email', searchable: true,orderable: true},
                {className: 'text-center', data: 'phonenumber', name: 'phonenumber', searchable: true,orderable: true},
                {className: 'text-center', data: 'edit_action',name: 'edit_action',orderable: false,searchable: false},
                {className: 'text-center', data: 'status', name: 'status', searchable: false,orderable: true}
               
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

    function showModal(id){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
            $.post('{{ url(config('app.prefix','admin').'/'.$data['route'].'/show')}}', {'id':id,'_token':'{!! csrf_token() !!}'} , function(data) {
                if(data.success) {
                    $('#edit_object').html(data.page).modal('show');
                    $('.textarea').wysihtml5();
                    $('#edit_object .modal-title').html('تواصل معنا');
                }else{
                    showAlertMessage('alert-danger', 'خطأ !', 'خطأ في الصفحة');
                }
            }, 'json');
        
    }

    function ch_st(id){
        $.ajax({
            url : '{{url(config('app.prefix','admin').'/'.$data['route'].'/change_status')}}',
            data : {id:id,_token : '{!! csrf_token() !!}' },
            type: "POST",
            success:function(data, textStatus, jqXHR) {
                var status = data.status;
                var str = '<span class="inc"></span><span class="check"></span><span class="box"></span>'+status;

                if(status === 'تمت المشاهدة'){
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
                                                                        <label class="col-md-2 control-label" for="branch">الفرع</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="branch" id="branch" placeholder="الفرع">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="branch_en">الفرع انجليزي</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="branch_en" id="branch_en" placeholder="الفرع انجليزي">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="address">العنوان</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="address" id="address" placeholder="العنوان">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="address_en">العنوان انجليزي</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="address_en" id="address_en" placeholder="العنوان انجليزي">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="fax">الفاكس</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="fax" id="fax" placeholder="الفاكس">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="phonenumber">رقم الجوال</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="رقم الجوال">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="lat">lat</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="lat" id="lat" placeholder="lat">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="lng">lng</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="lng" id="lng" placeholder="lng">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
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

                  
                </div>
                <div class="col-xs-12" style="margin-top: 15px;">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-striped table-bordered table-hover" id="objects_table">
                                <thead>
                                <tr>
                                    <th class="text-center" width="20%">اسم السيارة</th>
                                    <th class="text-center" width="20%">الاسم</th>
                                    <th class="text-center" width="20%">البريد</th>
                                    <th class="text-center" width="20%">رقم الجوال</th>
                                    <th class="text-center" width="20%">الرسالة</th>
                                    <th class="text-center" width="20%">الحالة</th>
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