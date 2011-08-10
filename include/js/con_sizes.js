$(function() {
    $("#conpscons").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=consizes&conid=" + $(this).val();
    });
});