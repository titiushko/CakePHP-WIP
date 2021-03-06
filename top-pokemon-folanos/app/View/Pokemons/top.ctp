<?php if (count($pokemonlist) == 0) { ?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3>No hay votos del Pokémon más popular</h3>
	</div>
</div>
<?php } else { ?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Top Pokémon de menos popular a más popular</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 pull-right">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 table-responsive">
								<table class="table table-striped table-bordered table-hover table-responsive dataTable" id="dataTable">
									<thead>
										<tr>
											<th class="text-center">Top</th>
											<!--<th class="text-center">%</th>-->
											<th class="text-center">Pokémon</th>
											<th class="text-center">Name</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$top = 1;
										foreach ($pokemonlist as $pokemon):
											if (strlen($pokemon["Pokemon"]["pokemon_id"]) == 1) {
												$pokemon_id = "00".$pokemon["Pokemon"]["pokemon_id"];
											}
											elseif (strlen($pokemon["Pokemon"]["pokemon_id"]) == 2) {
												$pokemon_id = "0".$pokemon["Pokemon"]["pokemon_id"];
											}
											elseif (strlen($pokemon["Pokemon"]["pokemon_id"]) == 3) {
												$pokemon_id = $pokemon["Pokemon"]["pokemon_id"];
											}
											
											if ($pokemon["Pokemon"]["pokemon_id"] == 721) {
												$url = "http://vignette3.wikia.nocookie.net/es.pokemon/images/8/8b/Volcanion.png";
											}
											elseif ($pokemon["Pokemon"]["pokemon_id"] >= 722) {
												$url = "http://img.pokemondb.net/artwork/".strtolower($pokemon[0]["pokemon"]).".jpg";
											}
											else {
												$url = "http://assets.pokemon.com/assets/cms2/img/pokedex/full/".$pokemon_id.".png";
											}
										?>
										<tr>
											<td class="text-center"><?= $top++; ?></td>
											<!--<td class="text-center"><?= number_format($pokemon[0]["percent"], 2, '.', ',')." %"; ?></td>-->
											<td class="text-center"><?= $this->Html->image($url, array("class" => "top-imagen")); ?></td>
											<td class="text-center top-nombre"><?= $pokemon[0]["pokemon"]; ?></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#dataTable").dataTable( {
		"order": [[ 0, "desc" ]],
		"info": false,
		"searching": false,
		"paging": false
	} );
</script>
<?php } ?>
