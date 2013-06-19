var add_connum = 0;
var connum = 0;
var conpnum = 0;
var con = new Array();
var conp = new Array();
var con_name = new Array();
var conp_name = new Array();
$(function() {
    updateList();
    $("#tree").treeview({
        collapsed: true,
        control: "#sidetreecontrol"
    });
    $("#showm").click(function() {
        if ($("#show_more").css("display") == "none") {
            $("#more_icon").text("▲");
            $("#show_more").show();
        } else {
            $("#more_icon").text("▼");
            $("#show_more").hide();
        }
    });
    $(":radio").click(function() {
        if ($(this).attr("id") == "addcon" && ($(this).attr("checked") == true || $(this).attr("checked") == "checked")) {
            $("#addconpool_m").hide();
            $("#addcon_m").show();
        } else if ($(this).attr("id") == "addcp" && ($(this).attr("checked") == true || $(this).attr("checked") == "checked")) {
            $("#addcon_m").hide();
            $("#addconpool_m").show();
        }
    });
    $("#add_new_con").click(function() {
        var new_o = $("<div class=\"conslist\"><div class=\"cons_tit\">●&nbsp;" + conp_consltit + "：<span class=\"consl_num\">1</span><span class=\"del_con\"><a class=\"del_con_e\" href=\"javascript:;\">" + del + "</a></span></div><div class=\"pcphost\"><p class=\"addcphost\">" + con_host + "：<input class=\"conphost\" name=\"conhost\" type=\"text\" value=\"127.0.0.1\"/><span id=\"conpport\">" + con_port + "：</span><input class=\"conpport\" name=\"conpport\" type=\"text\" value=\"11211\"/></p></div><div class=\"cp_more_but\"><span class=\"cp_more_icon\">▼</span>&nbsp;<a class=\"show_cp_more\" href=\"javascript:;\">" + con_more + "</a></div><div class=\"cp_show_more\"><p class=\"conp_pcon\"><input class=\"chec_pcon\" type=\"checkbox\" name=\"chec_pcon\" checked/>&nbsp;" + conp_pcon + "</p><p class=\"conp_weight\">" + con_weight + "：<input class=\"inp_weight\" name=\"inp_weight\" type=\"text\" value=\"\"/></p><p class=\"conp_stit\">" + con_timeout + "：<input class=\"inp_stit\" name=\"inp_stit\" type=\"text\" value=\"1\"/>&nbsp;" + con_se + "</p><p class=\"conp_retry\">" + con_retry + "：<input class=\"inp_retry\" name=\"inp_stit\" type=\"text\" value=\"15\"/>&nbsp;" + con_se + "</p><p class=\"conp_status\"><input class=\"chec_status\" type=\"checkbox\" name=\"chec_status\" />&nbsp;" + conp_statusfalse + "</p></div><div class=\"cp_line\"></div></div>");
        $("#cons").append(new_o);
        addEvent(); ++add_connum;
        setNum();
    });
    $("#addcon_but").click(function() {
        if ($("#conname").val() == "") {
            alert(no_conname);
            return;
        }
        if ($("#conhost").val() == "") {
            alert(no_host);
            return;
        }
        if ($("#conport").val() == "") {
            alert(no_port);
            return;
        }
        var rehost = /^[A-Za-z0-9_\.\/]+$/;
        var report = /^[1-9]+[0-9]*$/;
        var retimeout = /^[1-9]+[0-9]*$/;
        if (!rehost.test($("#conhost").val())) {
            alert(con_host + " " + con_failhost);
            return;
        }
        if (!report.test($("#conport").val())) {
            alert(con_failport);
            return;
        }
        if (!report.test($("#contimeout").val())) {
            alert(con_failtimeout);
            return;
        }

        if (typeof con_name[$.md5(encodeURI($("#conname").val()))] != 'undefined' && con_name[$.md5(encodeURI($("#conname").val()))] != "") {
            alert(con_havecon);
            return;
        }
        var temp_arr = new Array();
        temp_arr['cname'] = $("#conname").val();
        temp_arr['chost'] = $("#conhost").val();
        temp_arr['cport'] = $("#conport").val();
        if ($("#addpc").attr('checked') == undefined) 
          temp_arr['ispcon'] = 0;
        else 
          temp_arr['ispcon'] = 1;
        temp_arr['timeout'] = $("#contimeout").val();
        var md5 = $.md5(temp_arr['chost'] + "-" + temp_arr['cport'] + "-" + temp_arr['ispcon'] + "-" + temp_arr['timeout']);
        if (typeof con[md5] == 'undefined' || con[md5] == null) {
            con[md5] = new Array();
            con[md5] = temp_arr;
            con_name[$.md5(encodeURI($("#conname").val()))] = 1; ++connum;
            updateList();
            if (temp_arr['ispcon'] == 0) 
              var t_pcon = con_arg_no;
            else 
              var t_pcon = con_arg_yes;
            if (temp_arr['timeout'] == 1) 
              var t_time_default = "(" + con_arg_default + ")";
            else 
              var t_time_default = "";
            $("#call").click();
            var onli = $("<li class=\"closed cont\"><div class=\"hitarea\"></div><input class=\"hide_md5\" name=\"himd\" type=\"text\" value=\"" + md5 + "\"/><span class=\"conc\" title=\"" + con[md5]['cname'] + "&nbsp;&nbsp;(" + con[md5]['chost'] + ":" + con[md5]['cport'] + ")\">" + con[md5]['cname'] + "&nbsp;&nbsp;(" + con[md5]['chost'] + ":" + con[md5]['cport'] + ")</span><div class=\"del_conc\"><a href=\"javascript:;\">" + del + "</a></div><ul><li class=\"closed\"><div class=\"hitarea\"></div><span class=\"file\">" + con_arg + "</span><ul><li><span class=\"showarg\">" + con_host + ":&nbsp;" + con[md5]['chost'] + "</span></li><li><span class=\"showarg\">" + con_port + ":&nbsp;" + con[md5]['cport'] + "</span></li><li><span class=\"showarg\">" + con_arg_pcon + ":&nbsp;" + t_pcon + "</span></li><li><span class=\"showarg\">" + con_arg_timeout + ":&nbsp;" + con[md5]['timeout'] + con_arg_se + t_time_default + "</span></li></ul></li></ul></li>").appendTo("#tree");
            $("#tree").treeview({
                collapsed: true,
                control: "#sidetreecontrol",
                add: onli
            });
        } else {
            alert(con_exist + " (" + con[md5]['cname'] + ")");
            return;
        }
        delEvent();
    });
    $("#listm").hover(function() {
        $("#showconmenu").slideDown(200);
    },
    function() {
        $("#showconmenu").hide();
    });
    $("#clearlist").click(function() {
        if (confirm(con_confirm_clear)) {
            con_name = null;
            conp_name = null;
            con = null;
            con = new Array();
            conp = null;
            conp = new Array();
            con_name = new Array();
            conp_name = new Array();
            connum = 0;
            conpnum = 0;
            $.ajax({
                type: "POST",
                url: "apps/ClearList.php",
                success: function(d) {
                    if (d == 'OK') {
                        alert(con_clearok) 
                        return;
                    } else {
                        alert("Fail: \n" + d);
                        return;
                    }
                }
            });
            updateList();
            $("#save_date").empty();
        } else 
          return;
    });
    $("#addconp_but").click(function() {
        if (add_connum == 0) {
            alert(con_failnoconp);
            return;
        }
        if ($("#conpname").val() == "") {
            alert(con_conpname);
            return;
        }
        if (typeof conp_name[$.md5(encodeURI($("#conpname").val()))] != 'undefined' && conp_name[$.md5(encodeURI($("#conpname").val()))] != "") {
            alert(con_haveconp);
            return;
        }
        var temp_arrp = new Array();
        temp_arrp['conpname'] = $("#conpname").val();
        var rehost = /^[A-Za-z0-9_\.\/]+$/;
        var report = /^[1-9]+[0-9]*$/;
        var retimeout = /^[1-9]+[0-9]*$/;
        var reweight = /^[0-9]*$/;
        var n = 0;
        var fail = 0;
        var fail_info = new Array();
        temp_arrp['cons'] = new Array();
        $(".conslist").each(function() {
            temp_arrp['cons'][n] = new Array();
            if (!rehost.test($(this).find('.conphost').val())) {
                fail_info.push(conp_consltit + (n + 1) + " " + con_host + " " + con_failhost);
                fail = 1;
            }
            if (fail == 0) 
              temp_arrp['cons'][n]['host'] = $(this).find('.conphost').val();
            if (!report.test($(this).find('.conpport').val())) {
                fail_info.push(conp_consltit + (n + 1) + " " + con_failport);
                fail = 1;
            }
            if (fail == 0) {
                temp_arrp['cons'][n]['port'] = $(this).find('.conpport').val();
                if ($(this).find(".chec_pcon").attr('checked') == undefined)
                  temp_arrp['cons'][n]['pcon'] = 0;
                else 
                  temp_arrp['cons'][n]['pcon'] = 1;
                if ($(this).find(".chec_status").attr('checked') == undefined) 
                  temp_arrp['cons'][n]['status_fail'] = 0;
                else 
                  temp_arrp['cons'][n]['status_fail'] = 1;
            }
            if (!reweight.test($(this).find('.inp_weight').val())) {
                fail_info.push(conp_consltit + (n + 1) + " " + con_failweight);
                fail = 1;
            }
            if (fail == 0) 
              temp_arrp['cons'][n]['weight'] = $(this).find('.conp_weight').val();
            if (!retimeout.test($(this).find('.inp_stit').val())) {
                fail_info.push(conp_consltit + (n + 1) + " " + con_failtimeout);
                fail = 1;
            }
            if (fail == 0) 
              temp_arrp['cons'][n]['timeout'] = $(this).find('.inp_stit').val();
            if (!retimeout.test($(this).find('.inp_retry').val()) && $(this).find('.inp_retry').val() != '-1') {
                fail_info.push(conp_consltit + (n + 1) + " " + con_failretry);
                fail = 1;
            }
            if (fail == 0) 
              temp_arrp['cons'][n]['retry'] = $(this).find('.inp_retry').val(); ++n;
        });
        if (fail == 1) {
            var finfo = "";
            $.each(fail_info,
            function(n, v) {
                finfo += v + "\n";
            });
            alert(finfo);
            n = 0;
            fail = 0;
            return;
        } else {
            var set_md5_str = n;
            for (var i = 0; i < n; i++) {
                set_md5_str += "-" + temp_arrp['cons'][i]['host'] + "-" + temp_arrp['cons'][i]['port'] + "-" + temp_arrp['cons'][i]['pcon'] + "-" + temp_arrp['cons'][i]['status_fail'] + "-" + temp_arrp['cons'][i]['weight'] + "-" + temp_arrp['cons'][i]['timeout'] + "-" + temp_arrp['cons'][i]['retry'];
            }
            var md5 = $.md5(set_md5_str);
            if (typeof conp[md5] == 'undefined' || conp[md5] == null) {
                temp_arrp['num'] = n;
                conp[md5] = new Array();
                conp[md5] = temp_arrp;
                conp_name[$.md5(encodeURI($("#conpname").val()))] = 1;

                $("#call").click();
                var onli = "<li class=\"closed conpt\"><div class=\"hitarea\"></div><input class=\"hide_md5\" name=\"himd\" type=\"text\" value=\"" + md5 + "\"/><span class=\"folder\" title=\"" + conp[md5]['conpname'] + "\">" + conp[md5]['conpname'] + "</span><div class=\"del_concp\"><a href=\"javascript:;\">" + del + "</a></div><ul>";
                for (var j = 0; j < n; j++) {
                    if (conp[md5]['cons'][j]['pcon'] == 0) 
                      var ispcon = con_arg_no;
                    else 
                      var ispcon = con_arg_yes + "(" + con_arg_default + ")";
                    if (conp[md5]['cons'][j]['status_fail'] == 0) 
                      var status = "TRUE" + "(" + con_arg_default + ")";
                    else 
                      var status = "FALSE";
                    if (conp[md5]['cons'][j]['weight'] == "") 
                      var isconweight = conp_noweight;
                    else 
                      var isconweight = conp[md5]['cons'][j]['weight'];
                    if (conp[md5]['cons'][j]['timeout'] == 1) 
                      var ctimeout = conp[md5]['cons'][j]['timeout'] + con_arg_se + "(" + con_arg_default + ")";
                    else 
                      var ctimeout = conp[md5]['cons'][j]['timeout'] + con_arg_se;
                    if (conp[md5]['cons'][j]['retry'] == 15) 
                      var cretry = conp[md5]['cons'][j]['retry'] + con_arg_se + "(" + con_arg_default + ")";
                    else 
                      var cretry = conp[md5]['cons'][j]['retry'] + con_arg_se;
                    onli += "<li class=\"closed\"><div class=\"hitarea closed-hitarea cont-hitarea expandable-hitarea lastExpandable-hitarea\"></div><span class=\"conc\">" + conp[md5]['cons'][j]['host'] + ":" + conp[md5]['cons'][j]['port'] + "</span><ul><li class=\"closed\"><div class=\"hitarea closed-hitarea cont-hitarea expandable-hitarea lastExpandable-hitarea\"></div><span class=\"file\">" + con_arg + "</span><ul><li><span class=\"showcparg\">" + con_host + ":&nbsp;" + conp[md5]['cons'][j]['host'] + "</span></li>	<li><span class=\"showcparg\">" + con_port + ":&nbsp;" + conp[md5]['cons'][j]['port'] + "</span></li><li><span class=\"showcparg\">" + con_arg_pcon + ":&nbsp;" + ispcon + "</span></li><li><span class=\"showcparg\">" + con_weight + ":&nbsp;" + isconweight + "</span></li><li><span class=\"showcparg\">" + con_arg_timeout + ":&nbsp;" + ctimeout + "</span></li><li><span class=\"showcparg\">" + con_failretry + ":&nbsp;" + cretry + "</span></li><li><span class=\"showcparg\">" + conp_status + ":&nbsp;" + status + "</span></li></ul></li></ul></li>";
                }
                onli += "</ul></li>";
                $("#tree").append(onli);
                $("#tree").treeview({
                    collapsed: true,
                    control: "#sidetreecontrol",
                    add: onli
                });
                ++conpnum;
                updateList();
                add_connum = 0;
                n = 0;
                fail = 0;
                $("#cons").empty();
                addconpdelEvent();
            } else {
                alert(con_exist_conp + " (" + conp[md5]['conpname'] + ")");
                n = 0;
                fail = 0;
                return;
            }
        }
    });
    $("#call").click(function() {
        $("#tc1").click();
        TreeBug();
    });
    $("#eall").click(function() {
        $("#tc2").click();
        TreeBug();
    });
    $("#loadlist").click(function() {
        if (confirm(con_loadnotice)) {
            json2data('apps/GetList.php');
            savelisttime();
        }
    });
    $("#savelist").click(function() {
        if (connum == 0 && conpnum == 0) {
            alert(con_nolist);
            return;
        } else {
            $.ajax({
                type: "POST",
                url: "apps/SaveList.php",
                data: data2json(),
                success: function(d) {
                    if (d == 'OK') {
                        alert(con_saveok);
                        savelisttime();
                        return;
                    } else {
                        alert("Fail: \n" + d);
                        return;
                    }
                }
            });
        }
    });
    $("#gonextbut").click(function() {
        if (connum == 0 && conpnum == 0) {
            alert(con_nolist);
            return;
        } else {
            $.ajax({
                type: "POST",
                url: "apps/SetListSession.php",
                data: data2json(),
                success: function(d) {
                    if (d != 'OK') {
                        alert("Fail: \n" + d);
                        return;
                    } else {
                        window.location.href = "index.php?action=admin";
                    }
                }
            });
        }
    });
});
function setNum() {
    var num = 0;
    $(".consl_num").each(function() {++num;
        $(this).text(num);
    });
}
function updateList() {
    if (connum == 0 && conpnum == 0) {
        $("#tree").empty();
        $("#no_tree").html("<div id=\"nolist\"><ul id=\"tree1\" class=\"filetree\"><li>" + con_no_list + "</li></ul></div>");
        $("#tree1").treeview({
            collapsed: true,
            control: "#sidetreecontrol"
        });
    } else {
        $("#nolist").remove();
    }
}
function addEvent() {
    $(".cp_more_but").unbind("click");
    $(".cp_more_but").click(function() {
        if ($(this).next().css("display") == "none") {
            $(this).find(".cp_more_icon").text("▲");
            $(this).next().show();
        } else {
            $(this).find(".cp_more_icon").text("▼");
            $(this).next().hide();
        }
    });
    $(".del_con_e").unbind("click");
    $(".del_con_e").click(function() {
        $(this).parent().parent().parent().remove(); --add_connum;
        setNum();
    });
}
function delEvent() {
    $(".del_conc").unbind("click");
    $(".del_conc").click(function() {
        if (confirm(con_confirm)) {
            var hide_md5 = $(this).parent().find(".hide_md5").val();
            con_name[$.md5(encodeURI(con[hide_md5]['cname']))] = "";
            con[hide_md5] = null;
            $(this).parent().remove(); 
            --connum;
            updateList();
        } else 
          return;
    });
}
function addconpdelEvent() {
    $(".del_concp").unbind("click");
    $(".del_concp").click(function() {
        if (confirm(con_confirm)) {
            var hide_md5 = $(this).parent().find(".hide_md5").val();
            conp_name[$.md5(encodeURI(conp[hide_md5]['conpname']))] = "";
            conp[hide_md5] = null;
            $(this).parent().remove(); 
            --conpnum;
            updateList();
        } else return;
    });
}
function TreeBug() {
    $("li.expandable").find("ul").hide();
}
function data2json() {
    //构造con数组
    var con_Arr = new Array();
    $(".cont .hide_md5").each(function() {
        var temp_str = "{'name':'" + con[$(this).val()]['cname'] + "','host':'" + con[$(this).val()]['chost'] + "','port':'" + con[$(this).val()]['cport'] + "','ispcon':'" + con[$(this).val()]['ispcon'] + "','timeout':'" + con[$(this).val()]['timeout'] + "'}";
        con_Arr.push(temp_str);
    });
    //构造conp数组
    var conp_Arr = new Array();
    $(".conpt .hide_md5").each(function() {
        var conp_str = "{'name':'" + conp[$(this).val()]['conpname'] + "','num':'" + conp[$(this).val()]['num'] + "','conlist':[";
        var temp_conl = new Array();
        for (var i = 0; i < conp[$(this).val()]['num']; i++) {
            var temp_str = "{'host':'" + conp[$(this).val()]['cons'][i]['host'] + "','port':'" + conp[$(this).val()]['cons'][i]['port'] + "','pcon':'" + conp[$(this).val()]['cons'][i]['pcon'] + "','status':'" + conp[$(this).val()]['cons'][i]['status_fail'] + "','weight':'" + conp[$(this).val()]['cons'][i]['weight'] + "','timeout':'" + conp[$(this).val()]['cons'][i]['timeout'] + "','retry':'" + conp[$(this).val()]['cons'][i]['retry'] + "'}";
            temp_conl.push(temp_str);
        }
        conp_str += temp_conl.join(",") + "]}";
        conp_Arr.push(conp_str);
    });
    //构造json字符串
    var json_str = "{'data':[{'con':[{'num':'" + connum + "','cons':[";
    json_str += con_Arr.join(",") + "]}]},{'conp':[{'num':'" + conpnum + "','conps':[";
    json_str += conp_Arr.join(",") + "]}]}]}";
    var p = eval("(" + json_str + ")");
    return p;
}
function json2data(url) {
    var temptime = (new Date()).getTime();
    $.ajax({
        url: url + "?cache=" + temptime,
        dateType: "json",
        success: function(d) {
            if (d == 'nolist') 
              return;
            else {
                con_name = null;
                conp_name = null;
                con = null;
                con = new Array();
                conp = null;
                conp = new Array();
                con_name = new Array();
                conp_name = new Array();
                connum = 0;
                conpnum = 0;
                updateList();
                var p = eval("(" + d + ")");
                //重置con相关数据
                for (var i = 0; i < p[0]['con'][0]['num']; i++) {
                    var conname_md5 = $.md5(encodeURI(p[0]['con'][0]['cons'][i].name));
                    var condata_md5 = $.md5(p[0]['con'][0]['cons'][i].host + "-" + p[0]['con'][0]['cons'][i].port + "-" + p[0]['con'][0]['cons'][i].ispcon + "-" + p[0]['con'][0]['cons'][i].timeout);
                    con_name[conname_md5] = 1;
                    con[condata_md5] = new Array();
                    con[condata_md5]['cname'] = p[0]['con'][0]['cons'][i].name;
                    con[condata_md5]['chost'] = p[0]['con'][0]['cons'][i].host;
                    con[condata_md5]['cport'] = p[0]['con'][0]['cons'][i].port;
                    con[condata_md5]['ispcon'] = p[0]['con'][0]['cons'][i].ispcon;
                    con[condata_md5]['timeout'] = p[0]['con'][0]['cons'][i].timeout; ++connum;
                    if (con[condata_md5]['ispcon'] == 0) 
                      var t_pcon = con_arg_no;
                    else 
                      var t_pcon = con_arg_yes;
                    if (con[condata_md5]['timeout'] == 1) 
                      var t_time_default = "(" + con_arg_default + ")";
                    else 
                      var t_time_default = "";
                    //更新列表
                    $("#call").click();
                    var onli = $("<li class=\"closed cont\"><div class=\"hitarea\"></div><input class=\"hide_md5\" name=\"himd\" type=\"text\" value=\"" + condata_md5 + "\"/><span class=\"conc\" title=\"" + con[condata_md5]['cname'] + "&nbsp;&nbsp;(" + con[condata_md5]['chost'] + ":" + con[condata_md5]['cport'] + ")\">" + con[condata_md5]['cname'] + "&nbsp;&nbsp;(" + con[condata_md5]['chost'] + ":" + con[condata_md5]['cport'] + ")</span><div class=\"del_conc\"><a href=\"javascript:;\">" + del + "</a></div><ul><li class=\"closed\"><div class=\"hitarea\"></div><span class=\"file\">" + con_arg + "</span><ul><li><span class=\"showarg\">" + con_host + ":&nbsp;" + con[condata_md5]['chost'] + "</span></li><li><span class=\"showarg\">" + con_port + ":&nbsp;" + con[condata_md5]['cport'] + "</span></li><li><span class=\"showarg\">" + con_arg_pcon + ":&nbsp;" + t_pcon + "</span></li><li><span class=\"showarg\">" + con_arg_timeout + ":&nbsp;" + con[condata_md5]['timeout'] + con_arg_se + t_time_default + "</span></li></ul></li></ul></li>").appendTo("#tree");

                    $("#tree").treeview({
                        collapsed: true,
                        control: "#sidetreecontrol",
                        add: onli
                    });
                    delEvent();
                }
                //重置conp相关数据
                for (var i = 0; i < p[1]['conp'][0]['num']; i++) {
                    var conpname_md5 = $.md5(encodeURI(p[1]['conp'][0]['conps'][i].name));
                    var temp_md5_str = p[1]['conp'][0]['conps'][i].num;
                    for (var j = 0; j < p[1]['conp'][0]['conps'][i].num; j++) {
                        temp_md5_str += "-" + p[1]['conp'][0]['conps'][i]['conlist'][j].host + "-" + p[1]['conp'][0]['conps'][i]['conlist'][j].port + "-" + p[1]['conp'][0]['conps'][i]['conlist'][j].pcon + "-" + p[1]['conp'][0]['conps'][i]['conlist'][j].status + "-" + p[1]['conp'][0]['conps'][i]['conlist'][j].weight + "-" + p[1]['conp'][0]['conps'][i]['conlist'][j].timeout + "-" + p[1]['conp'][0]['conps'][i]['conlist'][j].retry;
                    }
                    var conpdata_md5 = $.md5(temp_md5_str);
                    conp_name[conpname_md5] = 1;
                    conp[conpdata_md5] = new Array();
                    conp[conpdata_md5]['conpname'] = p[1]['conp'][0]['conps'][i].name;
                    conp[conpdata_md5]['num'] = p[1]['conp'][0]['conps'][i].num;
                    conp[conpdata_md5]['cons'] = new Array();
                    for (var j = 0; j < p[1]['conp'][0]['conps'][i].num; j++) {
                        conp[conpdata_md5]['cons'][j] = new Array();
                        conp[conpdata_md5]['cons'][j]['host'] = p[1]['conp'][0]['conps'][i]['conlist'][j].host;
                        conp[conpdata_md5]['cons'][j]['port'] = p[1]['conp'][0]['conps'][i]['conlist'][j].port;
                        conp[conpdata_md5]['cons'][j]['pcon'] = p[1]['conp'][0]['conps'][i]['conlist'][j].pcon;
                        conp[conpdata_md5]['cons'][j]['status_fail'] = p[1]['conp'][0]['conps'][i]['conlist'][j].status;
                        conp[conpdata_md5]['cons'][j]['weight'] = p[1]['conp'][0]['conps'][i]['conlist'][j].weight;
                        conp[conpdata_md5]['cons'][j]['timeout'] = p[1]['conp'][0]['conps'][i]['conlist'][j].timeout;
                        conp[conpdata_md5]['cons'][j]['retry'] = p[1]['conp'][0]['conps'][i]['conlist'][j].retry;
                    }
                    ++conpnum;
                    //更新列表
                    $("#call").click();
                    var onli = "<li class=\"closed conpt\"><div class=\"hitarea\"></div><input class=\"hide_md5\" name=\"himd\" type=\"text\" value=\"" + conpdata_md5 + "\"/><span class=\"folder\" title=\"" + conp[conpdata_md5]['conpname'] + "\">" + conp[conpdata_md5]['conpname'] + "</span><div class=\"del_concp\"><a href=\"javascript:;\">" + del + "</a></div><ul>";
                    for (var j = 0; j < p[1]['conp'][0]['conps'][i].num; j++) {
                        if (conp[conpdata_md5]['cons'][j]['pcon'] == 0) 
                          var ispcon = con_arg_no;
                        else 
                          var ispcon = con_arg_yes + "(" + con_arg_default + ")";
                        if (conp[conpdata_md5]['cons'][j]['status_fail'] == 0) 
                          var status = "TRUE" + "(" + con_arg_default + ")";
                        else 
                          var status = "FALSE";
                        if (conp[conpdata_md5]['cons'][j]['weight'] == "") 
                          var isconweight = conp_noweight;
                        else 
                          var isconweight = conp[conpdata_md5]['cons'][j]['weight'];
                        if (conp[conpdata_md5]['cons'][j]['timeout'] == 1) 
                          var ctimeout = conp[conpdata_md5]['cons'][j]['timeout'] + con_arg_se + "(" + con_arg_default + ")";
                        else 
                          var ctimeout = conp[conpdata_md5]['cons'][j]['timeout'] + con_arg_se;
                        if (conp[conpdata_md5]['cons'][j]['retry'] == 15) 
                          var cretry = conp[conpdata_md5]['cons'][j]['retry'] + con_arg_se + "(" + con_arg_default + ")";
                        else 
                          var cretry = conp[conpdata_md5]['cons'][j]['retry'] + con_arg_se;
                        onli += "<li class=\"closed\"><div class=\"hitarea closed-hitarea cont-hitarea expandable-hitarea lastExpandable-hitarea\"></div><span class=\"conc\">" + conp[conpdata_md5]['cons'][j]['host'] + ":" + conp[conpdata_md5]['cons'][j]['port'] + "</span><ul><li class=\"closed\"><div class=\"hitarea closed-hitarea cont-hitarea expandable-hitarea lastExpandable-hitarea\"></div><span class=\"file\">" + con_arg + "</span><ul><li><span class=\"showcparg\">" + con_host + ":&nbsp;" + conp[conpdata_md5]['cons'][j]['host'] + "</span></li><li><span class=\"showcparg\">" + con_port + ":&nbsp;" + conp[conpdata_md5]['cons'][j]['port'] + "</span></li><li><span class=\"showcparg\">" + con_arg_pcon + ":&nbsp;" + ispcon + "</span></li><li><span class=\"showcparg\">" + con_weight + ":&nbsp;" + isconweight + "</span></li><li><span class=\"showcparg\">" + con_arg_timeout + ":&nbsp;" + ctimeout + "</span></li><li><span class=\"showcparg\">" + con_failretry + ":&nbsp;" + cretry + "</span></li><li><span class=\"showcparg\">" + conp_status + ":&nbsp;" + status + "</span></li></ul></li></ul></li>";
                    }
                    onli += "</ul></li>";
                    $("#tree").append(onli);
                    $("#tree").treeview({
                        collapsed: true,
                        control: "#sidetreecontrol",
                        add: onli
                    });
                    addconpdelEvent();
                }
                updateList();
            }
        }
    });
}
function savelisttime() {
    var temptime = (new Date()).getTime();
    $.ajax({
        type: "POST",
        url: "apps/GetListTime.php?cache=" + temptime,
        success: function(d) {
            if (d == 'notime') {
                return;
            } else {
                $("#save_date").text(con_listsavetime + "：" + d);
                if (window.navigator.userAgent.indexOf("Safari") != -1) // for chrome/safari
                  $("#save_date").css('margin-top', '-25px');
                return;
            }
        }
    });
}
function hidelisttime() {
    $("#save_date").empty();
}
