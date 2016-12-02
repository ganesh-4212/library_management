<?php
    if (isset($_POST['action']) and $_POST['action']='bsubmit') {
        include("connectdb.php");
        extract($_POST);
        $sql="UPDATE book SET book_stock =book_stock-1  WHERE accn = '$accn1'";
        $con->query($sql);
        if($con->error){
            $result=$con->error;
        }
        else
        {
            $sql="INSERT INTO issue_books VALUES ('$usn', '$accn1','$issue_date')";
            $con->query($sql);            
            if($con->error){
                $sql="UPDATE book SET book_stock =book_stock+1  WHERE accn = '$accn1'";
                $con->query($sql);
                $result="$accn1 already issued. ";
            }
            else
            {
                $result="$accn1 issued. ";
            }
            if (strlen($accn2)>0) {
                $sql="UPDATE book SET book_stock =book_stock-1  WHERE accn = '$accn2'";
                $con->query($sql);
                if($con->error){
                    $result=$con->errno;
                }
                else
                {
                    $sql="INSERT INTO issue_books VALUES ('$usn', '$accn2','$issue_date')";
                    $con->query($sql);
                    if($con->error){
                        $sql="UPDATE book SET book_stock =book_stock+1  WHERE accn = '$accn2'";
                        $con->query($sql);
                        $result=$result."$accn2 already issued. ";
                    }
                    else
                    {
                        $result=$result."$accn2 issued. ";
                    }        
                    if (strlen($accn3)>0) {
                        $sql="UPDATE book SET book_stock =book_stock-1  WHERE accn = '$accn3'";
                        $con->query($sql);
                        if($con->error){
                            $result=$con->error;
                        }
                        else
                        {
                            $sql="INSERT INTO issue_books VALUES ('$usn', '$accn3','$issue_date')";
                            $con->query($sql);
                            if($con->error){
                                $sql="UPDATE book SET book_stock =book_stock+1  WHERE accn = '$accn3'";
                                $con->query($sql);
                                $result=$result."$accn3 already issued. ";
                            }
                            else
                            {
                                $result=$result."$accn3 issued. ";
                            }                                   
                        }
                    }
                }
            }
        }
        $con->close();
        header("location:".$_SERVER['PHP_SELF']."?result=$result");
    }
?>
<html>
    <head>
        <title>Library Management System : Issue Books</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function checkId(val){
                if(val.trim().length<4){
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
                        if(xmlhttp.responseText=='1'){
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
                var accn1=document.getElementById('accn1');
                var accn2=document.getElementById('accn2');
                var accn3=document.getElementById('accn3');
                 var usn=document.getElementById('usn');
                 if(!/^1(d|D)(s|S)\d{2}\w{3}\d{2}$/.test(usn.value.trim())){
                    alert("Invalid student USN number");
                    usn.focus();
                    return false;
                }
                if(!/^b\d{3,}$/.test(accn.value.trim())){
                    alert("book id must start from \'b\' followed by 3 minimum numbers");
                    accn.focus();
                    return false;
                }
                if(accn1.value.trim.length==0 && accn2.value.trim.length==0 && accn3.value.trim.length==0){
                    alert("Please enter minimum one book accn number to issue");
                    accn1.focus();
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
            <h2>Issue Books</h2>
            <form role="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return verify()">
                <div class="form-group">
                    <label for="usn">USN:</label>
                    <input type="text" class="form-control" onkeyup="checkId(this.value)" id="usn" name="usn">
                </div>
                <div class="form-group">
                    <label for="accn1">Accn 1 :</label>
                    <input type="text" class="form-control" id="accn1" name="accn1">
                </div>
                <div class="form-group">
                    <label for="accn2">Accn 2 :</label>
                    <input type="text" class="form-control" id="accn2" name="accn2">
                </div>
                <div class="form-group">
                    <label for="accn3">Accn 3 :</label>
                    <input type="text" class="form-control" id="accn3" name="accn3">
                </div>
                <div class="form-group">
                    <label for="issue_date">Issue Date :</label>
                    <input type="text" class="form-control" id="issue_date" name="issue_date" value="<?php echo date('Y-m-d');?>" readonly="true">
                </div>
                <button type="submit" name="action" value="bsubmit" id="bsubmit" class="btn btn-primary" disabled>Issue</button>
                <button type="reset" class="btn btn-default">Clear</button>
                <a type="button" class="btn btn-primary" href="index.php">Home</a>
            </form>
        </div>
    </body>
</html>