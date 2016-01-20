<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 08/01/16
 * Time: 16:35
 */

include_once('src/util/regex.php');

class EmptyView extends View {

    public function __construct($model) {
        $this->model = $model;
    }// UserView

    public function display() {
        //////////////////////////////////////////////////////ADMIN//////////////////////////////////////////////////////
        if(isset($_POST['enableOrDisable'])) {
            $task = substr($_POST['enableOrDisable'],0,3);  // ena ou dis
            $idUser = substr($_POST['enableOrDisable'],3); // ex : 69
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
            array_push($articleToAdd,$_POST['titreArticle']);
            array_push($articleToAdd,$_POST['themeArticle']);
            array_push($articleToAdd,$_POST['urlImgArticle']);
            array_push($articleToAdd,$_POST['contentArticle']);
            $this->model->addArticle($articleToAdd);
        }

        // Categorie
        else if(isset($_POST['nameCategorie']) && isset($_POST['colorCategorie'])) {
            $tab = array();
            array_push($tab,$_POST['nameCategorie']);
            array_push($tab,$_POST['colorCategorie']);
            $this->model->addCategory($tab);
        }

        // RSS feed favorite
        else if(isset($_POST['linkImgFavorite']) && isset($_POST['idRSSFeed']) && isset($_POST['idCategory'])) {
            if($_POST['linkImgFavorite'] == "http://aaron-aaron.alwaysdata.net/src/images/favorite_on.png")
                $value = "off";
            else
                $value = "on";
            $this->model->changeFavoriteRSSFeed($value,$_POST['idRSSFeed'],$_POST['idCategory']);
        }

        // Add a RSS feed to a category for a user
        else if(isset($_POST['nameFluxAdd']) && isset($_POST['nameCategorieToAdd']) && isset($_POST['urlFluxAdd'])) {
            $this->model->addRSSFeedCategoryUser($_POST['nameFluxAdd'],$_POST['nameCategorieToAdd'],$_POST['urlFluxAdd']);
        }

        // Add a user in friendlist
        else if(isset($_POST['userToAddInFriend'])) {
            $this->model->userToAddInFriend($_POST['userToAddInFriend']);
        }
        /////////////////////////////////////////////////////~ADD//////////////////////////////////////////////////////

        //////////////////////////////////////////////////////OPTIONS//////////////////////////////////////////////////////
        //Focus to the specific rss feed
        else if(isset($_POST['urlToFocus'])) {
            $rep = $this->model->focusToThisRSSFeed($_POST['urlToFocus']);
            echo $rep;
        }

        //Find the user
        else if(isset($_POST['userToFind'])) {
            $rep = $this->model->userToFindAndToDisplay($_POST['userToFind']);
            echo $rep;
        }

        else if(isset($_POST['imgToTest'])) {
            if(isImageURL($_POST['imgToTest']))
                echo "true";
            else
                echo "false";
        }

        else if(isset($_POST['disconnectUser'])) {
            session_destroy();
            header('Location:http://aaron-aaron.alwaysdata.net');
        }
        /////////////////////////////////////////////////////~OPTIONS//////////////////////////////////////////////////////

        //////////////////////////////////////////////////////DELETE//////////////////////////////////////////////////////
        else if(isset($_POST['catToDelete'])) {
            $res = $rep = $this->model->catToDelete($_POST['catToDelete']);
            echo $res;
        }

        else if (isset($_POST['idRSSFeedToDeleteOfACategory']) && isset($_POST['idCategory'])) {
            $this->model->RSSFeedToDeleteOfACategory($_POST['idRSSFeedToDeleteOfACategory'],$_POST['idCategory']);
        }

        else if(isset($_POST['idFriendDelete'])) {
            $this->model->deleteOneFriend($_POST['idFriendDelete']);
        }
        ////////////////////////////////////////////////////~DELETE//////////////////////////////////////////////////////


    }

}