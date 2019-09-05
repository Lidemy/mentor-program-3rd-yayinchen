<?php 
  require_once 'conn.php'; 

//分頁
	$result_count = $conn->query('SELECT COUNT(id) FROM yayinchen_comments');
	$sum1 = $result_count->fetch_assoc(); //留言總數
	$sum = $sum1['COUNT(id)'];
	$per = 20; //每頁留言數
	$pages = ceil($sum/$per);
	if(!isset($_GET['page'])) {
		$page = 1;
	} else {
		$page = intval($_GET['page']);
	}
?>

	<nav class="page m-3" aria-label="Page navigation example">
	  <ul class="pagination">
	  	<?php 
	  	if($page==1) {
	  		echo '<li class="page-item disabled">';
	  	} else {
	  		echo '<li class="page-item">';
	  	}
	  	?>	    
	      <a class="page-link" <?php echo 'href="./index.php?page='.($page-1).'"';?> aria-label="Previous">
	        <span aria-hidden="true">前一頁 &laquo;</span>
	      </a>
	    </li>
			<?php
			for($i=1; $i<=$pages; $i++) {
				if($i==$page) {
					echo '<li class="page-item active"><a class="page-link" href="./index.php?page='.$i.'">'.$i.'</a></li>';
				} else {
					echo '<li class="page-item"><a class="page-link" href="./index.php?page='.$i.'">'.$i.'</a></li>';
				}				
			}
			if($page==$pages) {
				echo '<li class="page-item disabled">';
			} else {
				echo '<li class="page-item">';
			}
			?>	    
	      <a class="page-link" <?php echo 'href="./index.php?page='.($page+1).'"';?> aria-label="Next">
	        <span aria-hidden="true">&raquo; 後一頁</span>
	      </a>
	    </li>
	  </ul>
	</nav>

