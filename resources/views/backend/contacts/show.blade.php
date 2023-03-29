<div class="modal-dialog">
    <div class="modal-content" style="width: 760px;">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">الاسم</label>
                                                <div class="col-md-9">
                                                    {{ $object['name'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">البريد الالكتروني</label>
                                                <div class="col-md-9">
                                                    {{ $object['email'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">رقم الجوال</label>
                                                <div class="col-md-9">
                                                    {{ $object['phonenumber'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>   
                                             <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">الرسالة</label>
                                                <div class="col-md-9">
                                                    {{ $object['message'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">الحالة</label>
                                                <div class="col-md-9">
                                                @if($object['status'] ==0)
                                                    قيد الانتظار
                                                @else
                                                    تمت المشاهدة
                                                @endif
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>

                                    </div>
                <div class="cleafix"></div>
        </div>
        <div class="cleafix"></div>
                    <!-- END SAMPLE FORM PORTLET-->
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">اغلاق</button>
        </div>
    </div>
</div>