<?php
/**
 * Created by Kevin.
 * User: h13002021
 * Date: 21/12/15
 * Time: 22:01
 */

include_once('View.php');
include_once('src/util/regex.php');

class DefaultView extends View {

    private $user;
	private $categories;
	private $friends;
	private $articles;

	public function __construct($model) {
        $this->model = $model;

        $this->user = $this->model->getCurrentUser();
        $this->categories = $this->user->getCategories();
        $this->friends = $this->user->getFriends();
		$this->articles = $this->user->getArticles();
    }

    public function display() {
    	echo '
    		<html>
				<head>
					<title>Aaron</title>
					<link rel="stylesheet" type="text/css" href="/src/style/user.css" />
					<link rel="stylesheet" type="text/css" href="/src/style/flux.css" />
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
					<script type="text/javascript" src="/src/js/menu.js"></script>
					<script type="text/javascript" src="/src/js/user_preference.js"></script>
					<script type="text/javascript" src="/src/js/switch_content.js"></script>
					<script type="text/javascript" src="/src/js/search.js"></script>
					<script type="text/javascript" src="/src/js/readUrl.js"></script>
					<script type="text/javascript" src="/src/js/popup.js"></script>
					<script type="text/javascript" src="/src/js/ajaxUser.js"></script>';
                    echo $this->model->getParam();
                    echo '
				</head>
				<body>
					<!-- TOP SIDE -->
					';
						if($this->user->avatarDefine())
							$image = $this->user->getAvatar();
					echo '
					<div id="top">
						<img class="top_logo" src="/src/images/aaron_logo.png">
						<div class="top_user"><button class="top_user_btn" type="button"><img width="100%" height="100%" src="'.$image.'"></button><span class="top_user_name">' .$this->user->getName().'</span></div>
						<button class="top_preference_btn" type="button"></button>
					</div>

					<!-- LEFT SIDE -->
					<div id="menu">
			        	<div id="LTBar">
							<input id="searchInput" name="search" type="search" placeholder="Recherche"/>
							<a href="#" onclick="javascript:;" class="imageButton search_btn"></a>
						</div>
						<div id="categorie_panel" class="searchOn">';
							foreach ($this->categories as $c) {
							echo '
								<button class="categorie default_block_panel" onclick="inputButton(this)" type="button" style="background-color:'.$c->getColor().';" value="'.$c->getName().'">'.$c->getName().'<input class="hide" onclick="inputCheckbox(this)" type="checkbox" name="categorie" value="'.$c->getName().'"></button>
							';
							}
						echo '
						</div>
						<div id="friend_panel" class="searchOn hide"> ';
							foreach ($this->friends as $f) {
							echo '
								<button class="friend default_block_panel" value="'.$f->getName().'" type="button">'.$f->getName().'</button>
							';
							}
						echo '
						</div>';
						foreach ($this->categories as $c) {
						echo '<div id="'.$c->getName().'_panel" class="flux_Panel searchOn hide">
							  		<button class="default_block_panel backflux_btn"><span class="flux_name">Retour</span></button>';
							foreach($c->getFlux() as $in) {
								($in->isFavorite() == true) ? $et = 'on' : $et = 'off';
                                $rgb = hex2rgb($c->getColor());
							  echo '<button onclick="switchFluxTo(\''.$in->getUrl().'\')" class="default_block_panel flux" value="'.$in->getName().'" type="button" style="background-color:rgba('.$rgb['red'].','.$rgb['green'].','.$rgb['blue'].',0.5);"><span class="flux_name">'.$in->getName().'</span><img onclick="fluxFavorite(this,'.$in->getId().',\''.$in->getName().'\','.$rgb['red'].','.$rgb['green'].','.$rgb['blue'].')" class="flux_with_image" src="/src/images/favorite_'.$et.'.png"></button>';
							}
						echo '</div>';
						}
						echo '
						<div id="favorite_panel" class="searchOn hide">';
							foreach($this->categories as $c) {
								foreach($c->getFlux() as $in) {
									if ($in->isFavorite() == false) continue;
                                    $rgb = hex2rgb($c->getColor());
									echo '<button class="default_block_panel flux" type="button" value="'.$in->getName().'" style="background-color:rgba('.$rgb['red'].','.$rgb['green'].','.$rgb['blue'].',0.5);">'.$in->getName().'</button>';
								}
							}

						echo '</div>
						<div id="LBBar">
							<a href="#" onclick="javascript:;" class="addF_btn"></a><a id="removeCategorie" href="#" onclick="javascript:;" class="lessF_btn"></a><button id="cancel_deleting_cat" class="hide cancel_delete_btn" type="button"></button><button id="validate_deleting_cat" class="hide validate_btn" type="button"></button>
						</div>
			    	</div>

			    	<!-- PAGE CONTENT -->
			    	<div id="page">
			    		<div id="leftSmallMenu">
			    			<button class="menu_btn close_btn" type="button"></button>
			    			<button class="menu_btn open_btn" type="button"></button>
			    			<button class="menu_btn all_btn" type="button"></button>
			    			<button class="menu_btn favorite_btn" type="button"></button>
			    			<button class="menu_btn friend_btn" type="button"></button>
			    			<div class="menu_btn"></div>
			    			<button class="menu_btn write_btn" type="button"></button>
			    			<button class="menu_btn blog_btn" type="button"></button>
			    			<button class="menu_btn actu_btn" type="button"></button>
			    		</div>

						<div id="content">
							<div id="content_flux">';
							//WHERE ANY FLUX SELECTED
							foreach($this->categories as $category) {
								foreach($category->getFlux() as $f) {
									foreach($f->getFluxArticles() as $fa) {
                                        echo $fa->display_rss();
                                    }
								}
							}
							echo '
							</div>
							<div id="content_blog" class="hide">';
							foreach($this->articles as $article) {
							echo '
								<div class="article" >
									<div class="article_zone_img" >
										<img class="article_img" src = "'.$article->getImgUrl().'" />
									</div >
									<div class="article_zone_content" >
										<span class="article_content_inf"><span class="article_inf_title">'.$article->getTitle().'</span> dans <span class="article_inf_theme">'.$article->getTheme().'</span></span><br/>
										<p class="article_content">'.$article->getContent().'</p>
									</div>
								</div>
							';
							}
							echo '
							</div>
						</div>
			    	</div>
			    	<!-- END PAGE CONTENT -->

			    	<!-- PREFERENCE -->
			    	<div id="user_preference" class="hide">
			    	    <div class="user_preference_top">
                            <span class="user_preference_top_title">Préférences</span><button id="close_user_preference" class="user_preference_top_btn"></button>
                        </div>
                    	   <div class="user_preference_rest">
                            <button class="user_preference_rest_btn" type="button">Options personnelles</button>
                            <button class="user_preference_rest_btn" type="button">Options Aaron</button>
                            <button id="user_deconnection" class="user_preference_rest_btn" type="button">Déconnexion</button>
                        </div>
			    	</div>

			    	<div id="user_information" class="hide">
			    		<div class="user_information_top">
                            <button id="close_user_information" class="user_information_top_btn" type="button"><img width="100%" height="100%" src="'.$image.'"></button><div class="user_information_top_foll"><img alt="Personnes qui vous suit" src="/src/images/follower.png">'.$this->user->getNbFollowers().'<img alt="Personnes que vous suivez" src="/src/images/follow.png">'.$this->user->getNbFollows().'</div><span class="user_information_top_name">'.$this->user->getName().'</span>
                        </div>
			    		<div class="user_information_rest">
			    			<button class="actu_btn user_information_rest_btn" type="button">Actualités</button>
							<button class="blog_btn user_information_rest_btn" type="button">Mon blog</button>
                        </div>
			    	</div>
			    	<!-- END PREFERENCE -->
			    	
					<!-- POP-UP FLUX -->
					<div id="overlay_flux" class="overlay"></div>
			        <div id="popup_flux" class="popup_flux">
			        	<div class="pop_selector pop_add">
			        		<h1>Selectionner un type d\'import </h1>
			        		<select id="selector">
			        			<option value="pop_add_categorie">Une catégorie</option>
			        			<option value="pop_add_flux">Un flux</option>
			        			<option value="pop_add_mail">Un compte mail</option>
			        			<option value="pop_add_friend">Suivre une personne</option>
			        		</select>
			        		<div class="selector_button">
			        			<button id="begin" type="button">Commencer</button><button id="end" type="button">Annuler</button>
			        		</div>
			        	</div>
			        	<div class="pop_add pop_add_categorie hide">
			        		<div class="sep"></div>
			        		<form id="F_categorie"  method="post">
								<input class="smallInput actionnable_lb" name="name" type="text" placeholder="Nom" required/>
								<input class="smallInput actionnable_lb" name="color" type="color" placeholder="Couleur" required/>
					    		<input id="add_categorie" class="smallInput" onclick ="addCategory(this)" name="submit" type="button" value="Créer"/><button id="btnCancel" class="smallInput" type="reset" form="F_categorie">Annuler</button>
							</form>
			        	</div>
			            <div class="pop_add pop_add_flux hide">
			            	<div class="sep"></div>
							<form id="F_flux" method="post">
								<input class="smallInput actionnable_fl" name="name" type="text" placeholder="Nom" required/>
								<input class="smallInput actionnable_fl" name="categorie" type="text" placeholder="Categorie" required/>
					    		<input class="bigInput actionnable_fl" name="urlFlux" type="text" placeholder="Url du flux" required/>
					    		<input class="smallInput" name="submit" type="button" onclick="addFlux(this)" value="Ajouter"/><button id="btnCancel" class="smallInput" type="reset" form="F_flux">Annuler</button>
							</form>
						</div>
						<div class="pop_add pop_add_mail hide">
			            	<div class="sep"></div>
						</div>
						<div class="pop_add pop_add_friend hide">
			            	<div class="sep"></div>
			            	<form id="F_friend" method="post">
			            		<input class="smallInput actionnable_fr" name="name" type="text" placeholder="Qui souhaitez-vous suivre ?" required/>
			            		<input class="smallInput" name="submit" type="button" onclick="searchUser(this)" value="Chercher"/>
			            	</form>
			            	<div id="researchResult" class="pop_add_friend_result hide"></div>
						</div>
			        </div>

			        <!-- POP-UP WRITTING ARTICLE -->
			        <div id="overlay_blog" class="overlay"></div>
			        <div id="popup_blog" class="popup_blog">
			        	<div id="writting_zone">
			        		<div class="writting_zone_image">
			        			<img id="preview_img_blog" class="preview_img_blog" src="#" />
			        		</div>
			        		<div class="writting_zone_text">
			        			<form id="F_blog" method="post">
			        				<input class="small_input actionnable_wr" type="text" name="title" placeholder="Titre" required/><input class="small_input actionnable_wr" type="text" name="theme" placeholder="Theme" required/>
			        				<input id="imgSelection" class="big_input actionnable_wr" type="text" name="title" placeholder="Lien de l\'image" required/>
			        				<textarea class="content_input actionnable_wr" name="content" form="F_blog"></textarea>
			        				<button id="add_article" class="action_btn" type="button" onclick="addArticle(this)">Publier</button><button id="F_cancel_btn" class="action_btn" type="reset" form="F_blog">Annuler</button>
			        			</form>
			        		</div>
			        	</div>
			        </div>
			        <!-- END POP-UP -->

				</body>
			</html>


    	';
    }
}