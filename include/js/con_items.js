$(function() {
    $("#slabs").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=conitems&slabid=" + $(this).val();
    });
    $("#conitemsle").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=conitems&conid=" + $(this).val();
    });
    $("#conpslabs").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=conitems&conid=" + getconid + "&slabid=" + $(this).val();
    });
});