@extends('backend.layouts.app')
@section('js')

@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <span>{{ $data['title'] }}</span>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/'.config('app.prefix','admin')) }}"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">{{ $data['title'] }}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div style="/*padding: 0 15px;*/">
                        <?php if (\Session::has('success')): ?>
                        <div class="alert alert-success">
                            <strong>نجاح !</strong>
                            {{\Session::get('success')}}
                        </div>
                        <?php endif ?>
                        <?php if (count($errors)): ?>
                        <div class="alert alert-danger">
                            <strong>خطأ !</strong>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-2"></div>
                <div class="col-xs-8" style="margin-top: 15px;">
                    <div class="panel panel-default">
                        <div class="panel-body form_view">

                            {{FORM::open([
                                        'files'=>'true',
                                        'class'=>"formular form-horizontal ls_form",
                                        'role'=>"form",
                                        'method'=>'post',
                                        'url'=>config('app.prefix','admin').'/notification/send'])}}

                            <div class="form-body">


                                <div class="form-group">
                                    <label class="col-md-2 control-label">عنوان الاشعار</label>
                                    <div class="col-md-10">
                                        <input required type="text" name="title" class="form-control" placeholder="عنوان الاشعار">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">نص الاشعار</label>
                                    <div class="col-md-10">
                                        <textarea required name="message" class="form-control" placeholder="نص الاشعار"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions">

                                <div class="row">

                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-primary">ارسال</button>
                                    </div>

                                </div>

                            </div>

                            {{FORM::close()}}

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection