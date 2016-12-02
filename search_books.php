<html>
    <head>
        <title>Library Management System : View  Available books</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        	function search_book() {
        		var cat=document.getElementById('cat_id').value.trim();
        		var bname=document.getElementById('book_name').value.trim();        	
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
                        document.getElementById('books_details').innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","search_book_ajax.php?bname="+bname+"&cat="+cat,true);
                xmlhttp.send();
        	}
        </script>
    </head>
    <body>
        <div class="container">
			<h2>Search books</h2>
				<form class="form-inline" role="form">
				    <div class="form-group">
				      <label for="book_name">Book name:</label>
				      <input type="text" class="form-control" id="book_name" name="book_name" onkeyup="search_book()">
				    </div>
				    <div class="form-group">                  
                    	<label for="cat_id">Category :</label>
                    	<select class="form-control" id="cat_id" name="cat_id" onchange="search_book()">
                    		<option>All</option>
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
                	</div>				
				</form>
		 		<table class="table table-hover">
				    <thead>
			        	<tr>
					        <th>Accn</th>
					        <th>Name</th>
					        <th>Author</th>
					        <th>Publisher</th>
					        <th>Category</th>
					        <th>Stock</th>
			      		</tr>
				    </thead>
			    	<tbody id="books_details">				
						    <?php   
	                            include("connectdb.php");                            
	                            $sql="SELECT book.accn,book.book_name as name, author.aut_name, publisher.pub_name,category.cat_name, book.book_stock FROM book INNER JOIN author ON book.aut_id=author.aut_id 
	                            	inner join publisher on book.pub_id=publisher.pub_id inner join category 
	                            	on book.cat_id = category.cat_id";
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