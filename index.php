<?php
	require_once('functions.php');
	index();
	include(HEADER_TEMPLATE);
?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2><i class="fa fa-list"></i> Pedidos</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Pedido</a>
			<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>

<?php
	if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>
	<?php clear_messages(); ?>
<?php 
	endif; 

	if (!empty($_GET['id'])){
		if($_GET['id']==-1){
			echo "<div class='alert alert-danger' role='alert'>Ocorreu algum erro ao adicionar o Pedido!</div>";
		}else if($_GET['id']==-2){
			echo "<div class='alert alert-danger' role='alert'>Ocorreu algum erro ao alterar o Pedido!</div>";
		}else{
			echo "<div class='alert alert-success' role='alert'>Pedido <strong>".$_GET['id']."</strong> Adicionado com Sucesso!</div>";
		}
	}

?>
<hr>

<table class="table table-hover">
<thead>
	<tr>
		<th>N° Pedido</th>
		<th width="30%">Cliente</th>
		<th class="text-right">Valor do Pedido</th>
		<th class="text-center">A&ccedil;&otilde;es</th>
	</tr>
</thead>
<tbody>
<?php if ($orders) : ?>
<?php foreach ($orders as $order) : ?>
	<tr>
		<td><?php echo $order['id']; ?></td>
		<td><?php echo $order['nome']; ?></td>
		<td class="text-right"><?php echo 'R$ ' . number_format($order['valor_do_pedido'], 2, ',', '.');?></td>
		<td class="actions text-right">
			<a href="view.php?id=<?php echo $order['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
			<a href="edit.php?id=<?php echo $order['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
			<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-order="<?php echo $order['id']; ?>"> <i class="fa fa-trash-o"></i> Excluir</a>
		</td>
	</tr>
<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>

<?php include('modal.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>