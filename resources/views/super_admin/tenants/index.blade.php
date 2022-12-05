@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.tenants')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <a data-toggle="modal" data-target="#exampleModalLong"
                   class="btn {{auth()->user()->button_color}} px-6 font-weight-bold"><i
                        class="flaticon2-plus"></i> {{trans('s_admin.add_new_tenant')}}</a>
            </div>
            <div class="card-toolbar">
                <div class="d-flex flex-column text-right" id="p1">
                    <span class="text-dark-75 font-weight-bolder font-size-h3">بيانات تسجيل الدخول الاساسية</span>
                    <span class="text-muted font-weight-bold mt-2">email: admin@admin.com</span>
                    <span class="text-muted font-weight-bold mt-2">phone: +966 2020</span>
                    <span class="text-muted font-weight-bold mt-2">password: 123456</span>
                </div>
                <a href="javascript:void(0);" style="margin-right: 20px;" onclick="copyToClipboard('#p1')"
                   class="example-copy" data-toggle="tooltip" title=""
                   data-original-title="نسخ البيانات"><i class="icon-2x text-dark-50 flaticon2-copy"></i> </a>
            </div>
        </div>
        <div class="card-body">

            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('s_admin.name')}}</th>
                    <th title="Field #2">{{trans('s_admin.domain')}}</th>
                    <th title="Field #2">{{trans('s_admin.database')}}</th>
                    <th title="Field #3">{{trans('s_admin.expire_date')}}</th>
                    <th title="Field #2">{{trans('s_admin.creation_date')}}</th>
                    <th title="Field #7">{{trans('s_admin.chooses')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->domain}}</td>
                        <td>{{$row->database}}</td>
                        <td>{{$row->expire_date}}</td>
                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                        <td class="text-center">
                                    <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2"
                                       data-editid="{{$row->id}}" data-name_ar="{{$row->name}}" data-database="{{$row->database}}"
                                       data-expire_date="{{$row->expire_date}}" data-domain="{{$row->domain}}" id="edit"
                                       alt="default" data-toggle="modal" data-target="#edit_model">
                                        <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                                    </a>

                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                               href="{{url('tenants/'.$row->id.'/delete')}}"
                               class='btn btn-icon btn-danger btn-circle btn-sm mr-2'><i class="icon-nm fas fa-trash"
                                                                                         aria-hidden='true'></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->-
    <!-- Store Modal-->
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_new_tenant')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'tenants.store','method'=>'post', 'files'=>'true'] ) }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.domain')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" name="domain">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.database')}}</label>
                            <div class="col-lg-8">
                                <select required name="database" class="form-control form-control-lg">
                                    @foreach($databases as $row)
                                        <option value="{{$row->name}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.expire_date')}}</label>
                            <div class="col-lg-8">
                                <input type="date" required class="form-control" name="expire_date">
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
    {{-- Edit model--}}
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
                    {{ Form::open( ['route' =>'tenants.update','method'=>'post'] ) }}
                    <input type="hidden" required class="form-control" id="txt_id" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" id="txt_name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.expire_date')}}</label>
                            <div class="col-lg-8">
                                <input type="date" required class="form-control" id="txt_expire_date" name="expire_date">
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
        var id;
        $(document).on('click', '#edit', function () {
            id = $(this).data('editid');
            name = $(this).data('name');
            domain = $(this).data('domain');
            database = $(this).data('database');
            expire_date = $(this).data('expire_date');
            $('#txt_id').val(id);
            $('#txt_name').val(name);
            $('#txt_domain').val(domain);
            $('#txt_database').val(database);
            $('#txt_expire_date').val(expire_date);
        });
    </script>

    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
@endsection
