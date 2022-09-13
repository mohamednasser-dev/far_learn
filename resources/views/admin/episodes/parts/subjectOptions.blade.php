
@if(app()->getLocale() =='ar')
    <option value="">اختر المنهج</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_ar}}</option>
    @empty
        <option disabled selected=""> لا يوجد مناهج حتى الأن </option>
    @endforelse
@else
    <option value="">choose subject</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_en}}</option>
    @empty
        <option disabled selected=""> no subjects until now </option>
    @endforelse
@endif
