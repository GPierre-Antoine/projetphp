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
        else if(t == "Disable") {
            var xhr = getXhr();
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    alert(xhr.responseText);
                }
            }
            xhr.open("POST","/ajx",true);
            xhr.send(null);
        }


    });
});

function getXhr(){
    var xhr = null;
    if(window.XMLHttpRequest) // Firefox et autres
        xhr = new XMLHttpRequest();
    else if(window.ActiveXObject){ // Internet Explorer
        try {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    else { // XMLHttpRequest non supporté par le navigateur
        alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
        xhr = false;
    }
    return xhr
}