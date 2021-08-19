// var custid = document.getElementById('custid').value;
// var fname = document.getElementById('fname').value;
// var lname = document.getElementById('lname').value;
// var address = document.getElementById('address').value;
// var email = document.getElementById('email').value;
// var pnum = document.getElementById('pnum').value;
var total = document.getElementById('total').value;

paypal.Buttons({
  style: {
    color: 'blue',
    shape: 'pill'
  },
  createOrder: function(data, actions) {
    return actions.order.create ({
      intent: 'CAPTURE', //Capture payment from buyer
      // payer: {
      //   name: {
      //     given_name: fname,
      //     surname: lname
      //   },
      //   address: {
      //     address_line_1: address
      //   },
      //   email_address: email,
      //
      //   phone: {
      //     phone_type: "MOBILE",
      //     phone_number: {
      //       national_number: pnum
      //     }
      //   }
      // },

      purchase_units: [{
        amount: {
          value: total,
          currency_code: "MYR"
        }
      }]
    });
  },
  onApprove:function(data, actions) {
    return actions.order.capture().then(function(details) {

      /* Get from elements values */
     var values = $(this).serialize();
     var total = document.getElementById('total').value;

     $.ajax({
            url: "../include/payment.php",
            type: "post",
            data: {total2:total},
            success: function (response) {
              window.location.replace("../include/paymentsuccessfully.php")
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    })
  },
  onCancel:function(data) {
    window.location.replace("../include/oncancelpayment.php")
  }
}).render('#paypal-button-container');
