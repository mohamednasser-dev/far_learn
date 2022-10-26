@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_public_settings')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.settings')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('metronic/assets/css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header card-header-tabs-line">
            <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       href="#kt_builder_themes">{{trans('s_admin.general')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_builder_page">{{trans('s_admin.social_media')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#kt_logo_themes">{{trans('s_admin.admin_website_logo')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#kt_hide_page">{{trans('s_admin.hide_show')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"
                       href="#kt_app_color">{{trans('s_admin.app_color')}}</a>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" data-toggle="tab"--}}
                {{--                       href="#kt_color_themes">{{trans('s_admin.admin_website_color')}}</a>--}}
                {{--                </li>--}}
            </ul>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
    {!! Form::model($data, ['route' => ['web_settings.update',1] , 'method'=>'put' ,'files'=> true]) !!}
    <!--begin::Body-->
        <div class="card-body">
            <div class="tab-content pt-3">
                <!--begin::Tab Pane-->
                <div class="tab-pane active" id="kt_builder_themes">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.website_title')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group input-group-solid">
                                <input type="text" required name="title_ar" placeholder="بالعربية"
                                       value="{{$data->title_ar}}" class="form-control form-control-solid"
                                       value="website_title">
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group input-group-solid">
                                <input type="text" required name="title_en" value="{{$data->title_en}}"
                                       placeholder="English" class="form-control form-control-solid"
                                       value="website_title">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.phone')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group input-group-solid">
                                <div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-phone"></i>
										</span>
                                </div>
                                <input type="text" required name="phone" value="{{$data->phone}}"
                                       class="form-control form-control-solid" value="+45678967456">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.email')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group input-group-solid">
                                <div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-at"></i>
										</span>
                                </div>
                                <input type="email" required name="email" value="{{$data->email}}"
                                       class="form-control form-control-solid" value="nick.watson@loop.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.address')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <input type="text" required name="address_ar" value="{{$data->address_ar}}"
                                   placeholder="بالعربية" class="form-control">
                        </div>
                        <div class="col-lg-9 col-xl-4">
                            <input type="text" required name="address_en" value="{{$data->address_en}}"
                                   placeholder="English" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('admin.who_are_us')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <input type="text" name="about_ar" value="{{$data->about_ar}}"
                                   placeholder="بالعربية" class="form-control">
                        </div>
                        <div class="col-lg-9 col-xl-4">
                            <input type="text" name="about_en" value="{{$data->about_en}}"
                                   placeholder="English" class="form-control">
                        </div>
                    </div>
                </div>
                <!--end::Tab Pane-->
                <!--begin::Tab Pane-->
                <div class="tab-pane" id="kt_builder_page">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">facebook :</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-chain"></i>
										</span>
                                </div>
                                <input type="url" name="facebook" value="{{$data->facebook}}"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">twiter :</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-chain"></i>
										</span>
                                </div>
                                <input type="url" name="twiter" value="{{$data->twiter}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">youtube :</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-chain"></i>
										</span>
                                </div>
                                <input type="url" name="youtube" value="{{$data->youtube}}"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">instegram :</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-chain"></i>
										</span>
                                </div>
                                <input type="url" name="insta" value="{{$data->insta}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">linked in :</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
										<span class="input-group-text">
											<i class="la la-chain"></i>
										</span>
                                </div>
                                <input type="url" name="linked_in" value="{{$data->linked_in}}"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="kt_color_themes">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.head_color')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <input class="form-control" type="color" name="color" value="{{$data->color}}"
                                   id="example-color-input">
                        </div>
                    </div>
                    {{--                    <div class="form-group row">--}}
                    {{--                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.sidebar_color')}}</label>--}}
                    {{--                        <div class="col-lg-9 col-xl-4">--}}
                    {{--                            <input class="form-control" type="color" name="color_side_bar" value="{{$data->color}}" id="example-color-input">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
                <div class="tab-pane" id="kt_logo_themes">
                    <div class="form-group row">
                        <div class="col-lg-6 col-xl-4">
                            <label class="col-lg-12 col-form-label text-lg-left">{{trans('s_admin.arabic')}}</label>
                            <div class="image-input image-input-empty image-input-outline" id="kt_user_edit_avatar"
                                 style="background-image: url(/uploads/logo/{{$data->logo_ar}})">
                                <div class="image-input-wrapper"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="{{trans('s_admin.change_logo')}}">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="logo_ar" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" name="profile_avatar_remove">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="cancel" data-toggle="tooltip" title=""
                                      data-original-title="{{trans('s_admin.cancel_logo')}}">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="remove" data-toggle="tooltip" title=""
                                      data-original-title="Remove avatar">
									<i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <label class="col-lg-12 col-form-label text-lg-left">{{trans('s_admin.english')}}</label>
                            <div class="image-input image-input-empty image-input-outline" id="kt_user_edit_avatar_en"
                                 style="background-image: url(/uploads/logo/{{$data->logo_en}})">
                                <div class="image-input-wrapper"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="{{trans('s_admin.change_logo')}}">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="logo_en" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" name="profile_avatar_remove">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="cancel" data-toggle="tooltip" title=""
                                      data-original-title="{{trans('s_admin.cancel_logo')}}">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="remove" data-toggle="tooltip" title=""
                                      data-original-title="Remove avatar">
									<i class="ki ki-bold-close icon-xs text-muted"></i>
								</span>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="tab-pane" id="kt_hide_page">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.mogmaa_dorr')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="switch">
                                <label>
                                    <input type="checkbox"
                                           name="show_mogmaa_dorr" @php if( $data->show_mogmaa_dorr == '1') echo "checked"; @endphp>
                                    <span class="lever switch-col-indigo"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('admin.search_teacher')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="switch">
                                <label>
                                    <input type="checkbox"
                                           name="show_search_teacher" @php if( $data->show_search_teacher == '1') echo "checked"; @endphp>
                                    <span class="lever switch-col-indigo"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.free_far_learn')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="switch">
                                <label>
                                    <input type="checkbox"
                                           name="show_free_subject" @php if( $data->show_free_subject == '1') echo "checked"; @endphp>
                                    <span class="lever switch-col-indigo"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.fixed_far_learn')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="switch">
                                <label>
                                    <input type="checkbox"
                                           name="show_fixed_subject" @php if( $data->show_fixed_subject == '1') echo "checked"; @endphp>
                                    <span class="lever switch-col-indigo"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.tracher_rating')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="switch">
                                <label>
                                    <input type="checkbox"
                                           name="rating" @php if( $data->rating == '1') echo "checked"; @endphp>
                                    <span class="lever switch-col-indigo"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="kt_app_color">
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.app_main_color')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <input class="form-control" type="color" name="app_main_color"
                                   value="{{$data->app_main_color}}" id="example-color-input"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.app_second_color')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <input class="form-control" type="color" name="app_second_color"
                                   value="{{$data->app_second_color}}" id="example-color-input"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.app_background_color')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <input class="form-control" type="color" name="app_background_color"
                                   value="{{$data->app_background_color}}" id="example-color-input"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.app_button_color')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <input class="form-control" type="color" name="app_button_color"
                                   value="{{$data->app_button_color}}" id="example-color-input"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.app_font_light_color')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <input class="form-control" type="color" name="app_font_light_color"
                                   value="{{$data->app_font_light_color}}" id="example-color-input"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.app_font_dark_color')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <input class="form-control" type="color" name="app_font_dark_color"
                                   value="{{$data->app_font_dark_color}}" id="example-color-input"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.app_icon_color')}} </label>
                        <div class="col-lg-9 col-xl-4">
                            <input class="form-control" type="color" name="app_icon_color"
                                   value="{{$data->app_icon_color}}" id="example-color-input"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-9">
                    <button type="submit" data-demo="demo1"
                            class="btn btn-primary font-weight-bold mr-2">{{trans('s_admin.save')}}</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
@section('scripts')

    <script>
        var avatar1 = new KTImageInput('kt_user_edit_avatar');
        var avatar2 = new KTImageInput('kt_user_edit_avatar_en');
    </script>
@endsection
