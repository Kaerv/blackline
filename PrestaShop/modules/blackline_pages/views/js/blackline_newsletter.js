$(document).ready(function() {
    $(".newsletter-check").on('change', function() {
        $(".newsletter-checkbox").toggleClass("checked-newsletter");
    });
});

$("#send-email-button").on("click", function() {
    $('.newsletter-warning').text("");
    if(newsletterFormIsValid()) {
        $.ajax({
            url: "http://34.107.72.57/PrestaShop/index.php?&fc=module&module=ps_emailsubscription&controller=subscription&ajax=true",
            type: "POST",
            data: {
                email: $("#email-input").val(),
                action: "0"
            },
            statusCode: {
                500: function(msg) {
                    $("body").append(msg.responseText)
                }
            },
            succes(msg) {
                console.log("Jej");
                console.log(msg);
            },
            fail(msg) {
                console.log("ojoj");
                console.log(msg);
            }
        });
    }
});

function newsletterFormIsValid() {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    if(!$(".newsletter-check").prop("checked")) {
        $('.newsletter-warning').text("Musisz zaakceptować warunki newslettera");
        return false;
    }
    else if(!re.test(String($("#email-input").val()).toLowerCase())) {
        $('.newsletter-warning').text("Adres e-mail jest niepoprawny");
        return false;
    }
    else return true;
}
