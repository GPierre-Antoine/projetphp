/**
 * Created by g13003750 on 13/01/16.
 */

//////////////////////////////ADD//////////////////////////////
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
    xhr.send("titreArticle="+tab[0]+"&themeArticle="+tab[1]+"&urlImgArticle="+tab[2]+"&contentArticle="+tab[3]);

    //AUTO REFRESH THE NEW ARTICLE
    var title = tab[0];
    var theme = tab[1];
    var imgurl = tab[2];
    var content = tab[3];

    var newArticle = '<div class="article"> <div class="article_zone_img" > <img class="article_img" src="'+imgurl+'" /></div><div class="article_zone_content" ><span class="article_content_inf"><span class="article_inf_title">'+title+'</span> dans <span class="article_inf_theme">'+theme+'</span></span><br/><p class="article_content">'+content+'</p></div></div>';
    document.getElementById('content_blog').innerHTML += newArticle;
} // addArticle()

function addCategory($object) {
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
                location.reload();
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
} // addCategory()

function addRSSFeedCategoryUser($object) {
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
    xhr.send("nameFluxAdd="+tab[0]+"&nameCategorieToAdd="+tab[1]+"&urlFluxAdd="+tab[2]);
}// addRSSFeedCategoryUser()

function addFriend($idFriend) {
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
    xhr.open("POST","/ajx", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("userToAddInFriend="+$idFriend);
} // addFriend()
/////////////////////////////~ADD//////////////////////////////

/////////////////////////////FLUX//////////////////////////////
function changeFavoriteRSSFeed($object,$idRSSFeed,$name,$red,$green,$blue) {
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
    xhr.send("linkImgFavorite="+$object.src+"&idRSSFeed="+$idRSSFeed);
} // fluxFavorite()

function focusToThisRSSFeed($url) {
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
    xhr.send("urlToFocus="+$url);
} // focusToThisRSSFeed()
////////////////////////////~FLUX//////////////////////////////

/////////////////////////FRIEND/////////////////////////
function searchUser($object) {
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
                $("#researchResult").removeClass("hide");
                document.getElementById('researchResult').innerHTML = "";
                for(i = 0 ; i < displays.length ; i += 3) {
                    var elm = '<div class="researchResult_friend"><img class="researchResult_friend_img" src="'+displays[i+2]+'">';
                    elm += '<span class="researchResult_friend_name">'+displays[i+1]+'</span>';
                    elm += '<button id="researchResult_friend_add" onclick="addFriend('+displays[i]+')" type="button">Ajouter</button></div>';
                    document.getElementById('researchResult').innerHTML += elm;
                }
            }
            else {
                alert("probleme");
            }
        }
    };
    xhr.open("POST","/ajx", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("userToFind="+$("#F_friend .actionnable_fr").val());
} // searchUser()
/////////////////////////~FRIEND/////////////////////////

////////////////////////OPTIONS IN MENU////////////////////////
function deleteCategorie($idCatDelete,$nameCatDelete) {
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
                //location.reload();
            }
            else {
                alert("probleme");
            }
        }
    };
    var idCateToDelete = $nameCatDelete+"_panel";
    var tab = new Array();
    $("#"+idCateToDelete+" .flux").each(function () {
        tab.push($(this).val());
    });
    if(tab.length != 0) {
        $("#overlay_warning").css({"display":"block", opacity:0});
        $("#overlay_warning").fadeTo(200,0.5);
        $("#popup_warning").fadeTo(200,1);
        //Affichage la zone ou tu vas écrire
        $(".warning_zone_categorie").removeClass("hide");
        $(".warning_zone_categorie").innerHTML = "";
        for (i = 0; i < tab.length; i++) {
            $(".warning_zone_categorie").innerHTML += " test: " +tab[i];
        }
    } // If RSS Feed in my category
    else {
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("catToDelete=" + $idCatDelete);
    } // Else no RSS Feed in my category
} // deleteCategorie()


function inputCheckbox(){
    event.stopPropagation();
} // inputCheckbox()

function deleteCategorieRSSFeedIn() {
    //AFFICHE LA POP-UP

}

///////////////////////~OPTIONS IN MENU////////////////////////

