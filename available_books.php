<html>
    <head>
        <title>Library Management System : View  Available books</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
			<h2>Available books</h2>
		 		<table class="table table-hover">
				    <thead>
			        	<tr>
					        <th>Accn</th>
					        <th>Name</th>
					        <th>Stock</th>
			      		</tr>
				    </thead>
			    	<tbody>				
						    <?php   
	                            include("connectdb.php");                            
	                            $sql="SELECT accn, book_name, book_stock FROM book WHERE book_stock>0";
	                            $result=$con->query($sql);
	                            while($row=$result->fetch_assoc()){
	                            	echo "<tr>";
	                            	foreach ($row as $key => $value) {
	                            		echo "<td>$value</td>";
	                            	}	                         
	                                echo "</tr>";
	                            }
	                            $con->close();                
	                        ?>					     			
			    	</tbody>
			  </table>
			  <a type="button" class="btn btn-primary" href="index.php">Home</a>
		</div>
    </body>
</html>