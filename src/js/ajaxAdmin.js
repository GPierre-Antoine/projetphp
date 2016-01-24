/**
 * Created by g13003750 on 13/01/16.
 */
function enableOrDisableUser($object) {
    var xhr;
    try {
        xhr = new ActiveXObject('Msxml2.XMLHTTP');
    }
    catch (e) {
        try {
            xhr = new ActiveXObject('Microsoft.XMLHTTP');
        }
        catch (e2) {
            try {
                xhr = new XMLHttpRequest();
            }
            catch (e3) {
                xhr = false;
            }
        }
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                xhr.responseText;
            }
            else {
                alert("probleme");
            }
        }
    };
    xhr.open("POST","/ajx", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("enableOrDisable="+$object.id);
} // enableOrDisableUser()



function deleteUser($object) {
    var xhr2;
    try {
        xhr2 = new ActiveXObject('Msxml2.XMLHTTP');
    }
    catch (e) {
        try {
            xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        }
        catch (e2) {
            try {
                xhr2 = new XMLHttpRequest();
            }
            catch (e3) {
                xhr2 = false;
            }
        }
    }
    xhr2.onreadystatechange = function () {
        if (xhr2.readyState == 4) {
            if (xhr2.status == 200) {
                location.reload();
            }
            else {
                alert("probleme");
            }
        }
    };
    xhr2.open("POST","/ajx", true);
    xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr2.send("enableOrDisable="+$object.id);
} // deleteUser()

function disconnect() {
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'disconnectUser=ok',
            success: function (data) {
                window.location.replace("http://aaron-aaron.alwaysdata.net/");
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                window.location.replace("http://aaron-aaron.alwaysdata.net/");
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('disconnectUser=ok');
    }
} // disconnect()