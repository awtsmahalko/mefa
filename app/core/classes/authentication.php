<?php
class Authentication extends Connection
{
    private $table = 'tbl_users';
    public $pk = 'user_id';
    public $name = 'user_fullname';
    public $session = array();

    public function signup()
    {
        $username = $this->clean($this->inputs['username']);
        $fullname = $this->clean($this->inputs['user_fullname']);
        $address  = $this->clean($this->inputs['user_address']);

        $fetch = $this->select($this->table, "user_id", "username = '$username'");
        if ($fetch->num_rows > 0) {
            $this->old = [
                'username'  => $username,
                'name'      => $fullname,
                'address'   => $address
            ];
            return 2;
        } else {
            $form = array(
                'username'      => $username,
                'password'      => md5($this->inputs['password']),
                'user_fullname' => $fullname,
                'user_address'  => $address,
                'user_category' => 'R'
            );
            $user_id =  $this->insert($this->table, $form, 'Y');
            if ($user_id > 0) {
                $this->session = [
                    'id'        => $user_id,
                    'name'      => $fullname,
                    'category'  => 'Resident'
                ];
                return 1;
            } else {
                return 0;
            }
        }
    }

    public function login()
    {
        $username = $this->clean($this->inputs['username']);
        $password = md5($this->inputs['password']);

        $fetch = $this->select($this->table, "*", "username = '$username' AND password = '$password'");
        if ($fetch->num_rows > 0) {
            $row = $fetch->fetch_assoc();
            $this->session = [
                'id'        => $row['user_id'],
                'name'      => $row['user_fullname'],
                'category'  => $row['user_category'],
                'username'  => $row['username'],
            ];
            return 1;
        } else {
            $this->old = [
                'username'  => $username,
                'password'  => $this->inputs['password'],
            ];
            return 0;
        }
    }

    public function logout()
    {
        session_destroy();
    }
}
