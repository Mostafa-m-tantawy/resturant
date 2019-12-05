@extends('layouts.welcome')
@section('head')
    <link href="{{asset('css/demo1/pages/general/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">

                        <!--begin: Form Wizard Nav -->
                        <div class="kt-wizard-v1__nav">
                            <div class="kt-wizard-v1__nav-items">
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.edit',[$dish->id])}}" data-ktwizard-type="step"
                                   data-ktwizard-state="current">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <img class="img-fluid" style="height: 100px"
                                                 src="/media/icons/svg/Food/Burger.svg"/>


                                        </div>
                                        <div class="kt-wizard-v1__nav-label">

                                            1){{trans('main.dish')}}
                                        </div>
                                    </div>
                                </a>
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.size.index',[$dish->id])}}" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <img style="height: 100px" class="img-fluid"
                                                 src="/media/icons/svg/Food/Miso-soup.svg"/>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">

                                            2) {{trans('main.dish')}} {{trans('main.sizes')}}
                                        </div>
                                    </div>
                                </a>
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.size.index',[$dish->id])}}" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <img style="height: 100px" class="img-fluid"
                                                 src="/media/icons/svg/Food/Carrot.svg"/>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            3){{trans('main.dish')}} {{trans('main.recipes')}}
                                        </div>
                                    </div>
                                </a>
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.size.index',[$dish->id])}}" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <img style="height: 100px" class="img-fluid"
                                                 src="/media/icons/svg/Food/French Bread.svg"/>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            4) {{trans('main.dish')}} {{trans('main.sides')}}
                                        </div>
                                    </div>
                                </a>
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.size.index',[$dish->id])}}" data-ktwizard-type="step">
                                    <div class="kt-wizard-v1__nav-body">
                                        <div class="kt-wizard-v1__nav-icon">
                                            <img style="height: 100px" class="img-fluid"
                                                 src="/media/icons/svg/Food/Cheese.svg"/>
                                        </div>
                                        <div class="kt-wizard-v1__nav-label">
                                            5) {{trans('main.dish')}} {{trans('main.extras')}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!--end: Form Wizard Nav -->
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
                    <div class="container">


                        <!--begin: Form Wizard Form-->
                        <form style="padding: unset" class="kt-form" action="{{route('dish.size.store')}}" method="post" id="kt_form"
                              enctype="multipart/form-data">
                        @csrf
                        <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">
                                <div
                                    class="kt-heading kt-heading--md">{{trans('main.create')}} {{trans('main.Dish')}}</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="row">
                                            <div class="col">

                                                <div class="form-group">

                                                    <label>{{trans('main.name')}}</label>
                                                    <input type="hidden" name="dish_id" value="{{$dish->id}}">
                                                    <input type="text" class="form-control" name="name"
                                                           placeholder="EX: Burger">
                                                    <span class="form-text text-muted">{{trans('main.dish')}}{{trans('main.size')}} {{trans('main.name')}}.</span>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>{{trans('main.price')}}</label>
                                                    <input type="number" min="0" step="0.01" class="form-control"
                                                           name="price">
                                                    <span class="form-text text-muted">{{trans('main.dish')}}{{trans('main.price')}}</span>
                                                </div>

                                            </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{trans('main.status')}}</label>
                                                <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" checked="checked" name="status">
												<span></span>
												</label>
											</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                            </div>

                            <!--end: Form Wizard Step 1-->

                            <!--begin: Form Actions -->
                            <div class="kt-form__actions">

                                <div>
                                    <button type="submit"
                                            class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">
                                        {{trans('main.submit')}}
                                    </button>
                                </div>
                            </div>

                            <!--end: Form Actions -->
                        </form>

                        <!--end: Form Wizard Form-->
                    </div>
<br>
<br>
                    <div class="container">

                    <!--begin: Datatable -->
                        <table id="datatable-responsive"
                               class="display table table-striped table-bordered " cellspacing="0"
                               style="width:100%">            <thead>
                        <tr>
                            <th> {{trans('main.size')}}</th>
                            <th>{{trans('main.price')}}</th>
                            <th>{{trans('main.status')}}</th>
                            <th>{{trans('main.update')}}</th>
                            <th>{{trans('main.recipes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dish->sizes as $size)
                            {{----}}
                            <tr>
                                <td>{{$size->name}}</td>
                                <td>{{$size->price}}</td>
                                <td>{{$size->status}}</td>
                                <td>
                                    <a title="update"
                                       data-toggle="modal" data-target=".bd-example-modal-lg"
                                       data-dish_id="{{$dish->id}}" data-id="{{$size->id}}" data-name="{{$size->name}}"
                                       data-status="{{$size->status}}" data-price="{{$size->price}}">
                                        <i class="flaticon-edit-1"></i>
                                    </a>
{{--                                    <a title="delete" href="{{url('dish-size/delete/'.$size->id)}}"> <i--}}
{{--                                            style="color: red"--}}
{{--                                            class="flaticon-delete"></i></a>--}}
                                </td>
                                <td>
                                    <a href="{{route('dish.recipe.index',[$size->id])}}">
                                        <i class="la la-cutlery"></i>
                                    </a>
{{--                                    <a title="delete" href="{{url('dish-size/delete/'.$size->id)}}"> <i--}}
{{--                                            style="color: red"--}}
{{--                                            class="flaticon-delete"></i></a>--}}
                                </td>
                                {{----}}
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="updatemodel" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('cost/dish-size/update')}}" method="post">
                    {{--                    {{url('unit/update)}}--}}
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.size')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="kt-wizard-v1__form">

                            <div class="form-group">
                                <label>{{trans('main.name')}}</label>
                                <input type="hidden" name="id">
                                <input type="hidden" name="dish_id">
                                <input type="text" class="form-control" name="name"
                                       placeholder="EX: Burger">
                                <span class="form-text text-muted">{{trans('main.dish')}} {{trans('main.name')}}.</span>
                            </div>
                            <div class="form-group">
                                <label>{{trans('main.price')}}</label>
                                <input type="number" min="0" step="0.01" class="form-control" name="price">
                                <span class="form-text text-muted">{{trans('main.dish')}} {{trans('main.size')}}</span>
                            </div>
                            <div class="form-group">
                                <label>{{trans('main.status')}}</label>
                                <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" checked="checked" name="status">
												<span></span>
												</label>
											</span></div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.submit')}}</button>
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
            $('#updatemodel').on('show.bs.modal', function (e) {
                var dish_id = $(e.relatedTarget).data('dish_id');
                var Id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                var price = $(e.relatedTarget).data('price');
                var status = $(e.relatedTarget).data('status');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                if (status == 0)
                    $(e.currentTarget).find('input[name="status"]').prop('checked', false);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('input[name="price"]').val(price);
                $(e.currentTarget).find('input[name="dish_id"]').val(dish_id);
            });

        })
    </script>

@stop
