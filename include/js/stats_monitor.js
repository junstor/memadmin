$(function() {
    $(".checkmo").change(function() {
        if ($(this).attr('checked') == 'checked') {
            if (!$.browser.msie) 
              $(this).parent().parent().find('td').css('background', '#fdf8cc');
            else 
              $(this).parent().parent().parent().find('td').css('background', '#fdf8cc');
        } else {
            if (!$.browser.msie) 
              $(this).parent().parent().find('td').css('background', '#ffffff');
            else 
              $(this).parent().parent().parent().find('td').css('background', '#ffffff');
        }
    });
    $("#seall").click(function() {
        $(".checkmo").attr("checked", 'checked');
        if (!$.browser.msie) 
          $(this).parent().parent().find('td').css('background', '#fdf8cc');
        else 
          $(this).parent().parent().parent().find('td').css('background', '#fdf8cc');
    });
    $("#ceall").click(function() {
        $(".checkmo").removeAttr("checked");
        if (!$.browser.msie) 
          $(this).parent().parent().find('td').css('background', '#ffffff');
        else 
          $(this).parent().parent().parent().find('td').css('background', '#ffffff');
    });
    $("#opall").click(function() {
        $(".checkmo").each(function() {
            if ($(this).attr('checked') == 'checked') {
                $(this).removeAttr("checked");
                if (!$.browser.msie) 
                  $(this).parent().parent().find('td').css('background', '#ffffff');
                else 
                  $(this).parent().parent().parent().find('td').css('background', '#ffffff');
            } else {
                $(this).attr("checked", 'checked');
                if (!$.browser.msie) 
                  $(this).parent().parent().find('td').css('background', '#fdf8cc');
                else 
                  $(this).parent().parent().parent().find('td').css('background', '#fdf8cc');
            }
        });
    });
    $("#scons").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=statsmonitor&conid=" + $(this).val();
    });
    $("#gomonitorbut").click(function() {
        if ($(".checkmo:checked").length == 0) {
            alert(nocheck);
            return;
        }
        var temptime = (new Date()).getTime();
        $.ajax({
            type: "POST",
            data: check2json(),
            url: "../apps/SetMonitorSession.php?cache=" + temptime,
            success: function(d) {
                if (d == 'OK') {
                    window.location.href = "show_monitor_stats.php";
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
    var jsonstr = "{'data':[{'monitor':'stats','type':'" + type + "','num':'" + num + "','conid':'";
    if (type == 'con') 
      jsonstr += "0'},[";
    else if (type == 'conp') 
      jsonstr += $("#scons").val() + "'},[";
    var i = 0;
    $(".checkmo:checked").each(function() {
        if (i == 0) 
          jsonstr += "'" + $(this).val() + "'";
        else 
          jsonstr += ",'" + $(this).val() + "'"; ++i;
    });
    jsonstr += "]]}";
    var p = eval("(" + jsonstr + ")");
    return p;
}