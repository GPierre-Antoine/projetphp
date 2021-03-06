/**
 * Created by g13003750 on 13/01/16.
 */

function closePopUpAddArticle(overlay,popup) {
    $(overlay).fadeOut(200);
    $(popup).css("display", "none");
} // closePopUpAddArticle()

////////////////////////////////////////////////////////////////////////////////FOR A USER/////////////////////////////////////////////////////////////////////////////
function searchUser($object) {
    if (navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'userToFind=' + $("#F_friend .actionnable_fr").val(),
            dataType: 'html',
            success: function (data) {
                document.getElementById('researchResult').innerHTML = "";
                document.querySelector('.friend_information').innerHTML = "";
                if(data === "false") {
                    document.querySelector('.friend_information').innerHTML = "Vous avez déjà cet utilisateur en ami ou cet utilisateur n'existe pas";
                }
                else {
                    var displays = JSON.parse(data);
                    if(displays.length == 0) {
                        document.querySelector('.friend_information').innerHTML = "Vous avez déjà cet utilisateur en ami ou cet utilisateur n'existe pas";
                    }
                    else {
                        $("#researchResult").removeClass("hide");
                        document.getElementById('researchResult').innerHTML = "";
                        for (i = 0; i < displays.length; i += 3) {
                            var elm = '<div class="researchResult_friend"><img class="researchResult_friend_img" src="' + displays[i + 2] + '">';
                            elm += '<span class="researchResult_friend_name">' + displays[i + 1] + '</span>';
                            elm += '<button id="researchResult_friend_add" class="noborder" onclick="addFriend(' + displays[i] + ')" type="button">Ajouter</button></div>';
                            document.getElementById('researchResult').innerHTML += elm;
                        }
                    }
                }
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                document.getElementById('researchResult').innerHTML = "";
                document.querySelector('.friend_information').innerHTML = "";
                if(xhr.responseText === "false") {
                    document.querySelector('.friend_information').innerHTML = "Vous avez déjà cet utilisateur en ami ou cet utilisateur n'existe pas";
                }
                else {
                    var displays = JSON.parse(xhr.responseText);
                    if(displays.length == 0) {
                        document.querySelector('.friend_information').innerHTML = "Vous avez déjà cet utilisateur en ami ou cet utilisateur n'existe pas";
                    }
                    else {
                        $("#researchResult").removeClass("hide");
                        document.getElementById('researchResult').innerHTML = "";
                        for (i = 0; i < displays.length; i += 3) {
                            var elm = '<div class="researchResult_friend"><img class="researchResult_friend_img" src="' + displays[i + 2] + '">';
                            elm += '<span class="researchResult_friend_name">' + displays[i + 1] + '</span>';
                            elm += '<button id="researchResult_friend_add" class="noborder" onclick="addFriend(' + displays[i] + ')" type="button">Ajouter</button></div>';
                            document.getElementById('researchResult').innerHTML += elm;
                        }
                    }
                }
            }
        };

        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('userToFind=' + $("#F_friend .actionnable_fr").val());
    }
} // searchUser()

//////////////////////////////////////////////////////////////////////////////////ARTICLE///////////////////////////////////////////////////////////////////////////////
function addArticle($object) {

    var url = document.getElementById('F_blog').childNodes[4].value;
    var tab = new Array();
    $("#F_blog .actionnable_wr").each(function () {
        tab.push($(this).val());
    });
    if (navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'imgToTest=' + url,
            dataType: 'html',
            success: function (data) {
                if(data === "false") {
                    document.getElementById('F_blog').childNodes[4].value = "";
                    document.getElementById('F_blog').childNodes[4].placeholder = "Lien invalide";
                }
                else
                    continueArticle($object, tab, data);
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                if (xhr.responseText === "false") {
                    document.getElementById('F_blog').childNodes[4].value = "";
                    document.getElementById('F_blog').childNodes[4].placeholder = "Lien invalide";
                }
                else
                    continueArticle($object, tab, xhr.responseText);
            }

        };

        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('imgToTest=' + url);
    }
}

function continueArticle($object,tab,$value) {
    if(!tab[0].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\' ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/) ||
        !tab[1].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\' ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/) ||
        $value != "true" ||
        !tab[3].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\' ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
        if(!tab[0].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
            document.getElementById('F_blog').childNodes[1].value = "";
            document.getElementById('F_blog').childNodes[1].placeholder = "Mauvaise syntaxe (2 carac mini.)";
        }
        if(!tab[1].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
            document.getElementById('F_blog').childNodes[2].value = "";
            document.getElementById('F_blog').childNodes[2].placeholder = "Mauvaise syntaxe (2 carac mini.)";
        }
        if($value != "true") {
            document.getElementById('F_blog').childNodes[4].value = "";
            document.getElementById('F_blog').childNodes[4].placeholder = "Lien invalide";
        }

        if(!tab[3].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
            document.getElementById('F_blog').childNodes[6].value = "";
            document.getElementById('F_blog').childNodes[6].placeholder = "Commentaire mal rédigé";
        }
    }
    else {
        if (navigator.userAgent.indexOf("Chrome") != -1) {
            $.ajax({
                url: '/ajx',
                type: 'POST',
                data: 'titreArticle=' + tab[0] + '&themeArticle=' + tab[1] + '&urlImgArticle=' + tab[2] + '&contentArticle=' + tab[3],
                dataType: 'html',
                success: function (data) {
                    closePopUpAddArticle("#overlay_blog", ".popup_blog");
                    location.reload();
                    //Faire un cookie avec une action et du coup dans default view gérer le cookie
                }
            });
        }
        else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    closePopUpAddArticle("#overlay_blog", ".popup_blog");
                    location.reload();
                }

            };

            xhr.open("POST", "/ajx", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('titreArticle=' + tab[0] + '&themeArticle=' + tab[1] + '&urlImgArticle=' + tab[2] + '&contentArticle=' + tab[3]);
        }
    }
} // continueArticle()

function deleteArticle($id) {
    if (navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'idArticleDelete='+$id,
            dataType: 'html',
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };

        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('idArticleDelete='+$id);
    }

}

/////////////////////////////////////////////////////////////////////////////////~ARTICLE///////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////RSS/////////////////////////////////////////////////////////////////////////////////
function changeFavoriteRSSFeed($object,$idRSSFeed,$idCategory,$name,$red,$green,$blue) {
    if (navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'linkImgFavorite=' + $object.src + '&idRSSFeed=' + $idRSSFeed + '&idCategory=' + $idCategory,
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };

        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('linkImgFavorite=' + $object.src + '&idRSSFeed=' + $idRSSFeed + '&idCategory=' + $idCategory);

    }

} // fluxFavorite()

function focusToThisRSSFeed($url) {
    if (navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'urlToFocus=' + $url,
            success: function (data) {
                var displays = JSON.parse(data);
                document.getElementById('content_flux').innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById('content_flux').innerHTML += entry;
                });
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var displays = JSON.parse(xhr.responseText);
                document.getElementById('content_flux').innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById('content_flux').innerHTML += entry;
                });
            }

        };

        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('urlToFocus=' + $url);
    }
} // focusToThisRSSFeed()

function deleteFlux($idRSSFeed,$idCategory) {
    if (navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'idRSSFeedToDeleteOfACategory=' + $idRSSFeed + '&idCategory=' + $idCategory,
            dataType: 'html',
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('idRSSFeedToDeleteOfACategory=' + $idRSSFeed + '&idCategory=' + $idCategory);
    }
} // deleteFlux()

//CONTINUE HERE

function addRSSFeedCategoryUser($object) {

    var tab = new Array();
    $("#F_flux .actionnable_fl").each(function () {
        tab.push($(this).val());
    });

    var tabCategory = new Array();
    $("#categorie_panel .default_block_panel").each(function () {
        tabCategory.push($(this).val());
    });

    $temp1 = "false";
    $temp2 = "false";

    for($i = 0 ; $i < tabCategory.length ; ++$i) {
        if(tabCategory[$i] === tab[1]) {
            $temp1 = tabCategory[$i];
        }
    }

    var tabCategoryRSSIn = new Array();
    $("#"+$temp1+"_panel .flux").each(function () {
        tabCategoryRSSIn.push($(this).val());
    });

    for($i = 0 ; $i < tabCategoryRSSIn.length ; ++$i) {
        if(tabCategoryRSSIn[$i] === tab[0]) {
            $temp2 = tabCategory[$i];
        }
    }

    if(!tab[0].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
        $temp1 = "false";
    }

    if($temp1 !== "false" && $temp2 === "false") {
        document.querySelector('.flux_information').innerHTML = "Analyse du flux RSS ...";
        if (navigator.userAgent.indexOf("Chrome") != -1) {
            $.ajax({
                url: '/ajx',
                type: 'POST',
                data: 'nameFluxAdd=' + tab[0] + '&nameCategorieToAdd=' + tab[1] + '&urlFluxAdd=' + tab[2],
                dataType: 'html',
                success: function (data) {
                    if (data === "false") {
                        document.querySelector('.flux_information').innerHTML = "";
                        document.querySelector('.flux_information').innerHTML = "Ce flux RSS n'est pas valide";
                    }
                    else {
                        location.reload();
                    }
                }
            });
        }
        else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    if (xhr.responseText === "false") {

                    }
                    else {
                        location.reload();
                    }
                }

            };
            xhr.open("POST", "/ajx", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('nameFluxAdd=' + tab[0] + '&nameCategorieToAdd=' + tab[1] + '&urlFluxAdd=' + tab[2]);

        }
    }
    else {
        if(document.querySelector('.flux_information').innerHTML.indexOf("Vous n'avez pas cette catégorie ou le flux existe déjà dans la catégorie") != -1) {

        }
        else {
            document.querySelector('.flux_information').innerHTML += "Vous n'avez pas cette catégorie ou le flux existe déjà dans la catégorie ou le format du nom n'est pas correct : 3 caractères alphanumériques au minimum";
        }
    }
}// addRSSFeedCategoryUser()

///////////////////////////////////////////////////////////////////////////////////~RSS/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////CATEGORY///////////////////////////////////////////////////////////////////////////////
function addCategory($object) {
    var tab = new Array();
    $("#F_categorie .actionnable_lb").each(function () {
        tab.push($(this).val());
    });

    var tabCategory = new Array();
    $("#categorie_panel .default_block_panel").each(function () {
        tabCategory.push($(this).val());
    });

    var temp = "";

    for($i = 0 ; $i < tabCategory.length ; ++$i) {
        if(tabCategory[$i] === tab[0]) {
            temp = "Vous avez déjà une catégorie de ce nom"
        }
    }
    if(temp != "") {
        document.querySelector('.category_information').innerHTML += temp;
    }
    else if(!tab[0].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/) &&
        document.querySelector('.category_information').innerHTML.indexOf("Aide : Une catégorie ne contient pas d'espace au début, elle contient que des caractères alphanumériques et fait au minimum une taille de deux caractères") == -1)  {
        document.querySelector('.category_information').innerHTML += "Aide : Une catégorie ne contient pas d'espace au début, elle contient que des caractères alphanumériques et fait au minimum une taille de deux caractères";
    }
    else if(tab[0].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/) ||
        document.querySelector('..category_information').innerHTML.indexOf("Aide : Une catégorie ne contient pas d'espace au début, elle contient que des caractères alphanumériques et fait au minimum une taille de deux caractères") != -1) {
        if (navigator.userAgent.indexOf("Chrome") != -1) {
            $.ajax({
                url: '/ajx',
                type: 'POST', // Le type de la requête HTTP, ici devenu POST
                data: 'nameCategorie=' + tab[0] + '&colorCategorie=' + tab[1], // On fait passer nos variables, exactement comme en GET, au script more_com.php
                dataType: 'html',
                success: function (data) {
                    location.reload();
                }
            });
        }
        else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    location.reload();
                }

            };
            xhr.open("POST", "/ajx", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('nameCategorie=' + tab[0] + '&colorCategorie=' + tab[1]);

        }
    }
    else {

    }
} // addCategory()

function hideCancelDeleteCategory() {
    closePopUpAddArticle("#overlay_warning",".popup_warning")
} // hideCancelDeleteCategory()


function deleteCategorie($idCatDelete,$nameCatDelete) {
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
        document.getElementById("warning_zone").childNodes[3].innerHTML = "<h2>Vous êtes sur le point de supprimer les flux suivant contenus dans la catégorie "+$nameCatDelete+" : </h2><br/>";
        for (i = 0; i < tab.length; ++i) {
            document.getElementById("warning_zone").childNodes[3].innerHTML += " - " +tab[i]+"<br/>";
        }
        document.getElementById("warning_zone").innerHTML += '<button class="action_btn" type="button" onclick="deleteCategorieRSSFeedIn('+$idCatDelete+')">Je suis sûr(e)</button><button id="cancel_delete_category" onclick="hideCancelDeleteCategory()"  class="action_btn" type="button" >Non</button>';
    } // If RSS Feed in my category
    else {
        if (navigator.userAgent.indexOf("Chrome") != -1) {
            $.ajax({
                url: '/ajx',
                type: 'POST',
                data: 'catToDelete=' + $idCatDelete,
                success: function (data) {
                    location.reload();
                }
            });
        }
        else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    location.reload();
                }

            };
            xhr.open("POST", "/ajx", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('catToDelete=' + $idCatDelete);

        }
    }
} // deleteCategorie()

function deleteCategorieRSSFeedIn($idCatDelete) {
    if (navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'catToDelete=' + $idCatDelete,
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('catToDelete=' + $idCatDelete);
    }

} // deleteCategorieRSSFeedIn()

function allCategories() {
    if (navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'allCategories=true',
            success: function (data) {
                var displays = JSON.parse(data);
                document.getElementById('content_flux').innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById('content_flux').innerHTML += entry;
                });

            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var displays = JSON.parse(xhr.responseText);
                document.getElementById('content_flux').innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById('content_flux').innerHTML += entry;
                });
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('allCategories=true');
    }
} // allCategories()

////////////////////////////////////////////////////////////////////////////////~CATEGORY///////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////FRIEND////////////////////////////////////////////////////////////////////////////////
function focusThisFriend($idFriendFocus) {
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'idFriendFocus=' + $idFriendFocus,
            success: function (data) {
                var displays = JSON.parse(data);
                document.getElementById('content_friend_blog').innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById('content_friend_blog').innerHTML += entry;
                });
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var displays = JSON.parse(xhr.responseText);
                document.getElementById('content_friend_blog').innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById('content_friend_blog').innerHTML += entry;
                });
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('idFriendFocus=' + $idFriendFocus);
    }
} // focusThisFriend()

function deleteFriend($idFriendDelete) {
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'idFriendDelete=' + $idFriendDelete,
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('idFriendDelete=' + $idFriendDelete);
    }
} // deleteFriend()

function addFriend($idFriend) {
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'userToAddInFriend=' + $idFriend,
            dataType: 'html',
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('userToAddInFriend=' + $idFriend);

    }
} // addFriend()

/////////////////////////////////////////////////////////////////////////////////~FRIEND////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////MAIL/////////////////////////////////////////////////////////////////////////////////
function loadMail() {
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        document.querySelector(".load_mail_information").innerHTML = "Chargement des mails en cours ...";
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'loadMail=' + $("#selector_mailbox option:selected").text(),
            dataType: 'html',
            success: function (data) {
                var displays = JSON.parse(data);
                document.querySelector(".load_mail_information").innerHTML = "";
                document.getElementById("content_mail").childNodes[5].innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById("content_mail").childNodes[5].innerHTML += entry;
                });
            }
        });
    }
    else {
        document.getElementById("content_mail").childNodes[3].innerHTML = "Chargement des mails en cours ...";
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var displays = JSON.parse(xhr.responseText);
                document.getElementById("content_mail").childNodes[5].innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById("content_mail").childNodes[5].innerHTML += entry;
                });
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('loadMail=' + $("#selector_mailbox option:selected").text());
    }
} // loadMail()

function addEmail($object){
    var tab = new Array();
    $("#F_mail .actionnable_ma").each(function () {
        tab.push($(this).val());
    });


    $temp = "true";
    if(!tab[0].match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/) || tab[1].length == 0 || tab[2].length == 0 || tab[3].length == 0) {
        $temp = "false";
    }
    if($temp === "true"){
        if(navigator.userAgent.indexOf("Chrome") != -1) {
            $.ajax({
                url: '/ajx',
                type: 'POST',
                data: 'emailName=' + tab[0] + '&emailPassword=' + tab[1] + '&emailServer=' + tab[2] + '&emailPort=' + tab[3],
                success: function (data) {
                    if(data === "false")
                        document.querySelector('.mail_information').innerHTML = "Vous avez déjà ce mail d'ajouté";
                    else
                        location.reload();
                }
            });
        }
        else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    if(xhr.responseText === "false")
                        document.querySelector('.mail_information').innerHTML = "Vous avez déjà ce mail d'ajouté";
                    else
                        location.reload();
                }

            };
            xhr.open("POST", "/ajx", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('emailName=' + tab[0] + '&emailPassword=' + tab[1] + '&emailServer=' + tab[2] + '&emailPort=' + tab[3]);
        }
    }
    else {
        if(document.querySelector('.mail_information').innerHTML.indexOf("Le format du mail n'est pas correcte") != -1) {

        }
        else
            document.querySelector('.mail_information').innerHTML += "Le format du mail n'est pas correcte ou il manque un (des) champ(s) à remplir";
    }
} // addEmail()

function deleteMail() {
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'deleteMail=' + $("#selector_mailbox option:selected").text(),
            dataType: 'html',
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('deleteMail=' + $("#selector_mailbox option:selected").text());
    }
} // deleteMail()

//////////////////////////////////////////////////////////////////////////////////~MAIL/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////TWITTER/////////////////////////////////////////////////////////////////////////////////
function searchTwitter($object) {
    var tab = new Array();
    $("#F_twitter .actionnable_tw").each(function () {
        tab.push($(this).val());
    });

    if(navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'searchTwitter=' + tab[0],
            dataType: 'html',
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('searchTwitter=' + tab[0]);
    }

} // searchTwitter()

function loadTwitter() {
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        document.querySelector(".load_twitter_information").innerHTML =  "Chargement du compte Twitter en cours ...";
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'loadTwitter=' + $("#selector_twitter option:selected").text(),
            dataType: 'html',
            success: function (data) {
                var displays = JSON.parse(data);
                document.querySelector(".load_twitter_information").innerHTML = "";
                document.getElementById("content_twitter").childNodes[5].innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById("content_twitter").childNodes[5].innerHTML += entry;
                });
            }
        });
    }
    else {
        document.getElementById("content_twitter").childNodes[3].innerHTML = "Chargement du compte Twitter en cours ...";
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var displays = JSON.parse(xhr.responseText);
                document.getElementById("content_twitter").childNodes[5].innerHTML = "";
                displays.forEach(function (entry) {
                    document.getElementById("content_twitter").childNodes[5].innerHTML += entry;
                });
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('loadTwitter=' + $("#selector_twitter option:selected").text());
    }
} // loadTwitter()

function deleteTwitter() {
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'deleteTwitter=' + $("#selector_twitter option:selected").text(),
            dataType: 'html',
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('deleteTwitter=' + $("#selector_twitter option:selected").text());
    }
} // deleteTwitter()
////////////////////////////////////////////////////////////////////////////////~TWITTER/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////OPTIONS/////////////////////////////////////////////////////////////////////////////////
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

function optionsChange() {
    var tab = new Array();
    $("#popup_setting .actionnable_ou").each(function () {
        tab.push($(this).val());
    });
    if(tab[2] === "") {
        tab[2] = "false";
        alert("on sechappe");
        continueoptionsChange(tab);
    }
    else {
        if(navigator.userAgent.indexOf("Chrome") != -1) {
            $.ajax({
                url: '/ajx',
                type: 'POST',
                data: 'imgToTest=' + tab[2],
                success: function (data) {
                    if (data === "false") {
                    }

                    else {
                        continueoptionsChange(tab);
                    }
                }
            });
        }
        else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    if (xhr.responseText === "false") {
                    }

                    else {
                        continueoptionsChange(tab);
                    }
                }

            };
            xhr.open("POST", "/ajx", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send('imgToTest=' + tab[2]);
        }
    }

} // optionsChange()

function continueoptionsChange(tab) {
    if(tab[1] === "") {
        tab[1] = "false";
    }
    if(tab[0] === "") {
        tab[0] = "false";
    }
    if(navigator.userAgent.indexOf("Chrome") != -1) {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'imgInformation=' + tab[2] + '&emailInformation=' + tab[1] + '&nameInformation=' + tab[0],
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                location.reload();
            }

        };
        xhr.open("POST", "/ajx", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('imgInformation=' + tab[2] + '&emailInformation=' + tab[1] + '&nameInformation=' + tab[0]);

    }
} // continueoptionsChange()

function quitterOption() {
    closePopUpAddArticle('#overlay_setting','.popup_setting');
} // quitterOption()

////////////////////////////////////////////////////////////////////////////////~OPTIONS/////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////~FOR A USER//////////////////////////////////////////////////////////////////////////////
