@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('title')
    {{trans('main.my approves')}}
@stop



@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{trans('main.my requests')}}
                    </h3>
                </div>

            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table id="datatable-responsive"
                       class="display table table-striped table-bordered " cellspacing="0"
                       style="width:100%"> <thead>



                    <tr>
                        <th> {{trans('main.id')}}</th>
                        <th>{{trans('main.who Request')}}</th>
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.approve type')}}</th>
                        <th>{{trans('main.subject')}}</th>
                        <th>{{trans('main.status')}}</th>
                        <th>{{trans('main.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($approves as $approve)
                        <tr>
                            <td>{{$approve->id}}</td>
                            <td>{{$approve->whoRequest->name}}</td>
                            <td>{{$approve->name}}</td>
                            <td>{{$approve->ApproveType->name}}</td>
                            <td>{{$approve->subject}}</td>
                            <td>{{$approve->status}}</td>
                            <td><form method="post" action="{{url('approve-request/response/'.$approve->id)}}">
                                    @csrf
                                    <select name="status" id="action{{$approve->id}}" class="form-control" onchange="this.form.submit()" >
                                        <option value="">{{trans('main.select')}} {{trans('main.action')}} </option>
                                        <option value="accepted">{{trans('main.accepted')}}  </option>
                                        <option value="rejected">{{trans('main.rejected')}}  </option>
                                        <option value="pending"> {{trans('main.pending')}} </option>
                                       </select>

                                </form></td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>

        </div>
    </div>

@stop

@section('scripts')
<script>
    @foreach($approves as $approve)
    $('#action{{$approve->id}}').val('{{$approve->status}}');
    @endforeach
</script>

@stop
