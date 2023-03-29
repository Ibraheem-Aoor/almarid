@extends('backend.layouts.app')
@section('css')
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var TABLE = $('#restaurants_user_table');
        var Add_Form = $('#add_restaurant_user_form');
        var Edit_Form = $('#edit_restaurant_user_form');
        var Modal_add = $('#add_restaurant_user');
        var Modal_edit = $('#edit_restaurant_user');
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
            ajax: '{!! url('admin/administrators/data') !!}',
            columns: [
                {className: 'text-center', data: 'name', name: 'name', searchable: true,orderable: true},
//                {className: 'text-center', data: 'username', name: 'username', searchable: true},
                {className: 'text-center', data: 'email', name: 'email', searchable: true,orderable: true},
                {className: 'text-center', data: 'status', name: 'status', searchable: false,orderable: true},
                {className: 'text-center', data: 'created_at', name: 'created_at', searchable: false,orderable: true},
                {className: 'text-center', data: 'edit_action',name: 'edit_action',orderable: false,searchable: false},
                {className: 'text-center', data: 'delete_action', name: 'delete_action', orderable: false, searchable: false}
            ]
        });

        $('.add_restaurant_user').click(function(e){
            e.preventDefault();
            postData(Add_Form);
        });

        Modal_add.on('shown.bs.modal',function(e){
            Add_Form.bootstrapValidator({
                message: '',
                live: true,
                feedbackIcons: {
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                },
                fields: {
                    name: {
                        message: 'اسم المدير ',
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            },
                            stringLength: {
                                min: 2,
                                max: 50,
                                message: 'يجب ان يكون الاسم من حرفين و حتى خمسين حرف'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z_1-9\u0600-\u06FF\u0020]+$/,
                                message: 'اسم المدير يحتوي فقط على ارقام وحروف'
                            }
                        }
                    },
                    password: {
                        message: 'كلمة المرور',
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            },
                            stringLength: {
                                min: 6,
                                max: 50,
                                message: 'يجب ان تكون كلمة المررور اكثر من 6 حروف'
                            }
                        }
                    },
                    username: {
                        message: 'اسم الدخول',
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            },
                            stringLength: {
                                min: 2,
                                max: 50,
                                message: 'يجب ان يكون الاسم من حرفين و حتى خمسين حرف'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z_1-9\u0600-\u06FF\u0020]+$/,
                                message: 'اسم الدخول يحتوي فقط على ارقام وحروف'
                            },
                            remote: {
                                url: '{!! url('admin/administrators/checkeuser') !!}',
                                data: function(validator) {
                                    return {
                                        s_username: validator.getFieldElements('username').val(),

                                    };
                                },
                                message: 'اسم الدخول موجود مسبقا'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'هذا الحقل مطلوب'
                            },
                            regexp: {
                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                message: 'صيغة البريد الإلكتروني غير صحيحة'
                            },
                            remote: {
                                url: '{!! url('admin/administrators/checkemail') !!}',
                                data: function(validator) {
                                    return {
                                        s_email: validator.getFieldElements('primary_email').val(),

                                    };
                                },
                                message: 'البريد الإلكتروني موجود مسبقا'
                            }
                        }
                    },
                }
            });
            $('#add_restaurant_user_form').bootstrapValidator('resetForm');
        });

    });

    function showModal(id){
        $("html, body").animate({
            scrollTop: 0
        }, 600);

        if(id == null){
            $('#add_restaurant_user .modal-title').html('اضافة مدير لوحة ');
            $('#add_restaurant_user').modal('show', {backdrop: 'static'});
        }
        else{
            $.post('{{ url('admin/administrators/show')}}', {'id':id,'_token':'{!! csrf_token() !!}'} , function(data) {
                if(data.success) {
                    $('#edit_restaurant_user').html(data.page).modal('show');
                    $('#edit_restaurant_user .modal-title').html('تعديل بيانات المدير ');
                    validateForm();
                }else{
                    showAlertMessage('alert-danger', 'خطأ !', 'خطأ في الصفحة');

                }
            }, 'json');
        }
    }

    function validateForm(){

        $('#edit_restaurant_user_form').bootstrapValidator({
            message: '',
            live: true,
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                name: {
                    message: 'اسم المدير',
                    validators: {
                        notEmpty: {
                            message: 'هذا الحقل مطلوب'
                        },
                        stringLength: {
                            min: 2,
                            max: 50,
                            message: 'يجب ان يكون الاسم من حرفين و حتى خمسين حرف'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z_1-9\u0600-\u06FF\u0020]+$/,
                            message: 'اسم المدير يحتوي فقط على ارقام وحروف'
                        }
                    }
                },
                username: {
                    message: 'اسم الدخول',
                    validators: {
                        notEmpty: {
                            message: 'هذا الحقل مطلوب'
                        },
                        stringLength: {
                            min: 2,
                            max: 50,
                            message: 'يجب ان يكون الاسم من حرفين و حتى خمسين حرف'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z_1-9\u0600-\u06FF\u0020]+$/,
                            message: 'اسم الدخول يحتوي فقط على ارقام وحروف'
                        }
                    }
                },
                email: {
                    message: 'البريد الإلكتروني',
                    validators: {
                        email: {
                            message: 'هذا الحقل مطلوب'
                        },
                    }
                },
            }
        });

        $('#edit_restaurant_user_form').bootstrapValidator('resetForm');



        $('.edit_restaurant_user').click(function(e){
            e.preventDefault();
            postEditableData($('#edit_restaurant_user_form'));
        });
    }

    function ch_st(id){
        $.ajax({
            url : '{{url('admin/administrators/status')}}',
            data : {id:id,_token : '{!! csrf_token() !!}' },
            type: "POST",
            success:function(data, textStatus, jqXHR) {
                var status = data.status;
                var str = '<span class="inc"></span><span class="check"></span><span class="box"></span>'+status;
                setTimeout(function(){$('#label_status_'+id).html(str)},1000);

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

    function deleteThis(id){
        if(!confirm('هل انت متاكد؟')){
            return false;
        }else {
            $.ajax({
                url: '{{url('admin/administrators/delete')}}',
                data: {id: id, _token: '{!! csrf_token() !!}'},
                type: "POST",
                success: function (data, textStatus, jqXHR) {
                    var id = data.restaurant_id;
//                        console.log('#cards_table > tbody > tr[id='+id+']');
                    $('#'+id).closest('tr').remove();
//                    $('#restaurants_table > tbody > tr[id='+id+']').remove();
                    showAlertMessage('alert-success', 'ادارة المدراء / ', 'تم حذف المدير بنجاح');
//                    setTimeout(function(){location.reload()},1000);
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

    function postData(form){
        form.data('bootstrapValidator').validate();
        if(!form.data('bootstrapValidator').isValid()){
            return;
        }
        var data = form.serializeArray();
        $.ajax({
            url : '{{ url('admin/administrators/add') }}',
            data : data,
            type: "POST",
            success:function(data) {
                if(data.success){
                    $('#add_restaurant_user').modal('hide');
                    $('#restaurants_user_table > tbody > tr:first').before(data.administrator);
                    showAlertMessage('alert-success','مدراء اللوحة / ', 'تم اضافة مدير بنجاح');
                }else{
                    showAlertMessage('alert-danger','مدراء اللوحة / ', ' حدث خطا أثناء الاضافة ! حاول مجددا');
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

    function postEditableData(form){
        var data = form.serializeArray();
        $.ajax({
            url : '{{ url('admin/administrators/edit') }}',
            data : data,
            type: "POST",
            success:function(data) {
                if(data.success){
                    $('#edit_restaurant_user').modal('hide');
                    $('#'+data.id).closest('tr').replaceWith(data.administrator_row);
                    showAlertMessage('alert-success','ادارة المدراء ', 'تم تعديل بيانات المدير بنجاح');
                }else{
                    showAlertMessage('alert-danger','ادارة المدراء ', ' حدث خطا أثناء التعديل ! حاول مجددا');
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

</script>
@endsection


@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <span>مدراء لوحة التحكم</span>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/'.config('app.prefix','admin')) }}"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">مدراء لوحة التحكم</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="modal fadeIn" id="edit_restaurant_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                    <div class="modal fadeIn" id="add_restaurant_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                {!! FORM::open(['url'=>url('admin/administrators/add'),'class'=>'form-horizontal','role'=>'form','id'=>'add_restaurant_user_form']) !!}
                                                <div class="portlet-body form">
                                                    <div class="col-md-12">
                                                        <div class="form-body">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-4 control-label" for="name">اسم المدير</label>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control" name="name" id="name" placeholder="اسم المدير">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-4 control-label" for="email">البريد الإلكتروني</label>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control" name="email" id="email" placeholder="البريد الإلكتروني">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-4 control-label" for="password">كلمة المرور</label>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control" name="password" id="password" placeholder="كلمة المرور">
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
                                    <button type="submit" class="btn btn-primary add_restaurant_user">حفظ التغييرات</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-default">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a onclick="showModal()" class="btn btn-info btn-flat">
                        <i class="fa fa-plus"></i> إضافة جديد
                    </a>
                </div>
                <div class="col-xs-12" style="margin-top: 15px;">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-striped table-bordered table-hover" id="restaurants_user_table">
                                <thead>
                                <tr>
                                    <th class="text-center">اسم المدير</th>
                                    {{--<th class="text-center">اسم الدخول</th>--}}
                                    <th class="text-center">البريد الإلكتروني</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">انشئ بتاريخ</th>
                                    <th class="text-center">تعديل</th>
                                    <th class="text-center">حذف</th>
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