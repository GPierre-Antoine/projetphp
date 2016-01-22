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
        //////////////////////////////////////////////////////ADMIN//////////////////////////////////////////////////////
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
        /////////////////////////////////////////////////////~ADMIN//////////////////////////////////////////////////////

        //////////////////////////////////////////////////////ADD//////////////////////////////////////////////////////
        //Article
        else if(isset($_POST['titreArticle']) && isset($_POST['themeArticle']) && isset($_POST['urlImgArticle']) && isset($_POST['contentArticle'])) {
            $articleToAdd = array();
            array_push($articleToAdd,POST('titreArticle'));
            array_push($articleToAdd,POST('themeArticle'));
            array_push($articleToAdd,POST('urlImgArticle'));
            array_push($articleToAdd,POST('contentArticle'));
            $this->model->addArticle($articleToAdd);
        }

        // Categorie
        else if(isset($_POST['nameCategorie']) && isset($_POST['colorCategorie'])) {
            $tab = array();
            array_push($tab,POST('nameCategorie'));
            array_push($tab,POST('colorCategorie'));
            $this->model->addCategory($tab);
        }

        // change RSS feed favorite
        else if(isset($_POST['linkImgFavorite']) && isset($_POST['idRSSFeed']) && isset($_POST['idCategory'])) {
            if(POST('linkImgFavorite') === "http://aaron-aaron.alwaysdata.net/src/images/favorite_on.png")
                $value = "off";
            else
                $value = "on";
            $this->model->changeFavoriteRSSFeed($value,POST('idRSSFeed'),POST('idCategory'));
        }

        // Add a RSS feed to a category for a user
        else if(isset($_POST['nameFluxAdd']) && isset($_POST['nameCategorieToAdd']) && isset($_POST['urlFluxAdd'])) {
            $this->model->addRSSFeedCategoryUser(POST('nameFluxAdd'),POST('nameCategorieToAdd'),POST('urlFluxAdd'));
        }

        // Add a user in friendlist
        else if(isset($_POST['userToAddInFriend'])) {
            $this->model->userToAddInFriend(POST('userToAddInFriend'));
        }
        /////////////////////////////////////////////////////~ADD//////////////////////////////////////////////////////

        //////////////////////////////////////////////////////OPTIONS//////////////////////////////////////////////////////
        //Display all categories
        else if(isset($_POST['allCategories'])) {
            $rep = $this->model->allCategories();
            echo $rep;
        }

        //Focus to the specific rss feed
        else if(isset($_POST['urlToFocus'])) {
            $rep = $this->model->focusToThisRSSFeed(POST('urlToFocus'));
            echo $rep;
        }

        //Find the user
        else if(isset($_POST['userToFind'])) {
            $rep = $this->model->userToFindAndToDisplay(POST('userToFind'));
            echo $rep;
        }

        //Focus on friend blog
        else if(isset($_POST['idFriendFocus'])) {
            $rep = $this->model->friendBlog(POST('idFriendFocus'));
            echo $rep;
        }

        //Test if the url is an image
        else if(isset($_POST['imgToTest'])) {
            if(isImageURL(POST('imgToTest')))
                echo "true";
            else
                echo "false";
        }

        //Disconnect
        else if(isset($_POST['disconnectUser'])) {
            session_destroy();
            header('Location:http://aaron-aaron.alwaysdata.net');
        }

        else if(isset($_POST['nameInformation']) && isset($_POST['emailInformation']) && isset($_POST['passwordInformation'])) {
            if($_POST['nameInformation'] != "") {
                $this->model->changeName(POST('nameInformation'));
            }
            if($_POST['emailInformation'] != "") {
                $this->model->changeEmail(POST('emailInformation'));

            }
            if($_POST['passwordInformation'] != "") {
                $userModel = new UserModel();
                $userModel->reset_password_with_id($_SESSION['ID'],POST('passwordInformation'));
            }
        }
        /////////////////////////////////////////////////////~OPTIONS//////////////////////////////////////////////////////

        ///////////////////////////////////////////////////////MAIL///////////////////////////////////////////////////////
        else if(isset($_POST['loadMail'])) {
            $res = $this->model->loadMail(POST('loadMail'));
            echo $res;
        }

        else if(isset($_POST['emailName']) && isset($_POST['emailPassword']) && isset($_POST['emailServer']) && isset($_POST['emailPort'])) {
            $this->model->addMail(POST('emailName'),POST('emailPassword'),POST('emailServer'),POST('emailPort'));
        }
        //////////////////////////////////////////////////////~MAIL///////////////////////////////////////////////////////

        //////////////////////////////////////////////////////DELETE//////////////////////////////////////////////////////
        else if(isset($_POST['catToDelete'])) {
            $res = $rep = $this->model->catToDelete(POST('catToDelete'));
            echo $res;
        }

        else if (isset($_POST['idRSSFeedToDeleteOfACategory']) && isset($_POST['idCategory'])) {
            $this->model->RSSFeedToDeleteOfACategory(POST('idRSSFeedToDeleteOfACategory'),POST('idCategory'));
        }

        else if(isset($_POST['idFriendDelete'])) {
            $this->model->deleteOneFriend(POST('idFriendDelete'));
        }
        ////////////////////////////////////////////////////~DELETE//////////////////////////////////////////////////////


    }

}