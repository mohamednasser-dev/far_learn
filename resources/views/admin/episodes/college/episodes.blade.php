
@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_electronic_chanel')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        @if(request()->segment(3) != 'mqraa')
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                @if(Route::current()->getName() == 'colleges.show')
                    <li class="breadcrumb-item">
                        <a  href="{{route('colleges.index')}}" class="text-muted">{{trans('s_admin.colleges')}}</a>
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a  href="{{route('dorr.index')}}" class="text-muted">{{trans('s_admin.dorrs')}}</a>
                    </li>
                @endif
            </ul>
        @endif
    </div>
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                    @if(Route::current()->getName() == 'colleges.show')
                        <a href="{{route('colleges.episodes.create_custom',$college_id)}}" class="btn btn-success px-6 font-weight-bold"><i class="flaticon2-plus"></i> {{trans('s_admin.add_colleg_eposide')}}</a>
                    @elseif(Route::current()->getName() == 'dorr.show')
                        <a href="{{route('dorrs.episodes.create_custom',$college_id)}}" class="btn btn-success px-6 font-weight-bold"><i class="flaticon2-plus"></i> {{trans('s_admin.add_colleg_eposide')}}</a>
                    @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('s_admin.episode_name')}}</th>
                    @if(Route::current()->getName() == 'colleges.show')
                        <th title="Field #1">{{trans('s_admin.mogmaa_name')}}</th>
                    @elseif(Route::current()->getName() == 'dorr.show')
                        <th title="Field #1">{{trans('s_admin.dorrs_name')}}</th>
                    @endif
                    <th title="Field #7">{{trans('s_admin.gender')}}</th>
                    <th>{{trans('s_admin.episode_students')}}</th>
                    <th>{{trans('s_admin.activation')}}</th>
                    <th title="Field #7">{{trans('s_admin.chooses')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            @if(app()->getLocale() == 'ar')
                                {{$row->name_ar}}
                            @else
                                {{$row->name_en}}
                            @endif
                        </td>
                        <td>
                            @if(app()->getLocale() == 'ar')
                                {{$row->Mogmaa->name_ar}}
                            @else
                                {{$row->Mogmaa->name_en}}
                            @endif
                        </td>
                        <td>
                            @if($row->gender == 'male')
                                {{trans('admin.male')}}
                            @elseif($row->gender == 'female')
                                {{trans('admin.female')}}
                            @endif
                        </td>
                        <td>
                            <a href="{{route('episode.students',$row->id)}}"
                               class="btn btn-info btn-circle">
                                {{trans('s_admin.students')}} ( {{count($row->Students)}} )
                            </a>
                        </td>
                        <td class="text-center">
                                <span class="switch switch-icon">
                                    <label>
                                        <input onchange="update_active(this)" value="{{ $row->id }}"
                                               type="checkbox" <?php if ($row->active == 'y') echo "checked";?>>
                                        <span></span>
                                    </label>
                                </span>
                        </td>
                        {{--                        <td>{{$row->created_at->format('Y-m-d')}}</td>--}}
                        <td>
                            <a href="{{route('episode.details',$row->id)}}" class="btn btn-icon btn-warning btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-eye" aria-hidden='true'></i>
                            </a>
                            <a href="{{route('episode.edit',$row->id)}}" class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-pencil-alt" aria-hidden='true'></i>
                            </a>
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')" href="{{route('episode.delete',$row->id)}}" class="btn btn-icon btn-danger btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-trash" aria-hidden='true'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.add_slider')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['url' => ['sliders'],'method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.title_ar')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" placeholder="Enter full name" name="title_ar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.title_en')}}</label>
                            <div class="col-lg-8">
                                <input type="text" required class="form-control" placeholder="Enter full name" name="title_en">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.desc_ar')}}</label>
                            <div class="col-lg-8">
                                <textarea name="desc_ar" required class="form-control" id="exampleTextarea" rows="3" placeholder="Please enter your message"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.desc_ar')}}</label>
                            <div class="col-lg-8">
                                <textarea name="desc_en" required class="form-control" id="exampleTextarea" rows="3" placeholder="Please enter your message"></textarea>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.image')}} &nbsp;715*1920 </label>
                            <div class="col-lg-8">
                                <div class="uppy" id="kt_uppy_5">
                                    <div class="uppy-wrapper"><div class="uppy-Root uppy-FileInput-container"><input class="uppy-FileInput-input uppy-input-control" style="" type="file" name="image" multiple="" id="kt_uppy_5_input_control"><label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_control">{{trans('s_admin.choose_file')}}</label></div></div>
                                    <div class="uppy-list"></div>
                                    <div class="uppy-status"><div class="uppy-Root uppy-StatusBar is-waiting" aria-hidden="true"><div class="uppy-StatusBar-progress
                           " style="width: 0%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"></div><div class="uppy-StatusBar-actions"></div></div></div>
                                    <div class="uppy-informer uppy-informer-min"><div class="uppy uppy-Informer" aria-hidden="true"><p role="alert"> </p></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function update_active(el){
            if(el.checked){
                var status = 'y';
            }
            else{
                var status = 'n';
            }
            $.post('{{ route('episode.change_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success("{{trans('s_admin.statuschanged')}}");
                }
                else{
                    toastr.error("{{trans('s_admin.statuschanged')}}");
                }
            });
        }
    </script>
@endsection

