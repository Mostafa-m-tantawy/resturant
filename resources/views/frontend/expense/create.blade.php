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
                        {{trans('main.create')}} {{trans('main.expense')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                            <a href="{{route('expenses.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.all')}} {{trans('main.expenses')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <div class="kt-portlet">


                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" method="post" action="{{route('expenses.store')}}">
                      @csrf  <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-md-12">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <h3>{{trans('main.expense')}}  {{trans('main.information')}}</h3>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>{{trans('main.payment')}} {{trans('main.method')}}</label>
                                         <select id="payment_method" class="form-control" name="payment_method">
                                             <option value="0"> {{trans('main.select')}} {{trans('main.method')}}</option>
                                             <option value="cash">{{trans('main.cash')}} </option>
                                             <option value="check">{{trans('main.check')}} </option>
                                         </select>
                                          </div>
                                        <div class="col-12"id="duedate"  style="display: none">
                                            <label class="">{{trans('main.Due Date')}}</label>
                                            <input type="date"  name="duedate" class="form-control">
                                        </div>
                                        <div class="col-12">
                                            <label class="">{{trans('main.payment')}} {{trans('main.amount')}} </label>
                                            <input type="number" required name="payment_amount" class="form-control">
                                        </div>
                                        <div class="col-12">
                                            <label>{{trans('main.note')}}  :</label>
                                            <input type="text" required name="note" class="form-control" >
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
                                        <button type="submit" class="btn btn-primary">{{trans('main.submit')}}</button>
                                        <button type="reset" class="btn btn-secondary">{{trans('main.cancel')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

            </div>
        </div>

    </div>

@stop
@section('scripts')

    <script>
$('document').ready(function () {
    $('#payment_method').change(function () {
        $('#duedate').css('display','none');
       if($(this).val()=='check'){
           $('#duedate').css('display','unset');

       }
    })
});
</script>
@stop
