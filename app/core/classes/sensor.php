<?php
class Sensors extends Connection
{
    private $table = 'tbl_sensors';
    public $pk = 'sensor_id';
    public $name = 'sensor_code';
    public $session = array();

    public function add()
    {
        $sensor_code        = $this->clean($this->inputs['sensor_code']);
        $sensor_location    = $this->clean($this->inputs['sensor_location']);
        $sensor_coordinates = $this->clean($this->inputs['sensor_coordinates']);
        $sensor_owner       = $_SESSION['user']['id']; //$this->clean($this->inputs['sensor_owner']);
        $sensor_property    = 0; //$this->clean($this->inputs['sensor_property']);

        $fetch = $this->select($this->table, "sensor_id", "sensor_code = '$sensor_code'");
        if ($fetch->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'sensor_coordinates'    => $sensor_coordinates,
                'sensor_code'           => $sensor_code,
                'sensor_location'       => $sensor_location,
                'user_id'               => $sensor_owner,
                'property_id'           => $sensor_property
            );
            return $this->insert($this->table, $form);
        }
    }

    public function datatable()
    {
        $select  = "$this->table AS s,tbl_properties AS p";
        // "sensor_code,s.user_id,s.date_added,property_name,property_address,property_coordinates", "s.property_id = p.property_id";
        $response['data'] = [];
        $result = $this->select($this->table);
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $map = "<a href='index.php?q=view_map&coord=$row[sensor_coordinates]'><i class='mdi mdi-google-maps'></i></a>";
            array_push($response['data'], [
                'count'         => $count++,
                'sensor_code'   => $row['sensor_code'],
                'holder'        => "", //Users::name($row['user_id']),
                'property'      => "", //$row['property_name'],
                'address'       => $row['sensor_location'],
                'map'           => $map,
                'date_added'    => date("F d, Y", strtotime($row['date_added'])),
            ]);
        }

        return json_encode($response);
    }
}
