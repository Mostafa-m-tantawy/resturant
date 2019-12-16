$('document').ready(function () {
    var form = $('#payment');


    form.submit(function (e) {

        e.preventDefault();
        $('#payment_modal').modal('toggle');
       if(status!='closed'){
         console.log(status);
           form.append("_token", $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                toastr.success("Submission was successful.");
                location.reload();

            },
            error: function (data) {
                // toastr.error("something went wrong");
            },
        });
       }else{
           toastr.error("order is closed" );

       }
    });


});
function  payment() {
    $('#payment_modal').modal('toggle');

}
