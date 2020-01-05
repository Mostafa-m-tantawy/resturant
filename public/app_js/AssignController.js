/**
 * Created by rifat on 8/27/17.
 */
var convertion_rate;

var clicked_source_type = '';
var clicked_source_id = '';
var clicked_assign_to = '';
var purse = {};
var unitId = '';
var unitName = '';
var purses = [];


// Class definition


/**
 * sum quantity assigned of purses list
 * @param product_id
 */
function checkQuantityForAdd(product_id) {
    var quantity = 0;
    for (var i = 0; i < purses.length; i++) {
        if (purses[i].product.productId == product_id)
            quantity += parseFloat(purses[i].quantity);
    }
    return quantity;
};


$(document).ready(function () {

    /**
     * It will take the current supplier id for further use
     */

    $("#sourceable_type").on('click', function (e) {
        clicked_source_type = $(this).val();
    });
    $("#sourceable_type").on('change', function () {
console.log(clicked_source_type);
        if (purses.length != 0) {
            if (clicked_source_type != 0) {
                $(this).val(clicked_source_type);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cannot change source type!',
                })
            }


        }else {


            var formdata = new FormData();
            formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: 'stock/get-sourceable/' + $(this).val(),
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log($('#sourceable_type').val());

                if(clicked_source_type=='department') {
                    $('#sourceable_id').html('');
                    $('<option ></option>').val('').text('select ID').appendTo('#sourceable_id');
                    $.each(data, function (i, item) {
                        $('<option ></option>').val(item.id).text(item.name).appendTo('#sourceable_id');
                    });
                }else{
                    $('#sourceable_id').html('');
                    $('<option ></option>').val('').text('select ID').appendTo('#sourceable_id');
                    // $.each(data, function (i, item) {
                        $('<option ></option>').val(data.id).text(data.user.name).appendTo('#sourceable_id');
                    // });
                }
                },
                error: function (data) {

                    if (data['status'] == 422) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'There are no IDs in this Types',
                        })
                    }

                },
            });

        }

    });
    $("#sourceable_id").on('click', function (e) {
        clicked_source_id = $(this).val();
        console.log(clicked_source_id);

    });
    $("#sourceable_id").on('change', function () {

        if (purses.length != 0) {
            if (clicked_source_id != 0) {
                $(this).val(clicked_source_id);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cannot change source ID!',
                })
            }


        }else {

            var formdata = new FormData();
            formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formdata.append("type", clicked_source_type);
            formdata.append("id",   $("#sourceable_id").val() );


            $.ajax({
                url: 'stock/get-sourceable-products',
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log(data);
                    if(clicked_source_type=='department') {


                        $('#assignable_id').html('');
                        $('<option ></option>').val('').text('select ID').appendTo('#assignable_id');
                        $.each(data[1], function (i, item) {
                            $('<option ></option>').val(item.id).text(item.user.name).appendTo('#assignable_id');
                        });

                    }else{


                        $('#assignable_id').html('');
                        $('<option ></option>').val('').text('select ID').appendTo('#assignable_id');
                        $.each(data[1], function (i, item) {
                            $('<option ></option>').val(item.id).text(item.name).appendTo('#assignable_id');
                        });

                    }


                    $('#product').html('');
                    $('<option ></option>').val('').text('select product').appendTo('#product');
                    $.each(data[0], function (i, item) {
                        $('<option  ' +
                            'data-cost="' + item.cost + '" ' +
                            'data-quantity="' + item.quantity + '"></option>')
                            .val(item.id).text(item.name).appendTo('#product');
                    })


                },
                error: function (data) {

                    if (data['status'] == 422) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'There are no IDs in this Types',
                        })
                    }

                },
            });

        }

    });

    $("#assignable_id").on('click', function (e) {
        clicked_assign_to = $(this).val();
    });
    $("#assignable_id").on('change', function () {


        if (purses.length != 0) {
            if (clicked_assign_to != 0) {
                $(this).val(clicked_assign_to);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cannot change assign to ID!',
                })
            }
        }

    });

    $("#quantity").on('keyup', function (e) {
        //console.log("Change");
        $("#grossPrice").val(($("#quantity").val() * $("#unitPrice").val()).toFixed(2));
        $("#child_unit_price").val(($("#unitPrice").val() / convertion_rate).toFixed(2));
    });

    /**
     * Product dropdown on change Action
     */
    $("#product").on('change', function (e) {
        var productId = $("#product").val()

        //unit price is fixed to cost of recioes if has recipe
        var selected = $(this).find('option:selected');

        var formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("type", clicked_source_type);
        formdata.append("id",   clicked_source_id );


        $.ajax({
            url: 'stock/product/quantity/'+$(this).val(),
            type: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data);
                $("#product option:selected").data('quantity',data)
                var quantityassigned = parseFloat( data) - checkQuantityForAdd(productId);

                if (parseFloat(quantityassigned) >= 0) {
                    $('#quantity').prop("max", quantityassigned);

                }
            },
            error: function (data) {

                if (data['status'] == 422) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'There is an error',
                    })
                }

            },
        });


        $.get('stock/get-unit-of-product/' + productId, function (data) {
            // console.log(data);
            $("#unit").text(data.unit.unit);
            // $("#child_unit").text(data.unit.child_unit);
            convertion_rate = data.unit.convert_rate;
            unitId = data.unit.id;
            unitName = data.unit.unit;

        });
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
        // //console.log('Form Submit');
        // //console.log($("#supplier_id").val());

        /**
         * Append value on purse object from form data
         * @type {{pursesId: string, supplier: {supplierId: (*), supplierName: (*)}, product: {productId: (*), productName: (*)}, quantity: (*), unit: {unitId: string, unitName: string, childUnit: number, convertRate: *, unitPrice: (*)}, grossPrice: (*)}}
         */

        if (!form[0].checkValidity()) {
            form[0].reportValidity();


        } else {
            purse = {
                assign_type: 'department',
                assign_to: clicked_assign_to,
                product: {
                    productId: $("#product").val(),
                    productName: $("#product option:selected").text(),
                    quantityAvailable: $("#product option:selected").data('quantity'),
                },
                quantity: $("#quantity").val(),
                unit: {
                    unitId: unitId,
                    unitName: unitName,
                },
            }

            //push purse object to purses array
            purses.push(purse);

            //Call render function to render purses list
            $("#pursesDetailsRender").empty();
            $(this).renderHtml(purses);

            //Set default value of all field except supplier in to form
            $("#quantity").val(0);
            $("#product").val('');
        }
    });

    /**
     * Render Purses List
     * @param data
     */
    $.fn.renderHtml = function (data) {
        // Final Total Cost
        var total = 0;
        var totalvat = 0;
        $.each(data, function (index, data) {
            // total += (data.unit.unitPrice * data.quantity) + (data.unit.unitPrice * data.quantity) * (data.product.vat / 100);
            // totalvat += (data.unit.unitPrice * data.quantity) * (data.product.vat / 100);
            $("#pursesDetailsRender").append(
                $("<tr>").append(
                    $("<th>", {text: index + 1}),
                    $("<td>", {text: (clicked_source_type!='restaurant')?'department':'restaurant'}),
                    $("<td>", {text: (clicked_source_type=='restaurant')?'department':'restaurant'}),
                    $("<td>", {text: data.product.productName}),
                    $("<td>").append(
                        $("<input/>", {
                            value: data.quantity,
                            class: 'form-control',
                            type: 'number',
                            onChange: '$(this).updateQuantity(' + index + ')'
                        })
                    ),
                    $("<td>").append(
                        $("<div>", {class: 'btn-group'}).append(
                            $("<button>", {
                                class: 'btn btn-danger btn-sm',
                                onClick: '$(this).deleteFromList(' + index + ')'
                            }).append(
                                $('<i>', {class: 'la la-remove'})
                            )
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
        purses.splice(index, 1);
        $("#pursesDetailsRender").empty();
        $(this).renderHtml(purses);
    };

    /**
     * Update quantity of purses list
     * @param index
     */
    $.fn.updateQuantity = function (index) {
        var quantityassigned = this.checkQuantityForUpdate(index);
        quantityassigned = parseFloat(purses[index].product.quantityAvailable)
            - parseFloat(quantityassigned) - parseFloat(this.val());
        if (quantityassigned >= 0) {
            purses[index].quantity = this.val();
            $("#pursesDetailsRender").empty();
            $(this).renderHtml(purses);

            var quantityassignedd = purses[index].product.quantityAvailable - checkQuantityForAdd(purses[index].product.productId);

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
            if (purses[i].product.productId == purses[index].product.productId && i != index)
                quantity += parseFloat(purses[i].quantity);
        }
        // console.log(quantity);

        return quantity;
    };


    /**
     * Calculate due after pay
     * @param total
     */
    $.fn.confirmPurses = function () {

        var formdata = new FormData();
        var json_arr = JSON.stringify(purses);
        // console.log(purses)



        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("purses", json_arr);
        formdata.append("source_type", clicked_source_type);
        formdata.append("source_id", clicked_source_id);
        formdata.append("assign_to", clicked_assign_to);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'stock/save-assign',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log(data);
                Swal.fire(
                    'Good job!',
                    'Success ! Purses Has been completed successfully',
                    'success'
                )
                purses = [];
                $("#pursesDetailsRender").empty();
                $(this).renderHtml(purses);

                location.reload();

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
