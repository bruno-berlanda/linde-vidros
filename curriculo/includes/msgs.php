<?php if (isset($_GET['msgSucesso'])) { $msg = $_GET['msgSucesso']; ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success" role="alert">
		<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
		<?php echo $msg; ?>
		</div>
	</div>
</div>
<?php } ?>
<?php if (isset($_GET['msgErro'])) { $msg = $_GET['msgErro']; ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
		<?php echo $msg; ?>
		</div>
	</div>
</div>
<?php } ?>
<?php if (isset($_GET['msgInfo'])) { $msg = $_GET['msgInfo']; ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info" role="alert">
		<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
		<?php echo $msg; ?>
		</div>
	</div>
</div>
<?php } ?>
<?php if (isset($_GET['msgAlerta'])) { $msg = $_GET['msgAlerta']; ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<?php echo $msg; ?>
		</div>
	</div>
</div>
<?php } ?>