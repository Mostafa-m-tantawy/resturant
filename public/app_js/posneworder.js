
var order=[];
var dish={};
var dishes;
var url="";
var vat="";
var service="";
var tempdish;
var subtotal=0;
var ordervat=0;
var orderservice=0;
var total=0;
var isstaff=0;
var order=[];
var dish={};
var dishes;
var url="";
var vat="";
var service="";
var tempdish;
var subtotal=0;
var ordervat=0;
var orderservice=0;
var total=0;
var isstaff=0;
var discount=0;

search = (key, inputArray) => {
    for (var i=0; i < inputArray.length; i++) {
        if (inputArray[i].id == key) {
            return inputArray[i];
        }
    }
}


$('document').ready(function () {


   url=$('meta[name="url"]').attr('content')
   vat=$('meta[name="vat"]').attr('content')/100
   service=$('meta[name="service"]').attr('content')/100
   type=$('meta[name="type"]').attr('content')
    var formdata = new FormData();
    formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
    $.ajax({

        url: url+'/pos/all-dishes',
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            dishes=data;
             // console.log(dishes);
            // console.log( search("1", dishes));
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
    subtotal=0;
  ordervat=0;
  orderservice=0;
  total=0;

  var table=$('#invoice tbody');
    $(table).html('');



    $.each(order, function (i, dish) {

subtotal+=((isstaff)?dish.size.cost:dish.size.price) *dish.quantity;
    $(table).append(
        $("<tr>").append(
            $("<th>", {text: dish.name }),
            $("<th>", {text: dish.size.name }),
            $("<td>", {html:
                    '<span class="minus"  onclick="minus(this)">-</span>\n' +
                    '<input type="number" onchange="changeQuantity('+i+',this.value)" class="quantity" value="'+dish.quantity+'" min="0"/>\n' +
                    '<span class="plus"  onclick="plus(this)">+</span>'
                   }),
            $("<td>", {text: ((isstaff)?dish.size.cost:dish.size.price)*dish.quantity}),
            $("<td>", {html: '<a onclick="deleteDish('+i+')"  class="btn btn-danger btn-icon">\n' +
                    '                                                            <i class="la la-remove"></i>\n' +
                    '                                                        </a>'}),
        ))

    if(dish.sides.length>0){
        $.each(dish.sides, function (i, side) {

            $(table).append(
                $("<tr>").append(
                    $("<th>", {html: ' ' +
                            ' <div class="row">\n' +
                            '     <div class="col-3"></div>\n' +
                            '     <div class="col-9">'+side.side_size.dish.name+'</div>\n' +
                            '  </div>',

                        }),
                    $("<th>", {text:side.side_size.name ,
                        colspan:4
                        }),

                ))
        })
    }
    if(dish.extras.length>0){

        $.each(dish.extras, function (i, extra) {
            subtotal+=((isstaff)?extra.extra_size.cost:extra.extra_size.price)*dish.quantity;

            $(table).append(
                $("<tr>").append(
                    $("<th>", {html: ' ' +
                            ' <div class="row">\n' +
                            '     <div class="col-3"></div>\n' +
                            '     <div class="col-9">'+extra.extra_size.dish.name+'</div>\n' +
                            '  </div>',

                    }),
                    $("<td>", {text: extra.extra_size.name}),
                    $("<td>", {text: ''}),
                    $("<td>", {text: ((isstaff)?extra.extra_size.cost:extra.extra_size.price)*dish.quantity}),
                    $("<td>", {text: ''}),

                ))
        })
    }

        $(table).append(
            $("<tr>").append(
                $("<th>", {html:'' ,colspan:5,style:'height:20px;'}),

            ))
    })

    var table=$('#invoice tfoot');
    $(table).html('');
 $(table).append(
        $("<tr>").append(
            $("<th>", {html:'' ,colspan:5,style:'height:50px;'}),

        ))

     orderservice= (type=='restaurant')? subtotal*service :0;
     ordervat=(subtotal+orderservice)*vat;

    total=subtotal+orderservice+ordervat-discount;
    $(table).append(
        $("<tr>").append(
            $("<th>", {text: 'staff',
                    colspan:2
            }),
            $("<td>", {html:
                    '<span class="kt-switch kt-switch--sm kt-switch--icon">\n' +
                    '<label>\n' +
                    '<input type="checkbox" id="show" name="show" onclick="staff()" class="form-control">\n' +
                    '<span></span>\n' +
                    '</label>\n' +
                    '</span>\n' ,
                style:'float:right;',
                colspan:3
            }),

         ),   $("<tr>").append(
            $("<th>", {text: 'sub-total',
                    colspan:2
            }),
            $("<td>", {text: subtotal.toFixed(3),
                style:'float:right;',
                colspan:3
            }),

         ), (type=='restaurant')?$("<tr>").append(
            $("<th>", {text: 'service',
                    colspan:2
            }),
            $("<td>", {text:orderservice.toFixed(3) ,
                style:'float:right;',
                colspan:3
            }),

         ):'',
        $("<tr>").append(
            $("<th>", {text: 'vat',
                    colspan:2
            }),
            $("<td>", {text: ordervat.toFixed(3),
                style:'float:right;',
                colspan:3
            }),

         ),
        (type=='delivery')? $("<tr>").append(
            $("<th>", {text: 'delivery',
                    colspan:2
            }),
            $("<td>", {html: '<input name="delivery" type="number" class="form-control" value="0" min="0">',
                style:'float:right;width:50px',
                colspan:3
            }),
        ):''
        ,  $("<tr>").append(
            $("<th>", {text: 'discount',
                    colspan:2
            }),
            $("<td>", {html: '<input name="discount" type="number" onchange="changeDiscount(this.value)" class="form-control" value="'+discount+'" min="0">',
                style:'float:right;width:100px',
                colspan:3
            }),
        )
        ,$("<tr>").append(
            $("<th>", {text: 'total',
                    colspan:2
            }),
            $("<td>", {text: total.toFixed(3),
                style:'float:right;',
                colspan:3
            }),

         ),$("<tr>").append(
            $("<th>", {html: '<button class="btn btn-primary" onclick="submitOrder()">submit</button>',
                    colspan:2
            }),
            $("<td>", {html: '<button class="btn btn-danger"onclick="cancelOrder()">cancel</button>',
                style:'float:right;',
                colspan:3
            }),

         ),
    )

}



function DrawDishDetailsTable(modal) {
    var table=$(modal).find('.dish_details tbody');
    $(table).html('');

    $(table).append(
        $("<tr>").append(
            $("<th>", {text: 'Dish'}),
            $("<td>", {text: dish.name}),
            $("<td>", {text: ''}),
        ))
    if(! jQuery.isEmptyObject(dish.size)){

        $(table).append(
            $("<tr>").append(
                $("<th>", {text: 'size'}),
                $("<td>", {text: dish.size.name}),
                $("<td>", {text: ''}),
                $("<td>", {text: dish.size.price}),
            ))
    }
    if(dish.sides.length>0){
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
    if(dish.extras.length>0){
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

function changeQuantity(index,number) {
    order[index].quantity = number;

    DrawOrderInvoice();
}
function deleteDish(index) {

    order.splice( index, 1 );
    DrawOrderInvoice();
}

function newDish(id) {

    tempdish= search(id, dishes);
    // console.log(dishes);
    dish={
        id:tempdish.id,
        name:tempdish.name,
        sides_limit:tempdish.sides_limit,
        quantity:1,
        size:{},
        sides:[],
        extras:[]
    };

    $('#sizes_modal').modal('toggle');

    var sizes=$('#sizes_modal').find('#sizes');
    $(sizes).html('');
    $.each(tempdish.sizes, function (i, size) {
        // console.log(size);

        $(sizes).append(' <div class="col-4 justify-content-center align-content-center">\n' +
            '                            <div style="padding: 30px;">    \n' +
            '                                <button class="btn btn-primary" onclick="DishSizes('+size.id+')" >'+size.name+'</button>\n' +
            '                     <br>           price : '+size.price+' \n'+
            '                         </div>\n' +
            '                        </div>\n');
    })
    DrawDishDetailsTable($('#sizes_modal'));


}



function DishSizes(id) {

    $('#sizes_modal').modal('toggle');
    $('#sides_modal').modal('toggle');
    // console.log(tempdish);
    dish.size=search(id, tempdish.sizes);;

    var sides=$('#sides_modal').find('#sides');

    $(sides).html('');
    $.each( dish.size.sides, function (i, side) {
        // console.log(size);

        $(sides).append(' <div class="col-4 justify-content-center align-content-center" >\n' +
            '                            <div style="padding: 30px;">    \n' +
            '                                <button class="btn btn-primary" onclick="addSide('+side.id+')" >'+side.side_size.dish.name+' </button>\n'
            +'                    <br>            size : '+side.side_size.name+' \n'+ '                         </div>\n' +
            '                        </div>\n');
    })
    var available=dish.sides_limit-dish.sides.length;

    DrawDishDetailsTable($('#sides_modal'));
    $('#available_sides').html(available);

// console.log(dish);
}



function addSide(id) {
    var available=dish.sides_limit-dish.sides.length;
    if(available > 0) {
        dish.sides.push(search(id, dish.size.sides));
        $('#available_sides').html(available-1);
    }
    DrawDishDetailsTable($('#sides_modal'));

}


function DishSides() {
// console.log(dish.size.extras);
   $('#extra_modal').modal('toggle');
    $('#sides_modal').modal('toggle');
    var extras=$('#extra_modal').find('#extras');

    $(extras).html('');
    $.each( dish.size.extras, function (i, extra) {
        // console.log(size);

        $(extras).append(
            '<div class="col-4 justify-content-center align-content-center"  >\n' +
            '  <div style="padding: 30px;">    \n' +
            '  <button class="btn btn-primary" onclick="addExtra('+extra.id+')" >'+extra.extra_size.dish.name+' </button>\n'+
            '     <br>           extra : '+extra.extra_size.name+' \n'+ '  <br>     ' +
            '     price : '+extra.extra_size.price+' \n'+ '     ' +
            '      </div>\n' +
            '       </div>\n');
    })

    DrawDishDetailsTable($('#extra_modal'));

}



function addExtra(id) {
    dish.extras.push(search(id, dish.size.extras));
    // console.log(  dish.extras);
    DrawDishDetailsTable($('#extra_modal'));

}




function DishExtra() {

    $('#extra_modal').modal('toggle');
    order.push(dish);
    DrawOrderInvoice();
}

function staff() {

    if(isstaff==0)
        isstaff=1;
    else
        isstaff=0;
    DrawOrderInvoice();

}


function submitOrder() {
    var formdata = new FormData();
    var json_arr = JSON.stringify(order);
    formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
    formdata.append("type", type);
    formdata.append("order",json_arr);
    formdata.append("vat",vat);
    formdata.append("service",service);
    formdata.append("is_staff",is_staff);
    formdata.append("discount",discount);

    if($('input[name=delivery]').val())
        formdata.append("delivery",$('input[name=delivery]').val());

    formdata.append("discount",$('input[name=discount]').val());

   $.ajax({

        url: url+'/pos/order',
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            // dishes=data;
            // console.log(dishes);
            // console.log( search("1", dishes));
        },
        error: function (data) {
        },
    });


    order=[];
    DrawOrderInvoice();
}


function cancelOrder() {

    var r = confirm("are yo sure canceling order!");
    if (r == true) {

        order=[];
        DrawOrderInvoice();}
}


function changeDiscount(value) {
discount=value;
        DrawOrderInvoice();
console.log(value);

}

