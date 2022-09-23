<?php
class Properties extends Connection
{
    private $table = 'tbl_properties';
    public $pk = 'property_id';
    public $name = 'property_code';
    public $session = array();

    public function add()
    {
        $property_code        = $this->generateRandomString(6);
        $property_name        = $this->clean($this->inputs['property_name']);
        $property_owner       = $_SESSION['user']['id']; //$this->clean($this->inputs['property_owner']);
        $property_coordinates = $this->clean($this->inputs['property_coordinates']);
        $property_address     = $this->clean($this->inputs['property_address']);

        $form = array(
            'property_code'         => $property_code,
            'property_name'         => $property_name,
            'user_id'               => $property_owner,
            'property_coordinates'  => $property_coordinates,
            'property_address'      => $property_address
        );
        return $this->insert($this->table, $form);
    }

    public function datatable()
    {
        $response['data'] = [];
        $result = $this->select($this->table, '*', "user_id = '" . $_SESSION['user']['id'] . "'");
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $map = "<a href='index.php?q=view_map&coord=$row[property_coordinates]'><i class='mdi mdi-google-maps'></i></a>";
            array_push($response['data'], [
                'count'         => $count++,
                'property_id'   => $row['property_id'],
                'property_code' => $row['property_code'],
                'property_name' => $row['property_name'],
                'holder'        => Users::name($row['user_id']),
                'address'       => $row['property_address'],
                'map'           => $map,
                'date_added'    => date("F d, Y", strtotime($row['date_added'])),
            ]);
        }

        return json_encode($response);
    }
}
