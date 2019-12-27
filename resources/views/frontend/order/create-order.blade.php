{{--@extends('layouts.welcome')--}}
{{--@section('head')--}}
{{--    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--@stop--}}

{{--@section('content')--}}

{{--    <input type="hidden" name="vatPercentage" value="{{$systemconf->where('name','vat')->first()->value}}">--}}
{{--    <input type="hidden" name="servicePercentage" value="{{$systemconf->where('name','service')->first()->value}}">--}}

{{--    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">--}}

{{--        <div class="kt-portlet kt-portlet--mobile">--}}
{{--            <div class="kt-portlet__body">--}}


{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="card-box" id="app">--}}
{{--                            <h4 class="m-t-0 header-title"><b> {{ trans('main.order') }}</b></h4>--}}
{{--                            <hr>--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label style="display: block;"> {{trans('main.vat')}}</label>--}}
{{--                                        <span class="kt-switch kt-switch--lg kt-switch--icon">--}}
{{--											<label>--}}
{{--											<input type="checkbox" id="vat"  name="vat">--}}
{{--												<span></span>--}}
{{--												</label>--}}
{{--											</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label style="display: block;"> {{trans('main.service')}}</label>--}}
{{--                                        <span class="kt-switch kt-switch--lg kt-switch--icon">--}}
{{--											<label>--}}
{{--											<input type="checkbox" id="service" name="service">--}}
{{--												<span></span>--}}
{{--												</label>--}}
{{--											</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label style="display: block;"> {{trans('main.staff')}}</label>--}}
{{--                                        <span class="kt-switch kt-switch--lg kt-switch--icon">--}}
{{--											<label>--}}
{{--											<input type="checkbox" id="staff" name="staff" class="form-control">--}}
{{--												<span></span>--}}
{{--												</label>--}}
{{--											</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-3">--}}
{{--                                    <div class="form-group ">--}}
{{--                                        <label class=" control-label"--}}
{{--                                               for="example-email"> {{ trans('main.discount') }} </label>--}}
{{--                                        <div class="input-group ">--}}
{{--                                            <input type="number" required id="discount" name="discount"--}}
{{--                                                   class="form-control" step="0.01" value="0" min="0">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <h4 class="m-t-0 header-title"><b> {{ trans('main.dishes') }}</b></h4>--}}
{{--                            <hr>--}}

{{--                            <form class="form-horizontal" role="form" action="#" id="purses" method="post"--}}
{{--                                  enctype="multipart/form-data" data-parsley-validate novalidate>--}}
{{--                                {{csrf_field()}}--}}
{{--                                <div class="row">--}}

{{--                                    <div class="form-group col-3">--}}
{{--                                        <label for=""--}}
{{--                                               class=" control-label">  {{ trans('main.category') }}</label>--}}
{{--                                        <select name="category" id="category" class="form-control " required>--}}
{{--                                            <option disabled selected value=""> {{ trans('main.select') }}   {{ trans('main.category') }} </option>--}}
{{--                                          <option value="dish">{{ trans('main.dish') }}</option>--}}
{{--                                          <option value="side">{{ trans('main.side') }}</option>--}}
{{--                                          <option value="extra">{{ trans('main.extra') }}</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-3">--}}
{{--                                        <label for=""--}}
{{--                                               class=" control-label"> {{ trans('main.select') }}  {{ trans('main.dish') }}</label>--}}
{{--                                        <select name="dish" id="dish" class="form-control" required>--}}
{{--                                            <option value=""> {{ trans('main.select') }}   {{ trans('main.dish') }} </option>--}}

{{--                                        </select>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group col-3">--}}
{{--                                        <label class=" control-label"--}}
{{--                                               for="example-email"> {{ trans('main.quantity') }} </label>--}}
{{--                                        <div class="input-group ">--}}
{{--                                            <input type="number" required id="quantity" name="quantity"--}}
{{--                                                   class="form-control" step="0.01" min="0">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}



{{--                                    <div class=" col-3">--}}
{{--                                        <label class=" control-label"--}}
{{--                                               for="example-email"> </label>--}}
{{--                                        <div class="input-group ">--}}
{{--                                        <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">--}}
{{--                                                {{ trans('main.purses') }}  {{ trans('main.now') }}--}}
{{--                                            </button>--}}
{{--                                    </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </form>--}}

{{--                            <div class="p-20">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table id="datatable-responsive"--}}
{{--                                           class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>#</th>--}}
{{--                                            <th> {{ trans('main.type') }} </th>--}}
{{--                                            <th> {{ trans('main.dish') }}</th>--}}
{{--                                            <th> {{ trans('main.size') }}</th>--}}
{{--                                            <th > {{ trans('main.quantity')}}</th>--}}
{{--                                            <th > {{ trans('main.action') }}</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody id="pursesDetailsRender">--}}


{{--                                        </tbody>--}}
{{--                                    </table>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}

{{--@section('scripts')--}}

{{--    <script src="{{ url('/app_js/OrderController.js') }}"></script>--}}

{{--<script>--}}

{{--    $(document).ready(function () {--}}

{{--//         $("#datatable-responsive").DataTable({--}}
{{--//             order: [0, 'desc'],--}}
{{--//             dom: 'Bfrtip',--}}
{{--//             buttons: [--}}
{{--//                 'copy', 'excel', 'pdf', 'print'--}}
{{--//             ],--}}
{{--// //--}}
{{--//         });--}}
{{--    })--}}
{{--</script>--}}
{{--@endsection--}}
