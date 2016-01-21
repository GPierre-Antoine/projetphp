<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 22:01
 */

include_once('View.php');

class IndexView extends View {
    private $lang;
    
    public function __construct($model) {
        $this->model = $model;

    }// ViewIndex

    public function display() {
        echo "
        <html>
          <head>
        		<title>Aaron</title>
                <meta name='google-signin-scope' content='profile email'>
        		<link rel='stylesheet' type='text/css' href='/src/style/index.css' />
        		<link rel='stylesheet' type='text/css' href='/src/style/general.css' />
                <meta name='google-signin-client_id' content='465981179540-rtkpb0od5g1op6edd11gjt5kq9bcpsfj.apps.googleusercontent.com'>
                <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
                <script src='https://apis.google.com/js/platform.js?onload=renderButton' async defer></script>
                <script type='text/javascript' src='/src/js/jquery.fullPage.js'></script>
                <script type='text/javascript' src='/src/js/indexForm.js'></script>
                <script type='text/javascript'>
                $(document).ready(function() {
                $('#fullpage').fullpage({
                    'verticalCentered': false,
                    'css3': true,
                    'navigation': true,
                    'navigationPosition': 'right',
                    'navigationTooltips': ['Index', 'A propos'],
                    'slidesNavigation' : true,
                    'controlArrows' : false
                });
                $.fn.fullpage.reBuild();
            });
                </script>
                <script type='text/javascript' src='../src/js/indexForm.js' ></script>
          </head>
          <body>
            <div id='fullpage'>
        		    <div class='section' data-anchor='index' id='index'>
        		    	<div id='signIndex'>
                            <div class='menu'>
            			    	<button id='register' class='buttonIndex selected' type='button'> Inscription </button>
            			    	<button id='login' class='buttonIndex' type='button'>Connexion</button>
                            </div>
        			    	<div id='formRegister' class='form'>
        			    		<form action='register' method='post'>
        			    			<input class='smallInput' name='fName' type='text' placeholder='Pr&eacute;nom'/>
        			    			<input class='smallInput' name='lName' type='text' placeholder='Nom'/>
        			    			<input class='smallInput' name='pwd0' type='password' placeholder='Mot de Passe'/>
        			    			<input class='smallInput' name='pwd1' type='password' placeholder='Verification'/>
        			    			<input class='bigInput' name='mail' type='email' placeholder='Adresse Mail'/><br/>
        			    			<input id='submitIndex' name='action' type='submit' value=\"S'inscrire sur Aaron\" />
        			    		</form>
        			    	</div>
        			    	<div id='formLogin' class='hide form'>
        			    		<form action='login' method='post'>
        			    			<input class='smallInput' name='mail' type='email' placeholder='Adresse Mail'/>
        			    			<input class='smallInput' name='pwd' type='password' placeholder='Mot de Passe'/>
        			    			<input id='submitIndex' name='action' type='submit' value='Rentrer sur Aaron'/>
        			    		</form>
                                <a href='forgotpass.php' > Mot de Passe Perdu ? </a>
        			    	</div>
        		    	</div>
        		    </div>
        		    <div class='section' data-anchor='propos' id='propos'>
                        <div class='section-left' data-ancor='propos' id='propos'>
                            <p> Bienvenue sur Aaron-aaron, un site de suivis regroupant actualités,
                            blogs, mails, tout un contenu accesible et modifiable par tous.
                            </br></br>

                            Vous avez aimé un article sur un site, mais il n'est pas présent sur Aaron,
                            ajoutez-le et partagez-le afin que tous le monde puisse le voir.
                            </br></br>

                             Vous souhaitez suivre une célébrité ou une personne en particulier sur Twitter
                             et connaître ses activités ? Ajoutez son twitter.</p>

                        </div>
                        <div class='section-right' data-ancor='propos' id='propos'>
                            <table>
                                <tbody>
                                    <tr>
                                        <td align='center'>
                                            <img src='src/view/picturesIndex/picture_01.jpg'>
                                        </td>
                                        <td align='center'>
                                            <img src='src/view/picturesIndex/picture_02.jpg'>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>

        		    </div>
        		</div>
          </body>
        </html>";
    }// render
}
