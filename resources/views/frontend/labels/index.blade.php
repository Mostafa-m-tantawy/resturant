@extends('layouts.master')

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/tree/css/bootstrap-treeview.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


@endsection
@section('breadcrumb')
    <div class="col-sm-6">

        <h4 class="page-title">{{ trans('labels.translation') }}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">{{ trans('labels.translation') }}</li>
        </ol>
    </div>
@endsection
@section('float-right')


@endsection



@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div id="custom-edit-modal" class="custom-modal bg-white shadow">
                        <form method="post" id="edit-labels-modal" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf

                            <div class=" header d-flex justify-content-between p-3 bg-dark">
                                <button type="button" class="btn btn-secondary" id="btn-edit-close">{{ trans('labels.close') }}</button>
                                <button type="submit" class="btn btn-primary" id="btn-edit-close">{{ trans('labels.save') }}</button>
                            </div>


                            <div data-repeater-item="" class="row">

                                <div class="col-md-12">
                                    <div class="form-group col-lg-5">
                                        <label for="edit-name">{{ trans('labels.name') }}</label>
                                        <input class="form-control" id="edit-name" placeholder="" name="name" type="text" readonly>
                                    </div>

                                    <div class="form-group col-lg-5">
                                        <label for="edit-value">{{ trans('labels.value') }}</label>
                                        <input class="form-control" id="edit-value" placeholder="" name="value" type="text">
                                    </div>
                                </div>


                            </div>
                        </form>

                    </div>
                        <div id="custom-modal" class="custom-modal bg-white shadow">
                            {{ Form::open(['route' => "labels.store",'method' => 'post','files'=>true]) }}
                            <div class=" header d-flex justify-content-between p-3 bg-dark">
                                <button type="button" class="btn btn-secondary" id="btn-close">Close</button>
                                <button type="submit" class="btn btn-primary" id="btn-close">Save changes</button>
                            </div>

<br>
                            <div data-repeater-item class="row">

                                <div class="col-md-12">
                                    <div  class="form-group col-lg-8">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name',null,['class' => 'form-control','id'=>'label-name','placeholder' => '',isset($disabled) ? 'disabled' : '','required']) !!}
                                    </div>

                                    <div  class="form-group col-lg-8">
                                        {!! Form::label('value', 'Value') !!}
                                        {!! Form::text('value',null,['class' => 'form-control','id'=>'label-value','placeholder' => '',isset($disabled) ? 'disabled' : '','required']) !!}
                                    </div>


                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>

                    {{-- form delete --}}
                    <form id="delete_labels" action="" method="post">
                        @csrf
                        @method('delete')
                    </form>
                        <button type="button" class="btn btn-info col-2" id="btn-open"><i class="fa fa-plus"></i> {{ trans('labels.create') }}</button>
                    <hr>
                    <table id="labels" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>{{ trans('labels.id') }}</th>
                            <th>{{ trans('labels.name') }}</th>
                            <th>{{ trans('labels.value') }}</th>
                            <th>{{ trans('labels.action') }}</th>
                        </tr>
                        </thead>


                        <tbody>
                        @forelse($labels as $label_key => $label_value)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $label_key }}</td>
                            <td>{{ $label_value }}</td>
                            <td><button class="btn btn-info waves-effect waves-light btn-edit" onclick="edit_modal('{{ $label_key }}')"><i class="fa fa-edit"></i>{{ trans('labels.edit') }}</button></td>
                            </tr>
                            @empty
                            <p>There are no labels added yet</p>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{URL::asset('assets/tree/js/bootstrap-treeview.js')}}"></script>


    <!-- Required datatable js -->
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ URL::asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ URL::asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('assets/pages/datatables.init.js') }}"></script>

    <script>
        function confirm_delete(id)
        {
            var confirm=window.confirm('delete record ?")');

            if(confirm)
            {
                $('#delete_labels').attr('action','{{url("labels/delete")}}'+"/"+id+"/");
                $('#delete_labels').submit();
            }
            else{
                return false;
            }

        }

        function edit_modal(label_key)
        {
            console.log(label_key);
            $.ajax({
                type:'get',
                url:"{{url('labels/edit/')}}"+"/"+label_key,
                success:function(data)
                {
                    $("#custom-edit-modal").addClass("active");
                    $('#edit-labels-modal').attr('action','{{url("labels/update/")}}'+"/"+data.value).attr('method','post');
                    $('#edit-name').val(data.name);
                    $('#edit-value').val(data.value);
                    $('#edit-old-value').val(data.value);
                    $("#btn-edit-close").on("click",(e)=>{
                        $("#custom-edit-modal").removeClass("active");
                    });
                }
            });
        }

    </script>


@endsection
