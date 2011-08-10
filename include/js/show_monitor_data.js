var autof = 0;
var slabid_t;
var hoverselect = 0;
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
                    url: "../apps/GetMonitorJson.php?slabid=" + slabid_t,
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
                            if (p.slabid != slabid_t) 
                              return;
                            else {
                                $("#lasttime").text(p.__aftime__);
                                $("#data_curr_items").text(p.curr_items);
                                $("#data_bytes").text(p.bytes);
                                $("#data_active_slabs").text(p.active_slabs);
                                $("#data_total_malloced").text(p.total_malloced);
                                $.each(p.mo,function(key, value) {
                                    $("#data_" + key).text(value);
                                });
                                var temp_value = $("#slabs").val();
                                var temp_value_str = "";
                                var md5_option = "";
                                $.each(p.update_select,function(key, value) {
                                    temp_value_str += "<option id=\"slab_" + value + "\" value=\"" + value + "\">SLAB : " + value + "</option>";
                                    md5_option += "-" + value;
                                });
                                $("#data_lostmem").text(parseInt(p.mo.total_chunks) * parseInt(p.mo.chunk_size) - parseInt(p.mo.mem_requested));
                                if (md5_option != md5_op) {
                                    $("#slabs").html(temp_value_str);
                                    $("#slab_" + temp_value).attr("SELECTED", "SELECTED");
                                    md5_op = md5_option;
                                }
                            }
                        }
                    }
                });
            },
            0, true);
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
    $("#slabs").change(function() {
        slabid_t = $(this).val();
        $.ajax({
            type: "POST",
            url: "../apps/GetMonitorJson.php?slabid=" + slabid_t,
            dateType: "json",
            success: function(d) {
                if (d == 'NoLogin' || d == 'SessionFail' || d == 'ConnectFail' || d == 'GetStatsFail' || d == 'GetKeyFail') {
                    alert("Fail");
                    return;
                } else {
                    var p = eval("(" + d + ")");
                    if (p.slabid != slabid_t) 
                      return;
                    else {
                        $("#lasttime").text(p.__aftime__);
                        $("#data_curr_items").text(p.curr_items);
                        $("#data_bytes").text(p.bytes);
                        $("#data_active_slabs").text(p.active_slabs);
                        $("#data_total_malloced").text(p.total_malloced);
                        $.each(p.mo,function(key, value) {
                            $("#data_" + key).text(value);
                        });
                        $("#data_lostmem").text(parseInt(p.mo.total_chunks) * parseInt(p.mo.chunk_size) - parseInt(p.mo.mem_requested));
                    }
                }
            }
        });
    });
});
function Init_Layout() {
    var initx = 10;
    var inity = 90;
    $("#drag_1").css({
        'position': 'absolute',
        'top': inity,
        'left': initx
    });
    var d2_top = $("#drag_1").offset().top + $("#drag_1").height() + 20;
    $("#drag_2").css({
        'position': 'absolute',
        'top': d2_top,
        'left': initx
    });
}