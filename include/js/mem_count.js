var revalue = /^[1-9]+[0-9]*$/;
$(function() {
    $("#incrbut").click(function() {
        if ($("#incrkeyin").val() == "" || $("#incrvaluein").val() == "") {
            alert(noempty);
            return;
        } else if (!revalue.test($("#incrvaluein").val())) {
            alert(valuenonum);
            return;
        } else {
            $.ajax({
                type: "POST",
                data: data2json('incr'),
                url: "../apps/MemCount.php?action=incr&type=" + type + "&num=" + num,
                success: function(d) {
                    if (d != 'Fail' && d != 'NoLogin' && d != 'ConnectFail' && d != 'IncrFail') {
                        alert(countsuss + d);
                        return;
                    } else {
                        alert(countfail);
                        return;
                    }
                }
            });
        }
    });
    $("#decrbut").click(function() {
        if ($("#decrkeyin").val() == "" || $("#decrvaluein").val() == "") {
            alert(noempty);
            return;
        } else if (!revalue.test($("#decrvaluein").val())) {
            alert(valuenonum);
            return;
        } else {
            $.ajax({
                type: "POST",
                data: data2json('decr'),
                url: "../apps/MemCount.php?action=decr&type=" + type + "&num=" + num,
                success: function(d) {
                    if (d != 'Fail' && d != 'NoLogin' && d != 'ConnectFail' && d != 'DecrFail') {
                        alert(countsuss + d);
                        return;
                    } else {
                        alert(countfail);
                        return;
                    }
                }
            });
        }
    });
});
function data2json(t) {
    if (t == 'incr') {
        var jsonstr = "{'data':[{'key':'" + $("#incrkeyin").val() + "','value':'" + $("#incrvaluein").val() + "'}]}";
        var p = eval("(" + jsonstr + ")");
        return p;
    } else if (t == 'decr') {
        var jsonstr = "{'data':[{'key':'" + $("#decrkeyin").val() + "','value':'" + $("#decrvaluein").val() + "'}]}";
        var p = eval("(" + jsonstr + ")");
        return p;
    }
}