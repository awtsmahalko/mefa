<?php
class Users extends Connection
{
    private $table = 'tbl_users';
    public $pk = 'user_id';
    public $name = 'user_fullname';
    public $session = array();

    public $inputs = array();

    public function addFireOfficer()
    {
        $username = $this->clean($this->inputs['username']);
        $fullname = $this->clean($this->inputs['user_fullname']);
        $department_id = $this->clean($this->inputs['department_id']);

        $fetch = $this->select($this->table, "user_id", "username = '$username'");
        if ($fetch->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'username'      => $username,
                'password'      => md5($this->inputs['password']),
                'department_id' => $department_id,
                'user_fullname' => $fullname,
                'user_address'  => "",
                'user_category' => 'F'
            );
            return $this->insert($this->table, $form);
        }
    }

    public function datatable()
    {
        $response['data'] = [];
        $result = $this->select($this->table);
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            array_push($response['data'], [
                'count' => $count++,
                'user_id' => $row['user_id'],
                'user_fullname' => $row['user_fullname'],
                'user_address' => $row['user_address'],
                'user_resident_coordinates' => $row['user_resident_coordinates'],
                'user_category' => $row['user_category'],
                'user_mobile' => $row['user_mobile'],
                'department' => Departments::dataOf($row['department_id']),
                'date_added' => date("F d, Y", strtotime($row['date_added'])),
            ]);
        }

        return json_encode($response);
    }

    public function updateCurrenLocation()
    {
        $coordinates = $this->clean($this->inputs['coordinates']);
        $user_id = $_SESSION['user']['id'];
        return $this->update($this->table, ['coordinates' => $coordinates], "user_id = '$user_id'");
    }

    public function updateResidentCoordinates()
    {
        $coordinates = $this->clean($this->inputs['user_resident_coordinates']);
        $user_radius = $this->clean($this->inputs['user_radius']);
        $user_id = $_SESSION['user']['id'];
        return $this->update($this->table, ['user_resident_coordinates' => $coordinates,'user_radius'=>$user_radius], "user_id = '$user_id'");
    }

    public function rnPcoordinates()
    {
        $response = array();
        if ($_SESSION['user']['category'] == 'R') {
            $data_ = $this->dataOf($_SESSION['user']['id']);
            $explode = explode(",", $data_['user_resident_coordinates']);
            array_push($response, [
                'lat' => (float) $explode[0],
                'lng' => (float) $explode[1],
                'marker' => "Residence",
                'radius' => (float) $data_['user_radius'],
            ]);

            $Property = new Properties();
            $dt = json_decode($Property->datatable());
            foreach ($dt->data as $row) {
                $explode = explode(",", $row->coordinates);
                array_push($response, [
                    'lat' => (float) $explode[0],
                    'lng' => (float) $explode[1],
                    'marker' => $row->property_name,
                    'radius' => (float) $row->property_radius,
                ]);
            }
        }

        if ($_SESSION['user']['category'] == 'F') {
            $data_ = Departments::dataOf($_SESSION['user']['department_id']);
            $explode = explode(",", $data_['department_coordinates']);
            array_push($response, [
                'lat' => (float) $explode[0],
                'lng' => (float) $explode[1],
                'marker' => $data_['department_name'],
                'radius' => (float) $data_['department_radius'],
            ]);
        }
        return json_encode($response);
    }

    public function updateProfile()
    {
        $user_id        = $this->clean($this->inputs['user_id']);
        $user_fullname  = $this->clean($this->inputs['user_fullname']);
        $user_address   = $this->clean($this->inputs['user_address']);
        $user_mobile    = $this->clean($this->inputs['user_mobile']);
        $user_email    = $this->clean($this->inputs['user_email']);

        $form = array(
            'user_id' => $user_id,
            'user_fullname' => $user_fullname,
            'user_address' => $user_address,
            'user_mobile' => $user_mobile,
            'user_email' => $user_email,
        );

        $_SESSION['user']['name'] = $user_fullname;
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
