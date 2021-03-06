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
	private $flux;
	private $friends;
	private $articles;
	private $twitters;

	public function __construct($model) {
        $this->model = $model;

        $this->user = $this->model->getUser();
        $this->categories = $this->user->getCategories();
		$this->flux = $this->user->getFlux();
        $this->friends = $this->user->getFriends();
		$this->articles = $this->user->getArticles();
		$this->twitters = $this->user->getTwitters();
    }

    public function display() {
			echo '
			<!DOCTYPE html>
    		<html>
				<head>
					<title>Aaron - '.$this->user->getName().'</title>
					<meta name="description" content="Page de l\'utilisateur de Aaaron">
					<meta name="keywords" content="aaron, flux, source, données, blog, twitter, categorie, email, mail, rss, feed, article">
					<link rel="stylesheet" type="text/css" href="/src/style/user.css" />
					<link rel="stylesheet" type="text/css" href="/src/style/general.css" />
					<link rel="shortcut icon" href="/src/images/favicon.ico" type="image/x-icon">
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
					<script type="text/javascript" src="/src/js/menu.js"></script>
					<script type="text/javascript" src="/src/js/user_preference.js"></script>
					<script type="text/javascript" src="/src/js/switch_content.js"></script>
					<script type="text/javascript" src="/src/js/search.js"></script>
					<script type="text/javascript" src="/src/js/readUrl.js"></script>
					<script type="text/javascript" src="/src/js/popup.js"></script>
					<script type="text/javascript" src="/src/js/ajaxUser.js"></script>
				</head>
				<body>
					<div id="top">
						<img class="top_logo" src="/src/images/aaron_logo.png">
						<div class="top_user"><button class="top_user_btn noborder" type="button"><img width="100%" height="100%" src="' . $this->user->getAvatar() . '"></button><span class="top_user_name">' . $this->user->getName() . '</span></div>
						<button onclick="disconnect()" class="top_deconnection_btn noborder" type="button"></button>
					</div>

					<!-- LEFT SIDE -->
					<div id="menu">
			        	<div id="LTBar">
							<input id="search" name="search" type="search" placeholder="Recherche"/>
							<button class="imageButton search_btn noborder" type="button"></button>
						</div>
						<div id="categorie_panel" class="panel searchOn">';
							if (empty($this->categories)) {
								echo '<button id="add_categorie" class="no_categorie default_block_panel noborder">Vous n\'avez pas de catégorie, ajouter en une !</span>';
							} else {
								echo '<button id="all_categories" onclick="allCategories()" class="default_block_panel noborder" type = "button" value = "all" > Tout afficher </button >';
								foreach ($this->categories as $c) {
									echo '<button class="categorie default_block_panel noborder" type="button" style="background-color:' . $c->getColor() . ';" value="' . $c->getName() . '">' . $c->getName() . '</button>';
								}
							}
						echo '
						</div>
						<div id="friend_panel" class="panel searchOn hide"> ';
							foreach ($this->friends as $f) {
								echo '<button onclick="focusThisFriend(' . $f->getId() . ')" class="friend default_block_panel noborder" value="' . $f->getName() . '" type="button">' . $f->getName() . '<img onclick="deleteFriend(' . $f->getId() . ')" class="flux_with_image" src="/src/images/del_btn.png"></button>';
							}echo '
						</div>';
						foreach ($this->categories as $c) {
							echo '<div id="' . $c->getName() . '_panel" class="panel flux_Panel searchOn hide">
												<button class="block_del_categorie noborder" onclick="deleteCategorie(' . $c->getId() . ',\'' . $c->getName() . '\')" type="button">Supprimer cette catégorie</button>
												<button class="default_block_panel backflux_btn noborder"><span class="flux_name">Retour</span></button>';
							foreach ($c->getFlux() as $in) {
								($in->isFavorite() == true) ? $et = 'on' : $et = 'off';
								$rgb = hex2rgb($c->getColor());
								echo '<button onclick="focusToThisRSSFeed(\'' . $in->getUrl() . '\')" class="default_block_flux flux noborder" value="' . $in->getName() . '" type="button" style="background-color:rgba(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ',0.5);"><span class="flux_name">' . $in->getName() . '</span></button><div style="background-color:rgba(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ',0.5);" class="default_action_flux"><img onclick="deleteFlux(' . $in->getId() . ',' . $c->getId() . ')" class="flux_with_image" src="src/images/del_btn.png"><img onclick="changeFavoriteRSSFeed(this,' . $in->getId() . ',' . $c->getId() . ',\'' . $in->getName() . '\',' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ')" class="flux_with_image" src="/src/images/favorite_' . $et . '.png"></div>';
							}
							echo '</div>';
						}
						echo '
						<div id="favorite_panel" class="panel searchOn hide">';
						foreach ($this->categories as $c) {
							foreach ($c->getFlux() as $in) {
								if ($in->isFavorite() == false) continue;
								$rgb = hex2rgb($c->getColor());
								echo '<button onclick="focusToThisRSSFeed(\'' . $in->getUrl() . '\')" class="default_block_panel flux noborder" type="button" value="' . $in->getName() . '" style="background-color:rgba(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ',0.5);">' . $in->getName() . '</button>';
							}
						}
						echo ' </div>
						<div id="LBBar">
							<button class="add_source_btn LBBar_btn noborder" type="button"></button><button class="add_article_btn LBBar_btn noborder" type="button"></button>
						</div>
			    	</div>

			    	<!-- PAGE CONTENT -->
			    	<div id="page">
			    		<div id="leftSmallMenu">
			    			<button class="menu_btn noborder close_btn" type="button"></button>
			    			<button class="menu_btn noborder open_btn" type="button"></button>
			    			<button class="menu_btn noborder all_btn" type="button"></button>
			    			<button class="menu_btn noborder favorite_btn" type="button"></button>
			    			<button class="menu_btn noborder friend_btn" type="button"></button>
			    			<div class="menu_btn"></div>
			    			<button class="menu_btn noborder actu_btn" type="button"></button>
			    			<button class="menu_btn noborder twitter_btn" type="button"></button>
			    			<button class="menu_btn noborder blog_btn" type="button"></button>
			    			<button class="menu_btn noborder blog_friend_btn" type="button"></button>
			    			<button class="menu_btn noborder mail_btn" type="button"></button>
			    		</div>

						<div id="content">
							<div id="content_flux" class="content">
								<div id="topscroll"></div>';
							if(empty($this->flux)) {
								echo 'Vous ne suivez pas flux actuellement';
							}
							foreach($this->flux as $article) {
								echo $article->display();
							}
							echo '
								<a class="scroll" href="#topscroll">Remonter</a>
							</div>



							<div id="content_blog" class="content hide">
								<div id="topscrollb"></div>';
								if(empty($this->articles)) {
									echo 'Vous n\'avez pas encore publié d\'article';
								}
								foreach ($this->articles as $article) {
									echo $article->display(true);
								}
								echo '<a class="scroll" href="#topscrollb">Remonter</a>
							</div>


							<div id="content_mail" class="content hide">
								<div id="topscrollm"></div>
								<div class="content_mail_select">
									<h1>Vos mails, partout avec vous !</h1>
									<select id="selector_mailbox">';
										if(empty($this->user->getMailBox())) {
											echo '<option value="none">Aucune boite de réception</option></select>
													<button id="add_mail" class="content_action_btn noborder">Ajouter</button>';
										} else {
											foreach ($this->user->getMailBox() as $mailBox) {
												echo '<option value="' . $mailBox->getAddress() . '">' . $mailBox->getAddress() . '</option>';
											}
											echo '</select><button onclick="loadMail()" class="content_action_btn noborder" type="button">Afficher</button><button onclick="deleteMail()" class="content_action_btn noborder" type="button">Supprime ce compte</button>';
										}
								echo '<span class="load_mail_information load_information"></span></div>
								<div class="content_mail_rest"></div><a class="scroll" href="#topscrollm">Remonter</a>
							</div>
							<div id="content_friend_blog" class="content hide">
								<div id="topscrollf"></div>';
							if(empty($this->friends)) {
								echo 'Vous ne suivez personne sur Aaron
									<button id="add_friend" class="content_action_btn noborder">Ajouter</button>';
							}
							$nbArt = 0;
							foreach ($this->friends as $friend) {
								$nbArt = $nbArt + count($friend->getArticles());
								foreach ($friend->getArticles() as $article) {
									echo $article->display();
								}
							}
							if(!empty($this->friends) && $nbArt == 0) {
								echo 'Vos amis n\'ont pas publié d\'articles';
							}
							echo '
							<a class="scroll" href="#topscrollf">Remonter</a></div>
							<div id="content_twitter" class="content hide">
								<div id="topscrollt"></div>
								<div class="content_twitter_select">
									<h1>Vos célébritées sont avec vous !</h1>
									<select id="selector_twitter">';
									if(empty($this->twitters)) {
										echo '<option value="none">Vous suivez personne sur Twitter</option></select>
												<button id="add_twitter" class="content_action_btn noborder">Ajouter</button>';
									} else {
										foreach ($this->user->getTwitters() as $twitter) {
											echo '<option value="' . $twitter . '">' . $twitter . '</option>';
										}
										echo '</select><button onclick="loadTwitter()" class="content_action_btn noborder" type="button">Filtrer</button><button onclick="deleteTwitter()" class="content_action_btn noborder" type="button">Ne plus suivre</button>';
									}
								echo '<span class="load_twitter_information load_information"></span></div>
								<div class="content_twitter_rest"></div>
								<a class="scroll" href="#topscrollt">Remonter</a>
							</div>

						</div>
			    	</div>
			    	<!-- END PAGE CONTENT -->

			    	<!-- PREFERENCE -->
			    	<div id="user_information" class="hide">
			    		<div class="user_information_top">
                            <button id="close_user_information" class="user_information_top_btn" type="button"><img width="100%" height="100%" src="' . $this->user->getAvatar() . '"></button><div class="user_information_top_foll"><img alt="Personnes qui vous suit" src="/src/images/follower.png">' . $this->user->getNbFollowers() . '<img alt="Personnes que vous suivez" src="/src/images/follow.png">' . $this->user->getNbFollows() . '</div><span class="user_information_top_name">' . $this->user->getName() . '</span>
                        </div>
			    		<div class="user_information_rest">
			    			<button class="actu_btn user_information_rest_btn noborder" type="button">Actualités</button>
							<button class="blog_btn user_information_rest_btn noborder" type="button">Mon blog</button>
							<button class="perso_btn user_information_rest_btn noborder" type="button">Options personnelles</button>
                        </div>
			    	</div>
			    	<!-- END PREFERENCE -->
			    	
					<!-- POP-UP FLUX -->
					<div id="overlay_flux" class="overlay"></div>
			        <div id="popup_source" class="popup_source popup">
			        	<div class="pop_selector pop_add">
			        		<h1>Selectionner un type d\'import </h1>
			        		<select id="selector">
			        			<option value="pop_add_categorie">Une catégorie</option>
			        			<option value="pop_add_flux">Un flux</option>
			        			<option value="pop_add_mail">Un compte mail</option>
			        			<option value="pop_add_friend">Suivre une personne sur Aaron</option>
			        			<option value="pop_add_twitter">Suivre une personne sur Twitter</option>
			        		</select>
			        		<div class="selector_button">
			        			<button id="begin" type="button" class="noborder">Commencer</button><button id="end" type="button" class="noborder">Annuler</button>
			        		</div>
			        	</div>
			        	<div class="pop_add pop_add_categorie hide">
			        		<div class="sep"></div>
			        		<form id="F_categorie"  method="post">
								<input class="smallInput actionnable_lb" name="name" type="text" placeholder="Nom" required/>
								<input class="smallInput actionnable_lb" name="color" type="color" placeholder="Couleur" required/>
					    		<input id="add_categorie" class="smallInput" onclick ="addCategory(this)" name="submit" type="button" value="Créer"/><button id="btnCancel" class="smallInput" type="reset" form="F_categorie">Effacer</button>
							</form>
							<span class="category_information information"></span>
			        	</div>
			            <div class="pop_add pop_add_flux hide">
			            	<div class="sep"></div>
							<form id="F_flux" method="post">
								<input class="smallInput actionnable_fl" name="name" type="text" placeholder="Nom" required/>
								<input class="smallInput actionnable_fl" name="categorie" type="text" placeholder="Categorie" required/>
					    		<input class="bigInput actionnable_fl" name="urlFlux" type="text" placeholder="Url du flux" required/>
					    		<input class="smallInput" name="submit" type="button" onclick="addRSSFeedCategoryUser(this)" value="Ajouter"/><button id="btnCancel" class="smallInput" type="reset" form="F_flux">Effacer</button>
							</form>
							<span class="flux_information information"></span>
						</div>
						<div class="pop_add pop_add_mail hide">
			            	<div class="sep"></div>
			            	<form id="F_mail" method="post">
								<input class="smallInput actionnable_ma" name="mail" type="email" placeholder="Email" required/>
								<input class="smallInput actionnable_ma" name="pass" type="password" placeholder="Mot de passe" required/>
								<input class="smallInput actionnable_ma" name="server" type="text" placeholder="Serveur email" required/>
								<input class="smallInput actionnable_ma" name="port" type="number" placeholder="Port email" required/>
					    		<input class="smallInput" name="submit" type="button" onclick="addEmail(this)" value="Ajouter"/><button id="btnCancel" class="smallInput" type="reset" form="F_mail">Effacer</button>
							</form>
							<span class="mail_information information"></span>
						</div>
						<div class="pop_add pop_add_friend hide">
			            	<div class="sep"></div>
			            	<form id="F_friend" method="post">
			            		<input class="smallInput actionnable_fr" name="name" type="text" placeholder="Qui souhaitez-vous suivre sur Aaron ?" required/>
			            		<input class="smallInput" name="submit" type="button" onclick="searchUser(this)" value="Chercher"/>
			            	</form>
			            	<span class="friend_information information"></span>
			            	<div id="researchResult" class="pop_add_friend_result hide"></div>
						</div>
						<div class="pop_add pop_add_twitter hide">
			            	<div class="sep"></div>
			            	<form id="F_twitter" method="post">
			            		<input class="smallInput actionnable_tw" name="name" type="text" placeholder="Qui souhaitez-vous suivre sur Twitter?" required/>
			            		<input class="smallInput" name="submit" type="button" onclick="searchTwitter(this)" value="Suivre"/>
			            	</form>
			            	<span class="twitter_information information"></span>
						</div>
			        </div>

			        <!-- POP-UP WRITTING ARTICLE -->
			        <div id="overlay_blog" class="overlay"></div>
			        <div id="popup_blog" class="popup_blog popup">
			        	<div id="writting_zone">
			        		<div class="writting_zone_image">
			        			<img id="preview_img_blog" class="preview_img_blog" src="#" />
			        		</div>
			        		<div class="writting_zone_text">
			        			<form id="F_blog" method="post">
			        				<input class="small_input actionnable_wr" type="text" name="title" placeholder="Titre" required/><input class="small_input actionnable_wr" type="text" name="theme" placeholder="Theme" required/>
			        				<input id="imgSelection" class="big_input actionnable_wr" type="text" name="title" placeholder="Lien de l\'image" required/>
			        				<textarea class="content_input actionnable_wr" name="content" form="F_blog"></textarea>
			        				<button id="add_article" class="action_btn noborder" type="button" form="F_blog" onclick="addArticle(this)">Publier</button><button id="F_cancel_btn" class="action_btn noborder" type="reset" form="F_blog">Annuler</button>
			        			</form>
			        		</div>
			        	</div>
			        </div>

			        <!-- POP-UP SETTING -->
			        <div id="overlay_setting" class="overlay"></div>
			        <div id="popup_setting" class="popup_setting popup">

						<h2>TOUT LES SETTINGS ICI, ON PEUT FAIRE SOUS FAIRE DE FORMULAIRE AVEC TOUT DE PRET REMPLI COMME :</h2><br/>
						<table>
						<tr>
							<td>Mon nom : </td>
							<td><input type="text" class="actionnable_ou" name="nom" value=""/></td>
						</tr>
						<tr>
							<td>Mon email : </td>
							<td><input type="email" class="actionnable_ou" name="email" value=""/></td>
						</tr>
						<tr>
						<td>Mon avatar : </td>
						<td><input type="text" class="actionnable_ou" name="avatar" value=""/><br/></td>
						</tr>
						<tr>
						<td><input onclick="optionsChange()" name="submit" type="button" value="Update"><br/></td>
						</tr>
						<tr>
						<td>Si vous laissez un champ vide, il ne sera pas mit à jour<br/></td>
						</tr>
						<tr>
						<td>Changer de mot de passe :<br/></td>
						</tr>
						<form method="post" action="/reset">
						<tr>
						<td><input type=password" name="password1" placeholder="Nouveau mot de passe"/><br/></td>
						</tr>
						<tr>
						<td><input type="password" name="password2"placeholder="Vérification"/><br/></td>
						</tr>
						<tr>
						<td><input type="submit" name="Changer mot de passe" value="Changer mot de passe"/></td>
						</tr>
						<tr>
						<td><input type="button" onclick="quitterOption()" name="Annuler" value="Annuler"/></td>
						</tr>
						</form>
						</table>

			        </div>

			        <!-- POP-UP WARNING -->
			        <div id="overlay_warning" class="overlay"></div>
			        <div id="popup_warning" class="popup_warning popup">
			        	<div id="warning_zone">
			        		<h1>Attention, êtes-vous sur de ce que vous faites ?</h1>
							<div class="warning_zone_categorie hide">
							</div>
			        	</div>
			        </div>
			        <!-- END POP-UP -->
				</body>
			</html>
    	';
    }
}