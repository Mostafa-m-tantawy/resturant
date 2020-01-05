@extends('.pos.layout.pos_app')


@section('title')
    {{trans('main.clients')}}
@stop


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
                        {{trans('main.clients')}}
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
                        <th>{{trans('main.email')}}</th>
                        <th>{{trans('main.phone 1')}} </th>
                        <th>{{trans('main.phone 2')}} </th>
                        <th>{{trans('main.national id')}} </th>
                        <th>{{trans('main.His money')}} </th>
                        <th>{{trans('main.payments')}} </th>
                        <th>{{trans('main.update')}}</th>
                        {{--                        <th>{{trans('main.delete')}}</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$client->id}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->email}}</td>
                            <td>{{$client->phone1}}</td>
                            <td>{{$client->phone2}}</td>
                            <td>{{$client->national_id}}</td>
                            <td>{{$client->hisMoney}}</td>
                            <td>
                                <a href="{{route('client.show',[$client->id])}}"
                                   class="btn btn-primary">
                                    <i class="flaticon-visible"></i>
                                </a>
                            </td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".updateAsset"
                                   data-id="{{$client->id}}"
                                   data-name="{{$client->name}}"
                                   data-email="{{$client->email}}"
                                   data-phone1="{{$client->phone1}}"
                                   data-phone2="{{$client->phone2}}"
                                   data-national_id="{{$client->national_id}}"
                                >
                                    <i class="flaticon-edit"></i>
                                </a>
                            </td>
                            {{--                            <td>--}}
                            {{--                                <form method="post"  onsubmit="deleteConfirm(event,'{{trans('main.client')}}')" action="{{route('asset.destroy',[$asset->id])}}">--}}
                            {{--                                    @csrf--}}
                            {{--                                    @method('DELETE')--}}
                            {{--                                    <button class="btn btn-danger"> {{trans('main.delete')}}</button>--}}
                            {{--                                </form>--}}
                            {{--                            </td>--}}
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

                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class=" form-group ">
                                        <label>{{trans('main.id')}}</label>
                                        <input type="number" readonly class="form-control" name="id">
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('main.name')}}</label>
                                        <input type="text" required class="form-control" name="name">
                                    </div>

                                    <div class="form-group">
                                        <label>{{trans('main.email')}}</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>

                                    <div class="form-group">
                                        <label>{{trans('main.phone 1')}}</label>
                                        <input type="text" required class="form-control" name="phone1">
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('main.phone 2')}}</label>
                                        <input type="text" class="form-control" name="phone2">
                                    </div>

                                    <div class="form-group">
                                        <label>{{trans('main.national id')}}</label>
                                        <input type="text" class="form-control" name="national_id">
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
                <form action="{{route('client.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new client')}} <span
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
                                    <input type="text" required class="form-control" name="name">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.email')}}</label>
                                    <input type="email" class="form-control" name="email">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.phone 1')}}</label>
                                    <input type="text" required class="form-control" name="phone1">
                                </div>
                                <div class="form-group">
                                    <label>{{trans('main.phone 2')}}</label>
                                    <input type="text" class="form-control" name="phone2">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.national id')}}</label>
                                    <input type="text" class="form-control" name="national_id">
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
                var email = $(e.relatedTarget).data('email');
                var phone1 = $(e.relatedTarget).data('phone1');
                var phone2 = $(e.relatedTarget).data('phone2');
                var national_id = $(e.relatedTarget).data('national_id');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('input[name="email"]').val(email);
                $(e.currentTarget).find('input[name="phone1"]').val(phone1);
                $(e.currentTarget).find('input[name="phone2"]').val(phone2);
                $(e.currentTarget).find('input[name="national_id"]').val(national_id);
                $(e.currentTarget).find('form').attr('action', "{{url('pos/client/')}}/" + Id);
            });


        })
    </script>

@stop
