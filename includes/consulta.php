<?php
	require 'db.php';

	$tabla = "";
	$sql = "SELECT * FROM users ORDER BY id";

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
