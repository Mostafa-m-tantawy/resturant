@extends('layouts.welcome')


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
                        {{trans('main.role')}}
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
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.permissions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permission->roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>
                                <form method="post"
                                      onsubmit="deleteConfirm(event,'{{trans('main.role association')}}')"
                                      action="{{route('permission.dissociation',[$role->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="permission_id" value="{{$permission->id}}">
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

    <div class="modal fade newLeaveType" id="newLeaveType" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('permission.association')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.role association')}} <span
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
                                <input type="hidden" name="permission_id" value="{{$permission->id}}" >
                                <div class="form-group">
                                    <label>{{trans('main.role')}}</label>
                                    <select name="role_id" class="form-control">
                                        <option value="">{{trans('main.select')}} {{trans('main.role')}} </option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}} </option>
                                            @endforeach
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
