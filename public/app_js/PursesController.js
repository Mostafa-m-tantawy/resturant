/**
 * Created by rifat on 8/27/17.
 */
var convertion_rate;
var clicked_supplier_id = 0;


$(document).ready(function () {

    /**
     * It will take the current supplier id for further use
     */
    $("#supplier_id").on('click', function (e) {
        clicked_supplier_id = $("#supplier_id").val();
    });

    /**
     * Supplier dropdown on change Action
     */
    $("#supplier_id").on('change', function () {


        if (purses.length != 0) {
            if (clicked_supplier_id != 0) {
                $(this).val(clicked_supplier_id);
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

                $.ajax({
                    url: 'stock/supplier-products/' + $(this).val(),
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#product').html('');

                        console.log(data);
                        // var options = '';//'<option value="">select Supplier</option>';
                        $('<option ></option>').val('').text('select product').appendTo('#product');

                        $.each(data, function (i, item) {
                            console.log(item.pivot);

                            $('<option data-vat="'+item.pivot.vat+'"></option>').val(item.id).text(item.name).appendTo('#product');

                        });
                        // for (var i = 0; i < data.lenght; i++) {
                        //     options += '<option data-vat="' + data[i].vat + '" value="' + data[i].id + '">' + data[i].name + '</option>';
                        // }
                        // $('#product').append(options);

                    },
                    error: function (data) {
                        if (data['status'] == 422) {
                            console.log(data);

                        }

                    },
                });

            }
        }
    });

    /**
     * Quantity on value change
     */
    $("#quantity").on('keyup', function (e) {
        //console.log("Change");
        $("#grossPrice").val(($("#quantity").val() * $("#unitPrice").val()).toFixed(2));
        $("#child_unit_price").val(($("#unitPrice").val() / convertion_rate).toFixed(2));
    });

    /**
     * Unit Price on value change
     */
    $("#unitPrice").on('keyup', function (e) {
        $("#grossPrice").val($("#quantity").val() * $("#unitPrice").val());
        $("#child_unit_price").val(($("#unitPrice").val() / convertion_rate).toFixed(2));
    });

    /**
     * Unit price on mouse scroll value change
     */
    $("#unitPrice").on('wheel', function (e) {
        $("#grossPrice").val($("#quantity").val() * $("#unitPrice").val());
        $("#child_unit_price").val(($("#unitPrice").val() / convertion_rate).toFixed(2));
    });

    /**
     * Product dropdown on change Action
     */
    $("#product").on('change', function (e) {
        var productId = $("#product").val()

        //unit price is fixed to cost of recioes if has recipe
        var selected = $(this).find('option:selected');


        $.get('stock/get-unit-of-product/' + productId, function (data) {
            // console.log(data);
            $("#unit").text(data.unit.unit);
            $("#child_unit").text(data.unit.child_unit);
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
        if ( !form[0].checkValidity()){
            form[0].reportValidity();

        }else{
            purse = {
                supplier: {
                    supplierId: $("#supplier_id").val(),
                    supplierName: $("#supplier_id option:selected").text()
                },
                product: {
                    productId: $("#product").val(),
                    productName: $("#product option:selected").text(),
                    vat: ($("#product option:selected").data('vat')) ? $("#product option:selected").data('vat') : 0
                },
                quantity: $("#quantity").val(),
                unit: {
                    unitId: unitId,
                    unitName: unitName,
                    childUnit: ($("#unitPrice").val() / convertion_rate).toFixed(2),
                    convertRate: convertion_rate,
                    unitPrice: $("#unitPrice").val()
                },
                grossPrice: $("#grossPrice").val()
            }

            //push purse object to purses array
            purses.push(purse);

            //Call render function to render purses list
            $("#pursesDetailsRender").empty();
            $(this).renderHtml(purses);

            //Set default value of all field except supplier in to form
            $("#quantity").val(0);
            $("#unitPrice").val(0);
            $("#child_unit_price").val(0);
            $("#grossPrice").val(0);
            $("#product").val('');
        }
        // $form[0].checkValidity();
        //  console.log($form[0]);
        // //console.log($("#supplier_id").val());

        /**
         * Append value on purse object from form data
         * @type {{pursesId: string, supplier: {supplierId: (*), supplierName: (*)}, product: {productId: (*), productName: (*)}, quantity: (*), unit: {unitId: string, unitName: string, childUnit: number, convertRate: *, unitPrice: (*)}, grossPrice: (*)}}
         */

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
            total += (data.unit.unitPrice * data.quantity) + (data.unit.unitPrice * data.quantity) * (data.product.vat / 100);
            totalvat += (data.unit.unitPrice * data.quantity) * (data.product.vat / 100);
            $("#pursesDetailsRender").append(
                $("<tr>").append(
                    $("<th>", {text: index + 1}),
                    $("<td>", {text: data.supplier.supplierName}),
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
                        $("<input/>", {
                            value: data.unit.unitPrice,
                            class: 'form-control',
                            type: 'number',
                            onChange: '$(this).updateUnitPrice(' + index + ')'
                        })
                    ),
                    $("<td>", {text: (data.unit.unitPrice / data.unit.convertRate).toFixed(2)}),
                    $("<td>", {text: (data.unit.unitPrice * data.quantity).toFixed(2)}),
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
                    $("<th>", {colspan: 5}),
                    $("<th>", {text: "Sub-Total :", class: "text-right"}),
                    $("<th>", {text: (total - totalvat).toFixed(2)})
                ), $("<tr>").append(
                    $("<th>", {colspan: 5}),
                    $("<th>", {text: "VAT :", class: "text-right"}),
                    $("<th>", {text: totalvat.toFixed(2)})
                ), $("<tr>").append(
                    $("<th>", {colspan: 5}),
                    $("<th>", {text: "Total :", class: "text-right"}),
                    $("<th>", {text: total.toFixed(2)})
                ), $("<tr>").append(
                    $("<th>", {colspan: 5}),
                    $("<th>", {text: "Total :", class: "text-right"}),
                    $("<th>", {html: '<select class="form-control" name="payment" id="payment">' +
                            '<option value="cash">Cash</option>' +
                            '<option value="later">Later</option>' +
                            '</select>'
                    })
                ),
                // $("<tr>").append('<th colspan="5"></th>' +
                //     '<th class="text-right"> Payment Method :</th>' +
                //     '<th>  <select id="payment_method" class="form-control"  name="payment_method">'+
                //     '<option value="cash">cash </option>'+
                //     '<option value="check">check</option>'+
                //     '  </select></th>'),
                // $("<tr>").append(
                //     $("<th>",{colspan:5}),
                //     $("<th>", {text: "Payment :",class:"text-right"}),
                //     $("<input/>",{type:"number",
                //         value:"0", min:"0", style:"width: 120px",class:"form-control",
                //         id:"payment",
                //         onChange:"$(this).changeDuePayment("+total+")",
                //         onkeyup:"$(this).changeDuePayment("+total+")",
                //         onwheel:"$(this).changeDuePayment("+total+")"
                //     })
                // ),

                $("<tr>").append(
                    $("<th>", {colspan: 5}),
                    $("<th>", {text: "scan image:", class: "text-right"}),
                    $("<th>", {
                        html: '<form id="imgform" name="imgform" enctype="multipart/form-data">' +
                            '<input class="form-control" type="file" multiple name="files[]" id="img"></form> ',
                        // $("<input/>",{type:"file",
                        //     value:"0", min:"0", style:"width: 120px",class:"form-control",
                        //     id:"image",
                    })

                    // )
                ),
                $("<tr>").append(
                    $("<th>", {colspan: 6}),
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
     * Update unit price of purses list
     * @param index
     */
    $.fn.updateUnitPrice = function (index) {
        purses[index].unit.unitPrice = this.val();
        $("#pursesDetailsRender").empty();
        $(this).renderHtml(purses);
    };

    /**
     * Calculate due after pay
     * @param total
     */
    $.fn.changeDuePayment = function (total) {
        $("#due").text(total - $(this).val());
    };

    /**
     * Confirm Purses
     */
    $.fn.confirmPurses = function () {

        var formdata = new FormData();
        var json_arr = JSON.stringify(purses);

        if ($('#img').prop('files').length > 0) {
            var file = $('#img').prop('files');

            for( var i = 0; i < file.length; i++ ){
                let filee = file[i];
                formdata.append('files[' + i + ']', filee);
            }

        }
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("supplier_id", $("#supplier_id").val());
        formdata.append("purses", json_arr);
        formdata.append("payment", $("#payment").val() );
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'stock/save-purses',
            type: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
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
                    console.log(data);
                    $.Notification.notify('error',
                        'bottom right',
                        data.responseJSON[0]);
                    purses = [];
                    // $("#pursesDetailsRender").empty();
                    $(this).renderHtml(purses);
                }

            },
        });


    }

});

var purse = {};
var unitId = '';
var unitName = '';
var purses = [];
