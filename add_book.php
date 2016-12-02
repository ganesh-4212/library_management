<?php
    if (isset($_POST['action']) and $_POST['action']='bsubmit') {
        include("connectdb.php");
        extract($_POST);
        $sql="INSERT INTO book VALUES ('$accn', '$aut_id','$pub_id','$book_name',$cat_id, $book_stock)";
        $con->query($sql);
        $result="book details added successfully";
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
            function add_cat(){
                var cat_name=prompt("Enter category name");
                if(cat_name!=null){
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
                            document.getElementById('cat_id').innerHTML=xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET","add_category.php?cat_name="+cat_name,true);
                    xmlhttp.send();
                }
            }
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
                xmlhttp.open("GET","searchId.php?table=book&id="+val,true);
                xmlhttp.send();
            }
            function verify(){
                var accn=document.getElementById('accn');
                var book_name=document.getElementById('book_name');
                var book_stock=document.getElementById('book_stock');
                var aut_addr=document.getElementById('aut_addr');
                if(!/^b\d{3,}$/.test(accn.value.trim())){
                    alert("book id must start from \'b\' followed by 3 minimum numbers");
                    accn.focus();
                    return false;
                }
                if(book_name.value.trim().length<1){
                    alert("book name must be more than 1 characters");
                    book_name.focus();
                    return false;
                }
                if(!/^\d+$/.test(book_stock.value.trim())){
                    alert("Enter valid book stock");
                    book_stock.focus();
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
            <h2>Add Book details</h2>
            <form role="form" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return verify()">
                <div class="form-group">
                    <label for="accn">Access number:</label>
                    <input type="text" class="form-control" onkeyup="checkId(this.value)" id="accn" name="accn">
                </div>
                <div class="form-group">
                    <label for="book_name">Name:</label>
                    <input type="text" class="form-control" id="book_name" name="book_name">
                </div>
                 <div class="form-group">
                    <label for="cat_id">Category :</label>
                    <select class="form-control" id="cat_id" name="cat_id">
                        <?php   
                            include("connectdb.php");                            
                            $sql="select cat_id,cat_name from Category";
                            $result=$con->query($sql);
                            while($row=$result->fetch_assoc()){
                                extract($row);
                                echo "<option value=\"$cat_id\">$cat_name</option>";
                            }
                            $con->close();                
                        ?>
                    </select>
                     <button type="button" class="btn btn-primary" onclick="add_cat()">Add category</button>
                </div>
                <div class="form-group">
                    <label for="aut_id">Author :</label>
                    <select class="form-control" id="aut_id" name="aut_id">
                        <?php   
                            include("connectdb.php");                            
                            $sql="select aut_id,aut_name from author";
                            $result=$con->query($sql);
                            while($row=$result->fetch_assoc()){
                                extract($row);
                                echo "<option value=\"$aut_id\">$aut_name</option>";
                            }
                            $con->close();                
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pub_id">Publisher :</label>
                    <select class="form-control" id="pub_id" name="pub_id">
                        <?php   
                            include("connectdb.php");                            
                            $sql="select pub_id,pub_name from publisher";
                            $result=$con->query($sql);
                            while($row=$result->fetch_assoc()){
                                extract($row);
                                echo "<option value=\"$pub_id\">$pub_name</option>";
                            }
                            $con->close();                
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="book_stock">Book stock:</label>
                    <input type="number" class="form-control" id="book_stock" name="book_stock" min="1" max="100">
                </div>
                <button type="submit" name="action" value="bsubmit" id="bsubmit" class="btn btn-primary" disabled>Add</button>
                <button type="reset" class="btn btn-default">Clear</button>
                <a type="button" class="btn btn-primary" href="index.php">Home</a>
            </form>
        </div>
    </body>
</html>