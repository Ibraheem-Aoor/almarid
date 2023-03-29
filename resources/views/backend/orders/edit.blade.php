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
                        {!! FORM::open(['url'=>url(config('app.prefix','admin').'/'.$data['route'].'/update'),'class'=>'form-horizontal','file'=>true,'role'=>'form','id'=>'edit_object_form']) !!}
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
                                                    {{ $object['mobile'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">العنوان</label>
                                                <div class="col-md-9">
                                                    {{ $object['address'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">السيارة</label>
                                                <div class="col-md-9">
                                                    {{ $object->product['name'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">اللون</label>
                                                <div class="col-md-9">
                                                    {{ $object->color['name'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-3 control-label" for="name">رقم التتبع</label>
                                                <div class="col-md-9">
                                                    {{ $object['tracking_number'] }}
                                                </div>
                                                <span class="help-block"></span>
                                                </div>
                                            </div>

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="status">حالة الطلب</label>
                                                <div class="col-md-10">
                                                    <select name="status" class="form-control">
                                                        @if(isset($data['tracking_status']) && !empty($data['tracking_status']) && count($data['tracking_status']->toArray()) > 0 )
                                                            @foreach($data['tracking_status'] as $row)
                                                                <option  @if($object->status == $row->id) selected @endif value="{{ $row->id }}">{{ $row['name'] }}</option>
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
                <div class="cleafix"></div>
            <input type="hidden" name="id" id="object_id" value="{{ $object->id }}">
        </div>
        <div class="cleafix"></div>
                        {!! FORM::close() !!}
                    <!-- END SAMPLE FORM PORTLET-->
        <div class="modal-footer">
            {{--<button type="submit" class="btn btn-primary edit_object">حفظ التغييرات</button>--}}
            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
            <button type="button" data-dismiss="modal" class="btn btn-default">اغلاق</button>
        </div>
    </div>
</div>