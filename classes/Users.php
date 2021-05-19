<?php

namespace classes;

require_once __DIR__ . '/../vendor/autoload.php';

class Users
{
    private $dbConnection;
    private $query;

    public function __construct()
    {
        $db = new Db();
        $this->dbConnection = $db->getConnection();
    }

    public function addUser($firstName, $lastName, $email)
    {
        $first_name = mysqli_real_escape_string($this->dbConnection, $firstName);
        $last_name = mysqli_real_escape_string($this->dbConnection, $lastName);
        $email = mysqli_real_escape_string($this->dbConnection, $email);
        $sql = "INSERT INTO users (first_name, last_name, email) VALUES ('".$first_name."', '".$last_name."', '".$email."')";
        mysqli_query($this->dbConnection, $sql);
    }

    public function getUserByID($userID)
    {
        $query = 'SELECT * FROM users WHERE id = ' . $userID;
        $result = mysqli_query($this->dbConnection, $query);
        return mysqli_fetch_assoc($result);
    }

    public function editUser($id, $firstName, $lastName, $email)
    {
        $userID = $id;
        $first_name = mysqli_real_escape_string($this->dbConnection, $firstName);
        $last_name = mysqli_real_escape_string($this->dbConnection, $lastName);
        $email = mysqli_real_escape_string($this->dbConnection, $email);
        $update_date = date('Y-m-d H:i:s');

        $sql = "
        UPDATE users 
        SET first_name = '" . $first_name . "', 
        last_name = '" . $last_name . "', 
        email = '" . $email . "', 
        update_date = '" . $update_date . "' 
        WHERE id = '" . $userID . "'
";

        mysqli_query($this->dbConnection, $sql);
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM users';
        $result = mysqli_query($this->dbConnection, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function findData($query)
    {
        $this->query = $query;

        $output = '';

        if ($this->query){
            $search = mysqli_real_escape_string($this->dbConnection, $this->query);
            $query = "SELECT * FROM users WHERE first_name LIKE '%" . $search . "%' OR last_name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%'";
        } else {
            $query = 'SELECT * FROM users';
        }

        $result = mysqli_query($this->dbConnection, $query);
        if (mysqli_num_rows($result) > 0){
            $output .= '<table id="table" class="table table-striped">
            <thead>
            <tr>
                <th scope="col"><a id="id" class="column_name" data-order="desc" href="#">ID</a></th>
                <th scope="col"><a id="first_name" class="column_name" data-order="desc" href="#">First Name</a></th>
                <th scope="col"><a id="last_name" class="column_name" data-order="desc" href="#">Last Name</a></th>
                <th scope="col"><a id="email" class="column_name" data-order="desc" href="#">Email</a></th>
                <th scope="col"><a id="create_date" class="column_name" data-order="desc" href="#">Date Created</a></th>
                <th scope="col"><a id="update_date" class="column_name" data-order="desc" href="#">Last Modified</a></th>
                <th scope="col"><a href="#">Action</a></th>
            </tr>
            </thead>
            <tbody>';
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($users as $user){
                $output .= '<tr>
                    <th scope="row">' . $user['id'] . '</th>
                    <td>' . $user['first_name'] . '</td>
                    <td>' . $user['last_name'] . '</td>
                    <td>' . $user['email'] . '</td>
                    <td>' . $user['create_date'] . '</td>
                    <td>' . $user['update_date'] . '</td>
                    <td>
                        <form action="edit_user_form.php" method="post">
                            <button class="btn btn-warning" name="id" value="' . $user['id'] . '">Edit</button>
                        </form>
                    </td>
                </tr>';
            }
            $output .= '</tbody>
        </table>';
            echo $output;
        } else {
            echo 'Data Not Found';
        }
    }

    public function sortData()
    {
        $data = $_POST;
        if ($data['order'] == 'desc') {
            $order = 'asc';
        } else {
            $order = 'desc';
        }
        $sql = "SELECT * FROM users ORDER BY {$data['id']} {$order}";
        $result = mysqli_query($this->dbConnection, $sql);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $output = '
            <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><a id="id" class="column_name" data-order="' . $order . '" href="#">ID</a></th>
                        <th scope="col"><a id="first_name" class="column_name" data-order="' . $order . '" href="#">First Name</a></th>
                        <th scope="col"><a id="last_name" class="column_name" data-order="' . $order . '" href="#">Last Name</a></th>
                        <th scope="col"><a id="email" class="column_name" data-order="' . $order . '" href="#">Email</a></th>
                        <th scope="col"><a id="create_date" class="column_name" data-order="' . $order . '" href="#">Date Created</a></th>
                        <th scope="col"><a id="update_date" class="column_name" data-order="' . $order . '" href="#">Last Modified</a></th>
                        <th scope="col"><a href="#">Action</a></th>
                    </tr>
                    </thead>
                    <tbody>
        ';
        foreach ($users as $user){
            $output .= '<tr>
                    <th scope="row">' . $user['id'] . '</th>
                    <td>' . $user['first_name'] . '</td>
                    <td>' . $user['last_name'] . '</td>
                    <td>' . $user['email'] . '</td>
                    <td>' . $user['create_date'] . '</td>
                    <td>' . $user['update_date'] . '</td>
                    <td>
                        <form action="edit_user_form.php" method="post">
                            <button class="btn btn-warning" name="id" value="' . $user['id'] . '">Edit</button>
                        </form>
                    </td>
                </tr>';
        }
        $output .= '</tbody>
        </table>';
        echo $output;
    }
}
