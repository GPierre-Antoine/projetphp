/**
 * Created by g13003750 on 13/01/16.
 */

function addArticle($object) {
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
    var tab = new Array();
    $("#F_blog .actionnable_wr").each(function () {
        tab.push($(this).val());
    });
    xhr.send("array1="+tab[0]+"&array2="+tab[1]+"&array3="+tab[2]+"&array4="+tab[3]);
}