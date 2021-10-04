<?php
class Database
{

    function getCon()
    {
        $db_connection = mysqli_connect('localhost', 'root', '', 'plants') or die("Unable to connect");
        return $db_connection;
    }

    function getProducts()
    {
        $con = $this->getCon();
        $query = "SELECT id, product_name, price FROM products";
        $result = $con->query($query);
        return $result->fetch_all();
    }

    function getName($id)
    {
        $con = $this->getCon();
        $statement = $con->prepare("SELECT product_name FROM products where id=?");
        $statement->bind_param("s", $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_row()[0];
    }

    function getPrice($id)
    {
        $con = $this->getCon();
        $statement = $con->prepare("SELECT price FROM products where id=?");
        $statement->bind_param("s", $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_row()[0];
    }

    function getAddress($username)
    {
        $con = $this->getCon();
        $statement = $con->prepare("SELECT address FROM users where username=?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_row()[0];
    }
}
