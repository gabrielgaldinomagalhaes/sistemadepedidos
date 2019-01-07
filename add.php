<?php 
	require_once('functions.php'); 
	add();
	include(HEADER_TEMPLATE);
?>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>
<?php
	clear_messages();
	endif; 
?>

<h2><i class="fa fa-plus"></i> Novo Pedido</h2>

<form action="add.php" method="post">
    
<hr />
<div class="row">
	<div class="form-group col-md-8">
		<label for="cliente"><strong>Cliente:</strong></label>
		<select class="form-control" name="id-consumer" id="id-consumer" required>
			<option value="">Selecione o cliente...</option>
			<?php if ($consumers) :  ?>
			<?php foreach ($consumers as $consumer) : ?> 
				<option value="<?php echo $consumer['id'];?>"><?php echo $consumer['id'];  ?> - <?php echo $consumer['nome']; ?></option>
			<?php endforeach; ?>
			<?php else : ?>
				<option value="">Nenhum registro encontrado.</option>
			<?php endif; ?>
		</select>
	</div>
</div>

<h4><small><i class="fa fa-plus"></i></small> Adicionar Produtos</h4>
<hr>
<?php if ($items) :  
	$aux=1;
	$num_linhas=count($items);
?>
<input type="hidden" class="form-control" value="<?php echo $num_linhas;  ?>" id="num-itens" name="num-itens">
	<div class="card-deck">

		<?php foreach ($items as $item) : ?>
		<div class="card my-3">
			<img class="card-img-top" src="<?php echo BASEURL; ?><?php echo $item['end_imagem'];  ?>">
			<div class="card-body">
				<h5 class="card-title"><?php echo $item['nome'];  ?><br><small class="text-muted">ID - <?php echo $item['id'];  ?></small> </h5>
				<input type="hidden" class="form-control" value="<?php echo $item['id'];  ?>" id="item-id_<?php echo $aux; ?>" name="item-id_<?php echo $aux; ?>">

				<div class="card-text">
					<div class="row mb-1">
						<strong class="col-md-6">Preço Sugerido:</strong>
						<div class="col-md-6 text-right"><span><?php echo 'R$ ' . number_format($item["preco"], 2, ',', '.');?></span></div>
						<input type="hidden" name="suggest-price_<?php echo $aux; ?>" id="suggest-price_<?php echo $aux; ?>" value="<?php echo $item["preco"];?>">
					</div>
					<div class="row mb-1">
						<div class="col-md-6"><strong >Packs de:</strong></div>
						<div class="col-md-6 text-right"><span><?php echo $item["multiplos"]?></span></div>
					</div>
				</div>
				<hr>
				<div class="col-md-12 card-text back-grey">
					<div class="row mb-1 pt-2">
						<strong class="col-md-6">Preço de Venda (R$):</strong>


						<input type="number" value="<?php echo $item['preco']?>" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="price float-right text-right currency col-md-5" id="item-price_<?php echo $aux; ?>" name="item-price_<?php echo $aux; ?>" onChange="value_update(this,'<?php echo $num_linhas;?>');"/>
					</div>
					<hr>
					<div class="row mb-1">
						<strong class="col-md-7">Rentabilidade:</strong>
						<div class="col-md-4  text-center rentability good" id="rentability_<?php echo $aux; ?>" name="rentability_<?php echo $aux; ?>"><strong>
							<div id="text-bad_<?php echo $aux; ?>" name="text-bad_<?php echo $aux; ?>" class="hidden">Ruim</div>
							<div id="text-good_<?php echo $aux; ?>" name="text-good_<?php echo $aux; ?>" >Boa</div>
							<div id="text-great_<?php echo $aux; ?>" name="text-great_<?php echo $aux; ?>" class="hidden">Ótima</div></strong>
						</div>
						<input type="hidden" id="rentab_<?php echo $aux; ?>" name="rentab_<?php echo $aux; ?>" value="Boa" >
					</div>
					<hr>
					<div class="row mb-1  pb-2">
						<strong class="col-md-8">Quantidade:</strong>
						<input class="amount form-control float-right text-right col-md-3 items-amount" size="10" type="number" step="<?php echo $item["multiplos"]?>" value="0" min="0" onChange="check_amount(this,'<?php echo $num_linhas;?>');" id="amount-item_<?php echo $aux; ?>" name="amount-item_<?php echo $aux; ?>">
					</div>
				</div>
				<hr class="bg-light">
			</div>
			<div class="card-footer">
				<strong>Total Parcial:</strong>
				<input disabled class="form-control text-right texto-valor-total" type="text"  id="item-total_<?php echo $aux; ?>" name="item-total_<?php echo $aux; ?>" value="R$ 0,00">
				<input class="form-control" type="hidden"  id="item-total-hid_<?php echo $aux; ?>" name="item-total-hid_<?php echo $aux; ?>" value="R$ 0,00">
			</div>
		</div>
		<?php  $aux+=1; endforeach; ?>
		<?php else : ?>
		<div class="row">
			<td colspan="6">Nenhum registro encontrado.</td>
		</div>
		<?php endif; ?>
	</div>
	<hr />
	<div class="row back-grey pt-3 pb-3 amount-total">
		<strong class="col-md-4">Total do Pedido:</strong>
		<input class="form-control col-md-4" id="order-total" name="order-total" value="R$ 0,00" disabled/>
		<input class="form-control  hidden" id="order-total-hidden" name="order-total-hidden" value=""/>
	</div>
	<hr />
	<div id="actions" class="row">
		<div class="col-md-12">
			<small class="text-muted" id="block-text" name="block-text">* O pedido deve conter pelo menos um item.<br>* Não podem ocorrer items com rentabilidade <b>Ruim</b>.</small><br><br>
			<button type="submit" class="btn btn-primary" disabled id="salvar" name="salvar" value="salvar"><i class="fa fa-save"></i> Salvar</button>
			<a href="index.php" class="btn btn-secondary"><i class="fa fa-close"></i> Cancelar</a>
		</div>
	</div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
