@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">


        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

            <div class="row">
                <div class="col-xl-12">

                    <!--begin:: Widgets/Product Sales-->
                    <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{$product->name}}
                                    <small> {{trans('main.restaurant stock')}}</small>
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget25">
                                <span class="kt-widget25__stats m-font-brand">{{$product->quantity}}</span>
                                <span class="kt-widget25__subtitle">
                                        {{trans('main.restaurant stock')}}
                                </span>
                                <div class="kt-widget25__items">
                                    <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: green">
															{{$purchase}}
														</span>
                                        <div class="progress kt-progress--sm">
                                            <div class="progress-bar kt-bg-success" role="progressbar"
                                                 style="color: green; width: @if($purchase!=0){{($purchase/$purchase)*100}}% @else 0% @endif"
                                                 aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                        <span class="kt-widget25__desc" style="color: green">
															{{trans('main.purchases')}}
														 </span>
                                    </div>
                                    <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: red">
															{{$refund}}
														</span>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar kt-bg-danger" role="progressbar"
                                                 style=" color: red; width: @if($purchase!=0){{($refund/$purchase)*100}}% @else 0% @endif; "
                                                 aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                        <span class="kt-widget25__desc" style="color: red">
															{{trans('main.refund')}}
														</span>
                                    </div>
                                    <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: red">
															{{$ruind}}
														</span>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar kt-bg-danger" role="progressbar"
                                                 style="color: red; width: @if($purchase!=0){{($ruind/$purchase)*100}}% @else 0% @endif ;"
                                                 aria-valuenow="50" aria-valuemin="0"
                                                 aria- aria-valuemax="100"></div>
                                        </div>
                                        <span class="kt-widget25__desc" style="color: red">
															{{trans('main.ruined')}}
														</span>
                                    </div>
                                    <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: red">
															{{$assign_to_other}}
														</span>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar kt-bg-danger" role="progressbar"
                                                 style="color: red;
                                                     width:@if($purchase!=0)
                                                 {{($assign_to_other/$purchase)*100}}%
                                                 @else
                                                     0%
                                                 @endif;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                                            </div>
                                        </div>
                                        <span class="kt-widget25__desc" style="color: red">
															{{trans('main.assign to departments')}}
														</span>
                                    </div>
                                    <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: green">
															{{$assign_to_me}}
														</span>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar kt-bg-success" role="progressbar"
                                                 style="color: green; width: @if($purchase!=0){{($assign_to_me/$purchase)*100}}% @else 0% @endif;"
                                                 aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                        <span class="kt-widget25__desc" style="color: green">
															{{trans('main.assign to restaurant from department')}}
														</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Product Sales-->

                </div>


                @foreach($departments as $department)
                    <div class="col-xl-6">

                        <!--begin:: Widgets/Product Sales-->
                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{$department->name}}
                                        <small> {{trans('main.department stock')}}</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget25">
                                    <span
                                        class="kt-widget25__stats m-font-brand">{{$product->departmentquantity($department)}}</span>
                                    <span class="kt-widget25__subtitle">
                                      {{trans('main.department stock')}}
                                </span>
                                    <div class="kt-widget25__items">
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: green">
															{{$product->assginedToMe($department)}}
														</span>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar kt-bg-success" role="progressbar"
                                                     style="color: green; width: @if($product->assginedToMe($department)!=0){{($product->assginedToMe($department)/$product->assginedToMe($department))*100}}% @else 0% @endif"
                                                     aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc" style="color: green">
															{{trans('main.assign from restaurant')}}
														 </span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: red">
															{{$product->assginedToOthers($department)}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-danger" role="progressbar"
                                                     style=" color: red; width: @if($product->assginedToMe($department)!=0){{($product->assginedToOthers($department)/$product->assginedToMe($department))*100}}% @else 0% @endif; "
                                                     aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc" style="color: red">
															{{trans('main.assign to restaurant')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: red">
															{{$product->ruinedFromMe($department)}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-danger" role="progressbar"
                                                     style="color: red; width: @if($product->assginedToMe($department)!=0){{($product->ruinedFromMe($department)/$product->assginedToMe($department))*100}}% @else 0% @endif ;"
                                                     aria-valuenow="50" aria-valuemin="0"
                                                     aria- aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc" style="color: red">
															{{trans('main.ruined')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number" style="color: red">
															{{$product->cookedProduct($department)}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-danger" role="progressbar"
                                                     style="color: red;
                                                         width:@if($product->assginedToMe($department)!=0)
                                                     {{($product->cookedProduct($department)/$product->assginedToMe($department))*100}}%
                                                     @else
                                                         0%
                                                     @endif;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                                                </div>
                                            </div>
                                            <span class="kt-widget25__desc" style="color: red">
															{{trans('main.cooked')}}
														</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Product Sales-->

                    </div>

                @endforeach


                <div class="col-xl-12">

                    <!--Begin:: Portlet-->
                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                                    role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_purchases"
                                           role="tab">
                                            <i class="flaticon2-calendar-3"></i> {{trans('main.purchases')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_ruined"
                                           role="tab">
                                            <i class="flaticon2-user-outline-symbol"></i> {{trans('main.ruined')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_refund"
                                           role="tab">
                                            <i class="flaticon2-gear"></i> {{trans('main.refund')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_assign"
                                           role="tab">
                                            <i class="flaticon2-gear"></i> {{trans('main.assign')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content kt-margin-t-20">

                                <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane active" id="kt_apps_purchases" role="tabpanel">

                                    <div class="kt-portlet__body" style="padding: unset">

                                        <div class="kt-portlet__head kt-portlet__head--lg">
                                            <div class="kt-portlet__head-label">
										        <span class="kt-portlet__head-icon">
											        <i class="kt-font-brand flaticon2-line-chart"></i>
										        </span>
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('main.product purchases')}}
                                                </h3>
                                            </div>

                                        </div>
                                        <!--begin: Datatable -->
                                          <table id="datatable-responsive"
                                               class="display table table-striped table-bordered " cellspacing="0"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{trans('main.id')}}</th>
                                                <th>{{trans('main.supplier')}}</th>
                                                <th>{{trans('main.price')}}</th>
                                                <th>{{trans('main.quantity')}}</th>
                                                <th>{{trans('main.vat')}}</th>
                                                <th>{{trans('main.total')}}</th>
                                                 </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($purchased as $purchase)
                                                <tr>
                                                    <td>{{$purchase->id}}</td>
                                                    <td>{{$purchase->purse->supplier->user->name}}</td>
                                                    <td>{{$purchase->unit_price}}</td>
                                                    <td>{{$purchase->quantity}}</td>
                                                    <td>{{($purchase->quantity * $purchase->unit_price)*($purchase->vat/100)}}</td>
                                                    <td>{{($purchase->unit_price*$purchase->quantity)+($purchase->quantity * $purchase->unit_price)*($purchase->vat/100) }}</td>


                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                                <!--End:: Tab Content-->


                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_ruined" role="tabpanel">

                                    <div class="kt-portlet__body" style="padding: unset">

                                        <div class="kt-portlet__head kt-portlet__head--lg">
                                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('main. ruined product' )}}
                                                </h3>
                                            </div>

                                        </div>
                                        <!--begin: Datatable -->
                                       <table id="datatable-responsive"
                                               class="display table table-striped table-bordered " cellspacing="0"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{trans('main.id')}}</th>
                                                <th>{{trans('main.from')}}</th>
                                                <th>{{trans('main.cost')}}</th>
                                                <th>{{trans('main.quantity')}}</th>
                                                <th>{{trans('main.vat')}}</th>
                                                <th>{{trans('main.total')}}</th>
                                                <th>{{trans('main.note')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ruineds as $ruined)
                                                <tr>
                                                    <td>{{$ruined->id}}</td>
                                                    <td>{{$ruined->ruinedHeader->ruinedable->name}}</td>
                                                    <td>{{$ruined->unit_price}}</td>
                                                    <td>{{$ruined->quantity}}</td>
                                                    <td>{{($ruined->quantity * $ruined->unit_price)*($ruined->vat/100)}}</td>
                                                    <td>{{($ruined->unit_price*$ruined->quantity)+($ruined->quantity * $ruined->unit_price)*($ruined->vat/100) }}</td>
                                                    <td>{{$ruined->note}}</td>

                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!--End:: Tab Content-->


                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_refund" role="tabpanel">

                                    <div class="kt-portlet__body" style="padding: unset">

                                        <div class="kt-portlet__head kt-portlet__head--lg">
                                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('main.refunded product')}}
                                                </h3>
                                            </div>

                                        </div>
                                        <!--begin: Datatable -->
                                        <table id="datatable-responsive"
                                               class="display table table-striped table-bordered " cellspacing="0"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{trans('main.id')}}</th>
                                                <th>{{trans('main.supplier')}}</th>
                                                <th>{{trans('main.price')}}</th>
                                                <th>{{trans('main.quantity')}}</th>
                                                <th>{{trans('main.vat')}}</th>
                                                <th>{{trans('main.total')}}</th>
                                                <th>{{trans('main.note')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($refunds as $refund)


                                                <tr>
                                                    <td>{{$refund->id}}</td>
                                                    <td>{{$refund->supplier->name}}</td>
                                                    <td>{{$refund->unit_price}}</td>
                                                    <td>{{$refund->quantity}}</td>
                                                    <td>{{($refund->quantity * $refund->unit_price)*($refund->vat/100)}}</td>
                                                    <td>{{($refund->unit_price*$refund->quantity)+($refund->quantity * $refund->unit_price)*($refund->vat/100) }}</td>
                                                    <td>{{$refund->note}}</td>

                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>


                                    <div
                                        class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>

                                    <div class="kt-form__actions">

                                    </div>
                                    </form>
                                </div>
                                <!--End:: Tab Content-->


                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_assign" role="tabpanel">

                                    <div class="kt-portlet__body" style="padding: unset">

                                        <div class="kt-portlet__head kt-portlet__head--lg">
                                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('main.product assignment')}}
                                                </h3>
                                            </div>

                                        </div>
                                        <!--begin: Datatable -->
                                      <table id="datatable-responsive"
                                               class="display table table-striped table-bordered " cellspacing="0"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th> {{trans('main.id')}}</th>
                                                <th> {{trans('main.from')}}</th>
                                                <th> {{trans('main.to')}}</th>
                                                <th> {{trans('main.product')}}</th>
                                                <th> {{trans('main.quantity')}}</th>
                                                <th>{{trans('main.created_at')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($assigns as $assign)


                                                <tr>
                                                    <td>{{$assign->id}}</td>
                                                    <td>{{$assign->assignHeader->sourceable->name}}</td>
                                                    <td>{{$assign->assignHeader->assignable->name}}</td>
                                                    <td>{{$assign->product->name}}</td>
                                                    <td>{{$assign->quantity}}</td>
                                                    <td>{{$assign->created_at}}</td>

                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>


                                    <div
                                        class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>

                                    <div class="kt-form__actions">

                                    </div>
                                    </form>
                                </div>
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
