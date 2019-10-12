@extends('layouts.welcome')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="alert alert-light alert-elevate" role="alert">
            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
            <div class="alert-text">
                You can use the dom initialisation parameter to move DataTables features around the table to where you
                want them.
                See official documentation <a class="kt-link kt-font-bold"
                                              href="https://datatables.net/examples/advanced_init/dom_multiple_elements.html"
                                              target="_blank">here</a>.
            </div>
        </div>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Multiple Controls
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Choose an option</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">Print</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                <span class="kt-nav__link-text">Copy</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                <span class="kt-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            &nbsp;
                            <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Record
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form kt-form--label-right" method="post" action="{{route('restaurant.store')}}">

                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                               Branch of Resturant

                            </h3>
                            <span class="kt-switch kt-switch--lg">
																	<label>
																		<input type="checkbox" readonly checked="checked" name="branch">
																		<span></span>
																	</label>
																</span>
                        </div>
                    </div>

                    <!--begin::Form-->
                      @csrf  <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3>Personal Information</h3>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Full Name:</label>
                                            <input type="text"required name="name" class="form-control" placeholder="Enter full name">
                                            <span class="form-text text-muted">Please enter your full name</span>
                                        </div>
                                        <div class="col-12">
                                            <label class="">Email:</label>
                                            <input type="email"required name="email" class="form-control" placeholder="Enter email">
                                            <span class="form-text text-muted">Please enter your email</span>
                                        </div>
                                        <div class="col-12">
                                            <label>Password :</label>
                                            <input type="password" required name="password" class="form-control" placeholder="********">
                                            <span class="form-text text-muted">Please enter password</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4" id="kt_repeater_1">
                                    <h3>Contact Information<a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand pull-right">
                                            <i class="la la-plus"></i> Add
                                        </a></h3>
                                        <div class="repeater" class="form-group  row">
                                            <div data-repeater-list="phone_g" class="col-lg-12">
                                                <div data-repeater-item class="row kt-margin-b-10">
                                                    <div class="col-lg-5">
                                                        <label>Phone</label>

                                                        <div class="input-group">

                                                            <input type="text" required class="form-control form-control-danger" name="phone" placeholder="012**********">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label>Type</label>

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
                                    <h3>Addresses Information<a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand pull-right">
                                            <i class="la la-plus"></i> Add
                                        </a></h3>
                                    <div data-repeater-list="address_g">
                                    <div class="form-group form-group-last row"  data-repeater-item>

                                        <div class="col-lg-12">
                                            <label>Address:</label>
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" name="address" class="form-control"
                                                      required placeholder="Enter your address">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                            class="la la-map-marker"></i></span></span>
                                            </div>
                                            <span class="form-text text-muted">Please enter your address</span>
                                        </div>
                                        <div  class="col-lg-12">
                                            <div  class="row kt-margin-b-10">
                                                <div class="col-lg-5">
                                                    <label>Country</label>
                                                        <select class="form-control country"name="country" onchange="changecity(this)">
                                                            <option value="00">Select Country</option>
                                                           @foreach($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
@endforeach
                                                        </select>
                                                </div>
                                                <div class="col-lg-5">
                                                    <label>City</label>

                                                        <select class="form-control" name="city">
                                                            <option value="00">Select City</option>

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
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

            </div>
        </div>
    </form>

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
