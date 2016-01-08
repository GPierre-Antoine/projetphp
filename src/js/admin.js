$(function () {
    $(".myButton").click(function() {
        var t = this.innerHTML;
        if(t == "Disable") {

            var sql = "UPDATE USERS SET ENABLE = 1 WHERE ID = " + $(this).attr('id');
            this.innerHTML = "Enable";
        }
        else if(t == "Enable") {
            var sql = "UPDATE USERS SET ENABLE = 0 WHERE ID = " + $(this).attr('id');
            this.innerHTML = "Disable";
        }


    });
});