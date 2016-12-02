<?php
    if (isset($_POST['action']) and $_POST['action']='bsubmit') {
        include("connectdb.php");
        extract($_POST);
        $sql="INSERT INTO student VALUES ('$usn', '$name','$branch',$sem)";
        $con->query($sql);
        $result="Student details added successfully";
        if($con->error){
            $result=$con->error;
        }
        $con->close();
        header("location:".$_SERVER['PHP_SELF']."?result=$result");
    }
?>
<html>
    <head>
        <title>Library Management System : Add Student</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function checkId(val){
                if(val.trim().length!=10){
                    document.getElementById("bsubmit").className="btn btn-primary disabled";
                    document.getElementById("bsubmit").disabled=true;
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
                            document.getElementById("bsubmit").className="btn btn-primary active";
                            document.getElementById("bsubmit").disabled=false;
                        }
                        else
                        {
                            document.getElementById("bsubmit").className="btn btn-primary disabled";
                            document.getElementById("bsubmit").disabled=true;
                        }
                    }
                }
                xmlhttp.open("GET","searchId.php?table=student&id="+val,true);
                xmlhttp.send();
            }
            function verify(){
                var usn=document.getElementById('usn');
                var name=document.getElementById('name');
                var branch=document.getElementById('branch');
                var sem=document.getElementById('sem');
                if(!/^1(d|D)(s|S)\d{2}\w{3}\d{2}$/.test(usn.value.trim())){
                    alert("Invalid student USN number");
                    usn.focus();
                    return false;
                }
                if(name.value.trim().length<3){
                    alert("Student name must be more than 3 characters");
                    name.focus();
                    return false;
                }
                if(branch.value.trim().length<3){
                    alert("Branch name must be more than 3 characters");
                    branch.focus();
                    return false;
                }
                if(!/^\d+$/.test(sem.value.trim())){
                    alert("Enter valid sem");
                    sem.focus();
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
            <h2>Add Student details</h2>
            <form role="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return verify()">
                <div class="form-group">
                    <label for="usn">Usn number:</label>
                    <input type="text" class="form-control" onkeyup="checkId(this.value)" id="usn" name="usn">
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="branch">Branch:</label>
                    <input type="text" class="form-control" id="branch" name="branch">
                </div>
                <div class="form-group">
                    <label for="sem">Sem:</label>
                    <input type="number" class="form-control" id="sem" name="sem" min='1' max='8'>
                </div>
                 
                <button type="submit" name="action" value="bsubmit" id="bsubmit" class="btn btn-primary" disabled>Add</button>
                <button type="reset" class="btn btn-default">Clear</button>
                <a type="button" class="btn btn-primary" href="index.php">Home</a>
            </form>
        </div>
    </body>
</html>