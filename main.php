<?php
include_once 'header.php';
include_once 'includes/dbhelper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pagination</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
	
	<?php
        $all_data = $conn->query("SELECT * FROM users");
		$num_rows = $all_data->num_rows;

		$per_page = 7;
		$offset = 0;

		$no_of_page = ceil($num_rows / $per_page);

		$current_page = '';

		if(isset($_GET['page'])){
			$current_page = $_GET['page'];

			$offset = ($per_page * $current_page) - $per_page;
		}

		$page_data = $conn->query("SELECT * FROM users LIMIT ".$per_page. " OFFSET ".$offset);
	 ?>

	<section>
		<div class="container">

			<div class="row">

				<div class="col-sm-12">
					<h2 class="text-center">Table User</h2>
					<table class="table table-bordered">
						<thead>
                            <tr>
                                <th>#</th>
                                <th>성</th>
                                <th>이름</th>
                                <th>ID</th>
                                <th>생일</th>
                                <th>연락처</th>
                                <th>이메일</th>
                                <th>주소</th>
                                <th>성별</th>
                                <th>등록일</th>
                            </tr>
						</thead>
						<tbody>
                            <?php while($row=$page_data->fetch_assoc()):?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['lastname']; ?></td>
                                    <td><?php echo $row['firstname']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php
                                        $birthday = $row['birthday'];
                                        if (strcmp(substr($birthday, 0, 4),"0000") == 0) {
                                            echo "TBD";
                                        } else {
                                            echo $row['birthday'];
                                        }
                                        ?>
                                    </td>
                                    <td><?php
                                        $cellphone = $row['cellphone'];
                                        if (strlen($cellphone) > 4) {
                                            echo substr_replace($cellphone, "xxxx", strlen($cellphone)-4);
                                        } else {
                                            echo "TBD";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['reg_date']; ?></td>
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
                <button class="btn btn-primary" onclick="location.href='server.php'">Export To Excel</button>
                <button class="btn btn-primary" onclick="location.href='import.php'">Import More Data</button>
                <button class="btn btn-primary" onclick="location.href='signup.php'">Insert One User</button>
            </div>
		</div>
	</section>

</body>
</html>