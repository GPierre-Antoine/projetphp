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

    //AUTO REFRESH THE NEW ARTICLE
    var title = tab[0];
    var theme = tab[1];
    var imgurl = tab[2];
    var content = tab[3];

    var newArticle = '<div class="article"> <div class="article_zone_img" > <img class="article_img" src="'+imgurl+'" /></div><div class="article_zone_content" ><span class="article_content_inf"><span class="article_inf_title">'+title+'</span> dans <span class="article_inf_theme">'+theme+'</span></span><br/><p class="article_content">'+content+'</p></div></div>'
    document.getElementById('content_blog').innerHTML += newArticle;
}

function addCategorie($object) {
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
    xhr.send("array1="+tab[0]+"&array2="+tab[1]+"&array3="+tab[2]+"&array4="+tab[3]);

}