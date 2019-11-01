/**
 * Created by rifat on 8/27/17.
 */

var purse = {};
var purses = [];
var deleted = {};
var deleteds = [];

// total of dishes
var sup_total = 0;
// service on dishes only    original percentage
var servicePercentage = 0;
// service on dishes only   12%
var service = 0;
//discount on order
var discount = 0;
// vat on dishes  only   original percentage
var vatPercentage = 0;

// vat on dishes  only      14%
var vat = 0;

var staff=false;
// Class definition


/**
 * sum quantity assigned of purses list
 * @param product_id
 */
function checkQuantityForAdd(dishSizeId) {
    var quantity = 0;
    for (var i = 0; i < purses.length; i++) {
        if (purses[i].dish.dishId == dishSizeId)
            quantity += parseFloat(purses[i].quantity);
    }
    return quantity;
};

function checkForNumberOfSides () {

    var quantity=0;
    var sidesavaliable=0;
    for (var i=0;i<purses.length;i++){
        if(purses[i].typeval=='side' && purses[i].deleted==false)
            quantity+=parseFloat(purses[i].quantity);
        if(purses[i].typeval!='side' && purses[i].deleted==false){
            sidesavaliable+=purses[i].dish.sides_limit*parseFloat(purses[i].quantity);;
        }
    }
    console.log(sidesavaliable-quantity)
    return sidesavaliable-quantity;
};

// Execute code, then leave
window.onbeforeunload = function () {
    var formdata = new FormData();
    var json_arr = JSON.stringify(purses);

    formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
    formdata.append("purses", json_arr);
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({

        url: '/all-delete-pending',
        type: "post",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {

        },
    });

}
$(document).ready(function () {

     vatPercentage = $('input[name="vatPercentage"]').val();
     servicePercentage = $('input[name="servicePercentage"]').val();
     discount = $('input[name="discount"]').val();;
     staff = $('input[name="staff"]').val();;

    if(vatPercentage != 0)
        $('#vat').     prop("checked",true);


    if(servicePercentage != 0)
    $('#service'). prop("checked",true);


    if(staff != 0)
     $('#staff').   prop("checked",true);

    var formdata = new FormData();
    formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url: '/order/edit-json/' + $('input[name="order_id"]').val(),
        type: "post",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);

            $.each(data.order_details, function (i, item) {
                purse = {
                    deleted:false,
                    oldId:item.id,
                    id: '',
                    type: item.dish_size.dish.type,
                    typeval:     item.dish_size.dish.type,
                    dish: {
                        dishId: item.dish_size.id,
                        dishName: item.dish_size.dish.name,
                        dishSizeName: item.dish_size.name,
                        quantityAvailable: '',
                        originalprice:item.dish_size.price,
                        price: item.unit_price,
                        cost:item.dish_size.cost,
                        sides_limit:  item.dish_size.dish.sides_limit,
                    },
                    quantity: item.quantity,
                }

                //push purse object to purses array
                purses.push(purse);

                //Call render function to render purses list

            });


            $("#pursesDetailsRender").empty();
            $(this).renderHtml(purses);

            //Set default value of all field except supplier in to form
            $("#quantity").val(0);
            $("#dish").val('');
            $("#category").val('');
        },
        error: function (data) {

            if (data['status'] == 422) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'There is no order with this id',
                })
            }

        },
    });


    /**
     * It will take the current supplier id for further use
     */

    $('#category').change(function () {

        if(checkForNumberOfSides()>0 ||$(this).val()!='side' ) {
            var formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: '/category-dishes/' + $(this).val(),
            type: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data);

                $('#dish').html('');
                $('<option ></option>').val('').text('select dish').appendTo('#dish');
                $.each(data, function (i, item) {
                    // $('<option ></option>').val(item.id).text(item.user.name).appendTo('#from_stock');


                    $("#dish").append(
                        $("<optgroup>", {label: item.name}).append(function (op) {
                            var options = '';
                            $.each(item.sizes, function (ii, size) {
                                options += "<option " +
                                    "data-sides_limit='" + item.sides_limit + "'" +
                                    "data-price='" + size.price + "' " +
                                    "value='" + size.id + "'" +
                                    "data-cost='" + size.cost + "' " +
                                    "data-quantity='" + size.quantity + "' " +
                                    "data-dish='" + item.name + "'>" + size.name + "</option>"
                            })
                            return options;
                        })
                    )
                });

            },
            error: function (data) {

                if (data['status'] == 422) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'There are no dishes in this category',
                    })
                }

            },
        });
        }else{
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'There is no Available sides ',
                })
            }

    });

    /**
     * Product dropdown on change Action
     */
    $("#dish").on('change', function (e) {
        var dish_sizeId = $("#dish").val()

        var selected = $(this).find('option:selected');
        var quantityassigned = selected.data('quantity') - checkQuantityForAdd(dish_sizeId);

        if (parseFloat(quantityassigned) >= 0) {
            $('#quantity').prop("max", quantityassigned);

        }

    });

    /**
     * Action on save purses button click
     */
    $("#savePurses").on('click', function (e) {
        if (purses.length != 0) {
            //console.log("You can go on")
        } else {
            //console.log("You cannot go on")
        }
    });

    /**
     * Purses Form Submit
     * @type {*}
     */
    var form = $("#purses");
    form.on('submit', function (e) {
        e.preventDefault();
        /**
         * Append value on purse object from form data
         * @type {{pursesId: string, supplier: {supplierId: (*), supplierName: (*)}, product: {productId: (*), productName: (*)}, quantity: (*), unit: {unitId: string, unitName: string, childUnit: number, convertRate: *, unitPrice: (*)}, grossPrice: (*)}}
         */

        if ( !form[0].checkValidity()
            ||((checkForNumberOfSides()- $("#quantity").val())<0
                && $("#category option:selected").val()=='side')){
            form[0].reportValidity();


            if((checkForNumberOfSides()- $("#quantity").val())<0){
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Available sides equal to '+checkForNumberOfSides(),
                })
            }

        } else {
            // console.log($("#dish").val());
            var formdataq = new FormData();
            formdataq.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formdataq.append("dish_size_id", $("#dish").val());
            formdataq.append("quantity", $("#quantity").val());

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/dish-available-units',
                type: "post",
                data: formdataq,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log(data);
                    purse = {
                        deleted:false,
                        oldId:'',
                        id: data,
                        type: $("#category option:selected").text(),
                        typeval:    $("#category option:selected").val(),
                        dish: {
                            dishId: $("#dish").val(),
                            dishName: $("#dish option:selected").data('dish'),
                            dishSizeName: $("#dish option:selected").text(),
                            quantityAvailable: $("#dish option:selected").data('quantity'),
                            originalprice:$("#dish option:selected").data('price'),
                            price: $("#dish option:selected").data('price'),
                            cost:  $("#dish option:selected").data('cost'),
                            sides_limit: $("#dish option:selected").data('sides_limit'),
                        },
                        quantity: $("#quantity").val(),
                    }

                    //push purse object to purses array
                    purses.push(purse);

                    //Call render function to render purses list
                    $("#pursesDetailsRender").empty();
                    $(this).renderHtml(purses);

                    //Set default value of all field except supplier in to form
                    $("#quantity").val(0);
                    $("#dish").val('');
                    $("#category").val('');
                },
                error: function (e) {
                    console.log(e);
                    if (e['status'] == 422) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'recipes not enough to order this dish max is ' + e['responseJSON'],
                        })
                        $('#quantity').prop("max", e['responseJSON']);

                    }

                },
            });


        }
    });

    /**
     * Render Purses List
     * @param data
     */
    $.fn.renderHtml = function (data) {

// total of dishes
        sup_total = 0;
// service on dishes only   12%
        service = 0;
// vat on dishes  only      14%
        vat = 0;

        $.each(data, function (index, data) {
          if(data.deleted==false) {
              sup_total += (data.dish.price * data.quantity);
              service += $('#service').is(':checked') ? (data.dish.price * data.quantity) * (servicePercentage / 100) : 0;
              vat += $('#vat').is(':checked') ? (data.dish.price * data.quantity) * (vatPercentage / 100) : 0;
          }
          $("#pursesDetailsRender").append(
                $("<tr>",{
                    style: (data.deleted == true)? 'background-color:red':''
                }).append(
                    $("<th>", {text: index + 1}),
                    $("<td>", {text: data.type}),
                    $("<td>", {text: data.dish.dishName}),
                    $("<td>", {text: data.dish.dishSizeName}),
                    $("<td>", {text: data.quantity}),
                    (data.deleted != true)?
                        $("<td>").append(
                        $("<div>", {class: 'btn-group'}).append(
                            $("<button>", {
                                class: 'btn btn-danger btn-sm',
                                onClick: '$(this).deleteFromList(' + index + ')'
                            }).append(
                                $('<i>', {class: 'la la-remove'})
                            )
                        )
                    ):$("<td>").append(
                        $("<div>", {class: 'btn-group'}).append(
                            $("<button>", {
                                style:  'color:white',
                                text:'undo',
                                class: 'btn  btn-sm',
                                onClick: '$(this).undoDelete(' + index + ')'
                            })
                        )
                        )
                )
            )
        });
        // Render bottom of purses list with sum of total cost, payment and others
        if (purses.length != 0) {
            $("#pursesDetailsRender").append(
                $("<tr>").append(
                    $("<th>", {colspan: 4}),
                    $("<th>", {text: "sup total:", class: "text-right"}),
                    $("<th>", {html:parseFloat( sup_total).toFixed(2),})
                ),
                $("<tr>").append(
                    $("<th>", {colspan: 4}),
                    $("<th>", {text: "vat:", class: "text-right"}),
                    $("<th>", {html: parseFloat(vat).toFixed(2),})
                ),
                $("<tr>").append(
                    $("<th>", {colspan: 4}),
                    $("<th>", {text: "service:", class: "text-right"}),
                    $("<th>", {html: parseFloat(service).toFixed(2),})
                ),
                $("<tr>").append(
                    $("<th>", {colspan: 4}),
                    $("<th>", {text: "discount:", class: "text-right"}),
                    $("<th>", {html: parseFloat(discount).toFixed(2),})
                ),
                $("<tr>").append(
                    $("<th>", {colspan: 4}),
                    $("<th>", {text: "Total:", class: "text-right"}),
                    $("<th>", {html: parseFloat(sup_total + service + vat - discount).toFixed(2),})
                ),

                $("<tr>").append(
                    $("<th>", {colspan: 5}),
                    $("<th>").append(
                        $("<button>", {
                            text: "Confirm Assignment",
                            class: "btn btn-brand btn-elevate btn-icon-sm",
                            onClick: '$(this).confirmPurses()'
                        })
                    )
                )
            )
        }
    };

    /**
     * Delete purses form purses list
     * @param index
     */
    $.fn.deleteFromList = function (index) {
        if (purses[index].oldId != '') {

            purses[index].deleted=true;

        }else{
            var formdata = new FormData();

            formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formdata.append("id", purses[index].id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                url: '/dish-delete-pending',
                type: "post",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                    Swal.fire(
                        'Good job!',
                        'Success ! dish deleted successfully',
                        'success'
                    );
                },
            });

            purses.splice(index, 1);

        }


        $("#pursesDetailsRender").empty();
        $(this).renderHtml(purses);
    };


    $.fn.undoDelete = function (index) {
        if (purses[index].oldId != '') {

            purses[index].deleted=false;

        }else{


        }


        $("#pursesDetailsRender").empty();
        $(this).renderHtml(purses);
    };

    /**
     * Update quantity of purses list
     * @param index
     */
    $.fn.updateQuantity = function (index) {
        var quantityassigned = this.checkQuantityForUpdate(index);
        quantityassigned = parseFloat(purses[index].dish.quantityAvailable)
            - parseFloat(quantityassigned) - parseFloat(this.val());
        if (quantityassigned >= 0) {
            purses[index].quantity = this.val();
            $("#pursesDetailsRender").empty();
            $(this).renderHtml(purses);

            var quantityassignedd = purses[index].dish.quantityAvailable - checkQuantityForAdd(purses[index].dish.dishId);

            $('#quantity').prop("max", quantityassignedd);

        } else {
            this.val(purses[index].quantity);

            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'quantity not enough',
            })
        }
        //     console.log(this.checkQuantityForUpdate(index));

    };


    /**
     * Update quantity of purses list
     * @param index
     */
    $.fn.checkQuantityForUpdate = function (index) {

        var quantity = 0;
        for (var i = 0; i < purses.length; i++) {
            if (purses[i].dish.dishId == purses[index].dish.dishId && i != index)
                quantity += parseFloat(purses[i].quantity);
        }
        // console.log(quantity);

        return quantity;
    };
    $('#vat').click(function () {
        $("#pursesDetailsRender").empty();

        $(this).renderHtml(purses);
        // console.log($(this).is(':checked'));
    })
    $('#service').click(function () {
        $("#pursesDetailsRender").empty();

        $(this).renderHtml(purses);
        // console.log($(this).is(':checked'));
    })

    $('#staff').click(function () {
        if($(this).is(':checked')){
            for (var i=0;i<purses.length;i++){
                purses[i].dish.price=purses[i].dish.cost;
            }
            staff=true;}
        else {
            for (var i=0;i<purses.length;i++){
                purses[i].dish.price=purses[i].dish.originalprice;
            }
            staff = false;
        }
        $("#pursesDetailsRender").empty();

        $(this).renderHtml(purses);
        // console.log($(this).is(':checked'));
    })
    $('#discount').change(function () {
        discount = $(this).val();
        $("#pursesDetailsRender").empty();
        $(this).renderHtml(purses);
    })

    /**
     * Calculate due after pay
     * @param total
     */
    $.fn.confirmPurses = function () {

        if (parseFloat(sup_total + vat + service) < parseFloat(discount)) {
            // console.log(data);
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Discount is more than total order',
            })
            return false;
        }
        var formdata = new FormData();
        var json_arr = JSON.stringify(purses);

        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("vat", $('#vat').is(':checked') ? 'on' : '');
        formdata.append("service", $('#service').is(':checked') ? 'on' : '');
        formdata.append("staff", $('#staff').is(':checked') ? 'on' : '');
        formdata.append("discount", $('#discount').val());
        formdata.append("order_id", $('input[name="order_id"]').val());
        formdata.append("purses", json_arr);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            url: '/order/update',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                Swal.fire(
                    'Good job!',
                    'Success ! Purses Has been completed successfully',
                    'success'
                );
                purses = [];
                $("#pursesDetailsRender").empty();
                $(this).renderHtml(purses);
            },
            error: function (data) {
                if (data['status'] == 422) {
                    // console.log(data);
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Some thing went wrong',
                    })
                    purses = [];
                    $(this).renderHtml(purses);
                }

            },
        });


    }

});
