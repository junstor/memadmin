$(function() {
    $("#slabs").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=conslabs&slabid=" + $(this).val();
    });
    $("#conitemselect").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=conslabs&conid=" + $(this).val();
    });
    $("#conpslabs").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=conslabs&conid=" + getconid + "&slabid=" + $(this).val();
    });
});