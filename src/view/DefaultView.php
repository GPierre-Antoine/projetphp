<?php
/**
 * Created by Kevin.
 * User: h13002021
 * Date: 21/12/15
 * Time: 22:01
 */

include_once('View.php');

class DefaultView extends View {
    
    public function __construct($model) {
        $this->model = $model;
    }// UserView

    public function display() {
    	echo '
    		<html>
				<head>
					<title>Aaron</title>
					<link rel="stylesheet" type="text/css" href="src/style/user.css" />
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
					<script type="text/javascript" src="src/js/jquery.magnific-popup.js" ></script>
					<script type="text/javascript" src="src/js/aside.js"></script>
					<script type="text/javascript" src="src/js/action.js"></script>
				</head>
				<body>
					<!-- TOP SIDE -->
					<div id="top">
						<img class="logo" src="src/images/aaron_logo.png">
						<div id="TUser"><div id="TUserLogo"><button id="btnUser" class="imageButton" type="button"><img src="src/images/account.png"></button></div><div id="TUserName"><strong>Pierre</strong></div></div>
						<a href="#" onclick="javascript:;" class="preference_btn"></a>
					</div>

					<!-- LEFT SIDE -->
					<div id="menu">
			        	<div id="LTBar">
							<input id="searchInput" name="search" type="search" placeholder="Recherche"/>
							<a href="#" onclick="javascript:;" class="imageButton search_btn"></a>
						</div>
						<div id="LPanel">
							<button class="choicePanel" type="button"><img height="100" width="100" src="src/images/apps.png"/></button>
							<button class="choicePanel" type="button"><img height="100" width="100" src="src/images/apps.png"/></button>
							<button class="choicePanel" type="button"><img height="100" width="100" src="src/images/apps.png"/></button>
						</div>
						<div id="friendPanel" class="hide">
							<div class="friend">
								<img class="img_friend" src="src/images/friend_img.png"><span class="name_friend">Paul</span><a href="#" onclick="javascript:;" class="link_friend"></a>
							</div>
							<div class="friend">
								<img class="img_friend" src="src/images/friend_img.png"><span class="name_friend">Olivier</span><a href="#" onclick="javascript:;" class="link_friend"></a>
							</div>
						</div>
						<div id="LBBar">
							<a href="#" onclick="javascript:;" class="addF_btn"></a><a href="#" onclick="javascript:;" class="lessF_btn"></a>			
						</div>
			    	</div>

			    	<!-- PAGE CONTENT -->
			    	<div id="page">
			    		<div id="leftSmallMenu">
			    			<a href="#" onclick="javascript:;" class="close_btn"></a>
			    			<a href="#" onclick="javascript:;" class="open_btn"></a>
			    			<a href="#" onclick="javascript:;" class="all_btn"></a>
			    			<a href="#" onclick="javascript:;" class="favorite_btn"></a>
			    			<a href="#" onclick="javascript:;" class="friend_btn"></a>
			    		</div>

			    		<div id="content">
			    			prout
			    		</div>
			    	</div>
			    	<!-- END PAGE CONTENT -->

			    	<!-- PREFERENCE -->
			    	<div id="userPreference" class="hide">
			    		<a href="#" onclick="javascript:;" class="pref_close_btn"></a>
			    		<button class="pref_option_btn" type="button">Options</button>
			    		<button class="pref_deconnection_btn" type="button">Déconnexion</button>
			    	</div>

			    	<div id="userInformation" class="hide">
			    		User information here
			    	</div>
			    	<!-- END PREFERENCE -->
			    	
					<!-- POP-UP -->
					<div id="overlay"></div>
			        <div id="popup" class="popup">
			        	<div class="addLibrary">
			        		<form id="F_library" action="" method="">
								<input class="smallInput" name="name" type="text" placeholder="Nom" required/>
								<input class="smallInput" name="color" type="color" placeholder="Couleur" required/>
					    		<input class="smallInput" name="submit" type="submit" value="Créer"/><button id="btnCancel" class="smallInput" type="reset" form="F_library">Annuler</button>
							</form>
			        	</div>
			        	<div class="sep"></div>
			            <div class="addFlux">
							<form id="F_flux" action="" method="">
								<input class="smallInput" name="name" type="text" placeholder="Nom" required/>
								<input class="smallInput" name="color" type="text" placeholder="Couleur" required/>
					    		<input class="bigInput" name="flux" type="text" placeholder="Url du flux" required/> <br/>
					    		<input class="bigInput" name="image" type="text" placeholder="Url de l\'image" /> <br/>
					    		<input class="smallInput" name="submit" type="submit" value="Ajouter"/><button id="btnCancel" class="smallInput" type="reset" form="F_flux">Annuler</button>
							</form>
						</div>
			        </div>
			        <script type="text/javascript">
			        $(function() {
				        var overlay = true;
				        $(".addF_btn").click(function () {
				            $("#overlay").css({"display":"block", opacity:0});
				            $("#overlay").fadeTo(200,0.5);
				            $("#popup").fadeTo(200,1);       
				            overlay = !overlay;   
				        }); 

				        $("#btnCancel").click(function () {
				            $("#overlay").fadeOut(200);
				            $(".popup").css("display", "none"); 
				            overlay = !overlay;
				        });
				    });
			        </script>
			        <!-- END POP-UP -->

				</body>
			</html>


    	';
    }
}