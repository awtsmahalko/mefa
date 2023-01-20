<?php
class Authentication extends Connection
{
    private $table = 'tbl_users';
    public $pk = 'user_id';
    public $name = 'user_fullname';
    public $session = array();

    public $inputs = array();
    public $old = array();

    public function signup()
    {
        $username = $this->clean($this->inputs['username']);
        $fullname = $this->clean($this->inputs['user_fullname']);
        $address  = $this->clean($this->inputs['user_address']);
        $email    = $this->clean($this->inputs['user_email']);

        $fetch = $this->select($this->table, "user_id,username", "username = '$username' OR user_email = '$email'");
        if ($fetch->num_rows > 0) {
            $this->old = [
                'username'  => $username,
                'name'      => $fullname,
                'address'   => $address,
                'email'     => $email
            ];
            $row = $fetch->fetch_assoc();
            return $row['username'] == $username ? 2 : 3;
        } else {
            $form = array(
                'username'      => $username,
                'password'      => md5($this->inputs['password']),
                'user_fullname' => $fullname,
                'user_address'  => $address,
                'user_email'    => $email,
                'user_category' => 'R'
            );
            $user_id =  $this->insert($this->table, $form, 'Y');
            if ($user_id > 0) {
                $this->session = [
                    'id'        => $user_id,
                    'name'      => $fullname,
                    'category'  => 'Resident',
                    'email'     => $email
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

    public function recover()
    {
        $user_email = $this->clean($this->inputs['user_email']);
        $fetch = $this->select($this->table, "user_id", "user_email = '$user_email' AND user_category = 'R'");
        if ($fetch->num_rows > 0) {
            $row = $fetch->fetch_assoc();
            $user_id = $row['user_id'];
            $otp = $this->generateRandomString(6);
            $this->update($this->table, ['user_otp' => $this->clean($otp)], "user_id = '$user_id'");

            $to = $user_email;
            $subject = "HTML email";

            $message = "
                <html>
                <head>
                <title>HTML email</title>
                </head>
                <body>
                <p>This email contains HTML Tags!</p>
                <table>
                <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                </tr>
                <tr>
                <td>John</td>
                <td>Doe</td>
                </tr>
                </table>
                </body>
                </html>
                ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            // $headers .= 'From: <webmaster@example.com>' . "\r\n";
            // $headers .= 'Cc: myboss@example.com' . "\r\n";

            mail($to, $subject, $message, $headers);
            return 1;
        } else {
            $this->old = [
                'user_email' => $user_email,
            ];
            return 0;
        }
    }

    public function logout()
    {
        session_destroy();
    }
}
