@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
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
                        {{trans('main.approve types')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="#" data-toggle="modal" data-target="#newLeaveType"
                               class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}} {{trans('main.record')}}
                            </a>
                        </div>
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
            <!--begin: Datatable -->
                <table id="datatable-responsive"
                       class="display table table-striped table-bordered " cellspacing="0"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>{{trans('main.id')}}</th>
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.style')}} </th>
                        <th>{{trans('main.model')}}</th>
                        <th>{{trans('main.update')}}</th>
                        <th>{{trans('main.approvers')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr>
                            <td>{{$type->id}}</td>
                            <td>{{$type->name}}</td>
                            <td>{{trans('main.'.$type->style)}}</td>
                            <td>{{trans('main.'.substr($type->model,4))}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".updateAsset"
                                   data-name="{{$type->name}}" data-id="{{$type->id}}"
                                   data-style="{{$type->style}}" data-model="{{$type->model}}">
                                    <i class="flaticon-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{url('hr/approver?id='.$type->id)}}"> <i class="flaticon2-group"></i></a>
                            </td>

                            {{----}}
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <div class="modal fade updateAsset" id="updateAsset" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.asset')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container">
                            <div class="row">
                                <div class=" form-group col-12">
                                    <label>{{trans('main.id')}}</label>
                                    <input type="number" readonly class="form-control" name="id">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{trans('main.name')}}</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{trans('main.style')}}</label>
                                    <select name="style" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.style')}}</option>
                                    <option  value="override"> {{trans('main.override')}}</option>
                                    <option  value="aggregate"> {{trans('main.aggregate')}}</option>
                                    <option  value="chain"> {{trans('main.chain')}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{trans('main.model')}}</label>
                                    <select>
                                    <option  value=""> {{trans('main.select')}} {{trans('main.model')}}</option>
                                    <option  value="App\HrLeave"> {{trans('main.HrLeave')}}</option>
                                    <option  value="App\HrPayslip"> {{trans('main.HrPayslip')}}</option>
                                    <option  value="App\HrPayroll"> {{trans('main.HrPayroll')}}</option>
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
    <div class="modal fade newLeaveType" id="newLeaveType" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('approve-type.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new asset')}} <span
                                class="model_type"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-1"></div>

                            <div class="col-10">

                                <div class="form-group">
                                    <label>{{trans('main.name')}}</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{trans('main.style')}}</label>
                                    <select name="style" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.style')}}</option>
                                        <option  value="override"> {{trans('main.override')}}</option>
                                        <option  value="aggregate"> {{trans('main.aggregate')}}</option>
                                        <option  value="chain"> {{trans('main.chain')}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{trans('main.model')}}</label>
                                    <select class="form-control" name="model">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.model')}}</option>
                                        <option  value="App\HrLeave"> {{trans('main.HrLeave')}}</option>
                                        <option  value="App\HrPayslip"> {{trans('main.HrPayslip')}}</option>
                                        <option  value="App\HrPayroll"> {{trans('main.HrPayroll')}}</option>
                                    </select>
                                </div>


                            </div>

                            <div class="col-1"></div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit"
                                    class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.create')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    {{----}}
    <script>

        $(document).ready(function () {
//
            $('#updateAsset').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                var style = $(e.relatedTarget).data('style');
                var model = $(e.relatedTarget).data('model');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('select[name="style"]').val(style);
                $(e.currentTarget).find('select[name="model"]').val(model);
                $(e.currentTarget).find('form').attr('action', "{{url('hr/approve-type/')}}/" + Id);
            });


        })
    </script>

@stop
