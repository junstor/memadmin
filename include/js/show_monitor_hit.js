$(function() {
    $(".monitordiv").anyDrag({
        obj: ".movetit",
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
                            try {
                                var p = eval("(" + d + ")");
                                $.each(p,function(key, value) {
                                    if (key == '__aftime__') 
                                      $("#lasttime").text(p.__aftime__);
                                    if (key == 'get') {
                                        if (p.__rtype__ == 'memcache') {
                                            var cmd = parseInt(p.get.cmd_get);
                                            var cmdhits = parseInt(p.get.get_hits);
                                            var cmdmiss = parseInt(p.get.get_misses);
                                        } else {
                                            var cmd = parseInt(p.get.cmd_get);
                                            var cmdhits = parseInt(p.get.cmd_get_hits);
                                            var cmdmiss = parseInt(p.get.cmd_get_misses);
                                        }
                                        $("#cmd_get_value").text(cmd);
                                        $("#get_hits_value").text(cmdhits);
                                        $("#get_misses_value").text(cmdmiss);
                                        if (cmd == 0) 
                                          rate = 0;
                                        else {
                                            var rt = cmdhits / cmd * 100;
                                            var rate = rt.toFixed(2);
                                        }
                                        $("#get_hit_rate").text(rate + "%");
                                        var x = parseInt(cmdhits / cmd * 100);
                                        var y = parseInt(cmdmiss / cmd * 100);
                                        var myvalues = [x, y];
                                        $("#gethitchart").html("");
                                        var hit_id = "getchar_" + (new Date()).getTime();
                                        if (cmd == 0) 
                                          $("#gethitchart").html("<div class=\"nochart\">" + nochart + "</div>");
                                        else 
                                          $("#gethitchart").html("<span id=\"" + hit_id + "\" class=\"chart\">Loading..</span><div class=\"chartico\"><div class=\"hitico\">" + charthit + "</div><div class=\"missico\">" + chartmiss + "</div></div>");
                                        $('#' + hit_id).sparkline(myvalues, {
                                            type: 'pie',
                                            width: '110px',
                                            height: '110px',
                                            sliceColors: ['#2886dd', '#fb3c4e']
                                        });
                                    }
                                    if (key == '_delete') {
                                        if (p.__rtype__ == 'memcache') {
                                            var cmd = parseInt(p._delete.delete_hits) + parseInt(p._delete.delete_misses);
                                            var cmdhits = parseInt(p._delete.delete_hits);
                                            var cmdmiss = parseInt(p._delete.delete_misses);
                                        } else {
                                            var cmd = parseInt(p._delete.cmd_delete);
                                            var cmdhits = parseInt(p._delete.cmd_delete_hits);
                                            var cmdmiss = parseInt(p._delete.cmd_delete_misses);
                                        }
                                        $("#cmd_delete_value").text(cmd);
                                        $("#delete_hits_value").text(cmdhits);
                                        $("#delete_misses_value").text(cmdmiss);
                                        if (cmd == 0) 
                                          rate = 0;
                                        else {
                                            var rt = cmdhits / cmd * 100;
                                            var rate = rt.toFixed(2);
                                        }
                                        $("#delete_hit_rate").text(rate + "%");
                                        var x = parseInt(cmdhits / cmd * 100);
                                        var y = parseInt(cmdmiss / cmd * 100);
                                        var myvalues = [x, y];
                                        $("#deletehitchart").html("");
                                        var hit_id = "deletechar_" + (new Date()).getTime();
                                        if (cmd == 0) 
                                          $("#deletehitchart").html("<div class=\"nochart\">" + nochart + "</div>");
                                        else 
                                          $("#deletehitchart").html("<span id=\"" + hit_id + "\" class=\"chart\">Loading..</span><div class=\"chartico\"><div class=\"hitico\">" + charthit + "</div><div class=\"missico\">" + chartmiss + "</div></div>");
                                        $('#' + hit_id).sparkline(myvalues, {
                                            type: 'pie',
                                            width: '110px',
                                            height: '110px',
                                            sliceColors: ['#2886dd', '#fb3c4e']
                                        });
                                    }
                                    if (key == 'set') {
                                        var cmd = parseInt(p.set.cmd_set);
                                        var cmdhits = parseInt(p.set.cmd_set_hits);
                                        var cmdmiss = parseInt(p.set.cmd_set_misses);
                                        $("#cmd_set_value").text(cmd);
                                        $("#set_hits_value").text(cmdhits);
                                        $("#set_misses_value").text(cmdmiss);
                                        if (cmd == 0)
                                          rate = 0;
                                        else {
                                            var rt = cmdhits / cmd * 100;
                                            var rate = rt.toFixed(2);
                                        }
                                        $("#set_hit_rate").text(rate + "%");
                                        var x = parseInt(cmdhits / cmd * 100);
                                        var y = parseInt(cmdmiss / cmd * 100);
                                        var myvalues = [x, y];
                                        $("#sethitchart").html("");
                                        var hit_id = "setchar_" + (new Date()).getTime();
                                        if (cmd == 0) 
                                          $("#sethitchart").html("<div class=\"nochart\">" + nochart + "</div>");
                                        else 
                                          $("#sethitchart").html("<span id=\"" + hit_id + "\" class=\"chart\">Loading..</span><div class=\"chartico\"><div class=\"hitico\">" + charthit + "</div><div class=\"missico\">" + chartmiss + "</div></div>");
                                        $('#' + hit_id).sparkline(myvalues, {
                                            type: 'pie',
                                            width: '110px',
                                            height: '110px',
                                            sliceColors: ['#2886dd', '#fb3c4e']
                                        });
                                    }
                                    if (key == 'incr') {
                                        var cmd = parseInt(p.incr.incr_hits) + parseInt(p.incr.incr_misses);
                                        var cmdhits = parseInt(p.incr.incr_hits);
                                        var cmdmiss = parseInt(p.incr.incr_misses);
                                        $("#cmd_incr_value").text(cmd);
                                        $("#incr_hits_value").text(cmdhits);
                                        $("#incr_misses_value").text(cmdmiss);
                                        if (cmd == 0) 
                                          rate = 0;
                                        else {
                                            var rt = cmdhits / cmd * 100;
                                            var rate = rt.toFixed(2);
                                        }
                                        $("#incr_hit_rate").text(rate + "%");
                                        var x = parseInt(cmdhits / cmd * 100);
                                        var y = parseInt(cmdmiss / cmd * 100);
                                        var myvalues = [x, y];
                                        $("#incrhitchart").html("");
                                        var hit_id = "incrchar_" + (new Date()).getTime();
                                        if (cmd == 0) 
                                          $("#incrhitchart").html("<div class=\"nochart\">" + nochart + "</div>");
                                        else 
                                          $("#incrhitchart").html("<span id=\"" + hit_id + "\" class=\"chart\">Loading..</span><div class=\"chartico\"><div class=\"hitico\">" + charthit + "</div><div class=\"missico\">" + chartmiss + "</div></div>");
                                        $('#' + hit_id).sparkline(myvalues, {
                                            type: 'pie',
                                            width: '110px',
                                            height: '110px',
                                            sliceColors: ['#2886dd', '#fb3c4e']
                                        });
                                    }
                                    if (key == 'decr') {
                                        var cmd = parseInt(p.decr.decr_hits) + parseInt(p.decr.decr_misses);
                                        var cmdhits = parseInt(p.decr.decr_hits);
                                        var cmdmiss = parseInt(p.decr.decr_misses);
                                        $("#cmd_decr_value").text(cmd);
                                        $("#decr_hits_value").text(cmdhits);
                                        $("#decr_misses_value").text(cmdmiss);
                                        if (cmd == 0) 
                                          rate = 0;
                                        else {
                                            var rt = cmdhits / cmd * 100;
                                            var rate = rt.toFixed(2);
                                        }
                                        $("#decr_hit_rate").text(rate + "%");
                                        var x = parseInt(cmdhits / cmd * 100);
                                        var y = parseInt(cmdmiss / cmd * 100);
                                        var myvalues = [x, y];
                                        $("#decrhitchart").html("");
                                        var hit_id = "decrchar_" + (new Date()).getTime();
                                        if (cmd == 0) 
                                          $("#decrhitchart").html("<div class=\"nochart\">" + nochart + "</div>");
                                        else 
                                          $("#decrhitchart").html("<span id=\"" + hit_id + "\" class=\"chart\">Loading..</span><div class=\"chartico\"><div class=\"hitico\">" + charthit + "</div><div class=\"missico\">" + chartmiss + "</div></div>");
                                        $('#' + hit_id).sparkline(myvalues, {
                                            type: 'pie',
                                            width: '110px',
                                            height: '110px',
                                            sliceColors: ['#2886dd', '#fb3c4e']
                                        });
                                    }
                                    if (key == 'cas') {
                                        var cmd = parseInt(p.cas.cas_hits) + parseInt(p.cas.cas_misses);
                                        var cmdhits = parseInt(p.cas.cas_hits);
                                        var cmdmiss = parseInt(p.cas.cas_misses);
                                        $("#cmd_cas_value").text(cmd);
                                        $("#cas_hits_value").text(cmdhits);
                                        $("#cas_misses_value").text(cmdmiss);
                                        if (cmd == 0) 
                                          rate = 0;
                                        else {
                                            var rt = cmdhits / cmd * 100;
                                            var rate = rt.toFixed(2);
                                        }
                                        $("#cas_hit_rate").text(rate + "%");
                                        var x = parseInt(cmdhits / cmd * 100);
                                        var y = parseInt(cmdmiss / cmd * 100);
                                        var myvalues = [x, y];
                                        $("#cashitchart").html("");
                                        var hit_id = "caschar_" + (new Date()).getTime();
                                        if (cmd == 0) 
                                          $("#cashitchart").html("<div class=\"nochart\">" + nochart + "</div>");
                                        else 
                                          $("#cashitchart").html("<span id=\"" + hit_id + "\" class=\"chart\">Loading..</span><div class=\"chartico\"><div class=\"hitico\">" + charthit + "</div><div class=\"missico\">" + chartmiss + "</div></div>");
                                        $('#' + hit_id).sparkline(myvalues, {
                                            type: 'pie',
                                            width: '110px',
                                            height: '110px',
                                            sliceColors: ['#2886dd', '#fb3c4e']
                                        });
                                    }
                                    if (key == 'touch') {
                                        var cmd = parseInt(p.touch.touch_hits) + parseInt(p.touch.touch_misses);
                                        var cmdhits = parseInt(p.touch.touch_hits);
                                        var cmdmiss = parseInt(p.touch.touch_misses);
                                        $("#cmd_touch_value").text(cmd);
                                        $("#touch_hits_value").text(cmdhits);
                                        $("#touch_misses_value").text(cmdmiss);
                                        if (cmd == 0) 
                                          rate = 0;
                                        else {
                                            var rt = cmdhits / cmd * 100;
                                            var rate = rt.toFixed(2);
                                        }
                                        $("#touch_hit_rate").text(rate + "%");
                                        var x = parseInt(cmdhits / cmd * 100);
                                        var y = parseInt(cmdmiss / cmd * 100);
                                        var myvalues = [x, y];
                                        $("#touchhitchart").html("");
                                        var hit_id = "touchchar_" + (new Date()).getTime();
                                        if (cmd == 0) 
                                          $("#touchhitchart").html("<div class=\"nochart\">" + nochart + "</div>");
                                        else 
                                          $("#touchhitchart").html("<span id=\"" + hit_id + "\" class=\"chart\">Loading..</span><div class=\"chartico\"><div class=\"hitico\">" + charthit + "</div><div class=\"missico\">" + chartmiss + "</div></div>");
                                        $('#' + hit_id).sparkline(myvalues, {
                                            type: 'pie',
                                            width: '110px',
                                            height: '110px',
                                            sliceColors: ['#2886dd', '#fb3c4e']
                                        });
                                    }

                                });
                            } catch(ex) {}

                        }
                    }
                });
            },0, true);
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
    $('#getchart').sparkline('html', {
        type: 'pie',
        width: '110px',
        height: '110px',
        sliceColors: ['#2886dd', '#fb3c4e']
    });
    $('#deletechart').sparkline('html', {
        type: 'pie',
        width: '110px',
        height: '110px',
        sliceColors: ['#2886dd', '#fb3c4e']
    });
    $('#setchart').sparkline('html', {
        type: 'pie',
        width: '110px',
        height: '110px',
        sliceColors: ['#2886dd', '#fb3c4e']
    });
    $('#incrchart').sparkline('html', {
        type: 'pie',
        width: '110px',
        height: '110px',
        sliceColors: ['#2886dd', '#fb3c4e']
    });
    $('#decrchart').sparkline('html', {
        type: 'pie',
        width: '110px',
        height: '110px',
        sliceColors: ['#2886dd', '#fb3c4e']
    });
    $('#caschart').sparkline('html', {
        type: 'pie',
        width: '110px',
        height: '110px',
        sliceColors: ['#2886dd', '#fb3c4e']
    });
    $('#touchchart').sparkline('html', {
        type: 'pie',
        width: '110px',
        height: '110px',
        sliceColors: ['#2886dd', '#fb3c4e']
    });
});
function Init_Layout() {
    var initx = 10,
    inity = 90,
    wsp = 20,
    hsp = 20;
    var i = 1;
    $(".monitordiv").each(function() {
        if (i == 1) {
            tx = initx;
            ty = inity;
        }
        if (i == 2) {
            tx = $(".drag_1").width() + wsp + initx;
            ty = inity;
        }
        if (i == 3) {
            tx = initx;
            ty = $(".drag_1").height() + hsp + inity;
        }
        if (i == 4) {
            tx = $(".drag_3").width() + wsp + initx;
            ty = $(".drag_2").height() + hsp + inity;
        }
        if (i == 5) {
            tx = initx;
            ty = $(".drag_1").height() + $(".drag_3").height() + inity + 2 * hsp;
        }
		if (i == 6) {
            tx = $(".drag_3").width() + wsp + initx;
            ty = $(".drag_1").height() + $(".drag_3").height() + inity + 2 * hsp;
        }
        $(this).css({
            'position': 'absolute',
            'top': ty,
            'left': tx
        }); ++i;
    });
}