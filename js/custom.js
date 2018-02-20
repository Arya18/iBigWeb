/* Write here your custom javascript codes */
// A $( document ).ready() block.
$( document ).ready(function() {
    $("#alert-div").hide();
    $(".loader-image").hide();
    $("#sky-form4 input").each(function() {
                    // do something
                    $(this).on('keyup', function(){
                      // alert("value changed");
                      if($(this).val() != '') {
                      $('#sky-form4 button[type="submit"]').attr('disabled', false).css("cursor","pointer");
                    }
                  });
                });
});

$("#start-button").on('click', function(){
        $('html, body').animate({
                    scrollTop: $(".form-div").offset().top - 100
                }, 2000);
  });
      
$(function () {
        $('.banner-form').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'banner-form.php',
            data: $('.banner-form').serialize(),
            beforeSend: function()
             {
                 $('#sky-form4 button[type="submit"]').attr('disabled', true).css("cursor","not-allowed");
                 $(".loader-image").show();
             },
            success: function(result){
              $(".loader-image").hide();
              var dataObj = JSON.parse(result);
            	console.log(dataObj.type)
              if(dataObj.type!='error'){
                $("#alert-div").css({"color":"white", "background-color":"#72c02c"}).fadeIn("slow").text(dataObj.text);
                $('html, body').animate({
                    scrollTop: $("#alert-div").offset().top - 100
                });
                $("#sky-form4").trigger("reset");
                $('#sky-form4 button[type="submit"]').attr('disabled', false).css("cursor","pointer");
                setTimeout(function(){ 
                  $("#alert-div").fadeOut("slow");
                }, 7000);  
              }else{
                $("#alert-div").css({"color":"white", "background-color":"#72c02c"}).fadeIn("slow").text(dataObj.text);
                 $('html, body').animate({
                    scrollTop: $("#alert-div").offset().top - 100
                });
                setTimeout(function(){ 
                  $("#alert-div").fadeOut("slow");
                }, 7000);
              }
              
            }
          });

        });

      });
