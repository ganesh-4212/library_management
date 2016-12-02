<?php
	if(isset($_REQUEST['bname']) and isset($_REQUEST['cat'])){
		include("connectdb.php"); 
		extract($_REQUEST);
		$sql="sql";
		if($cat=='All'){
			$sql="SELECT book.accn,book.book_name as name, author.aut_name, publisher.pub_name,category.cat_name, book.book_stock FROM book INNER JOIN author ON book.aut_id=author.aut_id 
	    	inner join publisher on book.pub_id=publisher.pub_id inner join category 
	    	on book.cat_id = category.cat_id where book.book_name like '$bname%'";
		}
		else 
		{
			$sql="SELECT book.accn,book.book_name as name, author.aut_name, publisher.pub_name,category.cat_name, book.book_stock FROM book INNER JOIN author ON book.aut_id=author.aut_id 
	    	inner join publisher on book.pub_id=publisher.pub_id inner join category 
	    	on book.cat_id = category.cat_id where book.book_name like '$bname%' and category.cat_id=$cat";
		}                  
	    $result=$con->query($sql);
	    while($row=$result->fetch_assoc()){
	    	echo "<tr>";
	    	foreach ($row as $key => $value) {
	    		echo "<td>$value</td>";
	    	}	                         
	        echo "</tr>";
	    }
	    $con->close();     
	}       
?>				