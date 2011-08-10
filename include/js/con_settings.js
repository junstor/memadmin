$(function() {
    $("#ssets").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=consettings&consetid=" + $(this).val();
    });
});