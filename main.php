<?php
include_once 'header.php';
include_once 'includes/dbhelper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Checking</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
	
	<?php
        $all_data = $conn->query("SELECT * FROM gps_data");
		$num_rows = $all_data->num_rows;

		$per_page = 7;
		$offset = 0;

		$no_of_page = ceil($num_rows / $per_page);

		$current_page = '';

		if(isset($_GET['page'])){
			$current_page = $_GET['page'];

			$offset = ($per_page * $current_page) - $per_page;
		}

		$page_data = $conn->query("SELECT * FROM gps_data LIMIT ".$per_page. " OFFSET ".$offset);
	 ?>

	<section>
		<div class="container">

			<div class="row">

				<div class="col-sm-12">
					<h2 class="text-center">Table GPS_DATA</h2>
					<table class="table table-bordered">
						<thead>
                            <tr>
                                <th>id</th>
                                <th>lat</th>
                                <th>lng</th>
                                <th>accuracy</th>
                                <th>extra</th>
                                <th>status</th>
                                <th>provider</th>
                                <th>last_updated</th>
                                <th>location_raw</th>                                
                            </tr>
						</thead>
						<tbody>
                            <?php while($row=$page_data->fetch_assoc()):?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['lat']; ?></td>
                                    <td><?php echo $row['lng']; ?></td>
                                    <td><?php echo $row['accuracy']; ?></td>
									<td><?php echo $row['extra']; ?></td>
									<td><?php echo $row['status']; ?></td>
									<td><?php echo $row['provider']; ?></td>
									<td><?php echo $row['last_updated']; ?></td>
									<td><?php echo $row['location_raw']; ?></td>                                    
                                </tr>
                            <?php endwhile; ?>

						</tbody>
					</table>

					<!-- Pagination -->
					<nav aria-label="Page navigation">
						<ul class="pagination">
							<li class="<?php if( $current_page == 1 || $current_page == '' ){ echo 'disabled'; } ?>">
								<a href="<?php 
									if( $current_page == 1 || $current_page == '' ){
										echo '#';
									}else{
										echo '?page='. ($current_page - 1);
									}
								?>" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
							</li>

							<?php for($p=1; $p <= $no_of_page; $p++): ?>
								<li class="<?php
									if( $current_page == $p ){
										echo 'active';
									}elseif( $current_page == '' && $p == 1 ){
										echo 'active';
									}
								?>"><a href="?page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
							<?php endfor; ?>
	
							<li class="<?php if( $current_page == $no_of_page ){ echo 'disabled'; } ?>">
								<a href="<?php 
									if( $current_page == $no_of_page ){
										echo '#';
									}elseif( $current_page == '' ){
										echo '?page=2';
									}else{
										echo '?page='. ($current_page + 1);
									}
								?>" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
            <div class="col-sm-12" >
                <button class="btn btn-primary" onclick="location.href='gsm_data.php'">GSM_DATA</button>                
            </div>
		</div>
	</section>

</body>
</html>