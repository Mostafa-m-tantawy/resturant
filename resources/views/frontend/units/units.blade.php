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
                        {{trans('main.units')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="#"  data-toggle="modal" data-target="#newunit" class="btn btn-brand btn-elevate btn-icon-sm">
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
                        <th>{{trans('main.unit')}}</th>
                        <th>{{trans('main.child unit')}} </th>
                        <th>{{trans('main.convert_rate')}}</th>
                        <th>{{trans('main.update')}}</th>
                        <th>{{trans('main.delete')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $unit)
{{----}}
                        <tr>
                            <td>{{$unit->id}}</td>
                            <td>{{$unit->unit}}</td>
                            <td>{{$unit->child_unit}}</td>
                            <td>{{$unit->convert_rate}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".bd-example-modal-lg"
                                   data-unit="{{$unit->unit}}" data-id="{{$unit->id}}"
                                   data-child="{{$unit->child_unit}}" data-convert_rate="{{$unit->convert_rate}}">
                                    <i class="flaticon-edit-1"></i>
                                </a>
                                </td>
{{----}}  <td>
                                    <form method="post"  onsubmit="deleteConfirm(event,'{{trans('main.unit')}}')"
                                          action="{{route('unit.destroy',[$unit->id])}}">
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

    <div class="modal fade bd-example-modal-lg" id="updatemodel" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form  method="post">

                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.unit')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <label>{{trans('main.id')}}</label>
                                    <input type="number" readonly class="form-control" name="id">
                                </div>
                                <div class="col-12">
                                    <label>{{trans('main.unit')}}</label>
                                    <input type="text" class="form-control" name="unit">
                                </div>

                                <div class="col-12">
                                    <label>{{trans('main.child unit')}}</label>
                                    <input type="text" class="form-control" name="child_unit">
                                </div>
                                <div class="col-12">
                                    <label>{{trans('main.convert_rate')}}</label>
                                    <input type="number" class="form-control" name="convert_rate">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">supmit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade newunit" id="newunit" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('unit.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.new')}} {{trans('main.unit')}} <span class="model_type"></span></h5>
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
                                    <label>{{trans('main.unit')}}</label>
                                    <input type="text" class="form-control" name="unit">
                                </div>

                                <div class=" form-group">
                                    <label>{{trans('main.child unit')}}</label>
                                    <input type="text" class="form-control" name="child_unit">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('main.convert_rate')}}</label>
                                    <input type="text" class="form-control" name="convert_rate">
                                </div>

                            </div>

                            <div class="col-1"></div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.create')}}</button>
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
            $('#updatemodel').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var unit = $(e.relatedTarget).data('unit');
                var child = $(e.relatedTarget).data('child');
                var convert_rate = $(e.relatedTarget).data('convert_rate');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="unit"]').val(unit);
                $(e.currentTarget).find('input[name="child_unit"]').val(child);
                $(e.currentTarget).find('input[name="convert_rate"]').val(convert_rate);

                $(e.currentTarget).find('form').attr('action', "{{url('stock/unit/')}}/" + Id);
            });

        })
    </script>

@stop
