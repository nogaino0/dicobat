<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Dicobat</title>
</head>
<body class="pt-4">

	<?php 
	// INSERT ELEMENTS IN DATABASE
	if (isset($_GET['term']) && isset($_GET['description'])) {

		include("connect.php");
		$term = $_GET['term'];
		$description = $_GET['description'];

		$sql = "INSERT INTO termes (nom, description) VALUES (?, ?)";

		$stmt = $pdo->prepare($sql);

		$stmt->execute([$term, $description]);

		if ($stmt->rowcount() > 0) {
			$message = "Added Successfuly";
			header("location:http://localhost/dicobat/index.php");
		}else{
			$message = "Something Went Wrong";
		}
	}?>

	<!-- Start Add Section -->
	<div class="addSec">

		<!-- Start Container Add Section -->
		<div class="container">

			<h3 class="text-primary">Nouveau Terme</h3>
			<form method="GET" name="add" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<i class="bi bi-key"></i><input type="text" name="term" placeholder="Terme : Le mot clé" class="form-control mb-2">
				<i class="bi bi-book"></i><textarea name="description" placeholder="Description : Ecrivez une introduction au concept" class="form-control mb-2"></textarea>

				<!-- <input type="submit" value="Ajouter" class="btn btn-dark"> -->
				Ajouter : <button name="add" type="submit" class="btn btn-warning py-1 px-3">Go</button>
			</form>
			
		</div>
		<!-- End Container Add Section -->

	</div>
	<!-- End Add Section -->

	<div class="container my-4"><hr></div>

	<!-- Start Result Section -->
	<div class="resultSec">

		<!-- Start Container Result Section  -->
		<div class="container">

			<?php 
				include("connect.php");
				$sql = "SELECT * FROM termes";

				$stmt = $pdo->query($sql);
				$count = $stmt->rowcount();

				$terms = array_reverse($stmt->fetchAll());
			?>

			<h4 class="text-primary">Dictionnaire (<?php echo $count; ?>)</h4>

			<div class="search">
				<form name="search" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mb-3">
					<div class="row">
						<div class="col">
							<input placeholder="Cherchez un mot" type="text" name="goal" class="form-control">
						</div>
						<div class="col">
							<!-- <input value="Cherche" type="submit" name="search" class="btn btn-info"> -->
							<button type="submit" class="btn btn-warning">Go</button>
						</div>
					</div>
				</form>
			</div>

			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Term</th>
						<th>Description</th>
						<th>Control</th>
					</tr>
				</thead>
				<tbody>

				<?php

					foreach ($terms as $term) {
						echo "<tr>";

						echo "<td class='nowrap'>";
						echo ucfirst($term['nom']);
						echo "</td>";

						echo "<td>";
						echo ucfirst($term['description']) . "<br>";
						echo "-------------<br>";
						echo $term['creeLe'];

						echo "</td>";

						echo "<td>";
						echo "<button class='btn btn-primary btn-sm w-100 mb-2'>Edit</button>";
						echo "<button class='btn btn-danger btn-sm w-100 mb-2'>Delete</button>";

						echo "</td>";

						echo "</tr>";
					}

				 ?>

				</tbody>

			</table>
			
		</div>
		<!-- End Container Result Section  -->
		
	</div>
	<!-- End Result Section -->

<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>