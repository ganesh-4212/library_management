<?php
    if (isset($_POST['action']) and $_POST['action']='psubmit') {
        include("connectdb.php");
        extract($_POST);
        $sql="INSERT INTO publisher VALUES ('$pub_id', '$pub_name', '$pub_phone', '$pub_addr')";
        $con->query($sql);
        $result="publisher details added successfully";
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
                    document.getElementById("psubmit").className="btn btn-primary disabled";
                    document.getElementById("psubmit").disabled=true;
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
                            document.getElementById("psubmit").className="btn btn-primary active";
                            document.getElementById("psubmit").disabled=false;
                        }
                        else
                        {
                            document.getElementById("psubmit").className="btn btn-primary disabled";
                            document.getElementById("psubmit").disabled=true;
                        }
                    }
                }
                xmlhttp.open("GET","searchId.php?table=publisher&id="+val,true);
                xmlhttp.send();
            }
            function verify(){
                var pub_id=document.getElementById('pub_id');
                var pub_name=document.getElementById('pub_name');
                var pub_phone=document.getElementById('pub_phone');
                var pub_addr=document.getElementById('pub_addr');
                if(!/^p\d{3,}$/.test(pub_id.value.trim())){
                    alert("publisher id must start from p followed by 3 minimum numbers");
                    pub_id.focus();
                    return false;
                }
                if(pub_name.value.trim().length<5){
                    alert("Publisher name must be more than 5 characters");
                    pub_name.focus();
                    return false;
                }
                if(!/^\d{10}$/.test(pub_phone.value.trim())){
                    alert("Enter valid phone number");
                    pub_phone.focus();
                    return false;
                }
                if(pub_addr.value.trim().length<10){
                    alert("Publisher address must be greater than 10 charaters");
                    pub_addr.focus();
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
            <h2>Add Publisher details</h2>
            <form role="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return verify()">
                <div class="form-group">
                    <label for="pub_id">Publisher Id:</label>
                    <input type="text" class="form-control" onkeyup="checkId(this.value)" id="pub_id" name="pub_id">
                </div>
                <div class="form-group">
                    <label for="pub_name">Name:</label>
                    <input type="text" class="form-control" id="pub_name" name="pub_name">
                </div>
                <div class="form-group">
                    <label for="pub_phone">Phone:</label>
                    <input type="text" class="form-control" id="pub_phone" name="pub_phone">
                </div>
                <div class="form-group">
                    <label for="pub_addr">Address:</label>
                    <textarea class="form-control" id="pub_addr" name="pub_addr"></textarea>
                </div>
                <button type="submit" name="action" value="psubmit" id="psubmit" class="btn btn-primary" disabled>Add</button>
                <button type="reset" class="btn btn-default">Clear</button>
                <a type="button" class="btn btn-primary" href="index.php">Home</a>
            </form>
        </div>
    </body>
</html>