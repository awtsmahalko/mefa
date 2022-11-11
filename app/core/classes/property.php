<?php
class Properties extends Connection
{
    private $table = 'tbl_properties';
    public $pk = 'property_id';
    public $name = 'property_code';
    public $session = array();

    public function add()
    {
        $property_id    = $this->clean($this->inputs['property_id']);

        $property_code        = $this->generateRandomString(6);
        $property_name        = $this->clean($this->inputs['property_name']);
        $property_owner       = $_SESSION['user']['id']; //$this->clean($this->inputs['property_owner']);
        $property_coordinates = $this->clean($this->inputs['property_coordinates']);
        $property_address     = $this->clean($this->inputs['property_address']);

        if ($property_id > 0) {
            $form = array(
                'property_name'         => $property_name,
                'property_coordinates'  => $property_coordinates,
                'property_address'      => $property_address
            );
            return $this->update($this->table, $form, "property_id = '$property_id'");
        } else {
            $form = array(
                'property_code'         => $property_code,
                'property_name'         => $property_name,
                'user_id'               => $property_owner,
                'property_coordinates'  => $property_coordinates,
                'property_address'      => $property_address
            );
            return $this->insert($this->table, $form);
        }
    }

    public function updateCoordinates()
    {
        $property_id            = $this->clean($this->inputs['property_id']);
        $property_coordinates   = $this->clean($this->inputs['property_coordinates']);
        $property_radius        = $this->clean($this->inputs['property_radius']);
        $form = array(
            'property_radius'       => $property_radius,
            'property_coordinates'  => $property_coordinates
        );
        return $this->update($this->table, $form, "property_id = '$property_id'");
    }
    public function datatable()
    {
        $response['data'] = [];
        $result = $this->select($this->table, '*', "user_id = '" . $_SESSION['user']['id'] . "'");
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $map = ""; //"<a href='index.php?q=view_map&coord=$row[property_coordinates]'><i class='mdi mdi-google-maps'></i></a>";
            array_push($response['data'], [
                'count'         => $count++,
                'property_id'   => $row['property_id'],
                'property_code' => $row['property_code'],
                'property_name' => $row['property_name'],
                'property_radius' => $row['property_radius'],
                'holder'        => Users::name($row['user_id']),
                'address'       => $row['property_address'],
                'coordinates'   => $row['property_coordinates'],
                'map'           => $map,
                'date_added'    => date("F d, Y", strtotime($row['date_added'])),
            ]);
        }

        return json_encode($response);
    }
    public static function dataOf($primary_id, $field = '*')
    {
        $self = new self;
        $result = $self->select($self->table, $field, "$self->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $field == '*' ? $row : $row[$field];
    }
}
