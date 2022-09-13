
<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
    <div class="card card-custom card-stretch">
        <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
           <h4>{{trans('s_admin.episodes_has_long')}}</h4>
        </div>
        <div class="card-body table-responsive px-0">
            <div class="list list-hover min-w-500px" data-inbox="list">
                @foreach($data as $row)
                    <div class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <span class="font-weight-bolder font-size-lg mr-2">{{$row->message}}</span>
                        </div>
                        <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{trans('s_admin.new')}}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'accepted','id'=>$row->id])}}">{{trans('s_admin.accept')}}</a>
                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'rejected','id'=>$row->id])}}">{{trans('s_admin.reject')}}</a>
                            </div>
                        </div>
                        <div class="mt-2 mr-3 font-weight-bolder w-50px text-right" data-toggle="view">{{$row->created_at->format('g:i a')}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>









