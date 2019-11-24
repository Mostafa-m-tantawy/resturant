<div class="modal fade update_emergency" id="update_emergency" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.update')}} {{trans('main.address')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @csrf
                    @method('put')
                    <div class="container">
                        <div class="row">

                            <div class="col-6">
                                <label>{{trans('main.ID')}}:</label>
                                <input type="text" readonly name="id"
                                       class="form-control">
                            </div>
                            <div class="col-6">
                                <label>{{trans('main.name')}}:</label>
                                <input type="text" required name="name"
                                       class="form-control"
                                       placeholder="Enter full name">
                            </div>
                            <div class="col-6">
                                <label class="">{{trans('main.email')}}:</label>
                                <input type="email" required name="email"
                                       class="form-control"
                                       placeholder="Enter email">
                            </div>
                            <div class="col-6">
                                <label>{{trans('main.phone')}}:</label>
                                <input type="text" name="phone"
                                       class="form-control">
                            </div>
                            <div class="col-6">
                                <label>{{trans('main.address')}}:</label>
                                <input type="text" name="address"
                                       class="form-control">
                            </div>
                            <div class="col-6">
                                <label>{{trans('main.relationship')}}:</label>
                                <input type="text" name="relationship"
                                       class="form-control">
                            </div>

                        </div>
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
