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
                                                <label class="col-md-2 control-label" for="name">السؤال</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="question" value="{{ $object->question }}" id="question" placeholder="السؤال">
                                                    <div class="form-control-focus">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="answer">الإجابة</label>
                                                <div class="col-md-10">
                                                    {{--<textarea name="text" class="form-control textarea" rows="5" placeholder="الإجابة">{!! $object->text !!}</textarea>--}}
                                                    <textarea name="answer" class="form-control textarea" rows="5" placeholder="الإجابة">{!! $object->answer !!}</textarea>
                                                    <div class="form-control-focus">
                                                    </div>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>


                                        {{--<div class="col-md-12">--}}
                                            {{--<div class="form-group form-md-line-input has-success">--}}
                                                {{--<label class="col-md-2 control-label" for="category_id">نوع الخيار</label>--}}
                                                {{--<div class="col-md-10">--}}
                                                    {{--<select name="category_id" class="form-control">--}}
                                                        {{--@if(isset($data['categories']) && !empty($data['categories']) && count($data['categories']->toArray()) > 0 )--}}
                                                            {{--@foreach($data['categories'] as $row)--}}
                                                                {{--<option  @if($object->category_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>--}}
                                                            {{--@endforeach--}}
                                                        {{--@endif--}}
                                                    {{--</select>--}}
                                                    {{--<div class="form-control-focus">--}}
                                                    {{--</div>--}}
                                                    {{--<span class="help-block"></span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                {{----}}

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