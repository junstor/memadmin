$(function() {
    $("#keybut").click(function() {
        if ($("#keyquery").val() == "") {
            alert(nokey);
            return;
        } else {
            $.ajax({
                type: "POST",
                data: data2json(),
                url: "../apps/MemGet.php?type=" + type + "&num=" + num,
                beforeSend: function() {
                    $("#showres").html("<div id=\"loading\"><img src=\"../images/loading.gif\" width=\"16\" height=\"16\" />" + loading + "</div>");
                },
                success: function(d) {
                    if (d == 'Fail' || d == 'NoLogin' || d == 'ConnectFail') {
                        alert(d);
                        return;
                    } else {
                        var p = eval("(" + d + ")");
                        if (p[0] == "") 
                          $("#showres").html("<div id=\"nolist\">" + notget + "</div>");
                        else {
                            $("#showres").html("<div id=\"querytit\"><div id=\"showtit\">" + getres + "：</div><div id=\"showimp\">" + resnot + "</div></div>");
                            $.each(p[0],function(key, value) {
                                if (value === false) 
                                  var showvalue = "<span class=\"valuefail\">" + valuefail + "</span>";
                                else 
                                  var showvalue = htmlspecialchars(value);
								key=htmlspecialchars(key);
                                var strout = "<div class=\"showvalue key_" + $.md5(encodeURI(key)) + "\"><div class=\"keyandflags\"><div class=\"thekey\"><span class=\"keytit\">KEY : </span><span class=\"keycon\">" + key + "</span></div><div class=\"theflags\">Flags:　" + p[1][key] + "</div></div><div class=\"thevalue\"><span class=\"valuespan\">" + showvalue + "</span></div><div class=\"valuemenu\"><div class=\"menulist\"><a class=\"showser t_hide\" href=\"javascript:ser('" + $.md5(encodeURI(key)) + "');\">" + sert + "</a><a class=\"showunser\" href=\"javascript:unser('" + $.md5(encodeURI(key)) + "');\">" + unsert + "</a><a class=\"updater\" href=\"javascript:updateres('" + $.md5(encodeURI(key)) + "');\">" + updatetit + "</a><a class=\"delkey\" href=\"javascript:delkey('" + $.md5(encodeURI(key)) + "');\">" + del + "</a></div></div></div>";
                                $("#showres").append(strout);
                            });
                        }
                    }
                }
            });
        }
    });
});
function delkey(key_md5) {
    if (confirm(delconfirm)) {
        $.ajax({
            type: "POST",
            data: formatjsons(key_md5),
            url: "../apps/DelKey.php?type=" + type + "&num=" + num,
            success: function(d) {
                if (d == 'DelOK') {
                    $(".key_" + key_md5).remove();
                    return;
                } else {
                    alert("Fail: \n" + d);
                    return;
                }
            }
        });
    }
}
function ser(key_md5) {
    $.ajax({
        type: "POST",
        data: formatjsons(key_md5),
        url: "../apps/FormatValue.php?action=ser&type=" + type + "&num=" + num,
        success: function(d) {
            if (d == 'Fail' || d == 'NoLogin' || d == 'ConnectFail' || d == 'FormatFail') {
                alert("Fail: \n" + d);
                return;
            } else {
                $(".key_" + key_md5).find(".thevalue").html(d);
                $(".key_" + key_md5).find(".valuemenu").find(".menulist").find(".showunser").show();
                $(".key_" + key_md5).find(".valuemenu").find(".menulist").find(".showser").hide();
            }
        }
    });
}
function unser(key_md5) {
    $.ajax({
        type: "POST",
        data: formatjsons(key_md5),
        url: "../apps/FormatValue.php?action=unser&type=" + type + "&num=" + num,
        success: function(d) {
            if (d == 'Fail' || d == 'NoLogin' || d == 'ConnectFail') {
                alert("Fail: \n" + d);
                return;
            } else if (d == 'FormatFail') {
                alert(unserfail);
                return;
            } else {
                $(".key_" + key_md5).find(".thevalue").html(d);
                $(".key_" + key_md5).find(".valuemenu").find(".menulist").find(".showser").show();
                $(".key_" + key_md5).find(".valuemenu").find(".menulist").find(".showunser").hide();
            }
        }
    });
}
function data2json(t) {
    var k = $("#keyquery").val();
    var kr = k.replace(/\'/g, '_ _rd');
    kr = kr.replace(/\\/g, '_ _rx');
    var jsonstr = "{'data':[{'key':'" + kr + "'}]}";
    var p = eval("(" + jsonstr + ")");
    return p;
}
function formatjsons(key_md5) {
    key = $(".key_" + key_md5).find(".keycon").text();
    var kr = key.replace(/\'/g, '_ _rd');
    kr = kr.replace(/\\/g, '_ _rx');
    var jsonstr = "{'data':[{'key':'" + kr + "'}]}";
    var p = eval("(" + jsonstr + ")");
    return p;
}

function htmlspecialchars(str)  {  
    str=str.toString();
    str = str.replace(/&/g, '&amp;');
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/'/g, '&#039;');
    return str;
}

function updateres(key_md5) {
	if($(".key_" + key_md5).find(".valuemenu").find(".menulist").find(".showser").css('display')=='none')
		ser(key_md5);
	else if($(".key_" + key_md5).find(".valuemenu").find(".menulist").find(".showunser").css('display')=='none')	
		unser(key_md5);		
}