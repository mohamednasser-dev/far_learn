<!--begin::Content-->

<div class="flex-row-fluid ml-lg-8">
    {!! Form::model($data, ['route' => ['teacher.profile'] , 'method'=>'post' ,'files'=> true]) !!}
    <div class="card card-custom card-stretch">
        <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">{{trans('s_admin.personal_info')}}</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{trans('s_admin.update_personal_info')}}</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.save_changes')}}</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mb-6">{{trans('s_admin.date_include_to_work')}} : {{$data->created_at->format('Y-m-d')}}</h5>
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <label class="col-xl-3"></label>--}}
{{--                    <div class="col-lg-9 col-xl-6">--}}
{{--                        <h5 class="font-weight-bold mb-6">{{trans('admin.user_name')}} : {{$data->unique_name}}</h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('s_admin.personal_image')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        @if($data->image == null)
                        <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(/uploads/users_images/blank.png)">
                            <div class="image-input-wrapper" style="background-image: url(/uploads/users_images/blank.png)"></div>
                        @else
                            <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url({{$data->image}})">
                                <div class="image-input-wrapper" style="background-image: url({{$data->image}})"></div>
                        @endif
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('s_admin.choose_image')}}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="{{trans('s_admin.cancel')}}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="{{trans('s_admin.remove_image')}}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.first_name')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input required class="form-control form-control-lg form-control-solid" value="{{$data->first_name_ar}}" type="text" name="first_name_ar" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.mid_name')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input required class="form-control form-control-lg form-control-solid" value="{{$data->mid_name_ar}}" type="text" name="mid_name_ar" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.last_name')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input required class="form-control form-control-lg form-control-solid" value="{{$data->last_name_ar}}" type="text" name="last_name_ar" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-2 col-lg-2 col-form-label" style="padding-top: 40px;">{{trans('s_admin.bio')}}</label>
                    <div class="col-lg-5 col-xl-5">
                        <p class="form-control-plaintext text-muted">{{trans('s_admin.arabic')}}</p>
                        <textarea name="bio_ar" class="form-control" id="exampleTextarea" rows="3"> {{$data->bio_ar}} </textarea>
                    </div>
                    <div class="col-lg-5 col-xl-5">
                        <p class="form-control-plaintext text-muted">{{trans('s_admin.english')}}</p>
                        <textarea name="bio_en" class="form-control" id="exampleTextarea" rows="3"> {{$data->bio_en}} </textarea>
                    </div>
                </div>
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mt-10 mb-6">{{trans('s_admin.contact_data')}}</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.phone')}}</label>
                    <div class="col-lg-7 col-xl-5">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-phone"></i>
                                </span>
                            </div>
                            <input type="text" readonly value="{{$data->phone}}" class="form-control form-control-lg form-control-solid" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-xl-1">
                        <input id="txt_country_code" readonly class="form-control form-control-lg form-control-solid" value="{{$data->country_code}}" type="text" name="country_code" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.date_of_birth')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <input type="text" name="date_of_birth" value="{{Carbon\Carbon::parse($data->date_of_birth)->format('d-m-Y')}}" class="form-control form-control-lg form-control-solid hijri-date-input" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.email')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-at"></i>
                                </span>
                            </div>
                            <input type="email" readonly value="{{$data->email}}" class="form-control form-control-lg form-control-solid" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.gender')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <select required class="form-control form-control-lg form-control-solid" name="gender">
                            <option value="male" @if($data->gender == 'male') selected @endif > {{trans('admin.male')}} </option>
                            <option value="female" @if($data->gender == 'female') selected @endif > {{trans('admin.female')}} </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.lang')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <select name="main_lang" class="form-control form-control-lg form-control-solid">
                            <option>{{trans('s_admin.choose_language')}}</option>
                            <option value="en" @if($data->main_lang == 'en') selected @endif >English</option>
                            <option value="ar" @if($data->main_lang == 'ar') selected @endif >العربية</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('s_admin.ident_num')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <input required type="number" name="ident_num" value="{{$data->ident_num}}" class="form-control form-control-lg form-control-solid" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('s_admin.save_quran_num')}}</label>
                    <div class="col-lg-7 col-xl-6">
                        <input required type="number" step="any" name="save_quran_num" min="0" max="30" value="{{$data->save_quran_num}}" class="form-control form-control-lg form-control-solid" />
                    </div>
                    <label class="col-xl-2 col-lg-2 col-form-label">{{trans('s_admin.gzaa')}}</label>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('s_admin.i_pan')}}</label>
                    <div class="col-lg-7 col-xl-6">
                        <input required type="text" name="i_pan" value="{{$data->i_pan}}" class="form-control form-control-lg form-control-solid"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('s_admin.nationality')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        @php $nationalities = \App\Models\Nationality::where('deleted','0')->get(); @endphp
                        <select name="nationality" required class="form-control form-control-lg form-control-solid">
                            <option>{{trans('s_admin.choose_nationality')}}</option>
                            @foreach($nationalities as $row)
                                @if($data->nationality == $row->id)
                                    <option value="{{$row->id}}" selected>
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @else
                                    <option value="{{$row->id}}">
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('s_admin.qualification')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        @php $qualifications = \App\Models\Qualification::where('deleted','0')->get(); @endphp
                        <select name="qualification" required class="form-control form-control-lg form-control-solid">
                            <option>{{trans('s_admin.choose_qualification')}}</option>
                            @foreach($qualifications as $row)
                                @if($data->qualification == $row->id)
                                    <option value="{{$row->id}}" selected>
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @else
                                    <option value="{{$row->id}}">
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.country')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        @php $countries = \App\Models\Country::where('deleted','0')->get(); @endphp
                        <select name="Country" required class="form-control form-control-lg form-control-solid">
                            <option>{{trans('s_admin.choose_country')}}</option>
                            @foreach($countries as $row)
                                @if($data->country == $row->id)
                                    <option value="{{$row->id}}" selected>
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @else
                                    <option value="{{$row->id}}">
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.job_name')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        @php  $jobnames = \App\Models\Job_name::where('deleted','0')->get(); @endphp
                        <select name="Job_name" required class="form-control form-control-lg form-control-solid">
                            <option>{{trans('s_admin.choose_Job_name')}}</option>
                            @foreach($jobnames as $row)
                                @if($data->job_name == $row->id)
                                    <option value="{{$row->id}}" selected>
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @else
                                    <option value="{{$row->id}}">
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->name_ar}}
                                        @else
                                            {{$row->name_en}}
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.save_changes')}}</button>
            </div>
        </div>
    {{ Form::close() }}
</div>
