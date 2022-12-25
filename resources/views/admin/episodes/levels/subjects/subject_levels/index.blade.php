@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.subject_levels')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('subjects.show',$subject->level_id)}}"
                   class="text-muted">{{trans('s_admin.subject')}}  @if(app()->getLocale() == 'ar')
                        ( {{$subject->name_ar}} ) @else( {{$subject->name_en}} ) @endif </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('levels.index')}}"
                   class="text-muted">{{trans('s_admin.nav_levels')}}  @if(app()->getLocale() == 'ar')
                        ( {{$subject->Level->name_ar}} )@else ( {{$subject->Level->name_en}} ) @endif</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">

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
                    <th  class="text-center" title="Field #1">#</th>
                    <th  class="text-center" title="Field #1">{{trans('s_admin.name')}}</th>
                    <th  class="text-center" title="Field #2">{{trans('s_admin.amount_save')}}</th>
                    <th class="text-center"  title="Field #2">{{trans('s_admin.creation_date')}}</th>
                    <th  class="text-center" title="Field #7">{{trans('s_admin.daily_plan')}}</th>
                    <th  class="text-center" title="Field #7">{{trans('s_admin.chooses')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td class="text-center" >{{$key + 1}}</td>
                        <td class="text-center" >@if(app()->getLocale() == 'ar'){{$row->name_ar}} @else {{$row->name_en}} @endif</td>
                        <td class="text-center" > @if(app()->getLocale() == 'ar'){{$row->desc_ar}} @else {{$row->desc_en}} @endif </td>
                        <td class="text-center" >{{$row->created_at->format('Y-m-d')}}</td>
                        <td class="text-center" >
                            <a href="{{route('subject_levels_daily_plan.show',$row->id)}}"
                               class="btn btn-dark mr-2">{{trans('s_admin.daily_plan')}}</a>
                        </td>
                        <td  class="text-center" >
                            <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2"
                               data-editid="{{$row->id}}" data-name_ar="{{$row->name_ar}}"
                               data-name_en="{{$row->name_en}}"
                               data-desc_ar="{{$row->desc_ar}}" data-desc_en="{{$row->desc_en}}"
                               data-num_lines="{{$row->num_lines}}"
                               data-num_ayat="{{$row->num_ayat}}" data-num_faces="{{$row->num_faces}}"
                               id="edit" alt="default" data-toggle="modal" data-target="#edit_model">
                                <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                               href="{{route('subjects_levels.delete',$row->id)}}"
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
    <!--end::Card-->-
    <!-- Modal-->
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_new_subject_level')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'subject_levels.store','method'=>'post', 'files'=>'true'] ) }}
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
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_save_ar')}}</label>
                            <div class="col-lg-7">
                                <input type="text" required class="form-control" readonly
                                       value="حفظ {{$subject->amount_num}} أسطر يوميا" name="desc_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_save_en')}}</label>
                            <div class="col-lg-7">
                                <input type="text" required class="form-control" readonly
                                       value="save {{$subject->amount_num}} lines daily" name="desc_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_with_lines')}}</label>
                            <div class="col-lg-7">
                                <input type="number" step="any" required class="form-control" readonly
                                       value="{{$subject->amount_num}}" name="num_lines">
                            </div>
                        </div>
                        @php $faces =  number_format((float) $subject->amount_num / 15, 1, '.', '');  @endphp
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_with_faces')}}</label>
                            <div class="col-lg-7">
                                <input type="number" step="any" class="form-control" value="{{$faces}}" readonly name="num_faces">
                            </div>
                        </div>

                        <input type="hidden" name="subject_id" value="{{$subject_id}}">
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
                    {{ Form::open( ['route' =>'subject_levels.update_new','method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" id="txt_id" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" id="txt_name_ar" name="name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" id="txt_name_en" name="name_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_save_ar')}}</label>
                            <div class="col-lg-7">
                                <input type="text" required readonly class="form-control" id="txt_desc_ar"
                                       name="desc_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_save_en')}}</label>
                            <div class="col-lg-7">
                                <input type="text" required readonly class="form-control" id="txt_desc_en"
                                       name="desc_en">
                            </div>
                        </div>

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_with_ayat')}}</label>--}}
                        {{--                            <div class="col-lg-7">--}}
                        {{--                                <input type="number" required class="form-control" id="txt_num_ayat" name="num_ayat">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_with_lines')}}</label>
                            <div class="col-lg-7">
                                <input type="number" step="any" required readonly class="form-control" id="txt_num_lines"
                                       name="num_lines">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-5 col-form-label text-lg-right">{{trans('s_admin.amount_with_faces')}}</label>
                            <div class="col-lg-7">
                                <input type="number"  step="any" required readonly class="form-control" id="txt_num_faces"
                                       name="num_faces">
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
    <script>
        $(document).on('click', '#edit', function () {
            var id = $(this).data('editid');
            var name_ar = $(this).data('name_ar');
            var name_en = $(this).data('name_en');
            var desc_ar = $(this).data('desc_ar');
            var desc_en = $(this).data('desc_en');
            var num_lines = $(this).data('num_lines');
            // var num_ayat = $(this).data('num_ayat');
            var num_faces = $(this).data('num_faces');
            $('#txt_id').val(id);
            $('#txt_name_ar').val(name_ar);
            $('#txt_name_en').val(name_en);
            $('#txt_desc_ar').val(desc_ar);
            $('#txt_desc_en').val(desc_en);
            // $('#txt_num_ayat').val(num_ayat);
            $('#txt_num_lines').val(num_lines);
            $('#txt_num_faces').val(num_faces);
        });
    </script>
@endsection
