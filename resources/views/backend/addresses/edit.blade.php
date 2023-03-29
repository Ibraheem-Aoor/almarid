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
                        {!! FORM::open(['url'=>url(config('app.prefix','admin').'/'.$data['route'].'/edit'),'class'=>'form-horizontal','file'=>true,'role'=>'form','id'=>'edit_object_form']) !!}
                        <div class="portlet-body form">
                            <div class="col-md-12">
                                <div class="form-body">
                                <div class="row">

<div class="col-md-12">
    <div class="form-group form-md-line-input has-success">
        <label class="col-md-2 control-label" for="branch">الفرع</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="branch" id="branch" value="{{ $object->branch }}" placeholder="الفرع">
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
            <input type="text" class="form-control" name="branch_en" id="branch_en" value="{{ $object->branch_en }}" placeholder="الفرع انجليزي">
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
            <input type="text" class="form-control" name="address" id="address" value="{{ $object->address }}" placeholder="العنوان">
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
            <input type="text" class="form-control" name="address_en" id="address_en" value="{{ $object->address_en }}" placeholder="العنوان انجليزي">
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
            <input type="text" class="form-control" name="fax" id="fax" value="{{ $object->fax }}"  style="direction: ltr;"  placeholder="الفاكس">
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
            <input type="text" class="form-control" name="phonenumber" id="phonenumber" style="direction: ltr;" value="{{ $object->phonenumber }}" placeholder="رقم الجوال">
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
            <input type="text" class="form-control" name="lat" id="lat" value="{{ $object->lat }}" placeholder="lat">
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
            <input type="text" class="form-control" name="lng" value="{{ $object->lng }}" id="lng" placeholder="lng">
            <div class="form-control-focus">
            </div>
            <span class="help-block"></span>
        </div>
    </div>
</div>

<div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="lng">Google Map</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" value="{{ $object->map }}" class="form-control" name="map" id="lng" placeholder="Google Map">
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
                        <input type="hidden" name="id" id="object_id" value="{{ $object->id }}">
                        {!! FORM::close() !!}
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary edit_object">حفظ التغييرات</button>
            <button type="button" data-dismiss="modal" class="btn btn-default">اغلاق</button>
        </div>

    </div>
</div>