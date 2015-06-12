	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?= $this->Html->link('RESTAURANTE', array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'navbar-brand')); ?>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><?= $this->Html->link('Inicio', array('controller' => 'pages', 'action' => 'display', 'home')); ?></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Meseros <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?= $this->Html->link(__('Lista Meseros'), array('controller' => 'meseros', 'action' => 'index')); ?></li>
							<li class="divider"></li>
							<li><?= $this->Html->link(__('Nuevo Mesero'), array('controller' => 'meseros', 'action' => 'nuevo')); ?></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mesas <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?= $this->Html->link(__('Lista Mesas'), array('controller' => 'mesas', 'action' => 'index')); ?></li>
							<li class="divider"></li>
							<li><?= $this->Html->link(__('Nueva Mesa'), array('controller' => 'mesas', 'action' => 'nuevo')); ?></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>