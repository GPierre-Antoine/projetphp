<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 08/01/16
 * Time: 16:35
 */

include_once('src/util/regex.php');
include_once('src/class/Email.php');

class EmptyView extends View {

    public function __construct($model) {
        $this->model = $model;
    }// UserView

    public function display() {
        ///////////////////////////////////////////////////////////////////////////////////ADMIN////////////////////////////////////////////////////////////////////////////////
        //Enable or disable or delete a user
        if(isset($_POST['enableOrDisable'])) {
            $task = substr(POST('enableOrDisable'),0,3);  // ena ou dis
            $idUser = substr(POST('enableOrDisable'),3); // ex : 69
            if($task == "del") {
                $this->model->deleteUser($idUser);
            }
            else {
                $this->model->enableOrDisableUser($task,$idUser);
            }
        }
        //////////////////////////////////////////////////////////////////////////////////~ADMIN////////////////////////////////////////////////////////////////////////////////

        ////////////////////////////////////////////////////////////////////////////////FOR A USER/////////////////////////////////////////////////////////////////////////////
        //Find a user
        else if(isset($_POST['userToFind'])) {
            $rep = $this->model->userToFindAndToDisplay(POST('userToFind'));
            echo $rep;
        }

        //Test if the url is an image
        else if(isset($_POST['imgToTest'])) {
            echo isImageURL(POST('imgToTest'));
        }

        //////////////////////////////////////////////////////////////////////////////////ARTICLE///////////////////////////////////////////////////////////////////////////////
        //Add a article for a user
        else if(isset($_POST['titreArticle']) && isset($_POST['themeArticle']) && isset($_POST['urlImgArticle']) && isset($_POST['contentArticle'])) {
            $articleToAdd = array();
            array_push($articleToAdd,POST('titreArticle'));
            array_push($articleToAdd,POST('themeArticle'));
            array_push($articleToAdd,POST('urlImgArticle'));
            array_push($articleToAdd,POST('contentArticle'));
            $this->model->addArticle($articleToAdd);
        }

        /////////////////////////////////////////////////////////////////////////////////~ARTICLE///////////////////////////////////////////////////////////////////////////////

        ////////////////////////////////////////////////////////////////////////////////////RSS/////////////////////////////////////////////////////////////////////////////////
        //Change favorite rss feed of a user
        else if(isset($_POST['linkImgFavorite']) && isset($_POST['idRSSFeed']) && isset($_POST['idCategory'])) {
            if(POST('linkImgFavorite') === "http://aaron-aaron.alwaysdata.net/src/images/favorite_on.png")
                $value = "off";
            else
                $value = "on";
            $this->model->changeFavoriteRSSFeed($value,POST('idRSSFeed'),POST('idCategory'));
        }

        //Focus on a RSS feed
        else if(isset($_POST['urlToFocus'])) {
            $rep = $this->model->focusToThisRSSFeed(POST('urlToFocus'));
            echo $rep;
        }

        //RSS feed to delete in a category
        else if (isset($_POST['idRSSFeedToDeleteOfACategory']) && isset($_POST['idCategory'])) {
            $this->model->RSSFeedToDeleteOfACategory(POST('idRSSFeedToDeleteOfACategory'),POST('idCategory'));
        }

        //Add a RSS in a category
        else if(isset($_POST['nameFluxAdd']) && isset($_POST['nameCategorieToAdd']) && isset($_POST['urlFluxAdd'])) {
            $sValidator = 'http://feedvalidator.org/check.cgi?url=';
            if( $sValidationResponse = @file_get_contents($sValidator . urlencode(POST('urlFluxAdd'))) ) {
                if( stristr( $sValidationResponse , 'This is a valid RSS feed' ) !== false ) {
                    $this->model->addRSSFeedCategoryUser(POST('nameFluxAdd'),POST('nameCategorieToAdd'),POST('urlFluxAdd'));
                    return;
                }
                else {
                    echo "false";
                    return;
                }
            }
            else
            {
                echo "false";
                return;
            }
        }

        ///////////////////////////////////////////////////////////////////////////////////~RSS/////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////////////////////CATEGORY///////////////////////////////////////////////////////////////////////////////
        //Add a category
        else if(isset($_POST['nameCategorie']) && isset($_POST['colorCategorie'])) {
            $tab = array();
            array_push($tab,POST('nameCategorie'));
            array_push($tab,POST('colorCategorie'));
            $this->model->addCategory($tab);
        }

        //Delete a Category
        else if(isset($_POST['catToDelete'])) {
            $rep = $this->model->catToDelete(POST('catToDelete'));
        }

        //Display all categories
        else if(isset($_POST['allCategories'])) {
            $rep = $this->model->allCategories();
            echo $rep;
        }

        ////////////////////////////////////////////////////////////////////////////////~CATEGORY///////////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////FRIEND////////////////////////////////////////////////////////////////////////////////
        //Focus on friend blog
        else if(isset($_POST['idFriendFocus'])) {
            $rep = $this->model->friendBlog(POST('idFriendFocus'));
            echo $rep;
        }

        //Delete a friend
        else if(isset($_POST['idFriendDelete'])) {
            $this->model->deleteOneFriend(POST('idFriendDelete'));
        }

        // Add a user in friendlist
        else if(isset($_POST['userToAddInFriend'])) {
            $this->model->userToAddInFriend(POST('userToAddInFriend'));
        }

        /////////////////////////////////////////////////////////////////////////////////~FRIEND////////////////////////////////////////////////////////////////////////////////

        ///////////////////////////////////////////////////////////////////////////////////MAIL/////////////////////////////////////////////////////////////////////////////////
        //Load current mail
        else if(isset($_POST['loadMail'])) {
            $res = $this->model->loadMail(POST('loadMail'));
            echo $res;
        }

        //Add a mail
        else if(isset($_POST['emailName']) && isset($_POST['emailPassword']) && isset($_POST['emailServer']) && isset($_POST['emailPort'])) {
            $this->model->addMail(POST('emailName'),POST('emailPassword'),POST('emailServer'),POST('emailPort'));
        }

        //Delete mail
        else if(isset($_POST['deleteMail'])) {
            $this->model->deleteMail(POST('deleteMail'));
        }
        //////////////////////////////////////////////////////////////////////////////////~MAIL/////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////////////////////TWITTER////////////////////////////////////////////////////////////////////////////////
        //Follow a twitter user
        else if(isset($_POST['searchTwitter'])) {
            $this->model->searchTwitter(POST('searchTwitter'));
        }

        //Load twitter user
        else if(isset($_POST['loadTwitter'])) {
            $res = $this->model->loadTwitter(POST('loadTwitter'));
            echo $res;
        }

        //Delete twitter user
        else if(isset($_POST['deleteTwitter'])) {
            $this->model->deleteTwitter(POST('deleteTwitter'));
        }

        ////////////////////////////////////////////////////////////////////////////////~TWITTER/////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////////////////////OPTIONS/////////////////////////////////////////////////////////////////////////////////
        //Options for a user
        else if(isset($_POST['nameInformation']) && isset($_POST['emailInformation']) && isset($_POST['imgInformation'])) {
            if(POST('nameInformation') !== "false") {
                $this->model->changeName(POST('nameInformation'));
            }
            if(POST('emailInformation') !== "false") {
                if(mail_check(POST('emailInformation')))
                        $this->model->changeEmail(POST('emailOption'));
            }
            if(POST('imgInformation') !== "false") {
                $this->model->changeImg(POST('imgInformation'));
            }
        }

        //Disconnect
        else if(isset($_POST['disconnectUser'])) {
            session_destroy();
            header('Location:http://aaron-aaron.alwaysdata.net');
        }

        ////////////////////////////////////////////////////////////////////////////////~OPTIONS/////////////////////////////////////////////////////////////////////////////////

        ////////////////////////////////////////////////////////////////////////////////~FOR A USER//////////////////////////////////////////////////////////////////////////////


    }

}