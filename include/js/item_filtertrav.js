var glo_p = null;
var curpage = null;
var totalnum = null;
var pagenum = null;
var isvaluefilter = null;
var perpage = 50;

$(function() {
    $("#showdemo").hide();
    $("#showdemobut").click(function() {
        $("#showdemo").css('position', 'absolute');
        $("#showdemo").show();
	if($(document.body).width()<=935) {
		$("#showdemo").css({'top':'250px','left':'450px'});
	}
    });
    $("#closedemo").click(function() {
        $("#showdemo").hide();
    });
    $("#selslabid").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=filtertrav&slabid=" + $(this).val();
    });
    $("#gotrav").click(function() {
        isvaluefilter = null;
        if ($("#travnum").val() == "") {
            alert(nonum);
            return;
        }
        var revalue = /^[1-9]+[0-9]*$/;
        if (!revalue.test($("#travnum").val())) {
            alert(numonly);
            return;
        }
        if (parseInt($("#travnum").val()) > parseInt($("#slabtotalnumvalue").text())) {
            alert(numwrong);
            return;
        }
        if (! ($("#keyfiltercheck").attr("checked") == true || $("#keyfiltercheck").attr("checked") == "checked") && !($("#valuefiltercheck").attr("checked") == true || $("#valuefiltercheck").attr("checked") == "checked")) {
            alert(nofiltercheck);
            return;
        }
        if ($("#keyfiltercheck").attr("checked") == true || $("#keyfiltercheck").attr("checked") == "checked") {
            if ($("#keyfilterin").val() == "") {
                alert(keyfilteremp);
                return;
            }
        }
        if ($("#valuefiltercheck").attr("checked") == true || $("#valuefiltercheck").attr("checked") == "checked") {
            if ($("#valuefilterin").val() == "") {
                alert(valuefilteremp);
                return;
            }
            isvaluefilter = 1;
        }
        $("#showres").html("");
        $("#pages").html("");
        glo_p = null;
        if (type == 'con') {
            $.ajax({
                type: "POST",
                data: filter2json(),
                url: "../apps/ItemFilterTrav.php?type=" + type + "&num=" + num + "&slabid=" + $("#selslabid").val() + "&shownum=" + $("#travnum").val(),
                beforeSend: function() {
                    $("#showres").html("<div id=\"loading\"><img src=\"../images/loading.gif\" width=\"16\" height=\"16\" />" + loading + "</div>");
                },
                success: function(d) {
                    if (d == 'Fail' || d == 'NoLogin' || d == 'ConnectFail') {
                        alert(d);
                        return;
                    } else if (d == 'KeyFilterFail') {
                        $("#showres").html("");
                        alert(keyfilterfail);
                        return;
                    } else if (d == 'ValueFilterFail') {
                        $("#showres").html("");
                        alert(valuefilterfail);
                        return;
                    } else {
                        var thep = eval("(" + d + ")");
                        if (parseInt(thep['rnum']) == 0) {
                            $("#showres").html("<div id=\"noret\">" + nofilterret + "</div>");
                            $("#pages").html("");
                            return;
                        }
                        glo_p = thep['res'];
                        curpage = 1;
                        totalnum = parseInt(thep['rnum']);
                        if (totalnum <= perpage) 
                          pagenum = 1;
                        if (totalnum % perpage) 
                          pagenum = Math.floor(totalnum / perpage) + 1;
                        else 
                          pagenum = Math.floor(totalnum / perpage);
                        showpage(curpage);
                    }
                }
            });
        } else if (type == 'conp') {
            $.ajax({
                type: "POST",
                data: filter2json(),
                url: "../apps/ItemFilterTrav.php?type=" + type + "&num=" + num + "&conid=" + $("#conitemsle").val() + "&slabid=" + $("#conpselslabid").val() + "&shownum=" + $("#travnum").val(),
                beforeSend: function() {
                    $("#showres").html("<div id=\"loading\"><img src=\"../images/loading.gif\" width=\"16\" height=\"16\" />" + loading + "</div>");
                },
                success: function(d) {
                    if (d == 'Fail' || d == 'NoLogin' || d == 'ConnectFail') {
                        alert(d);
                        return;
                    } else if (d == 'KeyFilterFail') {
                        $("#showres").html("");
                        alert(keyfilterfail);
                        return;
                    } else if (d == 'ValueFilterFail') {
                        $("#showres").html("");
                        alert(valuefilterfail);
                        return;
                    } else {
                        var thep = eval("(" + d + ")");
                        if (parseInt(thep['rnum']) == 0) {
                            $("#showres").html("<div id=\"noret\">" + nofilterret + "</div>");
                            $("#pages").html("");
                            return;
                        }
                        glo_p = thep['res'];
                        curpage = 1;
                        totalnum = parseInt(thep['rnum']);
                        if (totalnum <= perpage) 
                          pagenum = 1;
                        if (totalnum % perpage) 
                          pagenum = Math.floor(totalnum / perpage) + 1;
                        else 
                          pagenum = Math.floor(totalnum / perpage);
                        showpage(curpage);
                    }
                }
            });
        }
    });
    $("#conitemsle").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=filtertrav&conid=" + $(this).val();
    });
    $("#conpselslabid").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=filtertrav&conid=" + getconid + "&slabid=" + $(this).val();
    });
    $("#keyfilterin").bind('keyup',
    function() {
        if ($(this).val() != "") 
          $("#keyfiltercheck").attr("checked", 'checked');
        else 
          $("#keyfiltercheck").removeAttr("checked");
    });
    $("#valuefilterin").bind('keyup',
    function() {
        if ($(this).val() != "") 
          $("#valuefiltercheck").attr("checked", 'checked');
        else 
          $("#valuefiltercheck").removeAttr("checked");
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
                    nownum = parseInt($("#slabtotalnumvalue").text()); --nownum;
                    theindex = parseInt($(".key_" + key_md5).find("#hideindex").val());
                    glo_p[theindex] = "___   ___memadmin__deleted";
                    $("#slabtotalnumvalue").text(nownum);
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

function filter2json() {
    var keyfilter = null;
    var valuefilter = null;
    var kt = 0;
    var vt = 0;
    if ($("#keyfiltercheck").attr("checked") == true || $("#keyfiltercheck").attr("checked") == "checked") {
        keyfilter = $("#keyfilterin").val();
    }
    if ($("#valuefiltercheck").attr("checked") == true || $("#valuefiltercheck").attr("checked") == "checked") {
        valuefilter = $("#valuefilterin").val();
    }
    if (keyfilter != null) {
        keyfilter = keyfilter.replace(/\'/g, '_ _rd');
        kt = 1;
    }
    if (valuefilter != null) {
        valuefilter = valuefilter.replace(/\'/g, '_ _rd');
        vt = 1;
    }
    var jsonstr = "{'data':[{'kt':'" + kt + "','kf':'" + keyfilter + "','vt':'" + vt + "','vf':'" + valuefilter + "'}]}";
    var p = eval("(" + jsonstr + ")");
    return p;
}
function showpage(page) {
    try {
        curpage = parseInt(page);
        $("#showres").html("");
        var begini = (curpage - 1) * perpage;
        var keystr;
        if ((totalnum - begini) >= perpage) 
          endnum = perpage;
        else 
          endnum = totalnum - begini;
        for (var i = 0; i < endnum; i++) {
            keystr += " " + glo_p[begini++][0];
        }
        var kr = keystr.replace(/\'/g, '_ _rd');
        kr = kr.replace(/\\/g, '_ _rx');
        var jsonstr = "{'data':[{'key':'" + kr + "'}]}";
        var p = eval("(" + jsonstr + ")");
        $.ajax({
            type: "POST",
            data: p,
            url: "../apps/MemGet.php?type=" + type + "&num=" + num,
            beforeSend: function() {
                $("#showres").append("<div id=\"loading\"><img src=\"../images/loading.gif\" width=\"16\" height=\"16\" />" + loading + "</div>");
            },
            success: function(d) {
                $("#loading").remove();
                $("#showres").html("<div id=\"querytit\"><div id=\"showtit\">" + getres + "：</div><div id=\"showimp\">" + resnot + "</div></div>");
                if (d == 'Fail' || d == 'NoLogin' || d == 'ConnectFail') {
                    alert(d);
                    return;
                } else {
                    var p = eval("(" + d + ")");
                    begini = (curpage - 1) * perpage;
                    for (var i = 0; i < endnum; i++) {
                        var caldel = 0;
                        var kindex = begini++;
                        if (glo_p[kindex] != "___   ___memadmin__deleted") {
                            if (typeof(p[0][glo_p[kindex][0]]) == 'undefined') {
                                if (type == 'con') 
                                  var showvalue = noexist;
                                else {
                                    if (isvaluefilter == 1) 
                                      var showvalue = conpcannotfilter;
                                    else 
                                      var showvalue = conpnoexist;
                                }
                                caldel = 1;
                            } else if (p[0][glo_p[kindex][0]] == false) {
                                var showvalue = valuefail;
                                caldel = 1;
                            } else 
                              var showvalue = p[0][glo_p[kindex][0]];
							  showvalue = htmlspecialchars(showvalue);
							  glo_p[kindex][0]=htmlspecialchars(glo_p[kindex][0]);
                            var strout = "<div class=\"showvalue key_" + $.md5(encodeURI(glo_p[kindex][0])) + "\"><input id=\"hideindex\" name=\"hideindex\" type=\"text\" value=\"" + kindex + "\"/><div class=\"keyandflags\"><div class=\"thekey\"><span class=\"keytit\">KEY : </span><span class=\"keycon\">" + glo_p[kindex][0] + "</span></div><div class=\"theflags\">Flags:　" + p[1][glo_p[kindex][0]] + "</div></div><div class=\"thevalue\"><span class=\"valuespan\">" + showvalue + "</span></div><div class=\"valuemenu\"><div class=\"menulist\"><span class=\"novaluet\">" + novaluetime + "：" + glo_p[kindex][1][1] + "</span><a class=\"showser t_hide\" href=\"javascript:ser('" + $.md5(encodeURI(glo_p[kindex][0])) + "');\">" + sert + "</a><a class=\"showunser\" href=\"javascript:unser('" + $.md5(encodeURI(glo_p[kindex][0])) + "');\">" + unsert + "</a><a class=\"updater\" href=\"javascript:updateres('" + $.md5(encodeURI(glo_p[kindex][0])) + "');\">" + updatetit + "</a>";
                            if (caldel == 0) 
                              strout += "<a class=\"delkey\" href=\"javascript:delkey('" + $.md5(encodeURI(glo_p[kindex][0])) + "');\">" + del + "</a>";
                            else 
                              strout += "<a class=\"delkey\" href=\"javascript:;\">" + del + "</a>";
                            strout += "</div></div></div>";
                            $("#showres").append(strout);
                        }
                    }
                }
                paging();
            }
        });
    } catch(e) {
        alert(pagingerr);
    }
}
function paging() {
    if (pagenum > 1) {
        if (curpage - 5 <= 0) 
          var lpage = 1;
        else 
          var lpage = curpage - 5;
        if (curpage + 5 > pagenum) 
          var rpage = pagenum;
        else
          var rpage = curpage + 5;
        if (curpage == 1) 
          var outstr = "";
        else 
          var outstr = "<a class=\"everypage\" href=\"javascript:showpage(" + (curpage - 1) + ")\">" + prepage + "</a>";
        for (var i = lpage; i <= rpage; i++) {
            if (i == curpage) 
              outstr += "<span id=\"curpage\">" + i + "</span>";
            else 
              outstr += "<a class=\"everypage\" href=\"javascript:showpage(" + i + ")\">" + i + "</a>";
        }
        if (curpage == pagenum) 
          outstr += "";
        else 
          outstr += "<a class=\"everypage\" href=\"javascript:showpage(" + (curpage + 1) + ")\">" + nexpage + "</a>";
        outstr += "<span id=\"showtotalnum\">" + curpage + " / " + pagenum + "</span><input  id=\"inputpage\" name=\"inputpage\" type=\"text\" /><input id=\"gopage\" class=\"but\" name=\"gopage\" type=\"button\" value=\"GO\" onclick=\"go2page();\"/><span id=\"totalitemsnum\">" + thetnum + " ： " + totalnum + "</span>";
        $("#pages").html(outstr);
    } else {
        $("#pages").html("<span id=\"totalitemsnum\">" + thetnum + " ： " + totalnum + "</span>");
    }
}
function go2page() {
    if ($("#inputpage").val() == "") {
        alert(pagenumno);
        return;
    }
    var revalue = /^[1-9]+[0-9]*$/;
    if (!revalue.test($("#inputpage").val())) {
        alert(pagenumno);
        return;
    }
    var thepage = parseInt($("#inputpage").val());
    if (thepage < 1 || thepage > pagenum) {
        alert(pagenumno);
        return;
    }
    showpage(thepage);
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