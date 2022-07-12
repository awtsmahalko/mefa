<?php
class Posts extends Connection
{
    private $table = 'tbl_posts';
    public $pk = 'post_id';
    public $name = 'post_title';
    public function add()
    {
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'post_content'  => $this->clean($this->inputs['post_content']),
            'post_category' => $this->clean($this->inputs['post_category']),
            'post_status'   => 1
        );
        return $this->insert($this->table, $form);
    }

    public function show()
    {
        // $param = isset($this->inputs['param']) ? $this->inputs['param'] : '';
        $rows = array();
        $result = $this->select($this->table);
        while ($row = $result->fetch_assoc()) {
            $row['post_date']  = date("F d, Y", strtotime($row['post_date']));
            $row['category'] = $row['post_category'] == 'A' ? "note-announcement" : 'note-important';
            $rows[] = $row;
        }

        $response['data'] = $rows;
        return json_encode($response);
    }

    public function timeline()
    {
        $rows = array();
        $result = $this->select($this->table, "*", "post_status = 1 ORDER BY post_date ASC");
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
}
