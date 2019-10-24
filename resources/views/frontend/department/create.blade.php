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
                        {{trans('main.create')}}  {{trans('main.department')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                           &nbsp;
                            <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}}  {{trans('main.record')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <div class="kt-portlet">

                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" method="post" action="{{route('department.store')}}">
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

                                    <h3> {{trans('main.department')}}  {{trans('main.information')}}</h3>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label> {{trans('main.name')}}</label>
                                            <input type="text"required name="name" class="form-control" placeholder="Enter full name">
                                        </div>
                                        <div class="col-12">
                                            <label class="">{{trans('main.description')}} :</label>
                                            <input type="text" name="description" class="form-control" placeholder="Enter description">
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

    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
<script>

        function changecity(select){


        $.ajax('{{url('/')}}/states',{
            method:'post',
            data:{_token:'{{@csrf_token()}}',id:$(select).val()},
            dataType:'JSON',
            success:function(data){
                // $('#cityoption').html('');
                // console.log(  $(select).parent().parent().find(' .col-lg-5:nth-child(2) select ').html('ssssss'));
                $(select).parent().parent().find(' .col-lg-5:nth-child(2) select').empty();

                for (var i=0;i<data.length;i++){
                    $(select).parent().parent().find(' .col-lg-5:nth-child(2) select').append('           ' +
                        '<option value="'+data[i].id+'">'+data[i].name+'</option>');
                }
            },
            error:function() {
                alert('There is an error  exist make sure you are  log in ');
            }
        });
    }

</script>
@stop
