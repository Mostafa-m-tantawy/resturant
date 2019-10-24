<div class="modal fade delete" id="delete" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('delete/address-phones')}}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.delete')}} <span class="model_type"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden"   name="type">
                                <input type="hidden"   name="id">
                                <h3>{{trans('main.Do you Want to confirm Delete ?')}}</h3>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-12 pull-left">
                        <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.delete')}}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
