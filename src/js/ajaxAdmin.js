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
                alert(xhr2.responseText);
                document.getElementById($object.parentNode.parentNode.id).remove();
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