var revalue = /^[1-9]+[0-9]*$/;
$(function() {
    $("#addbut").click(function() {
        if ($("#keyin").val() == "" || $("#valuein").val() == "") {
            alert(noempty);
            return;
        } else {
            $.ajax({
                type: "POST",
                data: data2json('set'),
                url: "../apps/MemSet.php?type=" + type + "&num=" + num,
                success: function(d) {
                    if (d == 'SetOK') {
                        alert(setsuss);
                        $("#keyin").val("");
                        $("#valuein").val("");
                        return;
                    } else {
                        if (type == 'con') {
                            alert(consavefail);
                            return;
                        } else {
                            alert(conpsavefail);
                            return;
                        }
                    }
                }
            });
        }
    });
});
function data2json(t) {
    if (t == 'set') {
        var k = $("#keyin").val();
        var v = $("#valuein").val();
        var kr = k.replace(/\'/g, '_ _rd');
        kr = kr.replace(/\\/g, '_ _rx');
        var vr = v.replace(/\'/g, '_ _rd');
        vr = vr.replace(/\\/g, '_ _rx');
        var jsonstr = "{'data':[{'key':'" + kr + "','value':'" + vr + "'}]}";
        var p = eval("(" + jsonstr + ")");
        return p;
    }
}