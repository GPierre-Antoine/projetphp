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

    var newArticle = '<div class="article"> <div class="article_zone_img" > <img class="article_img" src="'+imgurl+'" /></div><div class="article_zone_content" ><span class="article_content_inf"><span class="article_inf_title">'+title+'</span> dans <span class="article_inf_theme">'+theme+'</span></span><br/><p class="article_content">'+content+'</p></div></div>';
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
    var tab = new Array();
    $("#F_categorie .actionnable_lb").each(function () {
        tab.push($(this).val());
    });
    xhr.open("POST","/ajx", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("idUserCategorie=3&nameCategorie="+tab[0]+"&colorCategorie="+tab[1]);

    //AUTO REFRESH THE NEW CATEGORIE
    var title = tab[0];
    var color = tab[1];

    var newCategorie = '<button class="categorie default_block_panel" type="button" style="background-color:'+color+';" value="'+title+'">'+title+'<input class="hide" type="checkbox" name="categorie" value="'+title+'"></button>';
    document.getElementById('categorie_panel').innerHTML += newCategorie;
}

function fluxFavorite($object,$id,$name,$red,$green,$blue) {
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
                if($object.src == "http://aaron-aaron.alwaysdata.net/src/images/favorite_off.png") {
                    $object.src = "http://aaron-aaron.alwaysdata.net/src/images/favorite_on.png";
                    var newFavorite = '<button class="default_block_panel flux" type="button" value="'+$name+'" style="background-color:rgba('+$red+','+$green+','+$blue+',0.5);">'+$name+'</button>';
                    document.getElementById('favorite_panel').innerHTML += newFavorite;
                }
                else {
                    $object.src = "http://aaron-aaron.alwaysdata.net/src/images/favorite_off.png";
                    $("#favorite_panel .flux").each(function () {
                        if($(this).val() === $name) {
                            this.remove();
                        }
                    });
                }
            }
            else {
                alert("probleme");
            }
        }
    };
    xhr.open("POST","/ajx", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("linkImgFavorite="+$object.src+"&idImg="+$id);
}

function switchFluxTo($url) {
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
                var displays =  JSON.parse(xhr.responseText);
                document.getElementById('content_flux').innerHTML = "";
                displays.forEach(function(entry) {
                    document.getElementById('content_flux').innerHTML += entry;
                });
            }
            else {
                alert("probleme");
            }
        }
    };
    xhr.open("POST","/ajx", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("urlFlux="+$url);
}

function addFlux($object) {
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
                alert(xhr.responseText);
            }
            else {
                alert("probleme");
            }
        }
    };
    var tab = new Array();
    $("#F_flux .actionnable_fl").each(function () {
        tab.push($(this).val());
    });
    xhr.open("POST","/ajx", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("nameFluxAdd="+tab[0]+"&categorieFluxAdd"+tab[1]+"&urlFluxAdd"+tab[2]);
}

function inputButton($object) {
    alert('Button was pressed;')
}

function inputCheckbox($object){
    event.stopPropagation();
    alert('Input was pressed;')
}