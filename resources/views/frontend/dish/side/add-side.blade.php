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
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.edit',[$dish_size->dish->id])}}" data-ktwizard-type="step"
                                   data-ktwizard-state="done">
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
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.size.index',[$dish_size->dish->id])}}" data-ktwizard-type="step" data-ktwizard-state="done">
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
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.recipe.index',[$dish_size->id])}}" data-ktwizard-type="step" data-ktwizard-state="done">
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
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.side.index',[$dish_size->id])}}" data-ktwizard-type="step"data-ktwizard-state="current">
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
                                <a class="kt-wizard-v1__nav-item" href="{{route('dish.extra.index',[$dish_size->id])}}" data-ktwizard-type="step">
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
                        <form style="padding: unset" class="kt-form" action="{{route('dish.side.store')}}"
                              method="post" id="kt_form"
                              enctype="multipart/form-data">
                        @csrf
                        <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">
                                <div
                                    class="kt-heading kt-heading--md">{{trans('main.create')}} {{trans('main.recipe')}}</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="row">
                                            <div class="col">

                                                <div class="form-group">
                                                    <input type="hidden" name="dish_size_id" value="{{$dish_size->id}}">
                                                    <label>{{trans('main.sides')}}</label>
                                                    <select name="dish" id="dish" class="form-control">
                                                        <option
                                                            value="">{{trans('main.select')}} {{trans('main.sides')}}</option>
                                                        @foreach($categories as $category )
                                                            <optgroup label="{{$category->name}}">
                                                                @foreach($category->dishes as $dish )
                                                                    <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;{{$dish->name}}">
                                                                        @foreach($dish->sizes as $size )
                                                                    <option value="{{$size->id}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$size->name}}</option>
                                                                        @endforeach

                                                                    </optgroup>
                                                                @endforeach

                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                    <span class="form-text text-muted"> {{trans('main.select')}} {{trans('main.side')}}  {{trans('main.dish')}} </span>
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
                        <h2> {{trans('main.sides')}} {{trans('main.of')}} {{$dish_size->dish->name}} -> {{$dish_size->name}}</h2>
                        <!--begin: Datatable -->
                        <table id="datatable-responsive"
                               class="display table table-striped table-bordered " cellspacing="0"
                               style="width:100%">            <thead>
                            <tr>
                                <th>{{trans('main.side')}} {{trans('main.name')}}</th>
                                <th>{{trans('main.side')}} {{trans('main.size')}}</th>
                                <th>{{trans('main.Delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dish_size->sides as $side)
{{--                              {{  dd($side->sideSize->dish)}}--}}
                                {{----}}
                                <tr>
                                    <td>{{$side->sideSize->dish->name}}</td>
                                    <td>{{$side->sideSize->name}}</td>
                                    <td>
                                        <a title="delete" href="{{route('dish.side.delete',[$side->id])}}"> <i
                                                style="color: red"
                                                class="flaticon-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    {{----}}
    <script>
        var convertion_rate = 0;
        var unitName = '';

        $(document).ready(function () {
//
            $("#product").on('change', function (e) {

                var productId = $("#product").val();
                $.get('/get-unit-of-product/' + productId, function (data) {
                    // console.log(data);
                    convertion_rate = parseFloat(data.unit.convert_rate);
                    unitName = data.unit.unit;
                    $("#unit").text(data.unit.unit);
                    $("#child_unit").text(data.unit.child_unit);
                });
            });
            $("#quantity").on('change keyup', function (e) {
                console.log('dddddddd');
                $("#child").val(parseFloat($(this).val() * convertion_rate));


            });


        })
    </script>

@stop


