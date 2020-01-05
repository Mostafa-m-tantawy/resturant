@extends('layouts.welcome')

@section('title')
    {{trans('main.system configuration')}}
@stop

@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">

            <div class="kt-portlet__body">

                <div class="kt-portlet">

                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" method="post" action="{{url('system-configuration/store')}}">
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

                                    <h3> {{trans('main.system configuration')}}  </h3>
                                    <div class="row">
                                        <div class="col-12 form-group">

                                            <label> {{trans('main.vat')}} %</label>
                                            <input type="number" step="0.01" required  value="{{$systemconf->where('name','vat')->first()->value}}" name="vat" class="form-control" placeholder="14">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label class="">{{trans('main.service')}} %</label>
                                            <input type="number" step="0.01" required value="{{$systemconf->where('name','service')->first()->value}}"name="service" class="form-control" placeholder="12">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label class="">{{trans('main.cost method')}}:</label>
                                            <select name="methodd" id="methodd" required  class="form-control" >
                                                <option value="">{{trans('main.select')}}  {{trans('main.method')}} </option>
                                                <option value="last_cost">{{trans('main.last')}} {{trans('main.cost')}}</option>
                                                <option value="avg_cost"> {{trans('main.average')}} {{trans('main.cost')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group" id="divmonth" value="{{$systemconf->where('name','months')->first()->value}}" style="display: none">
                                            <label class="">{{trans('main.number of months')}} :</label>
                                            <input type="number" step="1" name="months"value="{{$systemconf->where('name','months')->first()->value}}"  class="form-control" placeholder="6">
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
        $(document).ready(function () {


            $('#methodd').change(function () {
                $('#divmonth').css('display', 'none');

                if ($(this).val() == 'avg_cost')
                    $('#divmonth').css('display', 'block');
            });

            $('#methodd').val('{{ $systemconf->where('name','method')->first()->value}}');
            if('{{ $systemconf->where('name','method')->first()->value}}'=='avg_cost'){
                $('#divmonth').css('display', 'block');

            }
        })
    </script>

@stop
