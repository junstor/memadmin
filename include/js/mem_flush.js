$(function() {
    $("#flushbut").click(function() {
        if (confirm(flushconfirm)) {
            $.ajax({
                type: "GET",
                url: "../apps/MemFlush.php?type=" + type + "&num=" + num,
                success: function(d) {
                    if (d == 'Fail' || d == 'NoLogin' || d == 'ConnectFail') {
                        alert(d);
                        return;
                    } else if (d == 'FlushOK') {
                        alert(flushok);
                    }
                }
            });
        }
    });
});