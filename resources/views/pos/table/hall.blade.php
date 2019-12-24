@extends('.pos.layout.pos_app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head-label">

                    <div class="row ">
                        <div class="col-3 "><h2 class="kt-portlet__head-title text-center">
                                {{trans('main.hall')}}
                            </h2></div>
                        <div class="col-9 ">
                            <button style=" margin-left: 50px;"
                                    title="transfer"
                                    data-toggle="modal"
                                    data-target=".transfer_modal"
                                    class="btn btn-primary pull-right"> transfer
                            </button>
                            <button style=" margin-left: 50px;"
                                    title="transfer"
                                    data-toggle="modal"
                                    data-target=".merge_modal"
                                    class="btn btn-primary pull-right"> mearge</button>
                        </div>

                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        @foreach($halls as $hall)
                            <li class="nav-item">

                                <a class="nav-link @if($loop->first) active @endif"
                                   id="{{str_replace(' ', '', $hall->name)}}-tab"
                                   data-toggle="tab" href="#{{str_replace(' ', '', $hall->name)}}" role="tab"
                                   aria-controls="{{str_replace(' ', '', $hall->name)}}"
                                   aria-selected="true">{{$hall->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($halls as $hall)


                            <div class="tab-pane fade @if($loop->first) show active @endif"
                                 id="{{str_replace(' ', '', $hall->name)}}"
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

    <div class="modal fade transfer_modal" id="transfer_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.transfer')}} <span class="name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('pos/transfer-table')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>from</label>
                                    <select name="from" class="form-control">
                                        <option value="">{{trans('main.select')}} {{trans('main.table')}}</option>
                                        @foreach($tables->where('occupied',true) as $table)
                                            <option value="{{$table->id}}">{{$table->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>to</label>
                                    <select name="to" class="form-control">
                                        <option value="">{{trans('main.select')}} {{trans('main.table')}}</option>
                                        @foreach($tables->where('occupied',false) as $table)
                                            <option value="{{$table->id}}">{{$table->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit"
                                    class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade merge_modal" id="merge_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.payment')}} <span class="name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{url('pos/merge')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>table 1</label>
                                    <select name="table1" class="form-control">
                                        <option value="">{{trans('main.select')}} {{trans('main.table')}}</option>
                                        @foreach($tables->where('occupied',true) as $table)
                                            <option value="{{$table->id}}">{{$table->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>table 2</label>
                                    <select name="table2" class="form-control">
                                        <option value="">{{trans('main.select')}} {{trans('main.table')}}</option>
                                        @foreach($tables->where('occupied',true) as $table)
                                            <option value="{{$table->id}}">{{$table->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label style="display: block;"> {{trans('main.available')}}</label>
                                    <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" id="available" name="available" class="form-control">
												<span></span>
												</label>
											</span>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit"
                                    class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.submit')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop
