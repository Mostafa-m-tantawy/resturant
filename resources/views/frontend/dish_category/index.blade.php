@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop

@section('title')
    {{trans('main.index dish category')}}
@stop


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
                        {{trans('main.dishes')}} {{trans('main.categories')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="#"  data-toggle="modal" data-target="#newunit" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}} {{trans('main.record')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!--begin: Datatable -->
                    <table id="datatable-responsive"
                           class="display table table-striped table-bordered " cellspacing="0"
                           style="width:100%">          <thead>
                    <tr>
                        <th>{{trans('main.id')}}</th>
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.description')}}</th>
                        <th>{{trans('main.show')}}</th>
                        <th>{{trans('main.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        {{----}}
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td>{{$category->show?'yes':'no'}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".updatemodel"
                                   data-name="{{$category->name}}" data-id="{{$category->id}}"
                                   data-description="{{$category->description}}" data-isshow="{{$category->show}}">
                                    <i class="flaticon-edit-1"></i>
                                </a>
                            </td>
                            {{----}}
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <div class="modal fade updatemodel" id="updatemodel" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form  method="post">
                    {{--                    {{url('unit/update)}}--}}
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.category')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <label>{{trans('main.id')}}</label>
                                    <input type="number" readonly class="form-control" name="id">
                                </div>
                                <div class="col-12">
                                    <label>{{trans('main.name')}}</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="col-12">
                                    <label>{{trans('main.description')}}</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                                <div class="form-group col-12">
                                    <label style="display: block;"> {{trans('main.show')}}</label>
                                    <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" id="show" name="show" class="form-control">
												<span></span>
												</label>
											</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.update')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
        <div class="modal fade delete" id="newunit" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{url('cost/dish-category')}}" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">{{trans('main.create')}} {{trans('main.dish')}} {{trans('main.category')}} <span class="model_type"></span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-1"></div>

                                <div class="col-10">

                                    <div class="form-group">
                                        <label>{{trans('main.name')}}</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>

                                    <div class=" form-group">
                                        <label>{{trans('main.description')}}</label>
                                        <input type="text" class="form-control" name="description">
                                    </div>
                                    <div class="form-group ">
                                        <label style="display: block;"> {{trans('main.show')}}</label>
                                        <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" id="show" name="show" class="form-control">
												<span></span>
												</label>
											</span>
                                    </div>

                                </div>

                                <div class="col-1"></div>


                            </div>


                        </div>
                        <div class="modal-footer">
                            <div class="col-12 pull-left">
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.create')}}</button>
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
                var Id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                var description = $(e.relatedTarget).data('description');
                var show = $(e.relatedTarget).data('show');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('input[name="description"]').val(description);

                console.log(show);
              if(show!=0 && show!=null)
                  $(e.currentTarget).find('input[name="show"]').attr('checked',true);

                $(e.currentTarget).find('form').attr('action', "{{url('cost/dish-category/update')}}" );
            });

        })
    </script>

@stop
