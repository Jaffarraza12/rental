var payment  = {
    init : function () {
            payment.VisibleButton()
        //setTimeout(function(){})
            $(".payment").click(function() {
                 payment.VisibleButton(this);
            });


    },VisibleButton:function (elem) {
         if($(".payment:checked").length) {
             $(".payment_button").prop("disabled", false);
         } else {
             $(".payment_button").prop("disabled", true);
         }
    },
};