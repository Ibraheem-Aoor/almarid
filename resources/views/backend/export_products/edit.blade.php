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
                                                <label class="col-md-2 control-label" for="name">الاسم عربي</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="name" value="{{ $object->name }}" id="name" placeholder="">
                                                    <div class="form-control-focus">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="name">الاسم انجليزي</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="name_en" value="{{ $object->name_en }}" id="name" placeholder="">
                                                    <div class="form-control-focus">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">الجير</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="geer"  value="{{ $object->geer }}" id="name" placeholder="الجير">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div> 
  
  <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">الدفع</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="wheel_drive"  id="name" placeholder="الدفع">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                        <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">المصنع</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="make"  value="{{ $object->make }}" id="name" placeholder="المصنع">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div><div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">السنة</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="year"  value="{{ $object->year }}" id="name" placeholder="السنة">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div><div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">الموديل</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="model"  value="{{ $object->model }}" id="name" placeholder="الموديل">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div><div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">السعر</label>
                                                                        <div class="col-md-10">
                                                                            <input type="number" class="form-control" name="price"  value="{{ $object->price }}" id="name" placeholder="السعر">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div><div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">السعر بالدولار</label>
                                                                        <div class="col-md-10">
                                                                            <input type="number" class="form-control" name="price_dollar" value="{{ $object->price_dollar }}"  id="name" placeholder="السعر">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">الشكل</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="body_style"  value="{{ $object->body_style }}" id="name" placeholder="الشكل">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div><div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">رقم المخزون</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="stack_number"  value="{{ $object->stack_number }}" id="name" placeholder="رقم المخزون">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div><div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">العداد</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="mileage"  value="{{ $object->mileage }}" id="name" placeholder="العداد">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div><div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">الموقع</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="loaction"  value="{{ $object->loaction }}" id="name" placeholder="الموقع">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">محرك</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="engine"  value="{{ $object->engine }}" id="name" placeholder="محرك">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div><div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">عدد الأبواب</label>
                                                                        <div class="col-md-10">
                                                                            <input type="number" class="form-control" name="door"  value="{{ $object->door }}" id="name" placeholder="عدد الأبواب">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">الضمان</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="warranty" value="{{ $object->warranty }}" id="name" placeholder="الضمان">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">حصان</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="bhp" value="{{ $object->bhp }}" id="name" placeholder="حصان">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
  <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">عنوان ورقم جوال</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="phone"  value="{{ $object->phone }}" id="name" placeholder="عنوان ورقم جوال">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-md-line-input has-success">
                                                                        <label class="col-md-2 control-label" for="price">عنوان ورقم جوال 2</label>
                                                                        <div class="col-md-10">
                                                                            <input type="text" class="form-control" name="phone1"  value="{{ $object->phone1 }}" id="name" placeholder="عنوان ورقم جوال">
                                                                            <div class="form-control-focus">
                                                                            </div>
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>  
                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="services">الخدمات</label>
                                                <div class="col-md-10">
                                                    <select multiple="multiple" name="services[]" class="form-control">
                                                        @if(isset($data['services']) && !empty($data['services']) && count($data['services']->toArray()) > 0 )
                                                            @foreach($data['services'] as $row)
                                                                <option  @if( isset($data['export_product_service']) && !empty($data['export_product_service']) && count($data['export_product_service']) > 0 &&  in_array($row->id,$data['export_product_service']) ) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
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
                                                <label class="col-md-6 control-label" for="s_image">الصورة الحالية</label>
                                                <div class="col-md-6">
                                                    @if(!empty($object->image))
                                                        <img src="{{ asset('uploads/'.$data['upload_folder'].'/'.$object->image) }}" width="100px" alt="">
                                                    @else
                                                        لا يوجد صورة الرجاء اختيار صورة
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="image">صورة الرئيسية</label>
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" name="image" id="image">
                                                    <span class="help-block">اذا كنت لا تريد تغير الصورة اتركها فارغة</span>
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