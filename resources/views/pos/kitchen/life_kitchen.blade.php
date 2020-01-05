@extends('.pos.layout.pos_app')


@section('title')
    {{trans('main.life kitchen')}}
@stop



@section('content')
    <div class="row" >
        <div class="col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head-label">

                    <div class="row ">
                        <div class="col-3 "><h2 class="kt-portlet__head-title text-center">
                                {{trans('main.life kitchen')}}
                            </h2></div>
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
                    <div class="row " id="orders">

                    </div>
                </div>
            </div>

        </div>
    </div>


@stop
@section('scripts')
    <script src="{{ url('/app_js/lifekitchen.js') }}"></script>
@stop
