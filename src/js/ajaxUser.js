/**
 * Created by g13003750 on 13/01/16.
 */

//////////////////////////////ADD//////////////////////////////
function addArticle($object) {

    var url = document.getElementById('F_blog').childNodes[4].value;
    var tab = new Array();
    $("#F_blog .actionnable_wr").each(function () {
        tab.push($(this).val());
    });

    $.ajax({
        url : '/ajx',
        type : 'POST', // Le type de la requête HTTP, ici devenu POST
        data : 'imgToTest=' + url, // On fait passer nos variables, exactement comme en GET, au script more_com.php
        dataType : 'html',
        success:function(data) {
            continueArticle($object,tab,data);
        }
    });
}

function continueArticle($object,tab,data) {
    if(!tab[0].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/) ||
        !tab[1].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/) ||
        data != "true" ||
        !tab[3].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
        if(!tab[0].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
            document.getElementById('F_blog').childNodes[1].value = "";
            document.getElementById('F_blog').childNodes[1].placeholder = "Mauvaise syntaxe (2 carac mini.)";
        }
        if(!tab[1].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
            document.getElementById('F_blog').childNodes[2].value = "";
            document.getElementById('F_blog').childNodes[2].placeholder = "Mauvaise syntaxe (2 carac mini.)";
        }
        if(data != "true") {
            document.getElementById('F_blog').childNodes[4].value = "";
            document.getElementById('F_blog').childNodes[4].placeholder = "Lien invalide";
        }

        if(!tab[3].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
            document.getElementById('F_blog').childNodes[6].value = "";
            document.getElementById('F_blog').childNodes[6].placeholder = "Commentaire mal rédigé";
        }
    }
    else {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'titreArticle=' + tab[0] + '&themeArticle=' + tab[1] + '&urlImgArticle=' + tab[2] + '&contentArticle=' + tab[3],
            dataType: 'html',
            success: function (data) {
                closePopUpAddArticle("#overlay_blog",".popup_blog");
                location.reload();
            }
        });
    }
} // addArticle()

function closePopUpAddArticle(overlay,popup) {
    $(overlay).fadeOut(200);
    $(popup).css("display", "none");
} // closePopUpAddArticle()

function addCategory($object) {
    var tab = new Array();
    $("#F_categorie .actionnable_lb").each(function () {
        tab.push($(this).val());
    });

    if(!tab[0].match(/^[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+[a-zA-Z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]$/)) {
        document.querySelector('.pop_add_categorie').innerHTML += "<span class='error_categorie_name'>Aide : Une catégorie ne contient pas d'espace au début et elle contient que des caractères alphanumériques</span>";
    }
    else {
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
} // addCategory()

function addRSSFeedCategoryUser($object) {
    var tab = new Array();
    $("#F_flux .actionnable_fl").each(function () {
        tab.push($(this).val());
    });

    $.ajax({
        url: '/ajx',
        type: 'POST', // Le type de la requête HTTP, ici devenu POST
        data: 'nameFluxAdd=' + tab[0] + '&nameCategorieToAdd=' + tab[1] + '&urlFluxAdd=' +tab[2], // On fait passer nos variables, exactement comme en GET, au script more_com.php
        dataType: 'html',
        success: function (data) {
            location.reload();
        }
    });
}// addRSSFeedCategoryUser()

function addFriend($idFriend) {
    $.ajax({
        url: '/ajx',
        type: 'POST', // Le type de la requête HTTP, ici devenu POST
        data: 'userToAddInFriend=' + $idFriend,
        dataType: 'html',
        success: function (data) {
            location.reload();
        }
    });
} // addFriend()

function addEmail($object){
    var tab = new Array();
    $("#F_mail .actionnable_ma").each(function () {
        tab.push($(this).val());
    });
    $.ajax({
        url: '/ajx',
        type: 'POST',
        data: 'emailName=' + tab[0] + '&emailPassword=' + tab[1] + '&emailServer=' + tab[2] + '&emailPort =' + tab[3],
        success: function (data) {
            location.reload();
        }
    });

}
/////////////////////////////~ADD//////////////////////////////

/////////////////////////////FLUX//////////////////////////////
function changeFavoriteRSSFeed($object,$idRSSFeed,$idCategory,$name,$red,$green,$blue) {
    $.ajax({
        url: '/ajx',
        type: 'POST',
        data: 'linkImgFavorite=' + $object.src + '&idRSSFeed=' + $idRSSFeed + '&idCategory=' + $idCategory,
        success: function (data) {
            if($object.src == "http://aaron-aaron.alwaysdata.net/src/images/favorite_off.png") {
                $object.src = "http://aaron-aaron.alwaysdata.net/src/images/favorite_on.png";
                var newFavorite = '<button class="default_block_panel flux noborder" type="button" value="'+$name+'" style="background-color:rgba('+$red+','+$green+','+$blue+',0.5);">'+$name+'</button>';
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
    });

} // fluxFavorite()

function focusToThisRSSFeed($url) {
    $.ajax({
        url: '/ajx',
        type: 'POST',
        data: 'urlToFocus='+$url,
        success: function (data) {
            var displays =  JSON.parse(data);
            document.getElementById('content_flux').innerHTML = "";
            displays.forEach(function(entry) {
                document.getElementById('content_flux').innerHTML += entry;
            });
        }
    });
} // focusToThisRSSFeed()


function deleteFlux($idRSSFeed,$idCategory) {
    $.ajax({
        url: '/ajx',
        type: 'POST', // Le type de la requête HTTP, ici devenu POST
        data: 'idRSSFeedToDeleteOfACategory=' + $idRSSFeed + '&idCategory=' + $idCategory, // On fait passer nos variables, exactement comme en GET, au script more_com.php
        dataType: 'html',
        success: function (data) {
            location.reload();
        }
    });
} // deleteFlux()

function loadMail() {
    $.ajax({
        url: '/ajx',
        type: 'POST',
        data: 'loadMail='+$("#selector_mailbox option:selected" ).text(),
        dataType: 'html',
        success: function (data) {
            var displays =  JSON.parse(data);
            displays.forEach(function(entry) {
                document.getElementById('content_mail').innerHTML += entry;
            });
        }
    });
} // loadMail()
////////////////////////////~FLUX//////////////////////////////

/////////////////////////FRIEND/////////////////////////
function searchUser($object) {
    $.ajax({
        url: '/ajx',
        type: 'POST', // Le type de la requête HTTP, ici devenu POST
        data: 'userToFind=' + $("#F_friend .actionnable_fr").val(), // On fait passer nos variables, exactement comme en GET, au script more_com.php
        dataType: 'html',
        success: function (data) {
            var displays =  JSON.parse(data);
            $("#researchResult").removeClass("hide");
            document.getElementById('researchResult').innerHTML = "";
            for(i = 0 ; i < displays.length ; i += 3) {
                var elm = '<div class="researchResult_friend"><img class="researchResult_friend_img" src="'+displays[i+2]+'">';
                elm += '<span class="researchResult_friend_name">'+displays[i+1]+'</span>';
                elm += '<button id="researchResult_friend_add" class="noborder" onclick="addFriend('+displays[i]+')" type="button">Ajouter</button></div>';
                document.getElementById('researchResult').innerHTML += elm;
            }
        }
    });
} // searchUser()

function deleteFriend($idFriendDelete) {
    $.ajax({
        url: '/ajx',
        type: 'POST',
        data: 'idFriendDelete='+$idFriendDelete,
        success: function (data) {
            location.reload();
        }
    });
} // deleteFriend()
/////////////////////////~FRIEND/////////////////////////

////////////////////////OPTIONS IN MENU////////////////////////
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
        document.getElementById("warning_zone").innerHTML += '<button class="action_btn" type="button" onclick="deleteCategorieRSSFeedIn('+$idCatDelete+')">Je suis sûr(e)</button><button class="action_btn" type="button" >Euh non</button>';
    } // If RSS Feed in my category
    else {
        $.ajax({
            url: '/ajx',
            type: 'POST',
            data: 'catToDelete=' + $idCatDelete,
            success: function (data) {
                location.reload();
            }
        });
    }
} // deleteCategorie()

function deleteCategorieRSSFeedIn($idCatDelete) {
    $.ajax({
        url: '/ajx',
        type: 'POST',
        data: 'catToDelete='+$idCatDelete,
        success: function (data) {
            location.reload();
        }
    });

} // deleteCategorieRSSFeedIn()

function disconnect() {
    $.ajax({
        url: '/ajx',
        type: 'POST',
        data: 'disconnectUser=ok',
        success: function (data) {
            window.location.replace("http://aaron-aaron.alwaysdata.net/");
        }
    });
} // disconnect()

///////////////////////~OPTIONS IN MENU////////////////////////

