<?

include_once("ModelPDO.php");

class UserModel extends ModelPDO {

    private $joinlist;

    private function log_with_id ($id) {
        $_SESSION["logged"] = true;
        $_SESSION["ID"] = $id;
    }

    private function de_log() {
        if ($_SESSION["logged"] === true)
            session_unset();
    }

    public function __construct() {
    parent::__construct();
        $this->table = "USERS";
    }

    public function login_with_password ($mail,$password) {
        $this->de_log();

        $this->pdo->prepare("
            SELECT ID, PASSWORD, PASSWORD.TOKEN as TOK
            from USERS
            JOIN ON PASSWORD ON PASSWORD.ID = USERS.ID
            WHERE USERS.EMAIL = ?");

        $this->pdo->execute(array($mail));
        $stmt = $this->pdo->fetch(\PDO::FETCH_ASSOC);

        if ($this->pdo->rowCount() !== 1) {
            //error, un-existing or multi existing users with this mail
            return false;
        }

        $token = $stmt["TOK"];
        $stored_hashed_pwd = $stmt["PASSWORD"];

        $hashed_pwd = encrypt($password,$token);

        if ($hashed_pwd !== $stored_hashed_pwd)
        {
            //bad password
            return false;
        }

        $this->log_with_id($stmt["ID"]);
        return true;
    }

    public function login_with_validation ($validation) {
        $this->de_log();

        $this->pdo->prepare("CALL REQUEST_USER_FROM_TOKEN (?)");
        $this->pdo->execute(array($validation));

        $stmt = $this->pdo->fetch(\PDO::FETCH_ASSOC);

        if ($this->pdo->rowCount() !== 1) {
            //error, un-existing or multi existing users with this validation token
            return false;
        }

        $this->log_with_id($stmt["ID"]);
    }

    public function reset_password ($validation,$password) {
        $this->de_log();

        $loop = false;
        for (;!$loop;)
            $token = random_string_token(64,$loop);

        $this->pdo->prepare("SELECT * FROM USERS WHERE ID=(SELECT REPLACE_USER_PASSWORD(?,?,?) AS ID_P)");
        $this->pdo->execute(array($validation,encrypt($password,$token),$token));

        $stmt = $this->pdo->fetch(\PDO::FETCH_ASSOC);
        if ($this->pdo->rowCount() !== 1) {
            //error, un-existing or multi existing users with this validation token
            return false;
        }
        $this->log_with_id($stmt["ID"]);
    }


    public function request_password_change ($mail) {
        if ($_SESSION["logged"] === true) {
            return "";
        }
        $loop = true;
        $token = random_string_token(20,$loop);
        for (;!$loop;)
            $token = random_string_token(20,$loop);


        $this->pdo->prepare("
            SELECT ID
            from USERS
            WHERE USERS.EMAIL = ?");

        $this->pdo->execute(array($mail));
        $stmt = $this->pdo->fetch(\PDO::FETCH_ASSOC);

        if ($this->pdo->rowCount() !== 1) {
            //error, un-existing or multi existing users with this mail
            return "";
        }

        //mail exists,
        //send a new mail and sets a token to caller.

        $this->pdo->prepare("UPDATE USERS SET TOKEN = ? WHERE ID=?");
        $this->pdo->execute(array($token,$stmt["ID"]));



        return $token;
    }


    public function create_new_user(User $user,$password,$key) {

        $crypto_strong = true;
        $token = random_string_token(64,$crypto_strong);


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

    protected function getSpecific()
    {
        return $this->joinlist;
    }
}