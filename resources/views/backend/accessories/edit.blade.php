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
												<label class="col-md-2 control-label" for="name">الوصف عربي</label>
												<div class="col-md-10">
													<textarea class="form-control textarea2" name="description" id="description" rows="2">{{ $object->description }}</textarea>
													<div class="form-control-focus">
													</div>
													<span class="help-block"></span>
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group form-md-line-input has-success">
												<label class="col-md-2 control-label" for="name">الوصف انجليزي</label>
												<div class="col-md-10">
													<textarea class="form-control textarea2" name="description_en" id="description_en" rows="2">{{ $object->description_en }}</textarea>
													<div class="form-control-focus">
													</div>
													<span class="help-block"></span>
												</div>
											</div>
										</div>

                                        <div class="col-md-12">
                                            <div class="form-group form-md-line-input has-success">
                                                <label class="col-md-2 control-label" for="category_id">نوع الاكسسوار</label>
                                                <div class="col-md-10">
                                                    <select name="category_id" class="form-control">
                                                        @if(isset($data['categories']) && !empty($data['categories']) && count($data['categories']->toArray()) > 0 )
                                                            @foreach($data['categories'] as $row)
                                                                <option  @if($object->category_id == $row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
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
												<label class="col-md-2 control-label" for="colors">الألوان</label>
												<div class="col-md-10">
													<select multiple="multiple" name="colors[]" class="form-control">
														@if(isset($data['colors']) && !empty($data['colors']) && count($data['colors']->toArray()) > 0 )
															@foreach($data['colors'] as $row)
																<option  @if( isset($data['product_color']) && !empty($data['product_color']) && count($data['product_color']) > 0 &&  in_array($row->id,$data['product_color']) ) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
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
												<label class="col-md-2 control-label" for="price">السعر</label>
												<div class="col-md-10">
													<input type="text" class="form-control" value="{{ $object->price }}" name="price" id="name" placeholder="السعر">
													<div class="form-control-focus">
													</div>
													<span class="help-block"></span>
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group form-md-line-input has-success">
												<label class="col-md-2 control-label" for="quantity">الكمية</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="quantity" value="{{ $object->quantity }}" id="quantity" placeholder="">
													<div class="form-control-focus">
													</div>
													<span class="help-block"></span>
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group form-md-line-input has-success">
												<label class="col-md-2 control-label" for="is_new">جديد</label>
												<div class="col-md-10">
													<select name="is_new" id="is_new" class="form-control">
														<option @if($object->is_new == 1) selected @endif value="1">نعم</option>
														<option @if($object->is_new == 0) selected @endif  value="0">لا</option>
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
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-4 control-label" for="image">الصور الأخرى</label>
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
														<img src="{{ asset('uploads/accessories/'.$row->image) }}" width="80px" alt="">
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