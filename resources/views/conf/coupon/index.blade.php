@extends('layouts.welcome')


@section('title')
    {{trans('main.index coupon')}}
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
                        {{trans('main.coupon')}}
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
                        <th>{{trans('main.description')}}</th>
                        <th>{{trans('main.from')}}</th>
                        <th>{{trans('main.to')}}</th>
                        <th>{{trans('main.percentage')}}</th>
                        <th>{{trans('main.created_at')}}</th>
                        <th>{{trans('main.update')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $coupon)
                        <tr>
                            <td>{{$coupon->id}}</td>
                            <td>{{$coupon->name}}</td>
                            <td>{{$coupon->description}}</td>
                            <td>{{$coupon->from}}</td>
                            <td>{{$coupon->to}}</td>
                            <td>{{$coupon->percentage}}</td>
                            <td>{{$coupon->created_at}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".updateAsset"
                                   data-name="{{$coupon->name}}"
                                   data-description="{{$coupon->description}}"
                                   data-from="{{$coupon->from}}"
                                   data-to="{{$coupon->to}}"
                                   data-percentage="{{$coupon->percentage}}"
                                   data-id="{{$coupon->id}}">
                                    <i class="flaticon-edit"></i>
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

    <div class="modal fade updateAsset" id="updateAsset" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.hall')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">

                                <div class=" form-group">
                                    <label>{{trans('main.id')}}</label>
                                    <input type="number" readonly class="form-control" name="id">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.name')}}</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.description')}}</label>
                                    <input type="text" class="form-control" name="description">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.from')}}</label>
                                    <input type="date" class="form-control" name="from">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.to')}}</label>
                                    <input type="date" class="form-control" name="to">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.percentage')}}</label>
                                    <input type="number" min="0" step="0.01" class="form-control" name="percentage">
                                </div>

</div>
                                <div class="col-1"></div>

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
                <form action="{{route('coupon.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new coupon')}} <span
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
                                    <label>{{trans('main.description')}}</label>
                                    <input type="text" class="form-control" name="description">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.from')}}</label>
                                    <input type="date" class="form-control" name="from">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.to')}}</label>
                                    <input type="date" class="form-control" name="to">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.percentage')}}</label>
                                    <input type="number" min="0" step="0.01" class="form-control" name="percentage">
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
                var description = $(e.relatedTarget).data('description');
                var from = $(e.relatedTarget).data('from');
                var to = $(e.relatedTarget).data('to');
                var percentage = $(e.relatedTarget).data('percentage');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('input[name="description"]').val(description);
                $(e.currentTarget).find('input[name="from"]').val(from);
                $(e.currentTarget).find('input[name="to"]').val(to);
                $(e.currentTarget).find('input[name="percentage"]').val(percentage);

                $(e.currentTarget).find('form').attr('action', "{{url('conf/coupon/')}}/" + Id);
            });


        })
    </script>

@stop
