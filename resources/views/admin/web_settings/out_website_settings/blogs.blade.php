@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_blogs')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_out_website_settings')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.settings')}}</a>
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
{{--                @can('add')--}}
                <a data-toggle="modal" data-target="#exampleModalLong" class="btn btn-light-primary px-6 font-weight-bold">{{trans('s_admin.add')}}</a>
{{--            @endcan--}}
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..."
                                           id="kt_datatable_search_query"/>
                                    <span><i class="flaticon2-search-1 text-muted"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">

                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">{{trans('s_admin.image')}}</th>
                    <th title="Field #2">{{trans('s_admin.title_ar')}}</th>
                    <th title="Field #3">{{trans('s_admin.title_en')}}</th>
                    <th title="Field #6">{{trans('s_admin.date')}}</th>
                    <th title="Field #7">{{trans('s_admin.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td><img src="{{ url($blog->image) }}" style="width:75px;height:75px;"/></td>
                        <td>{{$blog->title_ar}}</td>
                        <td>{{$blog->title_en}}</td>
                        <td>{{$blog->created_at->format('Y-m-d')}}</td>
                        <td class="text-center">
                            <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2"
                               data-editid="{{$blog->id}}" data-desc_ar="{{$blog->desc_ar}}" data-image="{{$blog->image}}"
                               data-desc_en="{{$blog->desc_en}}" data-name_ar="{{$blog->title_ar}}" data-name_en="{{$blog->title_en}}" id="edit"
                               alt="default" data-toggle="modal" data-target="#edit_model">
                                <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <form method="get" id='delete-form-{{ $blog->id }}' action="{{url('blogs/'.$blog->id.'/delete')}}" style='display: none;'>
                            {{csrf_field()}}
                            <!-- {{method_field('delete')}} -->
                            </form>
                            <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                {
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $blog->id }}').submit();
                                }else {
                                event.preventDefault();
                                }"
                                    class='btn btn-icon btn-danger btn-circle btn-sm mr-2' href=" "><i
                                    class="fa fa-trash" aria-hidden='true'>
                                </i>
                            </button>
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
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_blog')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['url' => ['blogs'],'method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.title_ar')}}</label>
                                <div class="col-lg-8">
                                    <input type="text" required class="form-control"  name="title_ar">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.title_en')}}</label>
                                <div class="col-lg-8">
                                    <input type="text" required class="form-control"  name="title_en">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.desc_ar')}}</label>
                                <div class="col-lg-8">
                                    <textarea name="desc_ar" required class="form-control" id="exampleTextarea" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.desc_ar')}}</label>
                                <div class="col-lg-8">
                                    <textarea name="desc_en" required class="form-control" id="exampleTextarea" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.image')}}</label>
                                <div class="col-lg-8">
                                    <div class="uppy" id="kt_uppy_5">
                                        <div class="uppy-wrapper">
                                            <div class="uppy-Root uppy-FileInput-container">
                                                <input required class="uppy-FileInput-input uppy-input-control" style="" type="file" name="image" multiple="" id="kt_uppy_5_input_control">
                                                <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_control">
                                                    {{trans('s_admin.choose_file')}}</label>
                                            </div>
                                        </div>
                                        <div class="uppy-list"></div>
                                        <div class="uppy-status"><div class="uppy-Root uppy-StatusBar is-waiting" aria-hidden="true">
                                                <div class="uppy-StatusBar-progress
                           " style="width: 0%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"></div>
                                                <div class="uppy-StatusBar-actions"></div></div></div>
                                        <div class="uppy-informer uppy-informer-min"><div class="uppy uppy-Informer" aria-hidden="true"><p role="alert"> </p></div></div>
                                    </div>
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
                    {{ Form::open( ['route' => ['blogs.update_new'],'method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" id="txt_id" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.title_ar')}}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="txt_title_ar" name="title_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.title_en')}}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="txt_title_en" name="title_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.desc_ar')}}</label>
                            <div class="col-lg-8">
                                <textarea name="desc_ar" class="form-control" id="txt_desc_ar" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.desc_en')}}</label>
                            <div class="col-lg-8">
                                <textarea name="desc_en" class="form-control" id="txt_desc_en" rows="3" ></textarea>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.image')}} &nbsp;715*1920 </label>
                            <div class="col-lg-8">
                                <input type="file"  class="btn btn-primary" name="image">
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
            desc_ar = $(this).data('desc_ar');
            desc_en = $(this).data('desc_en');
            image = $(this).data('image');
            $('#txt_id').val(id);
            $('#txt_title_ar').val(name_ar);
            $('#txt_title_en').val(name_en);
            $('#txt_desc_ar').val(desc_ar);
            $('#txt_desc_en').val(desc_en);
        });
    </script>
@endsection

