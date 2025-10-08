<?php if (isset($_GET['msgSucesso'])) { $msg = $_GET['msgSucesso']; ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fas fa-check-circle fa-lg"></i>
		<?php echo $msg; ?>
		</div>
	</div>
</div>
<?php } ?>
<?php if (isset($_GET['msgErro'])) { $msg = $_GET['msgErro']; ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fas fa-times-circle fa-lg"></i>
		<?php echo $msg; ?>
		</div>
	</div>
</div>
<?php } ?>
<?php if (isset($_GET['msgInfo'])) { $msg = $_GET['msgInfo']; ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fas fa-info-circle fa-lg"></i>
		<?php echo $msg; ?>
		</div>
	</div>
</div>
<?php } ?>
<?php if (isset($_GET['msgAlerta'])) { $msg = $_GET['msgAlerta']; ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fas fa-exclamation-triangle fa-lg"></i>
		<?php echo $msg; ?>
		</div>
	</div>
</div>
<?php } ?>