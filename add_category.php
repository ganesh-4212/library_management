<?php  
    if(isset($_REQUEST['cat_name'])){
        include("connectdb.php");
        extract($_REQUEST);
        $sql="INSERT INTO category (cat_name) VALUES ('$cat_name')";
        $con->query($sql);  
        if($con->error){
            echo "<option>".$con->error."</option>";
        }                       
        $sql="select cat_id,cat_name from category";
        $result=$con->query($sql);
        while($row=$result->fetch_assoc()){
            extract($row);
            echo "<option value=\"$cat_id\">$cat_name</option>";
        }
        $con->close();
    }            
?>