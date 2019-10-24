<div class="modal fade update_address" id="update_address" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('address/update')}}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.update')}} {{trans('main.address')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <label>{{trans('main.id')}}</label>
                                <input type="text" readonly class="form-control" name="id">
                            </div>
                            <div class="col-12">
                                <label>{{trans('main.name')}}</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="col-lg-12">
                                <div class="row kt-margin-b-10">
                                    <div class="col-lg-5">
                                        <label>{{trans('main.country')}}</label>
                                        <select class="form-control country" name="country"
                                                onchange="changecity(this)">
                                            <option value="00">{{trans('main.select')}} {{trans('main.country')}}</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-5">
                                        <label>{{trans('main.city')}}</label>

                                        <select class="form-control" name="city_id">
                                            <option value="00">{{trans('main.select')}} {{trans('main.city')}}</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-2" style=" display: flex;
  justify-content: center;
  align-items: center">
                                        <a href="javascript:;" data-repeater-delete=""
                                           class="btn btn-danger btn-icon">
                                            <i class="la la-remove"></i>
                                        </a>
                                    </div>
                                </div>
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
