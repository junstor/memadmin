var myLayout;
$(function() {
	if (window.navigator.userAgent.indexOf("Safari") != -1)
		var ww=195;
	else
		ww=200;
	myLayout = $('body').layout({ 
	 	north :{
            slidable:false,
			resizable: false,
			size:25
        },
		west : {
			resizable: false,
			size:ww
		}
	});
	$(".inithover").css('color','#ffffff');
	$("#list").hover(function() {
		myLayout.allowOverflow('north')
		$("#showlist").show();
		$("#dropbut a").css("background-position","0px -19px");
	},function() {
		$("#showlist").hide();
		$("#dropbut a").css("background-position","0px 0px");
	});
	$(".econ").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#curcon").text($(this).find(".conname").text());
		$(".inithover").css('color','#ffffff');
		$(".inithover").css('background','url(images/menu_active_bg.gif) no-repeat');
		type='con';
		num=$(this).find(".hide_num").val();
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type=con&num="+num+"&action=showcon"); 
		$("#showlist").hide();
		$("#dropbut a").css("background-position","0px 0px");
	});
	$(".econp").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#curcon").text($(this).find(".conname").text());
		$(".inithover").css('color','#ffffff');
		$(".inithover").css('background','url(images/menu_active_bg.gif) no-repeat');
		$("#curcon").text($(this).find(".conpname").text());
		type='conp';
		num=$(this).find(".hide_num").val();
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type=conp&num="+num+"&action=showcon");
		$("#showlist").hide();
		$("#dropbut a").css("background-position","0px 0px");
	});
	$("#showcon").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=showcon");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#constat").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=constatus");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#consett").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=consettings");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#conitems").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=conitems");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#consizes").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=consizes");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#conslabs").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=conslabs");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#statsmonitor").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=statsmonitor");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#datamonitor").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=datamonitor");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#hitmonitor").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=hitmonitor");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#memget").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=memget");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#memset").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=memset");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#memcount").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=memcount");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#itemtrav").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=itemtrav");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#filtertrav").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=filtertrav");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#memflush").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/memmanager.php?type="+type+"&num="+num+"&action=memflush");
		$(this).css('background','url(images/menu_active_bg.gif) no-repeat');
		$(this).css('color','#ffffff');
	});
	$("#aboutmem").click(function() {
		$(".but_a").css('background','#f7f6f6');
		$(".but_a").css('color','#0066cc')
		$("#mainframe",parent.document.body).attr("src","views/aboutmem.php");
	});
});