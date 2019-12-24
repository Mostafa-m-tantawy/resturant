var orders;
var dishes;
var url;
$('document').ready(function () {

    url = $('meta[name="url"]').attr('content')


    var formdata = new FormData();
    formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));

    $.ajax({

        url: url + '/pos/life-kitchen-json',
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            orders = data;


            console.log(data);

            renderOrders(orders);

        },
        error: function (data) {
        },
    });


});

function renderOrders(orders) {

    var orderDiv = $('#orders').html('');
    var orderstring = '';
    $.each(orders, function (i, order) {
        orderstring = '';

        orderstring += '<div class="col-3" >' +
            '<div class="card" >\n' +
            '<div class="card-body">\n' +

            '<h5 class="card-title">order-no : ' + order.id + ' </h5>\n';

        $.each(order.order_details, function (i, dish) {

          console.log(dish.dish_size.dish.name);
          orderstring += ' <div class="row card-text" >' +
                '<div class="col-10"> <span>' +
                dish.dish_size.dish.name+' </span> - <span>'+dish.dish_size.name +'</span>'+
                ' </div>' +
                '<div class="col-2 text-right" >' +
                dish.quantity+'' +
                ' </div>' +
                '</div>\n';

            $.each(dish.sides, function (i, side) {
                orderstring += '<div class="row card-text" style="margin-left: 20px">' +
                    '<div class="col-10">' +
                    side.dish_size.dish.name+' - '+side.dish_size.name +
                    ' </div>' +

                    '</div>\n'
            });
            $.each(dish.extras, function (i, extra) {
                orderstring += '<div class="row card-text" style="margin-left: 20px">' +
                    '<div class="col-10">' +
                    extra.dish_size.dish.name+' - '+extra.dish_size.name +
                    ' </div>' +

                    '</div>\n'
            })
        })
        orderstring += ' </div>\n' +
            ' </div>\n'
        ' </div>\n';
        orderDiv.append(orderstring);
    });
}
