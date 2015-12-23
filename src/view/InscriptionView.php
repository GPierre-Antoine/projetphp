<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 22:01
 */

include_once('View.php');

class InscriptionView extends View {

    public function __construct($model) {
        $this->model = $model;
    }// ViewIndex

    public function display() {
        echo "
        <html>
          <head>
        		<title>Aaron</title>
        		<link rel='stylesheet' type='text/css' href='index.css' />
          </head>
          <body>
            <div id='fullpage'>
        		    <div class='section' data-anchor='index' id='index'>
        		    	<div id='signIndex'>
        			    	<button id='register' class='buttonIndex selected' type='button'> ".$this->model->inscription."</button>
        			    	<button id='login' class='buttonIndex' type='button'>".$this->model->connection."</button>
        			    	<div id='formRegister' class='form'>
        			    		<form action='#' method='post'>
        			    			<input class='smallInput' name='fName' type='text' placeholder='". $this->model->firstName."' required/>
        			    			<input class='smallInput' name='lName' type='text' placeholder='".$this->model->name."' required/> <br/>
        			    			<input class='smallInput' name='pwd0' type='password' placeholder='".$this->model->password."' required/>
        			    			<input class='smallInput' name='pwd1' type='password' placeholder='".$this->model->repassword."' required/><br/>
        			    			<input class='bigInput' name='mail' type='email' placeholder='".$this->model->email."' required/><br/>
        			    			<input id='submitIndex' name='action' type='submit' value='".$this->model->submitation."' />
        			    		</form>
        			    	</div>
        			    	<div id='formLogin' class='hide form'>
        			    		<form action='#' method='post'>
        			    			<input class='smallInput' name='mail' type='email' placeholder='".$this->model->email."' required/>
        			    			<input class='smallInput' name='pwd' type='password' placeholder='".$this->model->password."' required/>
        			    			<input id='submitIndex' name='action' type='submit' value='".$this->model->submitation."' />
        			    		</form>
        			    	</div>
        		    	</div>
        		    </div>
        		    <div class='section' data-anchor='propos' id='propos'>
        		    	caca mdrrr
        		    </div>
        		</div>
          </body>
        </html>";
    }// render
}
