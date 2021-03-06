<?

include_once("ModelPDO.php");

class UserModel extends ModelPDO {


    private $state;

    public function setStrategy($state) {
        $this->state = $state;

    }

    public function getStrategy() {
        return $this->state;
    }

    private $joinlist;

    private function getRandomToken($nb = 64,&$crypto_strong = true) {
        return random_string_token($nb,$crypto_strong);
    }

    private function fetch($style = \PDO::FETCH_ASSOC) {
        return $this->pdo->fetch($style);
    }

    private function webserver_log_with_id ($id,$privi = null) {
        $_SESSION["logged"] = true;
        $_SESSION["ID"] = $id;
        if ($privi !== null)
            $_SESSION["admin"]=$privi;
    }

    private function de_log() {
        if ($_SESSION["logged"] === true)
        {
            //session_unset();
        }
        $_SESSION["logged"] = false;
    }

    private function privilege_set ($privilege_type) {
        $_SESSION["admin"] = $privilege_type;
    }

    public function __construct() {
    parent::__construct();
        $this->table = "USERS";
    }

    public function login_with_password ($mail,$password) {
        $this->de_log();
        $this->pdo->prepare("
            SELECT USERS.ID, PASSWORD, PASSWORD.TOKEN
            FROM USERS, PASSWORD
            WHERE PASSWORD.ID = USERS.ID
            AND EMAIL = ?");

        $this->pdo->execute(array($mail));
        $stmt = $this->pdo->fetch(\PDO::FETCH_NUM);


        if ($this->pdo->rowCount() !== 1) {
            //error, un-existing
            return -1;
        }

        $token = $stmt[2];
        $stored_hashed_pwd = $stmt[1];

        $hashed_pwd = encrypt($password,$token);

        if ($hashed_pwd !== $stored_hashed_pwd)
        {
            //bad password
            return 1;
        }

        $this->pdo->prepare("UPDATE USER_INFORMATION SET NB_CONNECTION = NB_CONNECTION +1 WHERE ID=?");
        $this->pdo->execute(array($stmt[0]));
        $this->webserver_log_with_id($stmt[0]);
        return 0;
    }

    public function login_with_validation ($validation) {
        $this->de_log();
        $this->pdo->prepare("CALL REQUEST_USER_FROM_TOKEN (?)");
        $this->pdo->execute(array($validation));

        $stmt = $this->fetch();

        echo "<br/>";
        echo $this->pdo->rowCount();
        echo "<br />";
        if ($this->pdo->rowCount() !== 1) {
            //error, un-existing or multi existing users with this validation token
            return false;
        }

        $this->webserver_log_with_id($stmt["ID"]);

    }

    public function reset_password_with_id ($id,$password) {
        // needs to be sure he is the right guy !
        //change user password
        $token = $this->getRandomToken();

        $ar = array(encrypt($password,$token),$token,$id);

        $this->pdo->prepare("UPDATE PASSWORD SET PASSWORD=? , TOKEN=? WHERE ID=?");
        $this->pdo->execute($ar);

        //$this->privilege_set($stmt["PRIVILEGE"]);

    }

    public function request_password_change ($mail) {
        $this->de_log();

        $token = $this->getRandomToken(32);

        $this->pdo->prepare("
            SELECT ID
            from USERS
            WHERE USERS.EMAIL = ?");

        $this->pdo->execute(array($mail));
        $stmt = $this->fetch();


        if ($this->pdo->rowCount() !== 1) {
            //error, un-existing or multi existing users with this mail
            throw new LoginException("Encountering non-unique token");
        }

        //mail exists,
        //send a new mail and sets a token to caller.

        $this->pdo->prepare("UPDATE USERS SET TOKEN = ? WHERE ID=?");
        $this->pdo->execute(array($token,$stmt["ID"]));

        //no connection, because it shouldn't

        return $token;
    }


    public function create_new_user(User $user,$password,$key) {

        $token = $this->getRandomToken();


        $this->pdo->prepare("INSERT INTO `USERS` (`EMAIL`,`NAME`,`ENABLE`,`TOKEN`) VALUES (?,?,0,?)");
        $this->pdo->execute(array($user->getEmail(),$user->getName(),$key));

        $id = $this->pdo->lastInsertId();


        $new_password = encrypt($password,$token);

        $passdb = new \db\db_handler();
        $passdb->prepare("INSERT INTO `PASSWORD` (`ID`,`PASSWORD`,`TOKEN`) VALUES (?,?,?)");
        $passdb->execute(array($id,$new_password,$token));
    }




    public function select () {
        $numarg = func_num_args();
        $args   = func_get_args();
        for ($i = 0;$i<$numarg;++$i)
        {
            $this->spec[] = $args[$i];
        }
    }

    public function select_user_by_id() {
        parent::change_option("WHERE ID = ?");
    }

    public function select_user_by_mail() {
        parent::change_option("WHERE EMAIL = ?");
    }
    public function join ($list) {
        $numarg = func_num_args();
        $args   = func_get_args();
        for ($i = 0;$i<$numarg;++$i)
        {
            $this->joinlist .= "JOIN $args[$i] ON $this->table.ID = $args[$i].ID \n";
        }

    }

    public function isAdmin($id) {
        $sql = 'SELECT COUNT(*) FROM USERS_PRIVILEGES WHERE ID = (SELECT ID FROM USERS WHERE ID = ?)';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($id));
        $stmt = $this->pdo->fetch(\PDO::FETCH_NUM);
        $privi = "";
        if($stmt[0] != 0) {
            $sql = 'SELECT * FROM USERS_PRIVILEGES WHERE ID = (SELECT ID FROM USERS WHERE ID = ?)';
            $this->pdo->prepare($sql);
            $this->pdo->execute(array($id));
            $result = $this->pdo->fetch(\PDO::FETCH_ASSOC);
            $privi = $result['LIBELLE'];
        }
        return $privi;
    }

    function CheckMailAdress($adresse)
    {
        //Adresse mail trop longue (254 octets max)
        if(strlen($adresse)>254)
        {
            return '<p>Votre adresse est trop longue.</p>';
        }

        /*Caractères non-ASCII autorisés dans un nom de domaine .eu :

        $nonASCII='ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
        $nonASCII.='ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
        $nonASCII.='ũūŭůűųŵŷźżztșțΐάέήίΰαβγδεζηθικλμνξοπρςστυφ';
        $nonASCII.='χψωϊϋόύώабвгдежзийклмнопрстуфхцчшщъыьэюяt';
        $nonASCII.='ἀἁἂἃἄἅἆἇἐἑἒἓἔἕἠἡἢἣἤἥἦἧἰἱἲἳἴἵἶἷὀὁὂὃὄὅὐὑὒὓὔ';
        $nonASCII.='ὕὖὗὠὡὢὣὤὥὦὧὰάὲέὴήὶίὸόὺύὼώᾀᾁᾂᾃᾄᾅᾆᾇᾐᾑᾒᾓᾔᾕᾖᾗ';
        $nonASCII.='ᾠᾡᾢᾣᾤᾥᾦᾧᾰᾱᾲᾳᾴᾶᾷῂῃῄῆῇῐῑῒΐῖῗῠῡῢΰῤῥῦῧῲῳῴῶῷ';
        */

        $messagerie = 'free';
        $messagerie.= 'orange';
        $messagerie.= 'gmail';
        $messagerie.= 'hotmail';


        $syntaxe="#^[\w-.]{1,64}@[$messagerie]{2,253}\.[[:alpha:].]{2,6}$#";

        if(preg_match($syntaxe,$adresse))
        {
            return true ;
        }
        else
        {
            return false;
        }
    }

    protected function getSpecific()
    {
        return $this->joinlist;
    }
}