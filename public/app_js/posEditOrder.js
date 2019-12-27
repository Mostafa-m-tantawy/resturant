var order = [];
var dish = {};
var dishes;
var coupons;
var url = "";
var vat = "";
var service = "";
var tempdish;
var subtotal = 0;
var ordervat = 0;
var orderservice = 0;
var total = 0;
var isstaff = 0;
var order_id = 0;
var status = 0;
var selected_coupon = 0;
var selected_value = 0;
var delivery = 0;

search = (key, inputArray) => {
    for (var i = 0; i < inputArray.length; i++) {
        if (inputArray[i].id == key) {
            return inputArray[i];
        }
    }
}
searchSide = (key, inputArray) => {
    for (var i = 0; i < inputArray.length; i++) {
        if (inputArray[i].side_id == key) {
            return inputArray[i];
        }
    }
}
searchExtra = (key, inputArray) => {
    for (var i = 0; i < inputArray.length; i++) {
        if (inputArray[i].extra_id == key) {
            return inputArray[i];
        }
    }
}


$('document').ready(function () {


    url = $('meta[name="url"]').attr('content')

    vat = $('meta[name="vat"]').attr('content') / 100
    service = $('meta[name="service"]').attr('content') / 100

    type = $('meta[name="type"]').attr('content')

    order_id  = $('meta[name="order_id"]').attr('content')

    status  = $('meta[name="status"]').attr('content')
    var sides = [];
    var extras = [];

    var formdata = new FormData();
    formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
    formdata.append("order_id", order_id);

    $.ajax({

        url: url + '/pos/get_order',
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            dishes = data['dishes'];
            // console.log(data['order']);
            coupons = data['coupons'];
            isstaff = data['order'].is_staff;
            discount = data['order'].discount;
            delivery = data['order'].delivery;
            selected_coupon = data['order'].coupon;
            // console.log(data['order']);

            $.each(data['order'].order_details, function (i, item) {
                var temp = search(item.dish_size.dish.id, dishes);
                if (item.type == null) {
                    order[i] = {
                        deleted: false,          //order_details_id
                        id: item.id,          //order_details_id
                        name: temp.name,
                        sides_limit: temp.sides_limit,
                        quantity: item.quantity,
                        size: search(item.dish_size_id, temp.sizes),

                        sides: [],
                        extras: []
                    };
                }
                $.each(item.sides, function (ii, side) {
                    order[i].sides.push(searchSide(side.dish_size_id, order[i].size.sides))
                })
                $.each(item.extras, function (ii, extra) {
                    order[i].extras.push(searchExtra(extra.dish_size_id, order[i].size.extras))

                })


            });
            // console.log(order);

            DrawOrderInvoice();

        },
        error: function (data) {
        },
    });


});

function minus(minus) {

    var $input = $(minus).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
}

function plus(plus) {
    var $input = $(plus).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
}

function DrawOrderInvoice() {
    subtotal = 0;
    ordervat = 0;
    orderservice = 0;
    total = 0;
var CouponsSelect=''
    var table = $('#invoice tbody');
    $(table).html('');
    CouponsSelect +='<option value=""> coupon</option>';
    $.each(coupons, function (i, coupon) {
        CouponsSelect +='<option value="'+coupon.percentage/100+'">'+coupon.name +' - '+coupon.percentage+'</option>'
    });

    $.each(order, function (i, dish) {

        subtotal += ((isstaff) ? dish.size.cost : dish.size.price) * dish.quantity;
        style = (dish.deleted) ? "style='background-color: #ff5959;'" : '';
        action = (dish.deleted) ?

            '<a onclick="undoDelete(' + i + ')"   style="float: right;"  class="btn btn-danger btn-icon">\n' +
            '    <i class="flaticon-reply"></i>\n' +
            '       </a>'
            :
            '<a onclick="deleteDish(' + i + ')"       style="float: right;"  class="btn btn-danger btn-icon">\n' +
            '    <i class="la la-remove"></i>\n' +
            '       </a>';
        $(table).append(
            $("<tr " + style + ">").append(
                $("<th>", {text: dish.name}),
                $("<th>", {text: dish.size.name}),
                $("<td>", {
                    html:'<div style="text-align: center">'+
                        '<span class="minus"  onclick="minus(this)">-</span>\n' +
                        '<input type="number" onchange="changeQuantity(' + i + ',this.value)" class="quantity" value="' + dish.quantity + '" min="0"/>\n' +
                        '<span class="plus"  onclick="plus(this)">+</span>'+'</div>'
                }),
                $("<td>", {text: ((isstaff) ? dish.size.cost : dish.size.price) * dish.quantity,
                    style: 'text-align: center;',
                }),
                $("<td>", {html: action}),
            )
        )

        if (dish.sides.length > 0) {
            $.each(dish.sides, function (i, side) {

                $(table).append(
                    $("<tr " + style + ">").append(
                        $("<th>", {
                            html: ' ' +
                                ' <div class="row">\n' +
                                '     <div class="col-3"></div>\n' +
                                '     <div class="col-9">' + side.side_size.dish.name + '</div>\n' +
                                '  </div>',

                        }),
                        $("<th>", {
                            text: side.side_size.name,
                            colspan: 4
                        }),
                    ))
            })
        }
        if (dish.extras.length > 0) {

            $.each(dish.extras, function (i, extra) {
                subtotal += ((isstaff) ? extra.extra_size.cost : extra.extra_size.price) * dish.quantity;

                $(table).append(
                    $("<tr " + style + ">").append(
                        $("<th>", {
                            html: ' ' +
                                ' <div class="row">\n' +
                                '     <div class="col-3"></div>\n' +
                                '     <div class="col-9">' + extra.extra_size.dish.name + '</div>\n' +
                                '  </div>',

                        }),
                        $("<td>", {text: extra.extra_size.name}),
                        $("<td>", {text: ''}),
                        $("<td>", {text: ((isstaff) ? extra.extra_size.cost : extra.extra_size.price) * dish.quantity,
                            style: 'text-align: center;',

                        }),
                        $("<td>", {text: ''}),
                    ))
            })
        }

        $(table).append(
            $("<tr>").append(
                $("<th>", {html: '', colspan: 5, style: 'height:20px;'}),
            ))
    })

    var table = $('#invoice tfoot');
    $(table).html('');
    $(table).append(
        $("<tr>").append(
            $("<th>", {html: '', colspan: 5, style: 'height:50px;'}),
        ))


  // console.log(selected_coupon);
    selected_value= subtotal * selected_coupon;
    orderservice = (type == 'restaurant') ? (subtotal-selected_value) * service : 0;
    ordervat = ((subtotal-selected_value) + orderservice) * vat;
    total = (subtotal-selected_value) + orderservice + ordervat - discount + parseFloat( delivery);

    $(table).append( $("<tr>").append(
        $("<th>", {
            text: 'coupon',
            colspan: 4
        }),
        $("<td>",{
                html: '<select onchange="changeCoupon(this)" name="coupon" class="form-control"> ' +
                    CouponsSelect+
                    '</select>',
            }
        ),
        ),
        $("<tr>").append(
            $("<th>", {
                text: 'staff',
                colspan: 4
            }),
            $("<td>", {
                html:
                    '<span class="kt-switch kt-switch--sm kt-switch--icon">\n' +
                    '<label>\n' +
                    '<input type="checkbox" id="show" name="show" onclick="staff()" class="form-control">\n' +
                    '<span></span>\n' +
                    '</label>\n' +
                    '</span>\n',
                style: 'text-align: right;',

            }),
        ), $("<tr>").append(
            $("<th>", {
                text: 'sub-total',
                colspan: 4
            }),
            $("<td>", {
                text: (subtotal-selected_value).toFixed(3),
                style: 'text-align: right;',

            }),
        ), (type == 'restaurant') ? $("<tr>").append(
            $("<th>", {
                text: 'service',
                colspan: 4
            }),
            $("<td>", {
                text: orderservice.toFixed(3),
                style: 'text-align: right;',

            }),
        ) : '',
        $("<tr>").append(
            $("<th>", {
                text: 'vat',
                colspan: 4
            }),
            $("<td>", {
                text: ordervat.toFixed(3),
                style: 'text-align: right;',

            }),
        ),
        (type == 'delivery') ? $("<tr>").append(
            $("<th>", {
                text: 'delivery',
                colspan: 4
            }),
            $("<td>", {
                html: '<input name="delivery"  onchange="changeDelivery()" type="number" class="form-control" value="'+delivery+'" min="0">',
                style: 'text-align: right;width:100px',

            }),
        ) : ''
        , $("<tr>").append(
            $("<th>", {
                text: 'discount',
                colspan: 4
            }),
            $("<td>", {
                html: '<input name="discount" type="number" onchange="changeDiscount(this.value)" class="form-control" value="' + discount + '" min="0">',
                style: 'text-align: right;;width:100px',

            }),
        )
        , $("<tr>").append(
            $("<th>", {
                text: 'total',
                colspan: 4
            }),
            $("<td>", {
                text: total.toFixed(3),
                style: 'text-align: right;',

            }),
        ), (status=='closed')?
            $("<tr>").append(
             $("<th>", {
                html: '<button class="btn btn-primary" onclick="cancelOrder()">refund</button>',
                colspan: 2
            }),
                $("<th>", {
                html: '<button class="btn btn-primary" onclick="payment()">Payment</button>',
                colspan: 2
            }),
            $("<td>", {
                html: '<button class="btn btn-danger">print</button>',
                style: 'text-align: right;',

            }),
        ):   $("<tr>").append(
                $("<th>", {
                    html: '<button class="btn btn-primary" onclick="submitOrder()">submit</button>',
                    colspan: 2
                }),
                $("<th>", {
                    html: '<button class="btn btn-primary" onclick="payment()">Payment</button>',
                }),$("<th>", {
                    html: '<button class="btn btn-primary" onclick="closeOrder()">close</button>',
                }),
                $("<td>", {
                    html: '<button class="btn btn-danger"onclick="cancelOrder()">cancel</button>',
                    style: 'text-align: right;',

                }),
            ),  $("<tr>").append(
            $("<th>", {html: '', colspan: 5, style: 'height:20px;'}),
        ),
        $("<tr>").append(
            $("<th>", {
                html: '<a href="'+url+'/pos/print/client/'+order_id+'" class="btn btn-primary" ">Clinet Print </a>',
                colspan: 2
            }),

            $("<td>", {
                html: '<a href="'+url+'/pos/print/department/'+order_id+'" class="btn btn-primary"">department Print</a>',
                style: 'text-align: right;',

            }),
        ),
    )

$('select[name=coupon]').val(selected_coupon);
}


function DrawDishDetailsTable(modal) {
    var table = $(modal).find('.dish_details tbody');
    $(table).html('');

    $(table).append(
        $("<tr>").append(
            $("<th>", {text: 'Dish'}),
            $("<td>", {text: dish.name}),
            $("<td>", {text: ''}),
        ))
    if (!jQuery.isEmptyObject(dish.size)) {

        $(table).append(
            $("<tr>").append(
                $("<th>", {text: 'size'}),
                $("<td>", {text: dish.size.name}),
                $("<td>", {text: ''}),
                $("<td>", {text: dish.size.price}),
            ))
    }
    if (dish.sides.length > 0) {
        $.each(dish.sides, function (i, side) {

            $(table).append(
                $("<tr>").append(
                    $("<th>", {text: 'side'}),
                    $("<td>", {text: side.side_size.dish.name}),
                    $("<td>", {text: side.side_size.name}),
                    $("<td>", {text: ''}),
                ))
        })
    }
    if (dish.extras.length > 0) {
        $.each(dish.extras, function (i, extra) {

            $(table).append(
                $("<tr>").append(
                    $("<th>", {text: 'extra'}),
                    $("<td>", {text: extra.extra_size.name}),
                    $("<td>", {text: extra.extra_size.dish.name}),
                    $("<td>", {text: extra.extra_size.price}),
                ))
        })
    }
}

function changeQuantity(index, number) {
    order[index].quantity = number;

    DrawOrderInvoice();
}

function deleteDish(index) {
    if (order[index].id != '') {
        order[index].deleted = true;
    } else {
        order.splice(index, 1);

    }
    DrawOrderInvoice();
}

function undoDelete(index) {
    if (order[index].id != '') {
        order[index].deleted = false;
    }
    DrawOrderInvoice();
}

function newDish(id) {

    tempdish = search(id, dishes);
    // console.log(dishes);
    dish = {
        deleted: false,          //order_details_id
        id: '',
        name: tempdish.name,
        sides_limit: tempdish.sides_limit,
        quantity: 1,
        size: {},
        sides: [],
        extras: []
    };

    $('#sizes_modal').modal('toggle');

    var sizes = $('#sizes_modal').find('#sizes');
    $(sizes).html('');
    $.each(tempdish.sizes, function (i, size) {
        // console.log(size);

        $(sizes).append(' <div class="col-4 justify-content-center align-content-center">\n' +
            '                            <div style="padding: 30px;">    \n' +
            '                                <button class="btn btn-primary" onclick="DishSizes(' + size.id + ')" >' + size.name + '</button>\n' +
            '                     <br>           price : ' + size.price + ' \n' +
            '                         </div>\n' +
            '                        </div>\n');
    })
    DrawDishDetailsTable($('#sizes_modal'));


}

function DishSizes(id) {

    $('#sizes_modal').modal('toggle');
    $('#sides_modal').modal('toggle');
    // console.log(tempdish);
    dish.size = search(id, tempdish.sizes);
    ;

    var sides = $('#sides_modal').find('#sides');

    $(sides).html('');
    $.each(dish.size.sides, function (i, side) {
        // console.log(size);

        $(sides).append(' <div class="col-4 justify-content-center align-content-center" >\n' +
            '                            <div style="padding: 30px;">    \n' +
            '                                <button class="btn btn-primary" onclick="addSide(' + side.id + ')" >' + side.side_size.dish.name + ' </button>\n'
            + '                    <br>            size : ' + side.side_size.name + ' \n' + '                         </div>\n' +
            '                        </div>\n');
    })
    var available = dish.sides_limit - dish.sides.length;

    DrawDishDetailsTable($('#sides_modal'));
    $('#available_sides').html(available);

// console.log(dish);
}

function addSide(id) {
    var available = dish.sides_limit - dish.sides.length;
    if (available > 0) {
        dish.sides.push(search(id, dish.size.sides));
        $('#available_sides').html(available - 1);
    }
    DrawDishDetailsTable($('#sides_modal'));

}


function DishSides() {
// console.log(dish.size.extras);
    $('#extra_modal').modal('toggle');
    $('#sides_modal').modal('toggle');
    var extras = $('#extra_modal').find('#extras');

    $(extras).html('');
    $.each(dish.size.extras, function (i, extra) {
        // console.log(size);

        $(extras).append(
            '<div class="col-4 justify-content-center align-content-center"  >\n' +
            '  <div style="padding: 30px;">    \n' +
            '  <button class="btn btn-primary" onclick="addExtra(' + extra.id + ')" >' + extra.extra_size.dish.name + ' </button>\n' +
            '     <br>           extra : ' + extra.extra_size.name + ' \n' + '  <br>     ' +
            '     price : ' + extra.extra_size.price + ' \n' + '     ' +
            '      </div>\n' +
            '       </div>\n');
    })

    DrawDishDetailsTable($('#extra_modal'));

}


function addExtra(id) {
    dish.extras.push(search(id, dish.size.extras));
    // console.log(dish.extras);
    DrawDishDetailsTable($('#extra_modal'));

}


function DishExtra() {

    $('#extra_modal').modal('toggle');
    order.push(dish);
    DrawOrderInvoice();
}

function staff() {

    if (isstaff == 0)
        isstaff = 1;
    else
        isstaff = 0;
    DrawOrderInvoice();

}

function submitOrder() {
    var formdata = new FormData();
    var json_arr = JSON.stringify(order);
    formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
    formdata.append("_method", 'PUT');
    formdata.append("type", type);
    formdata.append("order",json_arr);
    formdata.append("vat",vat);
    formdata.append("service",service);
    formdata.append("is_staff",isstaff);
    formdata.append("coupon",selected_coupon);

    if($('input[name=delivery]').val() &&type=='delivery')
        formdata.append("delivery",$('input[name=delivery]').val());

    formdata.append("discount",$('input[name=discount]').val());

    $.ajax({

        url: url+'/pos/order/'+order_id,
        type: "post",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            toastr.success("Submission was successful.");
            window.location.href = url+'/pos/order';

        },
        error: function (data) {
        },
    });


    DrawOrderInvoice();
}

function closeOrder() {
    var formdata = new FormData();
    formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));

    $.ajax({

        url: url+'/pos/close-order/'+order_id,
        type: "post",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
           status='closed';
            toastr.success("order closed successful.");
            DrawOrderInvoice();

        },
        error: function (data) {
            toastr.error(data.responseJSON[0]);
            // console.log(data.responseJSON[0]);
        },
    });


    DrawOrderInvoice();
}

function cancelOrder() {

    var r = confirm("Are you sure canceling order!? all payments will be refunded.");
    if (r == true) {

        var formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("_method", 'Delete');

        $.ajax({

            url: url+'/pos/order/'+order_id,
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {

                window.location ='/pos/hall';

            },
            error: function (data) {

                toastr.error(data.responseJSON[0]);
                // console.log(data.responseJSON[0]);
            },
        });

    }

}

function changeDiscount(value) {
    discount = value;
    DrawOrderInvoice();
    // console.log(value);

}


function changeCoupon(value) {
    selected_coupon = $(value).find( 'option:selected').val();
    DrawOrderInvoice();
    // console.log(value);

}

function changeDelivery() {
    delivery = $('input[name=delivery]').val();
    DrawOrderInvoice();
console.log(delivery)
}
