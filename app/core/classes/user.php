<?php
class Users extends Connection
{
    private $table = 'tbl_users';
    public $pk = 'user_id';
    public $name = 'user_fullname';
    public $session = array();

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
}
