(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

// // Prevent Paste
// $('input, textarea').bind("paste", function(e) {
//   e.preventDefault();
// });
// Textarea Validation
$('textarea, input[type=text]').on('keypress', function (event) {
  if (event.charCode != 13) {
    var regex = new RegExp("^[a-zA-Z0-9- ,_.?+]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
  }
});
// Email Validation
$('input[type=email]').on('keypress', function (event) {
  var regex = new RegExp("^[a-zA-Z0-9@_.-]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
     event.preventDefault();
     return false;
  }
});
// $('textarea, input').on('drop', function(e) {
//     e.preventDefault();
//   });
// For Only Digits
$(document).on('keypress', '.digits', function() {
  var regex = new RegExp("^[0-9+]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
     event.preventDefault();
     return false;
  }
});
$(document).on('keypress', '.alpha-digits', function() {
  var regex = new RegExp("^[a-zA-Z0-9-]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
     event.preventDefault();
     return false;
  }
});

// Only Alphabets
$(function() {
  $(".alphabets").keydown(function(e) {
    if (e.altKey) {
      e.preventDefault();
    } else {
      var key = e.keyCode;
      if (!(key == 8 || key == 9 || key == 32 || key == 46 || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
          e.preventDefault();
      }
    }
  });
});