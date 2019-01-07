<?php 
	require_once('functions.php'); 
	view($_GET['id']);
	include(HEADER_TEMPLATE);
	
	if (!empty($_SESSION['message'])) : ?>
		<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; 

if(isset($_GET['success'])){
	if($_GET['success']==1){
		echo "<div class='alert alert-success' role='alert'>Pedido <strong>".$_GET['id']."</strong> Adicionado com Sucesso!</div>";
	}else if ($_GET['success']==2){
		
		echo "<div class='alert alert-success' role='alert'>Pedido <strong>".$_GET['id']."</strong> Alterado com Sucesso!</div>";}
	}

?>

<h2><i class="fa fa-eye"></i> Pedido <small>- <?php echo $order['id']; ?></small></h2>
<hr>
<hr/>
<div class="row">
	<div class="col-sm-12" ><strong>Cliente </strong>-  <small class="text-muted">ID</small></div>
</div>
<div class="row">
	<div class="col-sm-12" ><h3><?php echo $order['nome']; ?> <small class="text-muted"> - <?php echo $order['id_cliente']; ?></small></h3></div>
</div>
<hr/>
<div class="row">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Item</th>
				<th>ID do Item</th>
				<th class="text-left">Nome</th>
				<th class="text-right">Preço Sugerido</th>
				<th class="text-right">Preço Venda</th>
				<th class="text-center">Rentabilidade</th>
				<th class="text-center">Quantidade</th>
				<th class="text-right">Total Parcial</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if($item->num_rows > 0){
			$x= 1;
			while($linha = mysqli_fetch_assoc($item)) {
		?>
			<tr>
				<td><?php echo $x; ?></td>
				<td><?php echo $linha["id_produto"];?></td>
				<td><?php echo $linha["nome"];?></td>
				<td class="text-right"><?php echo 'R$ ' . number_format($linha["preco"], 2, ',', '.');?></td>
				<td class="text-right"><?php echo 'R$ ' . number_format($linha["valor_venda"], 2, ',', '.');?></td>
				<td class="text-center">
					<?php if ($linha["rentabilidade"]=='Boa'){
						echo "<div class='rentability good'> ".$linha['rentabilidade']."</td>";
					}else{
						echo "<div class='rentability great'> Ótima</td>";
					}?>
				</td>
				<td class="text-center"><?php echo $linha["qtdade_de_produtos"];?></td>
				<td class="text-right"><?php echo 'R$ ' . number_format($linha["total_item"], 2, ',', '.');?></td>
			</tr>
			<?php $x++;}
			}else{?>
			<tr>
				<td colspan="6">Nenhum registro encontrado.</td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<hr/>
<hr/>
<div class="row">
	<div class="col-sm-6" ><strong>Total do Pedido:</strong></div>
	<div class="col-sm-6 text-right"><strong><?php echo 'R$ ' . number_format($order['valor_do_pedido'], 2, ',', '.');?></strong></div>
</div>

<hr/>

<div id="actions" class="row">
	<div class="col-md-12">
	  	<a href="index.php" class="btn btn-primary"><i class="fa fa-list"></i> Pedidos</a>
		<a href="edit.php?id=<?php echo $order['id']; ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar</a>
		<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" data-order="<?php echo $order['id']; ?>"><i class="fa fa-trash-o"></i> Excluir</a>
	  
	</div>
</div>
<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>