@extends('.pos.layout.pos_app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                           {{trans('main.hall')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        @foreach($halls as $hall)
                            <li class="nav-item">

                                <a class="nav-link @if($loop->first) active @endif" id="{{str_replace(' ', '', $hall->name)}}-tab"
                                   data-toggle="tab" href="#{{str_replace(' ', '', $hall->name)}}" role="tab"
                                   aria-controls="{{str_replace(' ', '', $hall->name)}}" aria-selected="true">{{$hall->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($halls as $hall)


                            <div class="tab-pane fade @if($loop->first) show active @endif" id="{{str_replace(' ', '', $hall->name)}}"
                                 role="tabpanel" aria-labelledby="{{str_replace(' ', '', $hall->name)}}-tab">
                                <div class="row">
                                    @foreach($hall->tables as $table)

                                    @if($table->occupied )
                                            <div class="col-2">
                                                    <div class="kt-widget kt-widget--user-profile-4">
                                                        <div class="kt-widget__head">
                                                            <a href="{{url('pos/order/'.$table->currentOrder.'/edit')}}">
                                                                <div class="kt-widget__media">
                                                                    <img style="max-height: 100px;"
                                                                         src="/media/icons/pos/full.png"
                                                                         alt="image">
                                                                </div>
                                                            </a>
                                                            <div class="kt-widget__content">
                                                                <div class="kt-widget__section">
                                                                    <a href="{{url('pos/order/'.$table->currentOrder.'/edit')}}"
                                                                       class="kt-widget__username">
                                                                        {{$table->name}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                        </div>
                                    @else
                                            <div class="col-2">
                                                <div class="kt-widget kt-widget--user-profile-4">
                                                    <div class="kt-widget__head">
                                                        <a href="{{url('pos/order/create')}}?type=restaurant&table={{$table->id}}">
                                                            <div class="kt-widget__media">
                                                                <img style="max-height: 100px;"
                                                                     src="/media/icons/pos/empty.png"
                                                                     alt="image">
                                                            </div>
                                                        </a>
                                                        <div class="kt-widget__content">
                                                            <div class="kt-widget__section">
                                                                <a href="{{url('pos/order/create')}}?type=restaurant&table={{$table->id}}"
                                                                   class="kt-widget__username">
                                                                    {{$table->name}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                @endif

                                    @endforeach


                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>
            </div>

        </div>
       </div>


@stop
