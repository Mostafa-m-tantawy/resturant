@extends('layouts.welcome')


@section('title')
    {{trans('main.table')}}
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
                        {{trans('main.table')}}
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
                        <th>{{trans('main.hall')}}</th>
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.status')}}</th>
                        <th>{{trans('main.update')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>{{$table->id}}</td>
                            <td>{{$table->hall->name}}</td>
                            <td>{{$table->name}}</td>
                            <td>{{$table->status?'yes':'no'}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".updateAsset"
                                   data-name="{{$table->name}}"
                                   data-hall="{{$table->hall_id}}"
                                   data-status="{{$table->status}}"
                                   data-id="{{$table->id}}">
                                    <i class="flaticon-edit"></i>
                                </a>
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
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.table')}}</h5>
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
                                    <label>{{trans('main.hall')}}</label>
                                    <select  name="hall" id="hall" class="form-control">
                                        <option value="">{{trans('main.select')}} {{trans('main.hall')}} </option>

                                        @foreach($halls as $hall)
                                            <option value="{{$hall->id}}">{{$hall->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-12">
                                    <label style="display: block;"> {{trans('main.status')}}</label>
                                    <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" id="status" name="status">
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
    <div class="modal fade newLeaveType" id="newLeaveType" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('table.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new table')}} <span
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
                                    <label>{{trans('main.hall')}}</label>
                              <select  name="hall" id="hall" class="form-control">
                                  <option value="">{{trans('main.select')}} {{trans('main.hall')}} </option>

                                  @foreach($halls as $hall)
                                      <option value="{{$hall->id}}">{{$hall->name}}</option>
                                  @endforeach
                              </select>

                                </div>

                                <div class="form-group ">
                                    <label style="display: block;"> {{trans('main.status')}}</label>
                                    <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" id="status" name="status">
												<span></span>
												</label>
											</span>
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

    <script>
        $(document).ready(function () {
            $('#updateAsset').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                var status = $(e.relatedTarget).data('status');
                var hall = $(e.relatedTarget).data('hall');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('select[name="hall"]').val(hall);
                if(status)
                    $(e.currentTarget).find('input[name="status"]').attr('checked',true);

                $(e.currentTarget).find('form').attr('action', "{{url('conf/table/')}}/" + Id);
            });


        })
    </script>

@stop
