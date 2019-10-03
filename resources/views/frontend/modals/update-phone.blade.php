<div class="modal fade update_phone" id="update_phone" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('phone/update')}}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Update Phone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <label>id</label>
                                <input type="text" readonly class="form-control" name="id">
                            </div>
                            <div class="col-12">
                                <label>phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="col-12">

                                <label>type</label>
                                <input type="text" class="form-control" name="type">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-12 pull-left">
                        <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">supmit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
