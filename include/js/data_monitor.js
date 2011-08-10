$(function() {
    $("#scons").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=datamonitor&conid=" + $(this).val();
    });
    $("#gomonitorbut").click(function() {
        var temptime = (new Date()).getTime();
        $.ajax({
            type: "POST",
            data: check2json(),
            url: "../apps/SetMonitorSession.php?cache=" + temptime,
            success: function(d) {
                if (d == 'OK') {
                    window.location.href = "show_monitor_data.php";
                    return;
                } else {
                    alert('Fail');
                    return;
                }
            }
        });
    });
});
function check2json() {
    var jsonstr = "{'data':[{'monitor':'data','type':'" + type + "','num':'" + num + "','conid':'";
    if (type == 'con') 
      jsonstr += "0'},[";
    else if (type == 'conp') 
      jsonstr += $("#scons").val() + "'},[";
    var i = 0;
    $(".checkmo:checked").each(function() {
        if (i == 0) 
          jsonstr += "'" + $(this).val() + "'";
        else 
          jsonstr += ",'" + $(this).val() + "'"; 
        ++i;
    });
    jsonstr += "]]}";
    var p = eval("(" + jsonstr + ")");
    return p;
}