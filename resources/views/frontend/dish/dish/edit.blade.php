@extends('layouts.welcome')

@section('title')
    {{trans('main.edit dish')}}
@stop
@section('head')
    <link href="{{asset('css/demo1/pages/general/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css"/>
    <style>

        .upload_image {
            position: relative;
            width: 100%;
            height: 250px;
            text-align: center;
            border: 5px dashed #ececec;

        }

        input[type="file"] {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            left: 0;
            z-index: 9999;
            cursor: pointer;
        }

        .upload_icon {
            width: 150px;
            margin-top: 20px;
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            top: 40px;
        }

        #blah {
            height: 240px;
            position: absolute;

            left: 0;
            right: 0;
            margin: 0 auto;
        }



    </style>
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
                           @if($dish->type=='dish')
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

                               @endif
                            </div>
                        </div>

                        <!--end: Form Wizard Nav -->
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <!--begin: Form Wizard Form-->
                        <form class="kt-form" action="{{route('dish.update',[$dish->id])}}" method="post" id="kt_form" enctype="multipart/form-data">
                        @csrf
                            @method('put')
                        <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v1__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">
                                <div
                                    class="kt-heading kt-heading--md">{{trans('main.create')}} {{trans('main.dish')}}</div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v1__form">
                                        <div class="upload_image form-group" >

                                            <input type="file" name="image"  id="imgInp" />
                                            <img class="upload_icon" src="{{asset('images/upload_img.png')}}" alt="">
                                            <img id="blah"class="img-fluid" src="{{asset($dish->image)}}" />

                                        </div>

                                        <div class="form-group">
                                            <label>{{trans('main.name')}} </label>
                                            <input type="text" class="form-control" name="name"
                                                   value="{{$dish->name}}" >
                                            <span class="form-text text-muted">{{trans('main.dish')}}  {{trans('main.name')}} .</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{trans('main.description')}} </label>
                                            <input type="text" class="form-control"  value="{{$dish->description}}" name="description">
                                            <span class="form-text text-muted">{{trans('main.dish')}}  {{trans('main.description')}} </span>
                                        </div>
                                        <div class="form-group">
                                            <label> {{trans('main.sides_limit')}}</label>
                                            <input type="number"  class="form-control" name="sides_limit"  value="{{$dish->sides_limit}}" >
                                            <span class="form-text text-muted"> {{trans('main.sides_limit')}} </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('main.category')}} </label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">{{trans('main.select')}}  {{trans('main.category')}} </option>
                                            @foreach($categories as $category )
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">{{trans('main.dish')}}  {{trans('main.category')}} </span>

                                    </div>
                                    <div class="form-group">
                                        <label> {{trans('main.department')}}</label>
                                        <select name="department"id="department" class="form-control">
                                            <option value=""> {{trans('main.select')}}  {{trans('main.department')}}</option>
                                            @foreach($departments as $department )
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('main.type')}} </label>
                                        <select name="type"  id="type" class="form-control">
                                            <option value="">{{trans('main.select')}}  {{trans('main.type')}} </option>
                                            <option value="dish">{{trans('main.dish')}} </option>
                                            <option value="side">{{trans('main.side')}} </option>
                                            <option value="extra">{{trans('main.extra')}} </option>
                                        </select>
                                        <span class="form-text text-muted">{{trans('main.dish')}}  {{trans('main.type')}} </span>

                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('main.status')}} </label>
                                        <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox"  @if($dish->status==1)checked="checked" @endif name="status">
												<span></span>
												</label>
											</span></div>

                                </div>


                            </div>

                            <!--end: Form Wizard Step 1-->

                            <!--begin: Form Actions -->
                            <div class="kt-form__actions">

                                <div >
                                    <button type="submit" class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">{{trans('main.update')}}  </button>
                                </div>
                            </div>

                            <!--end: Form Actions -->
                        </form>

                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    {{----}}
    <script src="{{asset('/js/demo1/pages/crud/forms/widgets/dropzone.js')}}" type="text/javascript"></script>
    <script>

        $(document).ready(function () {

            $('#type')      .val('{{$dish->type}}');
            $('#category')  .val('{{$dish->dish_category_id}}');
            $('#department')  .val('{{$dish->department_id}}');

        })
    </script>

@stop
