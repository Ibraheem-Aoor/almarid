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
                                                <label class="col-md-2 control-label" for="product_id">اسم السيارة</label>
                                                <div class="col-md-10">
                                                    <select name="product_id" class="form-control">
                                                        @if(isset($data['products']) && !empty($data['products']) && count($data['products']->toArray()) > 0 )
                                                            @foreach($data['products'] as $row)
                                                                <option  @if($object->product_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="form-control-focus">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="color_id">اللون</label>
                                                <div class="col-md-10">
                                                    <select name="color_id" class="form-control">
                                                        @if(isset($data['colors']) && !empty($data['colors']) && count($data['colors']->toArray()) > 0 )
                                                            @foreach($data['colors'] as $row)
                                                                <option  @if($object->color_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="form-control-focus">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="image">الصور الدخلية</label>
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" name="images[]" placeholder="address" multiple>
                                                    {{--<span class="help-block">اذا كنت لا تريد تغير الصورة اتركها فارغة</span>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            @if(isset($data['product_images']) && !empty($data['product_images']) && count($data['product_images']->toArray()) > 0)
                                                @foreach($data['product_images'] as $row)
                                                    <div class="single-image" style="float: right;margin: 5px;position: relative">
                                                        <a class="delete_product_single_image" data-imageid="{{ $row->id }}" style=" position: absolute; top: 5px; left: 5px; cursor: pointer; " ><i class="fa fa-times" style=" color: #fff; background: #f00; width: 20px; height: 20px; line-height: 20px; text-align: center; "></i></a>
                                                        <img src="{{ asset('uploads/products/'.$row->image) }}" width="80px" alt="">
                                                    </div>
                                                @endforeach
                                            @endif
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