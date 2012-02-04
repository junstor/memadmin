var glo_charset=null;
var char_arr=new Array('UTF-8','GBK','GB2312','GB18030','Latin-1');

$(function() {
    $("#keybut").click(function() {
        if ($("#keyquery").val() == "") {
            alert(nokey);
            return;
        } else {
        	glo_charset=$("#selcharset").val();
            $.ajax({
                type: "POST",
                data: data2json(),
                url: "../apps/MemGet.php?type=" + type + "&num=" + num + "&charset=" + glo_charset,
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
                                if (value[0] === false) 
                                  var showvalue = "<span class=\"valuefail\">" + valuefail + "</span>";
                                else 
                                  var showvalue = htmlspecialchars((decodeURIComponent(value[0])));
                                key=htmlspecialchars(key);
								var key_md5=$.md5(encodeURI(key));
                                var getcharset = charset+"：<select name=\"pselcharset\" id=\"pselcharset_"+key_md5+"\" class=\"selcharset_c\" pmd5=\""+key_md5+"\">";
                                for(var i=0;i<char_arr.length;i++) {
                                	if(char_arr[i]===glo_charset)
                                		getcharset += "<option id=\""+char_arr[i]+"\" value=\""+char_arr[i]+"\" selected=\"selected\">"+char_arr[i]+"</option>";
                                	else
                                		getcharset += "<option id=\""+char_arr[i]+"\" value=\""+char_arr[i]+"\">"+char_arr[i]+"</option>";
                                }
                                getcharset += "</select>";
                                var strout = "<div class=\"showvalue key_" + key_md5 + "\"><div class=\"keyandflags\"><div class=\"thekey\"><span class=\"keytit\">KEY : </span><span class=\"keycon\">" + decodeURIComponent(key) + "</span></div><div class=\"theflags\">"+getcharset+"</div></div><div class=\"thevalue\"><span class=\"valuespan\">" + showvalue + "</span></div><div class=\"valuemenu\"><div class=\"menulist\"><span class=\"downtheflags\">Flags:&nbsp;" + p[1][key] + "</span><span class=\"downtheflags\">"+valuetypetit+":&nbsp;" + p[0][key][1] + "</span><a class=\"showser t_hide\" href=\"javascript:ser('" + key_md5 + "');\">" + sert + "</a><a class=\"showunser\" href=\"javascript:unser('" + key_md5 + "');\">" + unsert + "</a><a class=\"updater\" href=\"javascript:updateres('" + key_md5 + "');\">" + updatetit + "</a><a class=\"delkey\" href=\"javascript:delkey('" + key_md5 + "');\">" + del + "</a></div></div></div>";
                                $("#showres").append(strout);
                            });
                        }
                    }
                    $(".selcharset_c").change(function() {
                    	changecs($(this).val(),$(this).attr('pmd5'));
                	});
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
	var cs=$("#pselcharset_"+key_md5).val();
    $.ajax({
        type: "POST",
        data: formatjsons(key_md5),
        url: "../apps/FormatValue.php?action=ser&type=" + type + "&num=" + num + "&charset=" + cs,
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
	var cs=$("#pselcharset_"+key_md5).val();
    $.ajax({
        type: "POST",
        data: formatjsons(key_md5),
        url: "../apps/FormatValue.php?action=unser&type=" + type + "&num=" + num + "&charset=" + cs,
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

function changecs(cs,key_md5) {
	if($(".key_" + key_md5).find(".valuemenu").find(".menulist").find(".showser").css('display')=='none')
		ser(key_md5);
	else if($(".key_" + key_md5).find(".valuemenu").find(".menulist").find(".showunser").css('display')=='none')	
		unser(key_md5);
}