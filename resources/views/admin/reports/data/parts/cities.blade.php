@if(app()->getLocale() =='ar')
    <option  disabled selected >اختر المحافظة</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_ar}}</option>
    @empty
        <option disabled selected=""> لا يوجد محافظات حتى الان </option>
    @endforelse
@else
    <option  disabled selected >choose city</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_en}}</option>
    @empty
        <option disabled selected=""> no cities until now </option>
    @endforelse
@endif
