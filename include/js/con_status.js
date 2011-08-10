$(function() {
    $("#scons").change(function() {
        window.location.href = "memmanager.php?type=" + type + "&num=" + num + "&action=constatus&conid=" + $(this).val();
    });
});