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

                            <a href="#" data-toggle="modal" data-target="#newapprover"
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
                        <th>{{trans('main.level')}} </th>
                        <th>{{trans('main.update')}}</th>
                        <th>{{trans('main.delete')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($approvers as $approver)
                        {{----}}
{{--                        {{dd()}}--}}
                        <tr>
                            <td>{{$approver->id}}</td>
                            <td>{{$approver->employee->name}}</td>
                            <td>{{$approver->level}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".update_approver"
                                   data-approver="{{$approver->hr_employee_id}}" data-id="{{$approver->id}}"
                                   data-level="{{$approver->level}}" >
                                    <i class="flaticon-edit-1"></i>
                                </a>
                            </td>
                            <td>
                                <a title="delete"
                                   data-toggle="modal" data-target=".delete_approver"
                                   data-approver="{{$approver->employee->name}}" data-id="{{$approver->id}}">
                                    <i class="flaticon-delete-1"></i>
                                </a>
                            </td>
                            {{----}}
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <div class="modal fade update_approver" id="update_approver" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form  method="post">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.approver')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container">


                            <div class="row">
                                <div class="col-1"></div>

                                <div class="col-10">
                                    <input type="hidden" class="form-control" name="hr_approval_type_id" value="{{$hr_approval_type_id}}">
                                    <div class=" form-group">

                                        <label>{{trans('main.id')}}</label>
                                        <input type="number" readonly class="form-control" name="id">
                                    </div>

                                    <div class=" form-group">
                                        <label>{{trans('main.approver')}}</label>
                                        <select readonly="" name="approver" class="form-control">
                                            <option value="">{{trans('main.select')}} {{trans('main.approver')}}</option>

                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}">{{$employee->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>{{trans('main.level')}}</label>
                                        <input type="text" class="form-control" name="level">
                                    </div>

                                </div>

                                <div class="col-1"></div>


                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.submit')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade newapprover" id="newapprover" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('approver')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new approver')}} <span
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
                                <input type="hidden" class="form-control" name="hr_approval_type_id" value="{{$hr_approval_type_id}}">

                                <div class=" form-group">
                                    <label>{{trans('main.approver')}}</label>
                                    <select name="approver" class="form-control">
                                        <option value="">{{trans('main.select')}} {{trans('main.approver')}}</option>

                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}} </option>
                                         @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.level')}}</label>
                                    <input type="text" class="form-control" name="level">
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

    <div class="modal fade delete_approver" id="delete_approver" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form  method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">  <span id="approver"></span>  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden"   name="id">
                                    <h3>{{trans('main.Do you Want to confirm Delete ?')}}</h3>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.delete')}}</button>
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
            $('#update_approver').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var approver = $(e.relatedTarget).data('approver');
                var level= $(e.relatedTarget).data('level');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('select[name="approver"]').val(approver);
                $(e.currentTarget).find('input[name="level"]').val(level);

                $(e.currentTarget).find('form').attr('action', "{{url('hr/approver/')}}/" + Id);
            });

//
            $('#delete_approver').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var approver = $(e.relatedTarget).data('approver');
               $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('#approver').text(approver);

                $(e.currentTarget).find('form').attr('action', "{{url('hr/approver/')}}/" + Id);
            });


        })
    </script>

@stop
