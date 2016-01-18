<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 08/01/16
 * Time: 16:35
 */

class EmptyView extends View {

    public function __construct($model) {
        $this->model = $model;
    }// UserView

    public function display() {
        // Activation/Désactivation/Suppression d'un user par l'admin
        if(isset($_POST['enableOrDisable'])) {
            $task = substr($_POST['enableOrDisable'],0,3);  // ena ou dis
            $idUser = substr($_POST['enableOrDisable'],3); // ex : 69
            if($task == "del") {
                $this->model->deleteUser($idUser);
                echo "je passe ici : " . $idUser;
            } // Si del alors je supprime l'user sinon je l'active ou je le désactive
            else {
                $this->model->enableOrDisableUser($task,$idUser);
            }
        } // if(isset($_POST['enableOrDisable'])

        // Ajouter
        else if(isset($_POST['titreArticle']) && isset($_POST['themeArticle']) && isset($_POST['urlImgArticle']) && isset($_POST['contentArticle'])) {
            $articleToAdd = array();
            array_push($articleToAdd,$_POST['titreArticle']);
            array_push($articleToAdd,$_POST['themeArticle']);
            array_push($articleToAdd,$_POST['urlImgArticle']);
            array_push($articleToAdd,$_POST['contentArticle']);
            $this->model->addArticle($articleToAdd);
        } // else if(isset($_POST['titreArticle']) && isset($_POST['themeArticle']) && isset($_POST['urlImgArticle']) && isset($_POST['contentArticle']))
        else if(isset($_POST['idUserCategorie']) && isset($_POST['nameCategorie']) && isset($_POST['colorCategorie'])) {
            $tab = array();
            array_push($tab,$_POST['idUserCategorie']);
            array_push($tab,$_POST['nameCategorie']);
            array_push($tab,$_POST['colorCategorie']);
            $this->model->addCategory($tab);
        }
        else if(isset($_POST['linkImgFavorite']) && isset($_POST['idImg'])) {
            if($_POST['linkImgFavorite'] == "http://aaron-aaron.alwaysdata.net/src/images/favorite_off.png")
                $value = "off";
            else
                $value = "on";
            $this->model->switchFavoriteFlux($value, $_POST['idImg']);
            echo $value;

        }
        else if(isset($_POST['urlFlux'])) {
            $rep = $this->model->createFluxAndDisplay($_POST['urlFlux']);
            echo $rep;
        }
        else if(isset($_POST['nameFluxAdd']) && isset($_POST['nameCategorieToAdd']) && isset($_POST['urlFluxAdd'])) {
            $this->model->addFlux($_POST['nameFluxAdd'],$_POST['nameCategorieToAdd'],$_POST['urlFluxAdd']);
        }
    }

}