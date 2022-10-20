@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.quran_suar')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
            </div>
            <div class="card-toolbar">
{{--                @can('add')--}}
                <a data-toggle="modal" data-target="#exampleModalLong" class="btn {{auth()->user()->button_color}} px-6 font-weight-bold"><i class="flaticon2-plus"></i> {{trans('s_admin.add')}}</a>
{{--            @endcan--}}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('s_admin.name_ar')}}</th>
                    <th title="Field #2">{{trans('s_admin.name_en')}}</th>
                    <th title="Field #2">{{trans('s_admin.ayat_num')}}</th>
                    <th title="Field #2">{{trans('s_admin.creation_date')}}</th>
                    <th title="Field #7">{{trans('s_admin.chooses')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$row->name_ar}}</td>
                        <td>{{$row->name_en}}</td>
                        <td>{{$row->ayat_num}}</td>
                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                        <td>
                            <a data-editid="{{$row->id}}" data-name_ar="{{$row->name_ar}}" data-name_en="{{$row->name_en}}" data-ayat_num="{{$row->ayat_num}}" id="edit"
                               alt="default" data-toggle="modal" data-target="#edit_model"
                               class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')" class="btn btn-icon btn-danger btn-circle btn-sm mr-2"  href="{{route('settings.episodes.suar.delete',$row->id)}}">
                                <i class="icon-nm fas fa-trash" aria-hidden='true'>
                                </i>
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
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'settings.episodes.suar.store','method'=>'post', 'files'=>'true'] ) }}

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control"  name="name_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control"  name="name_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.ayat_num')}}</label>
                            <div class="col-lg-8">
                                <input type="number" min="1" required class="form-control"  name="ayat_num">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{trans('s_admin.cancel')}}
                        </button>
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>

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
                    {{ Form::open( ['route' =>'settings.episodes.suar.update','method'=>'post', 'files'=>'true'] ) }}
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
                                <input type="text" required class="form-control" id="txt_name_en"  name="name_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.ayat_num')}}</label>
                            <div class="col-lg-8">
                                <input type="number" min="1" required class="form-control" id="txt_ayat_num" name="ayat_num">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.edit')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var id;
        $(document).on('click', '#edit', function () {
            id = $(this).data('editid');
            name_ar = $(this).data('name_ar');
            name_en = $(this).data('name_en');
            ayat_num = $(this).data('ayat_num');
            $('#txt_id').val(id);
            $('#txt_name_ar').val(name_ar);
            $('#txt_name_en').val(name_en);
            $('#txt_ayat_num').val(ayat_num);
        });
    </script>
@endsection


