<?

include_once("ModelPDO.php");

class UserModel extends ModelPDO {

    private $joinlist;

    public function __construct() {
    parent::__construct();
        $this->table = "USERS";
    }

    public function insert(/*do_it*/) {

    }

    public function select_user_by_id($uid) {
        parent::change_option("WHERE ID = ?");
        $this->spec = $uid;
    }

    public function select_user_by_mail($mail) {
        parent::change_option("WHERE EMAIL = ?");
        $this->spec = $mail;
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