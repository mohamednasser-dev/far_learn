@if(app()->getLocale() =='ar')
    <option disabled selected>اختر منطقة</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_ar}}</option>
    @empty
        <option disabled selected=""> لا يوجد مناطق حتى الان </option>
    @endforelse
@else
    <option disabled selected>choose zone</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_en}}</option>
    @empty
        <option disabled selected=""> no zones until now </option>
    @endforelse
@endif
