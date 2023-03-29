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
												<label class="col-md-2 control-label" for="name">العنوان</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="name" value="{{ $object->name }}" id="name" placeholder="الاسم">
													<div class="form-control-focus">
													</div>
													<span class="help-block"></span>
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group form-md-line-input has-success">
												<label class="col-md-2 control-label" for="type">القسم</label>
												<div class="col-md-10">
													<select name="type" class="form-control">
														<option value="ACCESSORY" {{ ($object['type'] == 'ACCESSORY')? 'selected' : '' }} >الاكسسوارات</option>
														<option value="CAR" {{ ($object['type'] == 'CAR')? 'selected' : '' }} >السيارات</option>
													</select>
													<div class="form-control-focus">
													</div>
													<span class="help-block"></span>
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group form-md-line-input has-success">
												<label class="col-md-2 control-label" for="to_date">اللغة</label>
												<div class="col-md-10">
													<select name="lang" class="form-control">
														@foreach(Config::get('app.locales') as $row)
															<option @if($object->lang == $row) selected @endif value="{{ $row }}">{{ trans('locales.'.$row) }}</option>
														@endforeach
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
													@if(!empty($object->file))
														<img src="{{ asset('uploads/'.$data['file_folder'].'/'.$object->file) }}" width="100px" alt="">
													@else
														لا يوجد ملف للبنر الرجاء اختيار صورة
													@endif
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-4 control-label" for="image">الصورة</label>
												<div class="col-md-8">
													<input type="file" class="form-control" name="image" id="image">
													<span class="help-block">اذا كنت لا تريد تغير الصورة او الفيديو اتركها فارغة</span>
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