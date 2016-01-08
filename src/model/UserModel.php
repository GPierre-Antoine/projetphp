<?

include_once("ModelPDO.php");

class UserModel extends ModelPDO {

    private $joinlist;

    public function __construct() {
    parent::__construct();
        $this->table = "USERS";
    }

    public function create_new_user(User $user,$password,$token) {
        $this->pdo->prepare("INSERT INTO `USERS` (`EMAIL`,`NAME`,`ENABLE`) VALUES (?,?,0)");
        $this->pdo->execute(array($user->getEmail(),$user->getName()));

        $id = $this->pdo->lastInsertId();

        $passdb = new \db\db_handler();
        $passdb->prepare("INSERT INTO `PASSWORD` (`ID`,`PASSWORD`,`TOKEN`) VALUES (?,?,?)");
        $passdb->execute(array($passdb->lastInsertId(),encrypt($password,$token),$token));
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