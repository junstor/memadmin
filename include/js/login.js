$(function() {
    $("#nojs").hide();
    $("#l_but").click(function() {
        $("#l_show_callbak").css({
            "visibility": "hidden"
        });
        if ($("#l_in_user").val() == "" || $("#l_in_pass").val() == "") {
            $("#l_show_callbak").text("username or password must be not empty");
            $("#l_show_callbak").css({
                "visibility": "visible"
            });
            return;
        } else {
            $.ajax({
                type: "POST",
                url: "index.php?action=login",
                data: sd(),
                success: function(d) {
                    if (d == 'FAIL') {
                        $("#l_show_callbak").text("username or password is incorrect");
                        $("#l_show_callbak").css({
                            "visibility": "visible"
                        });
                        return;
                    } else if (d == 'OK') {
                        window.location.href = "index.php?action=set.con";
                    }
                }
            });
        }
    });
});
function sd() {
    var slang = $('#selectLang option:selected');
    var lang = slang.val();
    var d = {
        user: $("#l_in_user").val(),
        passwd: $("#l_in_pass").val(),
        lang: lang
    };
    return d;
}
document.onkeydown = function(e) {
    var theEvent = window.event || e;
    var code = theEvent.keyCode || theEvent.which;
    if (code == 13) {
        $("#l_but").click();
    }
}