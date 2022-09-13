@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_subjects')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('levels.index')}}"
                   class="text-muted">{{trans('s_admin.nav_levels')}}  @if(app()->getLocale() == 'ar')
                        ( {{$level->name_ar}} )@else ( {{$level->name_en}} )@endif</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h4></h4>
            </div>
            <div class="card-toolbar">
{{--                @can("add")--}}
                    <a data-toggle="modal" data-target="#exampleModalLong"
                       class="btn btn-success px-6 font-weight-bold"><i
                            class="flaticon2-plus"></i> {{trans('s_admin.add')}}</a>
{{--                @endcan--}}
            </div>
        </div>
        <div class="card-body">

            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('s_admin.name')}}</th>
                    <th title="Field #2">{{trans('s_admin.amount_save')}}</th>
                    {{--                    <th title="Field #2">{{trans('s_admin.level')}}</th>--}}
                    <th title="Field #3">{{trans('s_admin.evaluation_info')}}</th>
                    <th title="Field #3">{{trans('s_admin.subject_levels')}}</th>
                    <th title="Field #7">{{trans('s_admin.chooses')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td> @if(app()->getLocale() == 'ar'){{$row->name_ar}} @else {{$row->name_en}} @endif </td>
                        <td> {{$row->amount_num}} </td>
                        {{--                        <td>{{$row->Level->name_ar}}</td>--}}
                        <td>
                            <a href="{{route('subject_evaluation.show',$row->id)}}"
                               class="btn btn-info mr-2">{{trans('s_admin.the_evaluation')}}</a>
                        </td>
                        <td>
                            <a href="{{route('subject_levels.show',$row->id)}}"
                               class="btn btn-dark mr-2">{{trans('s_admin.subject_levels')}}</a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2"
                               data-editid="{{$row->id}}" data-name_ar="{{$row->name_ar}}"
                               data-name_en="{{$row->name_en}}" data-desc_ar="{{$row->desc_ar}}"
                               data-desc_en="{{$row->desc_en}}" data-amount-num="{{$row->amount_num}}"
                               data-class_amount="{{$row->class_amount}}" data-from_surah_id="{{$row->from_surah_id}}"
                               data-from_num="{{$row->from_num}}"
                               data-to_surah_id="{{$row->to_surah_id}}" data-to_num="{{$row->to_num}}" id="edit"
                               alt="default" data-toggle="modal" data-target="#edit_model">
                                <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                               href="{{route('subjectss.delete',$row->id)}}"
                               class="btn btn-icon btn-danger btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-trash" aria-hidden='true'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    @php
        $surah = \App\Models\Plan\Plan_surah::where('deleted','0')->get();
    @endphp
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_new_subject')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'subjects.store','method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" name="level_id" value="{{$id}}">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
                            <div class="col-lg-7">
                                <input type="text" required class="form-control" name="name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
                            <div class="col-lg-7">
                                <input type="text" required class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_save_lines')}}</label>
                            <div class="col-lg-7">
                                <input type="number" step="any" min="0" required class="form-control" name="amount_num">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.class_amount')}}</label>
                            <div class="col-lg-7">
                                <input type="number" step="any" required class="form-control" name="class_amount">
                            </div>
                        </div>
                        <h4>{{trans('s_admin.start_subject')}}</h4>
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.surah')}}</label>
                            <div class="col-lg-7">
                                <select name="from_surah_id" required class="form-control select2" id="kt_select2_4">
                                    <option selected>{{trans('s_admin.choose_surah')}}</option>
                                    @foreach($surah as $row)
                                        <option value="{{$row->id}}">
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->name_ar}}
                                            @else
                                                {{$row->name_en}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="new_from_num_cont" style="display: none;">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.aya_number')}}</label>
                            <div class="col-lg-7">
                                <select required name="from_num" class="form-control form-control-lg"
                                        id="cmb_new_from_num">
                                </select>
                            </div>
                        </div>
                        <h4>{{trans('s_admin.end_subject')}}</h4>
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.surah')}}</label>
                            <div class="col-lg-7">
                                <select name="to_surah_id" required class="form-control select2" id="kt_select2_5">
                                    <option selected>{{trans('s_admin.choose_surah')}}</option>
                                    @foreach($surah as $row)
                                        <option value="{{$row->id}}">
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->name_ar}}
                                            @else
                                                {{$row->name_en}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="new_to_num_cont" style="display: none;">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.aya_number')}}</label>
                            <div class="col-lg-7">
                                <select required id="cmb_new_to_num" name="to_num" class="form-control form-control-lg">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}
                        </button>
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
    {{--    edit model--}}
    <div class="modal fade" id="edit_model" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'subjects.update_new','method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" id="txt_id" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
                            <div class="col-lg-7">
                                <input type="text" required class="form-control" id="txt_name_ar" name="name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
                            <div class="col-lg-7">
                                <input type="text" requi0red class="form-control" id="txt_name_en" name="name_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_save_lines')}}</label>
                            <div class="col-lg-7">
                                <input type="number" step="any" min="0" required class="form-control" id="txt_amount_num"
                                       name="amount_num">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.class_amount')}}</label>
                            <div class="col-lg-7">
                                <input type="number" step="any" step="any" required class="form-control" id="txt_class_amount"
                                       name="class_amount">
                            </div>
                        </div>
                        <h4>{{trans('s_admin.start_subject')}}</h4>
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.surah')}}</label>
                            <div class="col-lg-7">
                                <select name="from_surah_id" required class="form-control select2" id="kt_select2_2">
                                    <option selected>{{trans('s_admin.choose_surah')}}</option>
                                    @foreach($surah as $row)
                                        <option value="{{$row->id}}">
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->name_ar}}
                                            @else
                                                {{$row->name_en}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="tracomy_to_num_cont">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.aya_number')}}</label>
                            <div class="col-lg-7">
                                <select required name="from_num" class="form-control form-control-lg"
                                        id="cmb_tracomy_to_num">
                                </select>
                            </div>
                        </div>
                        <h4>{{trans('s_admin.end_subject')}}</h4>
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.surah')}}</label>
                            <div class="col-lg-7">
                                <select name="to_surah_id" id="kt_select2_1" va required
                                        class="form-control form-control-lg">
                                    <option selected>{{trans('s_admin.choose_surah')}}</option>
                                    @foreach($surah as $row)
                                        <option value="{{$row->id}}">
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->name_ar}}
                                            @else
                                                {{$row->name_en}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="tracomy_from_num_cont">
                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.aya_number')}}</label>
                            <div class="col-lg-7">
                                <select required name="to_num" class="form-control form-control-lg"
                                        id="cmb_tracomy_from_num">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.edit')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_subject_plan.js') }}"></script>
    <script>
        var id;
        $(document).on('click', '#edit', function () {
            id = $(this).data('editid');
            name_ar = $(this).data('name_ar');
            name_en = $(this).data('name_en');
            amount_num = $(this).data('amount-num');

            class_amount = $(this).data('class_amount');
            from_surah_id = $(this).data('from_surah_id');
            from_num = $(this).data('from_num');
            to_surah_id = $(this).data('to_surah_id');
            to_num = $(this).data('to_num');

            $('#txt_id').val(id);
            $('#txt_name_ar').val(name_ar);
            $('#txt_name_en').val(name_en);
            $('#txt_amount_num').val(amount_num);

            $('#txt_class_amount').val(class_amount);
            $('#kt_select2_2').val(from_surah_id);
            $('#cmb_new_from_num').val(from_num);
            $('#kt_select2_1').val(to_surah_id);
            $('#cmb_new_to_num').val(to_num);
        });
    </script>
@endsection
