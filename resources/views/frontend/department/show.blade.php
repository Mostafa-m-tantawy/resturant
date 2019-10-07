@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    View Contact
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <div class="kt-subheader__group" id="kt_subheader_search">
									<span class="kt-subheader__desc" id="kt_subheader_total">
										Sandra Stone </span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="btn btn-default btn-bold">
                    Back </a>
            </div>
        </div>

        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

            <div class="row">
                <div class="col-xl-4">


                    <!--Begin:: Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Supplier
                                </h3>
                            </div>

                        </div>
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">Name:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$department->name}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">description:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$department->description}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--End:: Portlet-->
                </div>


                <div class="col-xl-8">

                    <!--Begin:: Portlet-->
                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                                    role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_3"
                                           role="tab">
                                            <i class="flaticon2-calendar-3"></i> Personal
                                        </a>
                                    </li>
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_supplier_purchases"--}}
{{--                                           role="tab">--}}
{{--                                            <i class="flaticon2-user-outline-symbol"></i> Purchases--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_supplier_payments"--}}
{{--                                           role="tab">--}}
{{--                                            <i class="flaticon2-gear"></i> Payments--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content kt-margin-t-20">

                                    <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane active" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                                    <form class="kt-form kt-form--label-right" method="post"
                                          action="{{route('department.update',$department->id)}}">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Department Information</h3>
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label>Name:</label>
                                                            <input type="text" required name="name" class="form-control"
                                                                   placeholder="Enter full name" value="{{$department->name}}">
                                                            <span class="form-text text-muted"> department name</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="">Description:</label>
                                                            <input type="text" required name="description"
                                                                   value="{{$department->description}}" class="form-control" placeholder="Enter email">
                                                            <span
                                                                class="form-text text-muted">description</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!--End:: Tab Content-->


                                <!--Begin:: Tab Content-->
{{--                                <div class="tab-pane" id="kt_apps_supplier_purchases" role="tabpanel">--}}

{{--                                    <div class="kt-portlet__body" style="padding: unset">--}}

{{--                                        <div class="kt-portlet__head kt-portlet__head--lg">--}}
{{--                                            <div class="kt-portlet__head-label">--}}
{{--										<span class="kt-portlet__head-icon">--}}
{{--											<i class="kt-font-brand flaticon2-line-chart"></i>--}}
{{--										</span>--}}
{{--                                                <h3 class="kt-portlet__head-title">--}}
{{--                                                    Multiple Controls--}}
{{--                                                </h3>--}}
{{--                                            </div>--}}
{{--                                            <div class="kt-portlet__head-toolbar">--}}
{{--                                                <div class="kt-portlet__head-wrapper">--}}
{{--                                                    <div class="kt-portlet__head-actions">--}}

{{--                                                        <a href="{{url('purchase')}}"--}}
{{--                                                           class="btn btn-brand btn-elevate btn-icon-sm"--}}
{{--                                                           data-toggle="modal" data-target=".new_payment"><i--}}
{{--                                                                class="la la-plus"></i>--}}
{{--                                                            New Purchase--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--begin: Datatable -->--}}
{{--                                        <div--}}
{{--                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>--}}
{{--                                        <table id="datatable-responsive"--}}
{{--                                               class="table table-striped table-bordered dt-responsive  nowrap "--}}
{{--                                               cellspacing="0" width="100%">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th>Purchase ID</th>--}}
{{--                                                <th>Restaurant name</th>--}}
{{--                                                <th>Supplier Name</th>--}}
{{--                                                <th>Total price</th>--}}
{{--                                                <th>Actions</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @foreach($supplier->purchases as $purchase)--}}
{{--                                                <tr>--}}
{{--                                                    <td>{{$purchase->id}}</td>--}}
{{--                                                    <td>{{$purchase->restaurant->user->name}}</td>--}}
{{--                                                    <td>{{$purchase->supplier->user->name}}</td>--}}
{{--                                                    <td>{{$purchase->total}}</td>--}}

{{--                                                    <td>--}}
{{--                                                        <a title="Show" href="{{url('purchase/show/'.$purchase->id)}}">--}}
{{--                                                            <i class="fa fa-book-open"></i></a>--}}

{{--                                                        --}}{{--                                <a title="delete" href="{{url('product/delete/'.$product->id)}}"> <i style="color: red"--}}
{{--                                                        --}}{{--                                                                                                     class="flaticon-delete"></i></a>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}

{{--                                            </tbody>--}}
{{--                                        </table>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

                                <!--End:: Tab Content-->
                                <!--Begin:: Tab Content-->
{{--                                <div class="tab-pane" id="kt_apps_supplier_payments" role="tabpanel">--}}

{{--                                    <div class="kt-portlet__body" style="padding: unset">--}}

{{--                                        <div class="kt-portlet__head kt-portlet__head--lg">--}}
{{--                                            <div class="kt-portlet__head-label">--}}
{{--										<span class="kt-portlet__head-icon">--}}
{{--											<i class="kt-font-brand flaticon2-line-chart"></i>--}}
{{--										</span>--}}
{{--                                                <h3 class="kt-portlet__head-title">--}}
{{--                                                    Multiple Controls--}}
{{--                                                </h3>--}}
{{--                                            </div>--}}
{{--                                            <div class="kt-portlet__head-toolbar">--}}
{{--                                                <div class="kt-portlet__head-wrapper">--}}
{{--                                                    <div class="kt-portlet__head-actions">--}}

{{--                                                        <a href="{{route('payment.create')}}"--}}
{{--                                                           class="btn btn-brand btn-elevate btn-icon-sm"--}}
{{--                                                           data-toggle="modal" data-target=".new_payment"><i--}}
{{--                                                                class="la la-plus"></i>--}}
{{--                                                            New Payment--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--begin: Datatable -->--}}
{{--                                        <div--}}
{{--                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>--}}
{{--                                        <table id="datatable-responsive"--}}
{{--                                               class="table table-striped table-bordered dt-responsive  nowrap "--}}
{{--                                               cellspacing="0" width="100%">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th> ID</th>--}}
{{--                                                <th>Sender Id</th>--}}
{{--                                                <th>Sender name</th>--}}
{{--                                                <th>amount</th>--}}
{{--                                                <th>method</th>--}}
{{--                                                <th>due date</th>--}}
{{--                                                <th>action</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @foreach($supplier->payment as $payment)--}}


{{--                                                <tr>--}}
{{--                                                    <td>{{$payment->id}}</td>--}}
{{--                                                    <td>{{$payment->sender->id}}</td>--}}
{{--                                                    <td>{{$payment->sender->name}}</td>--}}
{{--                                                    <td>{{$payment->payment_amount}}</td>--}}
{{--                                                    <td>{{$payment->payment_method}}</td>--}}
{{--                                                    <td>{{$payment->due_date}}</td>--}}
{{--                                                    <td><a title="delete"--}}
{{--                                                           href="{{url('purchase/delete/'.$payment->id)}}">--}}
{{--                                                            <i style="color: red" class="flaticon-delete"></i></a>--}}
{{--                                                    </td>--}}
{{--                                                --}}{{--                                                    --}}{{----}}{{--                    <td>{{$product->unit->name}}</td>--}}
{{--                                                --}}{{--                                                    <td>1</td>--}}
{{--                                                --}}{{--                                                    <td>{{$payment->barcode}}</td>--}}
{{--                                                --}}{{--                                                    <td>{{$payment->reorder_point}}</td>--}}
{{--                                                --}}{{--                                                    <td>{{$payment->vat}}</td>--}}
{{--                                                --}}{{--                                                    <td>--}}
{{--                                                --}}{{--                                                        <a title="update"--}}
{{--                                                --}}{{--                                                           data-toggle="modal" data-target=".bd-example-modal-lg"--}}
{{--                                                --}}{{--                                                           data-id="{{$product->id}}" data-name="{{$product->name}}"--}}
{{--                                                --}}{{--                                                           data-unit="1"--}}
{{--                                                --}}{{--                                                           data-barcode="{{$product->barcode}}"--}}
{{--                                                --}}{{--                                                           data-vat="{{$product->vat}}"--}}
{{--                                                --}}{{--                                                           data-reorder="{{$product->reorder_point}}"><i--}}
{{--                                                --}}{{--                                                                class="flaticon-edit-1"></i>--}}
{{--                                                --}}{{--                                                        </a>--}}
{{--                                                --}}{{--                                                        <a title="delete"--}}
{{--                                                --}}{{--                                                           href="{{url('product/delete/'.$product->id)}}"> <i--}}
{{--                                                --}}{{--                                                                style="color: red"--}}
{{--                                                --}}{{--                                                                class="flaticon-delete"></i></a>--}}
{{--                                                --}}{{--                                                    </td>--}}

{{--                                                --}}{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                            --}}{{--                {{dd($products)}}--}}


{{--                                            </tbody>--}}
{{--                                        </table>--}}

{{--                                    </div>--}}


{{--                                    <div--}}
{{--                                        class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>--}}

{{--                                    <div class="kt-form__actions">--}}

{{--                                    </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}

                                <!--End:: Tab Content-->
                            </div>
                        </div>
                    </div>

                    <!--End:: Portlet-->
                </div>


            </div>
        </div>

        <!-- end:: Content -->
    </div>

@stop
@section('scripts')

    <script>
        $(document).ready(function () {

            $("#datatable-responsive").DataTable({
                order: [0, 'desc'],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],

            });
        })
    </script>

@stop
