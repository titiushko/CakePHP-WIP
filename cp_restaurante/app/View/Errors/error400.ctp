<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-times-circle"></i> Error 400</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= $message; ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<p class="alert alert-danger">
							<strong><?php echo __d('cake', 'Error'); ?>: </strong>
							<?php printf(
								__d('cake', 'The requested address %s was not found on this server.'),
								"<strong>'{$url}'</strong>"
							); ?>
						</p>
						<?php
						if (Configure::read('debug') > 0):
							echo $this->element('exception_stack_trace');
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
