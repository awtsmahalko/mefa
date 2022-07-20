<?php
class Departments extends Connection
{
    private $table = 'tbl_departments';
    public $pk = 'department_id';
    public $name = 'department_code';
    public $session = array();

    public function add()
    {
        $department_code        = $this->generateRandomString(6);
        $department_name        = $this->clean($this->inputs['department_name']);
        $department_owner       = $this->clean($this->inputs['department_owner']);
        $department_coordinates = $this->clean($this->inputs['department_coordinates']);
        $department_address     = $this->clean($this->inputs['department_address']);

        $form = array(
            'department_code'           => $department_code,
            'department_name'           => $department_name,
            'user_id'                   => $department_owner,
            'department_coordinates'    => $department_coordinates,
            'department_address'        => $department_address
        );
        return $this->insert($this->table, $form);
    }

    public function datatable()
    {
        $response['data'] = [];
        $result = $this->select($this->table);
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $map = "<a href='index.php?q=view_map&coord=$row[department_coordinates]'><i class='mdi mdi-google-maps'></i></a>";
            array_push($response['data'], [
                'count'         => $count++,
                'department_code' => $row['department_code'],
                'department_name' => $row['department_name'],
                'holder'        => Users::name($row['user_id']),
                'address'       => $row['department_address'],
                'map'           => $map,
                'date_added'    => date("F d, Y", strtotime($row['date_added'])),
            ]);
        }

        return json_encode($response);
    }
}
