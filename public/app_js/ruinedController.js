/**
 * Created by rifat on 8/27/17.
 */
var convertion_rate;
var clicked_ruined_type = '';
var clicked_ruind_from = '';
var clicked_rangeofdate = '';
var clicked_price_math_method = '';
var purse = {};
var unitId = '';
var unitName = '';
var purses = [];


$(document).ready(function () {

    /**
     * It will take the current supplier id for further use
     */
    $("#price_math_method").on('change', function (e) {
// console.log( $(this).val());
        if (purses.length != 0) {
            if (clicked_price_math_method != '') {
                $(this).val(clicked_price_math_method);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cannot change  Method!',
                })
            }
        }
        clicked_price_math_method = $(this).val();

    });


    $("#rangeofdate").on('change', function (e) {
        // console.log( $(this).val());

        if (purses.length != 0) {
            if (clicked_rangeofdate != '') {
                $(this).val(clicked_rangeofdate);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cannot change  date range!',
                })
            }}
        clicked_rangeofdate = $(this).val();

    });



    $("#type").on('change', function (e) {
        clicked_ruined_type = $(this).val();
    });


    /**
     * Supplier dropdown on change Action
     */
    $("#type").on('change', function () {

        if (purses.length != 0) {
            if (clicked_ruined_type != '') {
                $(this).val(clicked_ruined_type);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cannot change  type!',
                })
            }
        } else {
            if ($(this).val() != '') {

                var formdata = new FormData();
                formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: '/get-assignable-ruined/' + $(this).val(),
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        // console.log(data);
                        if (clicked_ruined_type == 'restaurant') {
                            $('#from_stock').html('');
                            $('<option ></option>').val('').text('select product').appendTo('#from_stock');
                            $.each(data, function (i, item) {
                                $('<option ></option>').val(item.id).text(item.user.name).appendTo('#from_stock');

                            });

                        } else if (clicked_ruined_type == 'department') {
                            $('#from_stock').html('');
                            $('<option ></option>').val('').text('select product').appendTo('#from_stock');
                            $.each(data, function (i, item) {
                                $('<option ></option>').val(item.id).text(item.name).appendTo('#from_stock');

                            });
                        }

                    },
                    error: function (data) {
                        if (data['status'] == 422) {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'There is no list fro selection!',
                            })
                        }

                    },
                });

            }
        }
    });

    $("#from_stock").on('change', function (e) {
        clicked_ruind_from = $(this).val();
    });

    $("#from_stock").on('change', function () {


        if (purses.length != 0) {
            if (clicked_ruind_from != 0) {
                $(this).val(clicked_ruind_from);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Cannot add multiple supplier in a purses!',
                })
            }
        } else {
            if ($(this).val() != '') {
                var formdata = new FormData();
                formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
                formdata.append("type", clicked_ruined_type);
                formdata.append("from", clicked_ruind_from);

                $.ajax({
                    url: '/ruined-products',
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        // var productlist=false;
                        // console.log(data)
                        $('#product').html('');

                        $('<option ></option>').val('').text('select product').appendTo('#product');

                        $.each(data, function (i, item) {
                        // if(item.quantity_available) {
                            $('<option data-vat="' + item.vat + '" data-quantity="' + item.quantity + '"></option>').val(item.id).text(item.name).appendTo('#product');
                            // productlist = true;
                        // }});
                      // if( productlist==false){
                      //     Swal.fire({
                      //         type: 'error',
                      //         title: 'Oops...',
                      //         text: 'there is no items in list',
                      //     })
                      })
                    },
                    error: function (data) {
                        if (data['status'] == 422) {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'there is no items in list',
                            })
                        }

                    },
                });

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


        $.get('/get-unit-of-product/' + productId, function (data) {
            // console.log(data);
            $("#unit").text(data.unit.unit);
            // $("#child_unit").text(data.unit.child_unit);
            // convertion_rate = data.unit.convert_rate;

            unitId = data.unit.id;
            unitName = data.unit.unit;
        });

        var formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("price_math_method", clicked_price_math_method);
        formdata.append("rangeofdate",clicked_rangeofdate );
        formdata.append("ruined_type",clicked_ruined_type );
        formdata.append("ruined_from",clicked_ruind_from );

        $.ajax({
            url: '/get-product-cost/' + $(this).val(),
            type: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                   $('#quantity').prop("max", parseFloat(data[1]));

$('#cost').val(parseFloat(data[0]));
            },
            error: function (data) {
                if (data['status'] == 422) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'There is error of cost!',
                    })
                }

            },
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
        if ( !form[0].checkValidity()){
            form[0].reportValidity();

        }else{
        purse = {
            price_math_method: clicked_price_math_method,
            rangeofdate: clicked_rangeofdate,
            type: clicked_rangeofdate,
            ruined_from: clicked_rangeofdate,

            product: {
                productId: $("#product").val(),
                productName: $("#product option:selected").text(),
            },
            quantity: $("#quantity").val(),
            unit_cost: $("#cost").val(),
            note: $("#note").val(),
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
        $("#note").val('');
        $("#cost").val('');
        $("#from_stock").val('');
        $("#type").val('');
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
                    $("<td>", {text: clicked_ruined_type}),
                    $("<td>", {text: clicked_ruind_from}),
                    $("<td>", {text: clicked_price_math_method}),
                    $("<td>", {text: clicked_rangeofdate}),
                    $("<td>", {text: data.product.productName}),
                    $("<td>").append(
                        $("<input/>", {
                            value: data.quantity,
                            class: 'form-control',
                            type: 'number',
                            onChange: '$(this).updateQuantity(' + index + ')'
                        })
                    ),
                    $("<td>", {text: data.unit_cost}),

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
                    $("<th>", {colspan: 7}),
                    $("<th>", {text: "scan image:", class: "text-right"}),
                    $("<th>", {
                        html: '<form id="imgform" name="imgform" enctype="multipart/form-data"><input class="form-control" type="file" name="img" id="img"></form> ',
                    })
                ),
                $("<tr>").append(
                    $("<th>", {colspan: 8}),
                    $("<th>").append(
                        $("<button>", {
                            text: "Confirm Purses",
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
        purses[index].quantity = this.val();
        $("#pursesDetailsRender").empty();
        $(this).renderHtml(purses);
    };


    /**
     * Calculate due after pay
     * @param total
     */
    $.fn.confirmPurses = function () {

        var formdata = new FormData();
        var json_arr = JSON.stringify(purses);
// console.log(purses)

        if ($('#img').prop('files').length > 0) {
            var file = $('#img').prop('files')[0];
            formdata.append("image", file);

        }


        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("purses", json_arr);
        formdata.append("type", clicked_ruined_type);
        formdata.append("ruined_from", clicked_ruind_from);
         formdata.append("price_math_method", clicked_price_math_method);
        formdata.append("rangeofdate", clicked_rangeofdate);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/save-ruined',
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
