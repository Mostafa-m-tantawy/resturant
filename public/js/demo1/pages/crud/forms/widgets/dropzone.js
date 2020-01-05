function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$('document').ready(function () {

    $("#imgInp").change(function() {
        readURL(this);
    });
});

// // "use strict";
// // Class definition
//
// var KTDropzoneDemo = function () {
//     // Private functions
//     var demos = function () {
//         // single file upload
//         Dropzone.options.kDropzoneOne = {
//             paramName: "image", // The name that will be used to transfer the file
//             maxFiles: 1,
//             maxFilesize: 2, // MB
//             addRemoveLinks: true,
//             accept: function(file, done) {
//                 if (file.name == "justinbieber.jpg") {
//                     done("Naha, you don't.");
//                 } else {
//                     done();
//                 }
//             }
//         };
//
//     }
//
//     return {
//         // public functions
//         init: function() {
//             demos();
//         }
//     };
// }();
//
// KTDropzoneDemo.init();
