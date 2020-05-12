<?php 
session_start();
include 'init.php';
// FUNCTIONS WEBSITE:::: 
$userid = $_SESSION['id']; // user id 
$Userinfo = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users


            $id = $_SESSION['id'];
            // STATMENT
        //    get_something("posts","*","WHERE userid = ".$id." ORDER BY postid DESC ","fetchAll");

                // if ($countsomething > 0) {
                //     echo 'Done';
                // }else {
                //     echo 'wrong';
                // }

                // $stamt = "SELECT * FROM posts WHERE userid = :id ORDER BY postid DESC ";
                // $set_Stamt = $con->prepare($stamt);
                // $set_Stamt->bindparam(":id",$id);
                $stamt = "SELECT Orders.OrderID, Customers.CustomerName
                FROM Orders
                INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID;";
                $set_Stamt = $con->prepare($stamt);
                $set_Stamt->execute();
                $posts = array() ;
                while ($query = $set_Stamt->fetch()) {
                    array_push($posts,$query);
                }
               
                $result["idpage"] = $posts['pageid'];
                jso
