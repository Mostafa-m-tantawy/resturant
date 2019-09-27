/**
 * Created by rifat on 9/8/17.
 */
var convertion_rate;
var clicked_supplier_id = 0;

$(document).ready(function (e) {

    var id = $("#purses_id").val();



    /**
     * Quantity on value change
     */
    $("#quantity").on('keyup', function (e) {
        //console.log("Change");
        $("#grossPrice").val($("#quantity").val() * $("#unitPrice").val());
        $("#child_unit_price").val($("#unitPrice").val() / convertion_rate);
    });

    /**
     * Unit Price on value change
     */
    $("#unitPrice").on('keyup', function (e) {
        $("#grossPrice").val($("#quantity").val() * $("#unitPrice").val());
        $("#child_unit_price").val($("#unitPrice").val() / convertion_rate);
    });

    /**
     * Unit price on mouse scroll value change
     */
    $("#unitPrice").on('wheel', function (e) {
        $("#grossPrice").val($("#quantity").val() * $("#unitPrice").val());
        $("#child_unit_price").val($("#unitPrice").val() / convertion_rate);
    });

    /**
     * Product dropdown on change Action
     */
    $("#product").on('change', function (e) {
        var productId = $("#product").val()
        $("#vat").val($('#product option:selected ').data('vat'));
        $.get('/get-unit-of-product/' + productId, function (data) {
            //console.log(data);
            $("#unit").text(data.unit.unit);
            $("#child_unit").text(data.unit.child_unit);
            convertion_rate = data.unit.convert_rate;

            unitId = data.unit.id;
            unitName = data.unit.unit;

        });
    });






});
