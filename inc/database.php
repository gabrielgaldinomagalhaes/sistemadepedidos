<?php

mysqli_report(MYSQLI_REPORT_STRICT);

function open_database() {
	try {
		$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
		return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		return null;
	}
}

function close_database($conn) {
	try {
		mysqli_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


function find( $table = null, $id = null ) {

	$database = open_database();
	$found = null;

	try {
		if ($id) {
			$sql = "SELECT " . $table . ".id, " . $table . ".id_cliente, " . $table . ".valor_do_pedido, clientes.nome FROM " . $table . " JOIN clientes ON " . $table . ".id_cliente = clientes.id WHERE " . $table . ".id = " . $id . " ORDER BY " . $table . ".id DESC";

			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc();
			}

		} else {

			$sql = "SELECT " . $table . ".id as id, " . $table . ".id_cliente, " . $table . ".valor_do_pedido, clientes.id as id_cliente_cliente, clientes.nome FROM " . $table . " JOIN clientes ON " . $table . ".id_cliente = clientes.id ORDER BY " . $table . ".id DESC";
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$found = $result->fetch_all(MYSQLI_ASSOC);

			}
		}

	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}

	close_database($database);
	return $found;
}

function find_consumers( $table = null, $id = null ) {
  
	$database = open_database();
	$found = null;

	try {
		if ($id) {
			$sql = "SELECT * FROM clientes WHERE id=" . $id . " ORDER BY id ASC";
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc();
			}
	    
		} else {	
	    
			$sql = "SELECT * FROM clientes ORDER BY id ASC";
			$result = $database->query($sql);


			if ($result->num_rows > 0) {
				$found = $result->fetch_all(MYSQLI_ASSOC);

			}
		}

	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}

	close_database($database);
	return $found;
}


function find_products( $table = null, $id = null ) {
  
	$database = open_database();
	$found = null;

	try {
		if ($id) {
			$sql = "SELECT * FROM produtos WHERE id=" . $id . " ORDER BY id ASC";
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc();
			}

		} else {

			$sql = "SELECT * FROM produtos ORDER BY id ASC";
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$found = $result->fetch_all(MYSQLI_ASSOC);
			}
		}

	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}

	close_database($database);
	return $found;
}

function find_order_items( $table = null, $id = null ) {

	$database = open_database();
	$found = null;
	$sql = "SELECT * FROM itens_pedido  JOIN produtos ON itens_pedido.id_produto = produtos.id  WHERE id_pedido=" . $id . " ORDER BY itens_pedido.id ASC";

	try {

		$result = $database->query($sql);

	  } catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $result;
}


function find_last_id(){
	$database = open_database();
	$last_id = null;
	$new_id  = null;
	
	$query_last_order = "SELECT * FROM pedidos ORDER BY id DESC LIMIT 1";

	$last_order = $database->query($query_last_order);
	$ultima_linha = mysqli_fetch_assoc($last_order);
	$last_id = $ultima_linha['id'];

	close_database($database);
	return $ultima_linha['id'];
}

function find_all( $table ) {
	return find($table);
}

function find_all_itens( $table ) {
	return find_items($table);
}

function save($table = null, $id_cliente  = null,  $valor_pedido  = null) {
	$erro = null;
	$database = open_database();

	$sql = "INSERT INTO `" . $table . "` (`id_cliente`, `valor_do_pedido`) VALUES (".$id_cliente.",".$valor_pedido.")";

	try {
		$database->query($sql);

		$_SESSION['message'] = 'Pedido adicionado com sucesso.';
		$_SESSION['type'] = 'success';
		$erro = false;


	} catch (Exception $e) { 

		$_SESSION['message'] = 'Nao foi possivel realizar a operação.';
		$_SESSION['type'] = 'danger';
		$erro = true;
	} 

	close_database($database);
	if($erro){
		return 0;
	}else{
		return 1;
	}
}

function save_item($order_id = null, $item_id  = null,  $item_amount  = null, $item_price  = null,  $item_rentab  = null, $item_total  = null ) {

	$erro = null;
	$database = open_database();

	$sql_item = "INSERT INTO `itens_pedido`(`id_pedido`, `id_produto`, `qtdade_de_produtos`, `valor_venda`, `total_item`, `rentabilidade`) VALUES ('$order_id','$item_id','$item_amount','$item_price','$item_total','$item_rentab')";

	try {
		$database->query($sql_item);

		$_SESSION['message'] = 'Item adicionado com sucesso.';
		$_SESSION['type'] = 'success';
		$erro = false;

	} catch (Exception $e) { 

		$_SESSION['message'] = 'Nao foi possivel realizar a operação.';
		$_SESSION['type'] = 'danger';
		$erro = true;
	} 

	close_database($database);
	if($erro){
		return 0;
	}else{
		return 1;
	}
}

function remove_item( $id = null ) {

	$database = open_database();

	try {
		if ($id) {

			$sql_delete = "DELETE FROM `itens_pedido` WHERE `id_pedido` = ".$id;

			$result = $database->query($sql_delete);

			if ($result = $database->query($sql_delete)) {   	
				$_SESSION['message'] = "Registro Removido com Sucesso.";
				$_SESSION['type'] = 'success';
			}
		}
	} catch (Exception $e) { 

		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}

	close_database($database);
}

function update($table = null, $id_cliente  = null,  $valor_pedido  = null, $id_pedido  = null) {
	$erro = null;
	$database = open_database();

	$sql = "UPDATE `".$table."` SET `id_cliente`=".$id_cliente." , `valor_do_pedido`=".$valor_pedido." WHERE id =".$id_pedido."";

	try {
		$database->query($sql);

		$_SESSION['message'] = 'Pedido alterado com sucesso.';
		$_SESSION['type'] = 'success';
		$erro = false;


	} catch (Exception $e) { 

		$_SESSION['message'] = 'Nao foi possivel realizar a operação.';
		$_SESSION['type'] = 'danger';
		$erro = true;
	} 

	close_database($database);
	if($erro){
		return 0;
	}else{
		return 1;
	}
}


function remove( $table = null, $id = null ) {

  $database = open_database();
	
  try {
		if ($id) {

			$sql = "DELETE FROM " . $table . " WHERE id = " . $id;
			$result = $database->query($sql);

			if ($result = $database->query($sql)) {   	
				$_SESSION['message'] = "Registro Removido com Sucesso.";
				$_SESSION['type'] = 'success';
			}
		}
	} catch (Exception $e) { 
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}

	close_database($database);
}