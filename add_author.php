<?php
    if (isset($_POST['action']) and $_POST['action']='asubmit') {
        include("connectdb.php");
        extract($_POST);
        $sql="INSERT INTO author VALUES ('$aut_id', '$aut_name', '$aut_phone', '$aut_addr')";
        $con->query($sql);
        $result="author details added successfully";
        if($con->error){
            $result=$con->error;
        }
        $con->close();
        header("location:".$_SERVER['PHP_SELF']."?result=$result");
    }
?>
<html>
    <head>
        <title>Library Management System : Add Publisher</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function checkId(val){
                if(val.trim().length<4){
                    document.getElementById("asubmit").className="btn btn-primary disabled";
                    document.getElementById("asubmit").disabled=true;
                    return;
                }
                var xmlhttp;
                if(window.XMLHttpRequest){
                
                    xmlhttp= new XMLHttpRequest();
                    
                }
                else
                {
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        if(xmlhttp.responseText=='0'){
                            document.getElementById("asubmit").className="btn btn-primary active";
                            document.getElementById("asubmit").disabled=false;
                        }
                        else
                        {
                            document.getElementById("asubmit").className="btn btn-primary disabled";
                            document.getElementById("asubmit").disabled=true;
                        }
                    }
                }
                xmlhttp.open("GET","searchId.php?table=author&id="+val,true);
                xmlhttp.send();
            }
            function verify(){
                var aut_id=document.getElementById('aut_id');
                var aut_name=document.getElementById('aut_name');
                var aut_phone=document.getElementById('aut_phone');
                var aut_addr=document.getElementById('aut_addr');
                if(!/^a\d{3,}$/.test(aut_id.value.trim())){
                    alert("author id must start from \'a\' followed by 3 minimum numbers");
                    aut_id.focus();
                    return false;
                }
                if(aut_name.value.trim().length<5){
                    alert("author name must be more than 5 characters");
                    aut_name.focus();
                    return false;
                }
                if(!/^\d{10}$/.test(aut_phone.value.trim())){
                    alert("Enter valid phone number");
                    aut_phone.focus();
                    return false;
                }
                if(aut_addr.value.trim().length<10){
                    alert("author address must be greater than 10 charaters");
                    aut_addr.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <script type="text/javascript">
            <?php
                if(isset($_REQUEST['result'])){
                    echo "alert('".$_REQUEST['result']."');";
                    echo "window.location='".$_SERVER['PHP_SELF']."';";
                }
            ?>
        </script>
        <div class="container">
            <h2>Add Author details</h2>
            <form role="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return verify()">
                <div class="form-group">
                    <label for="aut_id">Author Id:</label>
                    <input type="text" class="form-control" onkeyup="checkId(this.value)" id="aut_id" name="aut_id">
                </div>
                <div class="form-group">
                    <label for="aut_name">Name:</label>
                    <input type="text" class="form-control" id="aut_name" name="aut_name">
                </div>
                <div class="form-group">
                    <label for="aut_phone">Phone:</label>
                    <input type="text" class="form-control" id="aut_phone" name="aut_phone">
                </div>
                <div class="form-group">
                    <label for="aut_addr">Address:</label>
                    <textarea class="form-control" id="aut_addr" name="aut_addr"></textarea>
                </div>
                <button type="submit" name="action" value="asubmit" id="asubmit" class="btn btn-primary" disabled>Add</button>
                <button type="reset" class="btn btn-default">Clear</button>
                <a type="button" class="btn btn-primary" href="index.php">Home</a>
            </form>
        </div>
    </body>
</html>