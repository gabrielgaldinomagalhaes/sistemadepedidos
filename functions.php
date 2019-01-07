<?php
	require_once('config.php');
	require_once(DBAPI);

	$orders = null;
	$order = null;
	$item= null;
	$item_pedido= null;
	$items= null;
	$consumers= null;
	$last_id= null;
	$new_id= null;

	function index() {
		global $orders;
		$orders = find_all('pedidos');
	}

	function consumers() {
		global $consumers;
		$consumers = find_consumers('clientes');
	}

	function add() {
		global $consumers;
		$consumers = find_consumers('clientes');

		global $items;
		$items = find_products('produtos');

		if (!empty($_POST['salvar'])) {
			$consumer_id = $_POST['id-consumer'];
			$valor_pedido = $_POST['order-total-hidden'];
			$order_id = $_POST['num-order'];

			$valor_pedido = str_replace("R$", "", "$valor_pedido");
			$valor_pedido = str_replace(".", "", "$valor_pedido");
			$valor_pedido = str_replace(",", ".", "$valor_pedido");


			$valor_pedido = preg_replace("/[^0-9]/", "", $valor_pedido);
			$tam = strlen($valor_pedido);
			$tam = $tam-2;

			$array = str_split($valor_pedido, $tam);
			$novaString = implode(".", $array);

			$save = save('pedidos', $consumer_id,$novaString);
			remove_item($order_id);
			$items_quant = $_POST['num-itens'];

			for($x = 1; $x <= $items_quant; $x++){
				$quant = $_POST['amount-item_'.$x];
				if ($quant>0){

					$item_id = $_POST['item-id_'.$x];
					$item_price = $_POST['item-price_'.$x];
					$item_amount = $_POST['amount-item_'.$x];
					$item_rentab = utf8_decode($_POST['rentab_'.$x]);
					$item_total = $_POST['item-total-hid_'.$x];

					$item_total = str_replace("R$", "", "$item_total");
					$item_total = str_replace(".", "", "$item_total");
					$item_total = str_replace(",", ".", "$item_total");

					$item_total = preg_replace("/[^0-9]/", "", $item_total);
					$tam_total = strlen($item_total);
					$tam_total = $tam_total-2;

					$array_total = str_split($item_total, $tam_total);
					$nova_total = implode(".", $array_total);

					$save_item = save_item($order_id,$item_id,$item_amount,$item_price,$item_rentab,$nova_total);
				}

			}	  
			if($save==1 && $save_item==1){
				header('location: view.php?id='.preg_replace("/[^0-9]/", "", $order_id).'&success=1');
			}else{
				header('location: index.php?id=-1');
			}
		}
		global $last_id;
		global $new_id;
		$last_id = find_last_id();
		$new_id = str_pad($last_id+1, 5, '0', STR_PAD_LEFT);
	}

	function edit($order_id = null) {

		global $consumers;
		$consumers = find_consumers('clientes');

		global $items;
		$items = find_products('produtos');

		if (isset($_GET['id']) && $_GET['id']!= "" && $_GET['id']!= 0) {

			if (empty($_POST['salvar'])){

				global $order;
				$order = find('pedidos', $order_id);

				global $item_pedido;
				$item_pedido = find_order_items('itens_pedido', $order_id);

			}else{
				$consumer_id = $_POST['id-consumer'];
				$valor_pedido = $_POST['order-total-hidden'];
				$order_id = $_POST['num-order'];

				$valor_pedido = str_replace("R$", "", "$valor_pedido");
				$valor_pedido = str_replace(".", "", "$valor_pedido");
				$valor_pedido = str_replace(",", ".", "$valor_pedido");

				$valor_pedido = preg_replace("/[^0-9]/", "", $valor_pedido);
				$tam = strlen($valor_pedido);
				$tam = $tam-2;

				$array = str_split($valor_pedido, $tam);
				$novaString = implode(".", $array);

				$save = update('pedidos', $consumer_id,$novaString,$order_id);
				remove_item($order_id);

				$items_quant = $_POST['num-itens'];

				for($x = 1; $x <= $items_quant; $x++){
					$quant = $_POST['amount-item_'.$x];
					if ($quant>0){

						$item_id = $_POST['item-id_'.$x];
						$item_price = $_POST['item-price_'.$x];
						$item_amount = $_POST['amount-item_'.$x];
						$item_rentab = utf8_decode($_POST['rentab_'.$x]);
						$item_total = $_POST['item-total-hid_'.$x];

						$item_total = str_replace("R$", "", "$item_total");
						$item_total = str_replace(".", "", "$item_total");
						$item_total = str_replace(",", ".", "$item_total");

						$item_total = preg_replace("/[^0-9]/", "", $item_total);
						$tam_total = strlen($item_total);
						$tam_total = $tam_total-2;

						$array_total = str_split($item_total, $tam_total);
						$nova_total = implode(".", $array_total);

						$save_item = save_item($order_id,$item_id,$item_amount,$item_price,$item_rentab,$nova_total);
					}

				}	  
				if($save==1 && $save_item==1){
					header('location: view.php?id='.preg_replace("/[^0-9]/", "", $order_id).'&success=2');
				}else{
					header('location: index.php?id=-2');
				}
			}
		} else {
			header('location: index.php');
		}
	}

	function view($id = null) {
		global $order;
		$order = find('pedidos', $id);

		global $item;
		$item = find_order_items('itens_pedido', $id);

	}

	function delete($id = null) {

		global $order;
		$order = remove('pedidos', $id);

		header('location: index.php');
	}


?>