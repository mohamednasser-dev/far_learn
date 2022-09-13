@extends('front.layouts.temp')
@section('content')
	<section>
        <div class="w-100 pt-80 black-layer pb-70 opc65 position-relative">
            <div class="fixed-bg" style="background-image: url(/quran/assets/images/page-title-bg.png);"></div>
            <div class="container">
                <div class="page-title-wrap text-center w-100">
                    <div class="page-title-inner d-inline-block">
                        <h1 class="mb-0">{{trans('admin.parent_data')}}</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{trans('admin.nav_home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('admin.sign_up_student')}}</li>
                            <li class="breadcrumb-item active">{{trans('admin.parent_data')}}</li>
                        </ol>
                    </div>
                </div><!-- Page Title Wrap -->
            </div>
        </div>
    </section>
	<div class="container">
		<div class="sec-title text-center w-100">
            <div class="sec-title-inner d-inline-block" style="padding-top: 20px;">
                <i class="thm-clr flaticon-rub-el-hizb"></i>
            </div>
        </div><!-- Sec Title -->
        <div class="prod-wrap overlap-150 prod-caro w-100 slick-initialized slick-slider">
            <div class="card">
                <div class="card-header" style="background-color: #bdd63d;>
                    <h4 class="m-b-0 text-white">{{trans('admin.parent_data')}}</h4>
                </div>
                <div class="card-body">
                    {{ Form::open( ['route'  => ['store.parent'],'method'=>'post' , 'class'=>'form'] ) }}
                        <div class="form-body">
                        	<div class="row p-t-20">
	                        	@include('admin.layouts.errors')
						        @include('admin.layouts.messages')
						    </div>
                            <div class="row p-t-20">
								<input type="hidden" required id="student_id" value="{{$selected_student_id}}" name="student_id" class="form-control form-control-danger">
                                <div class="col-md-12">
                                    <div class="form-group has-danger">
                                        <label class="control-label">{{trans('admin.full_name')}}</label><span style="color: red;">*</span>
                                        <input type="text" required id="user_name" name="user_name" class="form-control form-control-danger" placeholder="">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{trans('admin.phone')}}</label><span style="color: red;">*</span>
                                        <input type="number" required id="phone" maxlength="10" min="0" name="phone" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="control-label">{{trans('admin.home_phone')}}</label><span style="color: red;">*</span>
                                        <input type="text" required id="home_phone" name="home_phone" class="form-control form-control-danger" placeholder="">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{trans('admin.relation')}}</label><span style="color: red;">*</span>
                                        <select name="relation" required class="form-control custom-select">
                                            @php $relations = \App\Models\Relation::where('deleted','0')->get(); @endphp
                                            @foreach($relations as $row)
                                                <option value="{{ $row->id }}" > {{ $row->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="control-label">{{trans('admin.address')}}</label><span style="color: red;">*</span>
                                        <input type="text" required id="address" name="address" class="form-control form-control-danger" placeholder="">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
	                        <div class="view-more d-inline-block text-center w-100">
			                    <button class="thm-btn mini-btn thm-bg"  type="submit">{{trans('admin.public_Save')}}<span></span><span></span><span></span><span></span></button>
			                </div>
		                </div>
                    {{ Form::close() }}
	            </div>
	        </div>
        </div>
    </div>
	@endsection
