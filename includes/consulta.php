<?php
	require 'db.php';

	$tabla = "";
	$data = "";
	$sql = "SELECT * FROM users ORDER BY id";

	# Eliminar usuarios
	if(isset($_POST['eliminar-user'])){
		$records = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $records->bindParam(':id', $_POST['eliminar-user']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
        }

		$sql = "DELETE FROM buzon WHERE users = :users";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindParam(':users', $user['name']);
		$stmt -> execute();

		$sql = "DELETE FROM comments WHERE name = :name";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindParam(':name', $user['name']);
		$stmt -> execute();

		$sql = "DELETE FROM users WHERE id = :id";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindParam(':id', $_POST['eliminar-user']);

		$data = $stmt -> execute() ? '¡Se elimino exitosamente!' : '¡No se ha podido eliminar!';

		die(json_encode($data));
	}

	function escape($value) {
		$return = '';
		for($i = 0; $i < strlen($value); ++$i) {
			$char = $value[$i];
			$ord = ord($char);
			if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
				$return .= $char;
			else
				$return .= '\\x' . dechex($ord);
		}
		return $return;
	}

	if(isset($_POST['name'])){
		$q = escape($_POST['name']);
		$sql="SELECT * FROM users WHERE 
			id LIKE '%".$q."%' OR
			name LIKE '%".$q."%'";
	}

	$stmt = $conn -> prepare($sql);
	$stmt -> execute();
	$users = $stmt -> fetchAll(PDO::FETCH_OBJ);

	if ($stmt -> rowCount() > 0){
		foreach($users as $user){
			$tabla.=
			'<tr>
				<td scope="row">'. $user -> id .'</td>
				<td>'. $user -> name. '</td>
				<td class="text-center" scope="row">
					<form action="" method="POST" id="userDelete'.  $user -> id.'">
						<input type="hidden" name="eliminar-user" value="'.  $user -> id .'">
						<button type="button" class="submit" onclick="userDelete('.  $user -> id .')"><i class="fa-solid fa-trash-can"></i></button>	
					</form>
				</td>
			</tr>';
		}
	} else {
			$tabla.="<tr>
						<td></td>
						<td>No se encontraron coincidencias con sus criterios de búsqueda.</td>
						<td></td>
		 			</tr>";
	}
	
	echo $tabla;
?>
