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
                        {{trans('main.taxes')}}
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
                            <th>{{trans('main.percentage')}} </th>
                            <th>{{trans('main.start')}}</th>
                            <th>{{trans('main.end')}}</th>
                            <th>{{trans('main.discount')}}</th>
                            <th>{{trans('main.update')}}</th>
                            <th>{{trans('main.delete')}}</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($taxes as $tax)
                        <tr>
                            <td>{{$tax->id}}</td>
                            <td>{{$tax->name}}</td>
                            <td>{{$tax->percentage}}</td>
                            <td>{{$tax->start}}</td>
                            <td>{{$tax->end}}</td>
                            <td>{{$tax->discount}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".updateAsset"
                                   data-name="{{$tax->name}}" data-id="{{$tax->id}}"
                                   data-percentage="{{$tax->percentage}}" data-end="{{$tax->end}}"
                                   data-start="{{$tax->start}}"data-discount="{{$tax->discount}}">
                                    <i class="flaticon-edit"></i>
                                </a>
                            </td>
                            <td>
                                <form method="post"  onsubmit="deleteConfirm(event,'{{trans('main.taxes')}}')" action="{{route('taxes.destroy',[$tax->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"> {{trans('main.delete')}}</button>
                                </form>
                            </td>
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
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.taxes')}}</h5>
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
                                    <label>{{trans('main.percentage')}}</label>
                                    <input type="number" min="0" max="100" step="0.01"  class="form-control" name="percentage">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{trans('main.start')}}</label>
                                    <input type="number" min="0" step="0.01"  class="form-control" name="start">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{trans('main.end')}}</label>
                                    <input type="number" min="0" step="0.01" class="form-control" name="end">
                                </div>
 <div class="form-group col-12">
                                    <label>{{trans('main.discount')}}</label>
                                    <input type="number" min="0" step="0.01" class="form-control" name="discount">
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
                <form action="{{route('taxes.store')}}" method="post">
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

                                <div class="form-group">
                                    <label>{{trans('main.percentage')}}</label>
                                    <input type="number" min="0" max="100" step="0.01"  class="form-control" name="percentage">
                                </div>


                                <div class="form-group">
                                    <label>{{trans('main.start')}}</label>
                                    <input type="number" min="0" step="0.01"  class="form-control" name="start">
                                </div>


                                <div class="form-group">
                                    <label>{{trans('main.end')}}</label>
                                    <input type="number" min="0" step="0.01" class="form-control" name="end">
                                </div>


                                <div class="form-group">
                                    <label>{{trans('main.discount')}}</label>
                                    <input type="number" min="0" step="0.01" class="form-control" name="discount">
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

            $('#updateAsset').on('show.bs.modal', function (e) {

                var Id          = $(e.relatedTarget).data('id');
                var name        = $(e.relatedTarget).data('name');
                var percentage  = $(e.relatedTarget).data('percentage');
                var start       = $(e.relatedTarget).data('start');
                var end         = $(e.relatedTarget).data('end');
                var discount         = $(e.relatedTarget).data('discount');


                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('input[name="percentage"]').val(percentage);
                $(e.currentTarget).find('input[name="start"]').val(start);
                $(e.currentTarget).find('input[name="end"]').val(end);
                $(e.currentTarget).find('input[name="discount"]').val(discount);
                $(e.currentTarget).find('form').attr('action', "{{url('hr/taxes/')}}/" + Id);
            });


        })
    </script>

@stop
