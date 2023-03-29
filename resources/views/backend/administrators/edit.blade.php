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
                        {!! FORM::open(['url'=>url('admin/administrators/edit'),'class'=>'form-horizontal','role'=>'form','id'=>'edit_restaurant_user_form']) !!}
                        <div class="portlet-body form">
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-4 control-label" for="username">اسم الدخول</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="{{ $administrator->username }}" name="username" id="username" placeholder="اسم الدخول">
                                                    <div class="form-control-focus">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-4 control-label" for="name">اسم المدير</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="{{ $administrator->name }}" name="name" id="name" placeholder="اسم المدير">
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
                                                    <input type="text" class="form-control" value="{{ $administrator->email }}" name="email" id="email" placeholder="البريد الإلكتروني">
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
                                                <label class="col-md-4 control-label" for="mobile">رقم الجوال</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="{{ $administrator->mobile }}" name="mobile" id="mobile" placeholder="رقم الجوال">
                                                    <div class="form-control-focus">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-4 control-label" for="mobile">الصلاحية</label>
                                                <div class="col-md-8">
                                                    <select name="role" class="form-control" id="role">
                                                        <option selected disabled value="0">-- اختر الصلاحية --</option>
                                                        @if(isset($roles) && !empty($roles) && count($roles) > 0 )
                                                            @foreach($roles as $row)
                                                                <option @if($administrator->hasRole($row->name)) {{ ' selected ' }} @endif value="{{ $row->id }}">@if(!empty($row->display_name)) {{ $row->display_name }} @else {{ str_replace('-',' ',$row->name) }} @endif</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
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
                        <input type="hidden" name="id" value="{{ $administrator->id }}">
                        {!! FORM::close() !!}
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary edit_restaurant_user">حفظ التغييرات</button>
            <button type="button" data-dismiss="modal" class="btn btn-default">اغلاق</button>
        </div>

    </div>
</div>