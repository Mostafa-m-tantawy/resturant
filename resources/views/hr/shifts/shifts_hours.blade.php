@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop


@section('title')
    {{trans('main.shifts')}}
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
                        {{trans('main.shifts')}}
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
                        <th>{{trans('main.start_day')}}</th>
                        <th>{{trans('main.end_day')}}</th>
                        <th>{{trans('main.start_time')}} </th>
                        <th>{{trans('main.end_time')}}</th>
                        <th>{{trans('main.update')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hours as $hour)
                        {{----}}
                        {{--                        {{dd()}}--}}
                        <tr>
                            <td>{{$hour->id}}</td>
                            <td>{{$hour->start_day}}</td>
                            <td>{{$hour->end_day}}</td>
                            <td>{{$hour->start_time}}</td>
                            <td>{{$hour->end_time}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".update_approver"
                                   data-start_day="{{$hour->start_day}}" data-end_day="{{$hour->end_day}}"
                                   data-start_time="{{$hour->start_time}}" data-end_time="{{$hour->end_time}}"
                                   data-id="{{$hour->id}}">
                                    <i class="flaticon-edit-1"></i>
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
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.shift hours')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container">


                            <div class="row">
                                <div class="col-1"></div>

                                <div class="col-10">
                                    <input type="hidden" class="form-control" name="shift_id" value="{{$shift->id}}">
                                    <div class=" form-group">

                                        <label>{{trans('main.id')}}</label>
                                        <input type="number" readonly class="form-control" name="id">
                                    </div>

                                    <div class="form-group">
                                        <label class=" control-label"> {{trans('main.Start Day')}} </label>
                                            <select class=" form-control"
                                                    name="start_day" required>
                                                <option value=""> {{trans('main.select')}} {{trans('main.day')}} </option>
                                                <option value="sat"> {{trans('main.Saturday')}} </option>
                                                <option value="sun">{{trans('main.Sunday')}}   </option>
                                                <option value="mon"> {{trans('main.Monday')}}  </option>
                                                <option value="tues"> {{trans('main.Tuesday')}}  </option>
                                                <option value="wend"> {{trans('main.Wendsday')}}  </option>
                                                <option value="thurs"> {{trans('main.Thursday')}}  </option>
                                                <option value="fri"> {{trans('main.Friday')}}  </option>
                                            </select>
                                    </div>





                                        <div class="form-group">
                                            <label class=" control-label">{{trans('main.End Day')}}  </label>

                                                <select class=" form-control"
                                                        name="end_day" required>
                                                    <option value=""> {{trans('main.select')}} {{trans('main.day')}} </option>
                                                    <option value="sat"> {{trans('main.Saturday')}} </option>
                                                    <option value="sun">{{trans('main.Sunday')}}   </option>
                                                    <option value="mon"> {{trans('main.Monday')}}  </option>
                                                    <option value="tues"> {{trans('main.Tuesday')}}  </option>
                                                    <option value="wend"> {{trans('main.Wendsday')}}  </option>
                                                    <option value="thurs"> {{trans('main.Thursday')}}  </option>
                                                    <option value="fri"> {{trans('main.Friday')}}  </option>
                                                </select>
                                            </div>
                                    <div class="form-group">
                                        <label class=" control-label">  {{trans('main.Start Time')}}  </label>
                                        <input type="time" name="start_time"
                                               class=" form-control" required>
                                    </div>

                                        <div class="form-group">
                                            <label class=" control-label">{{trans('main.End Time')}}  </label>
                                                <input type="time" name="end_time"
                                                       class="form-control" required>

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
                <form action="{{route('shift-hours.store')}}" method="post">

                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new shift hours')}} <span
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
                                <input type="hidden" class="form-control" name="shift_id" value="{{$shift->id}}">


                                <div class="form-group">
                                    <label class=" control-label"> {{trans('main.Start Day')}} </label>
                                    <select class=" form-control"
                                            name="start_day" required>
                                        <option value=""> {{trans('main.select')}} {{trans('main.day')}} </option>
                                        <option value="sat"> {{trans('main.Saturday')}} </option>
                                        <option value="sun">{{trans('main.Sunday')}}   </option>
                                        <option value="mon"> {{trans('main.Monday')}}  </option>
                                        <option value="tues"> {{trans('main.Tuesday')}}  </option>
                                        <option value="wend"> {{trans('main.Wendsday')}}  </option>
                                        <option value="thurs"> {{trans('main.Thursday')}}  </option>
                                        <option value="fri"> {{trans('main.Friday')}}  </option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label class=" control-label">{{trans('main.End Day')}}  </label>

                                    <select class=" form-control"
                                            name="end_day" required>
                                        <option value=""> {{trans('main.select')}} {{trans('main.day')}} </option>
                                        <option value="sat"> {{trans('main.Saturday')}} </option>
                                        <option value="sun">{{trans('main.Sunday')}}   </option>
                                        <option value="mon"> {{trans('main.Monday')}}  </option>
                                        <option value="tues"> {{trans('main.Tuesday')}}  </option>
                                        <option value="wend"> {{trans('main.Wendsday')}}  </option>
                                        <option value="thurs"> {{trans('main.Thursday')}}  </option>
                                        <option value="fri"> {{trans('main.Friday')}}  </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class=" control-label">  {{trans('main.Start Time')}}  </label>
                                    <input type="time" name="start_time"
                                           class=" form-control" required>
                                </div>



                                <div class="form-group">
                                    <label class=" control-label">{{trans('main.End Time')}}  </label>
                                    <input type="time" name="end_time"
                                           class="form-control" required>

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

            $('#update_approver').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var start_day = $(e.relatedTarget).data('start_day');
                var end_day = $(e.relatedTarget).data('end_day');
                var start_time= $(e.relatedTarget).data('start_time');
                var end_time= $(e.relatedTarget).data('end_time');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="start_time"]').val(start_time);
                $(e.currentTarget).find('input[name="end_time"]').val(end_time);
                $(e.currentTarget).find('select[name="start_day"]').val(start_day);
                $(e.currentTarget).find('select[name="end_day"]').val(end_day);

                $(e.currentTarget).find('form').attr('action', "{{url('hr/shift-hours/')}}/" + Id);
            });

//


        })
    </script>

@stop
