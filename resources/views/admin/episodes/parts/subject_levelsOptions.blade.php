
@if(app()->getLocale() =='ar')
    <option value="">أاختر مستوى المنهج</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_ar}} &nbsp; <code>{{$row->desc_ar}}</code></option>
    @empty
        <option disabled selected=""> لا يوجد مستويات للمنهج حتى الأن </option>
    @endforelse
@else
    <option value="">choose subject level</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_en}} &nbsp; <code>{{$row->desc_en}}</code></option>
    @empty
        <option disabled selected=""> no subject level until now</option>
    @endforelse
@endif
