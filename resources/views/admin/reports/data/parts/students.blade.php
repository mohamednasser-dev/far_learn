@if(app()->getLocale() =='ar')
    <option  disabled selected >اختر الطالب</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->user_name}}</option>
    @empty
        <option disabled selected=""> لا يوجد طلاب بالحلقة المختاره</option>
    @endforelse
@else
    <option  disabled selected >choose student</option>
    @forelse($data as $row)
        <option value="{{$row->id}}">{{$row->user_name}}</option>
    @empty
        <option disabled selected=""> no students in selected class</option>
    @endforelse
@endif
