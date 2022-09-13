@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_certifcates')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('episode.details.certificates',$episode->id)}}" class="text-muted">{{trans('s_admin.episode_students')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('episode.details',$episode->id)}}" class="text-muted">{{trans('s_admin.details')}}</a>
            </li>
            <li class="breadcrumb-item">
                @if($episode->type == 'mqraa')
                    <a href="{{route('episode.show.type','mqraa')}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                @elseif($episode->type == 'mogmaa')
                    <a href="{{route('colleges.show',$episode->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                @elseif($episode->type == 'mogmaa')
                    <a href="{{route('dorr.show',$episode->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                @endif
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <form action="{{route('episode.export.certificates')}}" method="post" style="width: 800px;height: 566px;
            @if($student->gender == 'male')
                background-image: url(/uploads/certificate/certificates.jpg);
            @else
                background-image: url(/uploads/certificate/certificates.jpg);
            @endif
            background-size: cover;
                position: relative;">
                @csrf
                <input type="hidden" name="student_id" value="{{$student->id}}">
                <input type="hidden" name="episode_id" value="{{$episode->id}}">
                <input type="text" name="name" value="{{$student->user_name}}" style="position: absolute;top: 195px;left: 500px;border: none;height: 19px;">
                <input type="text" name="num" value="{{$student->ident_num}}" style="position: absolute;top: 215px;left: 520px;border: none;height: 19px;">
                <input type="text" name="program" value="{{$episode->name_ar}}"  style="position: absolute;top: 258px;left: 476px;border: none;height: 15px;">
                <input type="text" name="country" @if($student->Nationality) value="{{$student->Nationality->name_ar}}"  @endif  style="position: absolute;top: 237px;left: 525px;border: none;height: 19px;">
                <input type="text" name="degree" value="{{$degree->name_ar}}" style="position: absolute;top: 311px;left: 600px;border: none;width: 120px;">
                <input type="text" name="from_sur" @if($first_surah_ar) value="{{$first_surah_ar}}" @endif style="position: absolute;top: 275px;left: 650px;border: none;width: 60px;">
                <input type="text" name="to_sur" @if($last_surah_ar) value="{{$last_surah_ar}}" @endif style="position: absolute;top: 275px;left: 510px;border: none;width: 60px;height: 15px;">
                <input type="text" name="to_y" value="{{$to_date_string}}" style="position: absolute;top: 297px;left: 537px;border: none;width: 75px;height: 15px;">
                <input type="text" name="from_y" value="{{$from_date_string}}" style="position: absolute;top: 297px;left: 632px;border: none;width: 75px;height: 15px;">

                <input type="text" name="name_en" value="{{$student->user_name}}" style="text-align: left; position: absolute;top: 195px;left: 115px;border: none;height: 19px;">
                <input type="text" name="num_en" value="{{$student->ident_num}}" style="text-align: left;position: absolute;top: 215px;left: 115px;border: none;height: 19px;">
                <input type="text" name="country_en" @if($student->Nationality) value="{{$student->Nationality->name_en}}"  @endif  style="text-align: left; position: absolute;top: 237px;left: 115px;border: none;height: 19px;">
                <input type="text" name="program_en" value="{{$episode->name_en}}"  style="text-align: left;position: absolute;top: 258px;left: 175px;border: none;height: 15px;">
                <input type="text" name="degree_en" value="{{$degree->name_en}}" style="text-align: left;position: absolute;top: 311px;left: 115px;border: none;width: 120px;">
                <input type="text" name="from_sur_en" @if($first_surah_en) value="{{$first_surah_en}}" @endif style="text-align: left;position: absolute;top: 275px;left: 115px;border: none;width: 115px;">
                <input type="text" name="to_sur_en" @if($last_surah_en) value="{{$last_surah_en}}" @endif style="text-align: left;position: absolute;top: 275px;left: 310px;border: none;width: 115px;height: 15px;">
                <input type="submit"  value="{{trans('s_admin.save')}}" class="btn btn-primary"
                       style=" position: absolute; top: 500px; left: -70px; border: none; ">
                <input type="text" name="to_y_en" value="{{$to_date_string}}" style="text-align: left;position: absolute;top: 297px;left: 265px;border: none;width: 75px;height: 15px;">
                <input type="text" name="from_y_en" value="{{$from_date_string}}" style="text-align: left;position: absolute;top: 297px;left: 175px;border: none;width: 75px;height: 15px;">
                <input type="text" name="created_at" value="{{$created_at}}" style="text-align: left;position: absolute;top: 545px;left: 375px;border: none;width: 75px;height: 15px;">
            </form>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
