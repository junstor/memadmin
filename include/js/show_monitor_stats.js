var autof = 0;
$(function() {
    $(".monitordiv").anyDrag({
        obj: ".moarg",
        maxTop: true,
        alpha: 1
    });
    Init_Layout();
    $("#relayout").click(function() {
        Init_Layout();
    });
    $("#afs").val('5');
    $("#startaf").click(function() {
        if (autof == 0) {
            if ($("#afs").val() == "") {
                alert(afsempty);
                return;
            }
            var reaf = /^[1-9]+[0-9]*$/;
            if (!reaf.test($("#afs").val())) {
                alert(afsfail);
                return;
            }
            $(this).attr('value', afstop);
            $("#afs").attr("readonly", "readonly");
            $("#sein").hide();
            $("#repaf").show();
            $("#ausrep").text($("#afs").val());
            $("#lasttime").show();
            $("#lastaftit").show();
            $("#afstit").hide();
            var t = $("#afs").val() + 's';
            $('body').everyTime(t, 'autof',function() {
                $.ajax({
                    type: "POST",
                    url: "../apps/GetMonitorJson.php",
                    dateType: "json",
                    success: function(d) {
                        if (d == 'NoLogin' || d == 'SessionFail' || d == 'ConnectFail' || d == 'GetStatsFail' || d == 'GetKeyFail') {
                            $(this).attr('value', afstart);
                            $("#afs").removeAttr("readonly");
                            $("#sein").show();
                            $("#repaf").hide();
                            $("#lasttime").hide();
                            $("#lastaftit").hide();
                            $("#afstit").show();
                            $('body').stopTime('autof');
                            autof = 0;
                            alert(afsjsonfail);
							$(this).attr('value', afstart);
                            return;
                        } else {
                            var p = eval("(" + d + ")");
                            $.each(p,function(key, value) {
                                if (key == '__aftime__') 
                                  $("#lasttime").text(p.__aftime__);
                                else 
                                  $("#mo_" + key).text(value);
                            });
                        }
                    }
                });
            }, 0, true);
            autof = 1;
        } else {
            $(this).attr('value', afstart);
            $("#afs").removeAttr("readonly");
            $("#sein").show();
            $("#repaf").hide();
            $("#lasttime").hide();
            $("#lastaftit").hide();
            $("#afstit").show();
            $('body').stopTime('autof');
            autof = 0;
        }
    });
});
function Init_Layout() {
    var initx = 10;
    var inity = 90;
    var w = 250;
    var ex = 20;
    var ey = 20;
    var temp_ty = 0;

    if (w >= $(document.body).width()) {
        var i = 1;
        $(".monitordiv").each(function() {
            tx = initx;
            if (i == 1) 
              ty = inity;
            else 
              ty = temp_ty + ey;
            $(this).css({
                'position': 'absolute',
                'top': ty,
                'left': tx
            });
            temp_ty = ty + $(this).height(); ++i;
        });
    } else {
        var rnum = parseInt(($(document.body).width() - initx) / (w - ex));
        var i = 1;
        $(".monitordiv").each(function() {
            if (i >= 1 && i <= rnum) {
                tx = initx + (i - 1) * ex + (i - 1) * w;
                ty = inity;
            } else {
                k = i % rnum;
                if (k == 0) 
                  k = rnum;
                tx = initx + (k - 1) * ex + (k - 1) * w;
                ty = $("#drag_" + (i - rnum)).offset().top + ey + $("#drag_" + (i - rnum)).height();
            }
            $(this).css({
                'position': 'absolute',
                'top': ty,
                'left': tx
            }); ++i;
        });
    }
}