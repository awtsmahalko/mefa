<?php
class IncidentReport extends Connection
{
    private $table = 'tbl_incident_report';
    public $pk = 'ir_id';
    public $name = 'ir_area';
    public $inputs = array();

    public function add()
    {
        $notif_id   = $this->clean($this->inputs['notif_id']);
        $ir_area    = $this->clean($this->inputs['area']);
        $ir_fireout = $this->clean($this->inputs['fireout']);
        $ir_report  = $this->clean($this->inputs['report']);

        $form = array(
            'notif_id'      => $notif_id,
            'ir_area'       => $ir_area,
            'ir_firein'     => Notifications::dataOf($notif_id, 'date_added'),
            'ir_fireout'    => $ir_fireout,
            'ir_report'     => $ir_report,
            'user_id'       => $_SESSION['user']['id']
        );
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $ir_id      = $this->clean($this->inputs['ir_id']);
        $ir_area    = $this->clean($this->inputs['area']);
        $ir_fireout = $this->clean($this->inputs['fireout']);
        $ir_report  = $this->clean($this->inputs['report']);

        $form = array(
            'ir_area'       => $ir_area,
            'ir_fireout'    => $ir_fireout,
            'ir_report'     => $ir_report,
            'user_id'       => $_SESSION['user']['id']
        );

        return $this->update($this->table, $form, "ir_id = '$ir_id'");
    }


    public static function hasNotif($notif_id)
    {
        $self = new self;
        $result = $self->select($self->table, $self->pk, "notif_id = '$notif_id'");
        return $result->num_rows;
    }

    public function datatable()
    {
        $response['data'] = [];
        $result = $this->select($this->table);
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            array_push($response['data'], [
                'count'         => $count++,
                'ir_id'         => $row['ir_id'],
                'notif_id'      => $row['notif_id'],
                'ir_area'       => $row['ir_area'],
                'ir_firein'     => $row['ir_firein'],
                'ir_firein_'    => date("M d, Y h:i A", strtotime($row['ir_firein'])),
                'ir_fireout'    => $row['ir_fireout'],
                'ir_fireout_'   => date("M d, Y h:i A", strtotime($row['ir_fireout'])),
                'ir_report'     => $row['ir_report'],
                'reported_by'   => Users::name($row['user_id']),
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
