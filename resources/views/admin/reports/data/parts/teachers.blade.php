@if(app()->getLocale() =='ar')
    <option>اختر معلم</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->user_name}}</option>
    @empty
        <option disabled selected=""> لا يوجد معلمين بالحلقة المختاره</option>
    @endforelse
@else
    <option>choose teacher</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->user_name}}</option>
    @empty
        <option disabled selected=""> no teachers in selected class</option>
    @endforelse
@endif
