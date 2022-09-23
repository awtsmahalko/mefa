<?php
class Authentication extends Connection
{
    private $table = 'tbl_users';
    public $pk = 'user_id';
    public $name = 'user_fullname';
    public $session = array();

    public function signup()
    {
        $username = $this->clean($this->inputs['username']);
        $fullname = $this->clean($this->inputs['user_fullname']);
        $address  = $this->clean($this->inputs['user_address']);

        $fetch = $this->select($this->table, "user_id", "username = '$username'");
        if ($fetch->num_rows > 0) {
            $this->old = [
                'username'  => $username,
                'name'      => $fullname,
                'address'   => $address
            ];
            return 2;
        } else {
            $form = array(
                'username'      => $username,
                'password'      => md5($this->inputs['password']),
                'user_fullname' => $fullname,
                'user_address'  => $address,
                'user_category' => 'R'
            );
            $user_id =  $this->insert($this->table, $form, 'Y');
            if ($user_id > 0) {
                $this->session = [
                    'id'        => $user_id,
                    'name'      => $fullname,
                    'category'  => 'Resident'
                ];
                return 1;
            } else {
                return 0;
            }
        }
    }

    public function login()
    {
        $username = $this->clean($this->inputs['username']);
        $password = md5($this->inputs['password']);

        $fetch = $this->select($this->table, "*", "username = '$username' AND password = '$password'");
        if ($fetch->num_rows > 0) {
            $row = $fetch->fetch_assoc();
            $this->session = [
                'id'        => $row['user_id'],
                'name'      => $row['user_fullname'],
                'category'  => $row['user_category'],
                'username'  => $row['username'],
            ];
            return 1;
        } else {
            $this->old = [
                'username'  => $username,
                'password'  => $this->inputs['password'],
            ];
            return 0;
        }
    }

    // public function add()
    // {
    //     $form = array(
    //         $this->name             => $this->clean($this->inputs[$this->name]),
    //         'product_price'         => $this->inputs['product_price'],
    //         'product_img'           => 'default.jpg',
    //         'product_category_id'   => $this->inputs['product_category_id'],
    //         'remarks'               => $this->inputs['remarks'],
    //         'product_code'          => $this->inputs['product_code']
    //     );
    //     return $this->insertIfNotExist($this->table, $form, "product_code=" . $this->inputs['product_code'] . " ");
    // }

    // public function edit()
    // {
    //     $form = array(
    //         $this->name             => $this->clean($this->inputs[$this->name]),
    //         'product_category_id'   => $this->inputs['product_category_id'],
    //         'product_price'         => $this->inputs['product_price']
    //     );
    //     return $this->updateIfNotExist($this->table, $form);
    // }

    // public function show()
    // {
    //     $param = isset($this->inputs['param']) ? $this->inputs['param'] : '';
    //     $ProductCategories = new ProductCategories();
    //     $rows = array();
    //     $result = $this->select($this->table, '*', $param);
    //     while ($row = $result->fetch_assoc()) {
    //         $row['product_category'] = $ProductCategories->name($row['product_category_id']);
    //         $rows[] = $row;
    //     }
    //     return $rows;
    // }

    // public function view()
    // {
    //     $primary_id = $this->inputs['id'];
    //     $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
    //     return $result->fetch_assoc();
    // }

    // public function remove()
    // {
    //     $ids = implode(",", $this->inputs['ids']);
    //     return $this->delete($this->table, "$this->pk IN($ids)");
    // }

    // public function name($primary_id)
    // {
    //     $result = $this->select($this->table, $this->name, "$this->pk = '$primary_id'");
    //     $row = $result->fetch_assoc();
    //     return $row[$this->name];
    // }

    // public function productID($product_code)
    // {
    //     $fetch = $this->select($this->table, $this->pk, "product_code='$product_code'");
    //     $row = $fetch->fetch_assoc();
    //     return $row[$this->pk];
    // }

    // public function productPrice($primary_id)
    // {
    //     $fetch = $this->select($this->table, "product_price", "$this->pk = '$primary_id'");
    //     $row = $fetch->fetch_assoc();
    //     return $row['product_price'];
    // }

    // public function schema()
    // {
    //     $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
    //     $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', '', 'ON UPDATE CURRENT_TIMESTAMP');


    //     // TABLE HEADER
    //     $tables[] = array(
    //         'name'      => $this->table,
    //         'primary'   => $this->pk,
    //         'fields' => array(
    //             $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
    //             $this->metadata($this->name, 'varchar', 75),
    //             $this->metadata('product_price', 'decimal', '11,2'),
    //             $this->metadata('product_img', 'text'),
    //             $this->metadata('product_category_id', 'int', 11),
    //             $this->metadata('remarks', 'varchar', 255),
    //             $default['date_added'],
    //             $default['date_last_modified']
    //         )
    //     );

    //     return $this->schemaCreator($tables);
    // }
}
