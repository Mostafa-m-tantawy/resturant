@extends('layouts.welcome')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">

                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">&nbsp;
                            <a href="{{route('supplier.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{ trans('main.all') }} {{ trans('main.suppliers') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{ trans('main.create') }}  {{ trans('main.supplier') }}
                            </h3>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" method="post" action="{{route('supplier.store')}}">
                      @csrf  <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3>{{trans('main.personal')}} {{trans('main.information')}}</h3>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>{{trans('main.name')}}:</label>
                                            <input type="text"required name="name" class="form-control" placeholder="Enter full name">
                                        </div>
                                        <div class="col-12">
                                            <label class="">{{trans('main.email')}}:</label>
                                            <input type="email"required name="email" class="form-control" placeholder="Enter email">
                                        </div>

                                        <div class="col-12">
                                            <label>{{trans('main.Starting Balance')}} :</label>
                                            <input type="number" step='0.01' name="balance" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" id="kt_repeater_1">
                                    <h3>{{trans('main.contact')}} {{trans('main.information')}}<a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand pull-right">
                                            <i class="la la-plus"></i> {{trans('main.add')}}
                                        </a></h3>
                                        <div class="repeater" class="form-group  row">
                                            <div data-repeater-list="phone_g" class="col-lg-12">
                                                <div data-repeater-item class="row kt-margin-b-10">
                                                    <div class="col-lg-5">
                                                        <label>{{trans('main.phone')}}</label>

                                                        <div class="input-group">

                                                            <input type="text" required class="form-control form-control-danger" name="phone" placeholder="012**********">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label>{{trans('main.type')}}</label>

                                                        <div class=" form-group input-group">

                                                            <input type="text" required class="form-control form-control-danger"name="type" placeholder="Ex: office">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2" style=" display: flex;
  justify-content: center;
  align-items: center">
                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                                            <i class="la la-remove"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                                <div class="col-md-4" id="kt_repeater_2"class="repeater">
                                    <h3>{{trans('main.addresses')}} {{trans('main.information')}}<a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand pull-right">
                                            <i class="la la-plus"></i> {{trans('main.add')}}
                                        </a></h3>
                                    <div data-repeater-list="address_g">
                                    <div class="form-group form-group-last row"  data-repeater-item>

                                        <div class="col-lg-12">
                                            <label>   {{trans('main.address')}}:</label>
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" name="address" class="form-control"
                                                      required placeholder="Enter your address">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                            class="la la-map-marker"></i></span></span>
                                            </div>
                                        </div>
                                        <div  class="col-lg-12">
                                            <div  class="row kt-margin-b-10">
                                                <div class="col-lg-5">
                                                    <label>{{trans('main.country')}}</label>
                                                        <select class="form-control country"name="country" onchange="changecity(this)">
                                                            <option value="00">{{trans('main.select')}} {{trans('main.country')}}</option>
                                                           @foreach($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
@endforeach
                                                        </select>
                                                </div>
                                                <div class="col-lg-5">
                                                    <label>{{trans('main.city')}}</label>

                                                        <select class="form-control" name="city">
                                                            <option value="00">{{trans('main.select')}} {{trans('main.city')}}</option>

                                                        </select>
                                                </div>
                                                <div class="col-lg-2" style=" display: flex;
  justify-content: center;
  align-items: center">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                                        <i class="la la-remove"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

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
