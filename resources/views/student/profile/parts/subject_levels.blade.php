@if(app()->getLocale() =='ar')
    <option value="">أاختر مستوى المنهج</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_ar}} &nbsp; &nbsp; &nbsp;{{$row->desc_ar}}</option>
    @empty
        <option disabled selected=""> لا يوجد مستويات للمنهج حتى الأن </option>
    @endforelse
@else
    <option value="">choose subject level</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->name_en}} &nbsp; &nbsp; &nbsp;{{$row->desc_en}}</option>
    @empty
        <option disabled selected=""> no subject level until now</option>
    @endforelse
@endif
