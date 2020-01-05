@extends('layouts.welcome')


@section('title')
    {{trans('main.create leave')}}
@stop


@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">

                <div class="kt-portlet">

                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" method="post" action="{{route('leave.store')}}">
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

                                    <h3> {{trans('main.create')}}  {{trans('main.leave')}}</h3>
                                    <div class="form-group row">

                                        <div class="col-12">
                                            <label> {{trans('main.name')}}</label>
                                        <select name="type" class="form-control">
                                            <option value="">{{trans('main.select')}} {{trans('main.type')}}</option>
                                        @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="">{{trans('main.from')}} :</label>
                                            <input type="date" name="from" class="form-control" >
                                        </div>


                                        <div class="col-12">
                                            <label class="">{{trans('main.to')}} :</label>
                                            <input type="date" name="to" class="form-control" >
                                        </div>


                                        <div class="col-12">
                                            <label class="">{{trans('main.reason')}} :</label>
                                            <input type="text" name="reason" class="form-control"
                                                   placeholder="{{trans('main.enter')}} {{trans('main.reason')}}">
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

@stop
