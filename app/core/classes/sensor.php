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
        $sensor_owner       = $this->clean($this->inputs['sensor_owner']);
        $sensor_property    = $this->clean($this->inputs['sensor_property']);

        $fetch = $this->select($this->table, "sensor_id", "sensor_code = '$sensor_code'");
        if ($fetch->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'sensor_code'           => $sensor_code,
                'user_id'               => $sensor_owner,
                'property_id'           => $sensor_property
            );
            return $this->insert($this->table, $form);
        }
    }

    public function datatable()
    {
        $select  = "$this->table AS s,tbl_properties AS p";
        $response['data'] = [];
        $result = $this->select($select, "sensor_code,s.user_id,s.date_added,property_name,property_address,property_coordinates", "s.property_id = p.property_id");
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $map = "<a href='index.php?q=view_map&coord=$row[property_coordinates]'><i class='mdi mdi-google-maps'></i></a>";
            array_push($response['data'], [
                'count'         => $count++,
                'sensor_code'   => $row['sensor_code'],
                'holder'        => Users::name($row['user_id']),
                'property'      => $row['property_name'],
                'address'       => $row['property_address'],
                'map'           => $map,
                'date_added'    => date("F d, Y", strtotime($row['date_added'])),
            ]);
        }

        return json_encode($response);
    }
}
