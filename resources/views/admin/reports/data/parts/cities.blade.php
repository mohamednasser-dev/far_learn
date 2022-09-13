@if(app()->getLocale() =='ar')
    <option value="">اختر المحافظة</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_ar}}</option>
    @empty
        <option disabled selected=""> لا يوجد محافظات حتى الان </option>
    @endforelse
@else
    <option value="">choose city</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_en}}</option>
    @empty
        <option disabled selected=""> no cities until now </option>
    @endforelse
@endif
