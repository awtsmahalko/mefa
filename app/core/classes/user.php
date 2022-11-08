<?php
class Users extends Connection
{
    private $table = 'tbl_users';
    public $pk = 'user_id';
    public $name = 'user_fullname';
    public $session = array();

    public function updateCurrenLocation()
    {
        $coordinates = $this->clean($this->inputs['coordinates']);
        $user_id = $_SESSION['user']['id'];
        return $this->update($this->table, ['coordinates' => $coordinates], "user_id = '$user_id'");
    }

    public function updateProfile()
    {
        $user_id        = $this->clean($this->inputs['user_id']);
        $user_fullname  = $this->clean($this->inputs['user_fullname']);
        $user_address   = $this->clean($this->inputs['user_address']);
        $user_mobile    = $this->clean($this->inputs['user_mobile']);

        $form = array(
            'user_id' => $user_id,
            'user_fullname' => $user_fullname,
            'user_address' => $user_address,
            'user_mobile' => $user_mobile,
        );

        return $this->update($this->table, $form, "user_id = '$user_id'");
    }

    public static function combo()
    {
        $self = new self;
        $select = "<option value=''> &mdash; Please Select &mdash; </option>";
        $result = $self->select($self->table, "user_id,user_fullname", "user_category = 'R'");
        while ($row = $result->fetch_assoc()) {
            $select .= "<option value='$row[user_id]'> $row[user_fullname] </option>";
        }
        return $select;
    }

    public static function name($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, $self->name, "$self->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$self->name];
    }
    public static function token($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_token', "$self->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['user_token'];
    }

    public static function dataOf($primary_id, $field = '*')
    {
        $self = new self;
        $result = $self->select($self->table, $field, "$self->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $field == '*' ? $row : $row[$field];
    }
}
