<?php
class Departments extends Connection
{
    private $table = 'tbl_departments';
    public $pk = 'department_id';
    public $name = 'department_code';
    public $session = array();

    public function add()
    {
        $department_id          = $this->clean($this->inputs['department_id']);
        $department_code        = $this->generateRandomString(6);
        $department_name        = $this->clean($this->inputs['department_name']);
        $department_owner       = $this->clean($this->inputs['department_owner']);
        $department_coordinates = $this->clean($this->inputs['department_coordinates']);
        $department_address     = $this->clean($this->inputs['department_address']);

        if ($department_id > 0) {
            $form = array(
                'department_name'           => $department_name,
                'department_coordinates'    => $department_coordinates,
                'department_address'        => $department_address
            );
            return $this->update($this->table, $form, "department_id = '$department_id'");
        } else {
            $form = array(
                'department_code'           => $department_code,
                'department_name'           => $department_name,
                'user_id'                   => $department_owner,
                'department_coordinates'    => $department_coordinates,
                'department_address'        => $department_address
            );
            return $this->insert($this->table, $form);
        }
    }

    public function updateCoordinates()
    {
        $department_id            = $this->clean($this->inputs['department_id']);
        $department_coordinates   = $this->clean($this->inputs['department_coordinates']);
        $department_radius        = $this->clean($this->inputs['department_radius']);
        $form = array(
            'department_radius'       => $department_radius,
            'department_coordinates'  => $department_coordinates
        );
        return $this->update($this->table, $form, "department_id = '$department_id'");
    }

    public function datatable()
    {
        $response['data'] = [];
        $result = $this->select($this->table);
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            array_push($response['data'], [
                'count'         => $count++,
                'department_id' => $row['department_id'],
                'department_code' => $row['department_code'],
                'department_name' => $row['department_name'],
                'coordinates' => $row['department_coordinates'],
                'holder'        => Users::name($row['user_id']),
                'address'       => $row['department_address'],
                'date_added'    => date("F d, Y", strtotime($row['date_added'])),
            ]);
        }

        return json_encode($response);
    }

    public static function option()
    {
        $self = new self;
        $option = "";
        $datatable = json_decode($self->datatable());
        $loop_options = $datatable->data;
        foreach ($loop_options as $row) {
            $option .= "<option value='" . $row->department_id . "'> " . $row->department_name . " </option>";
        }
        return $option;
    }

    public static function dataOf($primary_id, $field = '*')
    {
        $self = new self;
        $result = $self->select($self->table, $field, "$self->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $field == '*' ? $row : $row[$field];
    }
}
