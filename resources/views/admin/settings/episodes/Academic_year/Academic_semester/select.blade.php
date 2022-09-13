@foreach($data as $select)
    <option value="{{$select->id}}" >{{$select->name}}  &nbsp; &nbsp; &nbsp; {{$select->from}}  &nbsp; &nbsp; {{$select->to}}</option>
@endforeach
