@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_certifcates')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <form action="{{route('episode.export.certificates')}}" method="post" style="width: 800px;height: 566px;background-image: url(/uploads/certificate/woman.jpg);position: relative;">
                @csrf
                <input type="text" name="name" value="" style="position: absolute;top: 237px;left: 375px;border: none">
                <input type="text" name="num" value="" style="position: absolute;top: 237px;left: 90px;border: none">
                <input type="text" name="degree" value="" style="position: absolute;top: 311px;left: 166px;border: none;width: 60px;">
                <input type="text" name="to_y" value="" style="position: absolute;top: 311px;left: 310px;border: none;width: 35px;">
                <input type="text" name="to_m" value="" style="position: absolute;top: 311px;left: 355px;border: none;width: 28px;">
                <input type="text" name="to_d" value="" style="position: absolute;top: 311px;left: 393px;border: none;width: 25px;">
                <input type="text" name="from_y" value="" style="position: absolute;top: 311px;left: 496px;border: none;width: 35px;">
                <input type="text" name="from_m" value="" style="position: absolute;top: 311px;left: 542px;border: none;width: 28px;">
                <input type="text" name="from_d" value="" style="position: absolute;top: 311px;left: 581px;border: none;width: 25px;">
                <input type="submit"  value="حفظ" class="btn btn-primary" style="position: absolute;top: 20px;left: 370px;border: none;">
            </form>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
