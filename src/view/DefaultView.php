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

    public function __construct($model) {
        $this->model = $model;

        $this->user = $this->model->getCurrentUser();
        $this->categories = $this->user->getCategories();
        $this->friends = $this->user->getFriends();
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
					<script type="text/javascript" src="/src/js/ajaxUser.js"></script>';
                    echo $this->model->getParam();
                    echo '
				</head>
				<body>
					<!-- TOP SIDE -->
					<div id="top">
						<img class="logo" src="/src/images/aaron_logo.png">
						<div id="TUser"><div id="TUserLogo"><button id="btnUser" class="imageButton" type="button"><img src="/src/images/account.png"></button></div><div id="TUserName"><strong>' .$this->user->getName().'</strong></div></div>
						<a href="#" onclick="javascript:;" class="preference_btn"></a>
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
							$articles = $this->user->getArticles();
							foreach($articles as $article) {
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
			    	<div id="userPreference" class="hide">
			    	    <div id="userPreference_top">
                            <span class="userPreference_top_title">Préférences</span><a href="#" onclick="javascript:;" class="userPreference_top_close"></a>
                        </div>
                    	   <div id="userPreference_rest">
                            <button class="pref_btn" type="button">Options personnelles</button>
                            <button class="pref_btn" type="button">Options Aaron</button>
                            <button id="user_deconnection" class="pref_btn" type="button">Déconnexion</button>
                        </div>
			    	</div>

			    	<div id="userInformation" class="hide">
			    		<div id="userInformation_top">
                            <img class="userInformation_top_img" src="/src/images/account.png"><span class="userInformation_top_name">'.$this->user->getName().'</span>
                        </div>
			    		<div id="userInformation_rest">
			    			<button class="actu_btn user_btn" type="button">Actualités</button>
							<button class="blog_btn user_btn" type="button">Mon blog</button>
                        </div>
			    	</div>
			    	<!-- END PREFERENCE -->
			    	
					<!-- POP-UP FLUX -->
					<div id="overlay_flux" class="overlay"></div>
			        <div id="popup_flux" class="popup_flux">
			            <h1>Ajouter une catégorie</h1>
			        	<div class="add_categorie">
			        		<form id="F_categorie"  method="post">
								<input class="smallInput actionnable_lb" name="name" type="text" placeholder="Nom" required/>
								<input class="smallInput actionnable_lb" name="color" type="color" placeholder="Couleur" required/>
					    		<input id="add_categorie" class="smallInput" onclick ="addCategorie(this)" name="submit" type="button" value="Créer"/><button id="btnCancel" class="smallInput" type="reset" form="F_library">Annuler</button>
							</form>
			        	</div>
			        	<div class="sep"></div>
			        	<h1>Ajouter un flux</h1>
			            <div class="addFlux">
							<form id="F_flux" method="post">
								<input class="smallInput actionnable_fl" name="name" type="text" placeholder="Nom" required/>
								<input class="smallInput actionnable_fl" name="categorie" type="text" placeholder="Categorie" required/>
					    		<input class="bigInput actionnable_fl" name="urlFlux" type="text" placeholder="Url du flux" required/>
					    		<input class="smallInput" name="submit" type="button" onclick="addFlux(this)" value="Ajouter"/><button id="btnCancel" class="smallInput" type="reset" form="F_flux">Annuler</button>
							</form>
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

			        <script type="text/javascript">
			        $(function() {

			            function closePopUp($overlay,$popup) {
			                $($overlay).fadeOut(200);
				            $($popup).css("display", "none");
			            }

				        $(".addF_btn").click(function () {
				            $("#overlay_flux").css({"display":"block", opacity:0});
				            $("#overlay_flux").fadeTo(200,0.5);
				            $("#popup_flux").fadeTo(200,1);
				        });

				        $(".write_btn").click(function () {
				            $("#overlay_blog").css({"display":"block", opacity:0});
				            $("#overlay_blog").fadeTo(200,0.5);
				            $("#popup_blog").fadeTo(200,1);
				        });

				        $("#add_categorie").click(function () {
				            closePopUp("#overlay_flux",".popup_flux");
				        })

				        $("#btnCancel").click(function () {
				            closePopUp("#overlay_flux",".popup_flux");
				        });

				        $("#F_cancel_btn").click(function () {
				            closePopUp("#overlay_blog",".popup_blog");
				        });

				        $("#add_article").click(function () {
				            closePopUp("#overlay_blog",".popup_blog");
				        });
				    });
			        </script>
			        <!-- END POP-UP -->

				</body>
			</html>


    	';
    }
}