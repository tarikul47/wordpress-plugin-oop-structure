(function ($) {
  $("#wecoder-enquiry-form form").on("submit", function (e) {
    e.preventDefault();
    var data = $(this).serialize();

    $.post(wecoderAcademy.ajaxurl, data, function (response) {
      //console.log(data);
      if(response.success){
       //console.log(response.success);
        console.log('Yes');
      }else{
        //alert(response.data.message);
        console.log('No');
      }
    }).fail(function (error) {
      alert(wecoderAcademy.error);
    });
  });
})(jQuery);
