@if(app()->getLocale() =='ar')
    <option value="">اختر الحلقة</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_ar}}</option>
    @empty
        <option disabled selected=""> لا يوجد حلقات حتى الان </option>
    @endforelse
@else
    <option value="">choose episode</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_en}}</option>
    @empty
        <option disabled selected=""> no episodes until now </option>
    @endforelse
@endif
