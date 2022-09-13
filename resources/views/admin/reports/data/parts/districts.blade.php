@if(app()->getLocale() =='ar')
    <option value="">اختر الحي</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_ar}}</option>
    @empty
        <option disabled selected=""> لا يوجد حي حتى الان </option>
    @endforelse
@else
    <option value="">choose district</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_en}}</option>
    @empty
        <option disabled selected=""> no district until now </option>
    @endforelse
@endif
