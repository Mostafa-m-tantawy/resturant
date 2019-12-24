$('document').ready(function () {
    var form = $('#payment');



    form.on('submit', function (e) {

        e.preventDefault();


        if (status != 'closed') {

            console.log(status);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data) {
                    $('#payment_modal').modal('toggle');
                    toastr.success("Submission was successful.");
                    location.reload();

                },
                error: function (data) {
                    $('#payment_modal').modal('toggle');
                    // toastr.error("something went wrong");
                },
            });
        } else {
            toastr.error("order is closed");

        }
// }


    });
});

function payment() {
    $('#payment_modal').modal('toggle');

}
function methodChange() {
  var method = $('#payment_method option:selected').val();
    $('#client_id').val('');
    if(method =='account'){
      $('#clientDiv').css('display','unset');

  }else{
      $('#clientDiv').css('display','none');

  }

}

function clientChange() {
    var money = $('#client_id option:selected').data('money');
    console.log(money);
    $('#easy-numpad-output').attr('max', money);

}
