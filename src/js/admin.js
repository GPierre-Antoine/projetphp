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
        else if(t == "Delete") {
            jQuery.ajax({
                type: "POST",
                url: "/ajx",
                dataType: "json",
                success: function(result){
                    if(result.status == "Success"){
                        console.log(result.value) // displays found value on console
                    }
                    else{
                        console.log('Error: No such variable value present')
                    }
                },
                error:function(){
                    console.log("Error: Unknown Error")
                }
            })
        }


    });
});
