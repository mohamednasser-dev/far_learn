@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.edit')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('subjects.show',$data->level_id)}}"
                   class="text-muted">{{trans('s_admin.subject')}} ( {{$data->name}} ) </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('levels.index')}}"
                   class="text-muted">{{trans('s_admin.nav_levels')}}( {{$level->name}} )</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
    <link href="{{url('/')}}/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
@endsection
@section('content')s
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{trans('s_admin.edit_subject')}}</h3>
        </div>
        {{ Form::open( ['route' =>'subjects.update_new','method'=>'post','class'=>'form', 'files'=>'true'] ) }}
        <input type="hidden" name="id" value="{{$data->id}}" required >
        <div class="card-body">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
                <div class="col-lg-9">
                    <input type="text" required class="form-control" id="txt_name_ar" name="name_ar"
                           value="{{$data->name_ar}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
                <div class="col-lg-9">
                    <input type="text" required class="form-control" id="txt_name_en" name="name_en"
                           value="{{$data->name_en}}">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.amount_save_lines')}}</label>
                <div class="col-lg-9">
                    <input type="number" step="any" min="0" required class="form-control" id="txt_amount_num"
                           value="{{$data->amount_num}}"
                           name="amount_num">
                </div>
            </div>
            <div class="form-group row">
                <label
                    class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.class_amount')}}</label>
                <div class="col-lg-9">
                    <input type="number" step="any" required class="form-control" id="txt_class_amount"
                           value="{{$data->class_amount}}"
                           name="class_amount">
                </div>
            </div>
            <h4>{{trans('s_admin.start_subject')}}</h4>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.surah')}}</label>
                <div class="col-lg-9">
                    <select name="from_surah_id" required class="form-control select2" style="width: 100%"
                            id="kt_select2_2">
                        <option selected>{{trans('s_admin.choose_surah')}}</option>
                        @foreach($surah as $row)
                            <option value="{{$row->id}}" @if($data->from_surah_id == $row->id) selected @endif >
                                {{$row->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row" id="tracomy_to_num_cont">
                <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.aya_number')}}</label>
                <div class="col-lg-9">
                    <select required name="from_num" class="form-control form-control-lg"
                            id="cmb_tracomy_to_num">
                        @foreach($from_ayat_num as $row)
                            <option value="{{$row}}" @if($data->from_num == $row) selected @endif >{{$row}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <h4>{{trans('s_admin.end_subject')}}</h4>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.surah')}}</label>
                <div class="col-lg-9">
                    <select name="to_surah_id" id="kt_select2_1" style="width: 100%" required
                            class="form-control form-control-lg select2">
                        <option selected>{{trans('s_admin.choose_surah')}}</option>
                        @foreach($surah as $row)
                            <option value="{{$row->id}}" @if($data->to_surah_id == $row->id) selected @endif >
                                {{$row->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row" id="tracomy_from_num_cont">
                <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.aya_number')}}</label>
                <div class="col-lg-9">
                    <select required name="to_num" class="form-control form-control-lg"
                            id="cmb_tracomy_from_num">
                        @foreach($to_ayat_num as $row)
                            <option value="{{$row}}" @if($data->to_num == $row) selected @endif >{{$row}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn {{auth()->user()->button_color}} mr-2">{{trans('s_admin.edit')}}</button>
        </div>
        {{ Form::close() }}
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_subject_plan.js') }}"></script>
@endsection

