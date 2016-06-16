<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Has click sobre tú Pokémon favorito</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 pull-right">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 table-responsive">
								<table class="table table-striped table-bordered table-hover dataTable" id="dataTable">
									<thead>
										<tr>
											<th class="text-center">N°</th>
											<th class="text-center">Pokémon</th>
											<th class="text-center">Name</th>
											<th class="text-center hidden-phone">Type 1</th>
											<th class="text-center hidden-phone">Type 2</th>
											<th class="text-center hidden-phone">Generation</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($pokemonlist as $pokemon):
											if (strlen($pokemon["Pokemonlist"]["pokemon_id"]) == 1) {
												$pokemon_id = "00".$pokemon["Pokemonlist"]["pokemon_id"];
											}
											elseif (strlen($pokemon["Pokemonlist"]["pokemon_id"]) == 2) {
												$pokemon_id = "0".$pokemon["Pokemonlist"]["pokemon_id"];
											}
											elseif (strlen($pokemon["Pokemonlist"]["pokemon_id"]) == 3) {
												$pokemon_id = $pokemon["Pokemonlist"]["pokemon_id"];
											}
											
											$position = strpos($pokemon["Pokemonlist"]["type"], "|");
											if ($position === false) {
												$type1 = $pokemon["Pokemonlist"]["type"];
												$type2 = "";
											}
											else {
												$type1 = substr($pokemon["Pokemonlist"]["type"], 0, $position);
												$type2 = substr($pokemon["Pokemonlist"]["type"], $position + 1);
											}
											
											if ($pokemon["Pokemonlist"]["pokemon_id"] >= 721) {
												$url = "http://img.pokemondb.net/artwork/".strtolower($pokemon["Pokemonlist"]["pokemon"]).".jpg";
											}
											else {
												$url = "http://assets.pokemon.com/assets/cms2/img/pokedex/full/".$pokemon_id.".png";
											}
										?>
										<tr class="votar" data-id="<?= $pokemon["Pokemonlist"]["pokemon_id"]; ?>" style="cursor: pointer !important;">
											<td class="text-center"><?= $pokemon["Pokemonlist"]["pokemon_id"]; ?></td>
											<td class="text-center"><?= $this->Html->image($url, array("width" => "50%")); ?></td>
											<td class="text-center"><?= $pokemon["Pokemonlist"]["pokemon"]; ?></td>
											<td class="text-center hidden-phone"><?= $type1; ?></td>
											<td class="text-center hidden-phone"><?= $type2; ?></td>
											<td class="text-center hidden-phone"><?= $this->MyHelper->generation($pokemon["Pokemonlist"]["pokemon_id"]); ?></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<th class="text-center input-search">N°</th>
											<th class="text-center ignore">Pokémon</th>
											<th class="text-center input-search">Name</th>
											<th class="text-center hidden-phone">Type 1</th>
											<th class="text-center hidden-phone">Type 2</th>
											<th class="text-center hidden-phone">Generation</th>
										</tr>
									</tfoot>
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
	$(document).ready(function () {
		$("#dataTable").dataTable({
			dom: "C<'clear'>lrtip",
			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
			"oLanguage":{
				"oPaginate":{
					"sFirst":		"<<",
					"sLast":		">>",
					"sNext":		">",
					"sPrevious":	"<"
				}
			},
			initComplete: function () {
				var table = this;
				var select_list = new Array();

				table.api().columns().every(function () {
					var column = this;
					var column_element = column.footer();

					if (!$(column_element).hasClass("input-search") && !$(column_element).hasClass("ignore")) {
						var text_search = "";
						var select = $(
						"<select " +
							"id='" + $(table).attr("id") + "-" + $(column_element).text().replace(" ", "") + "-select-search' " +
							"class='form-control' " +
							"style='width: 100%;'>" +
								"<option value=''>Select " + $(column_element).text() + "</option>" +
						"</select>")
						.appendTo($(column_element).empty())
						.on("change", function () {
							var val = $.fn.dataTable.util.escapeRegex($(this).val());
							column.search(val ? "^" + val + "$" : "", true, false).draw();
						});

						column.data().unique().sort().each(function (element, index) {
							if (element != "") {
								text = element.indexOf("<a") == -1 ? element : $(element).text();
								if (text_search != text) {
									text_search = text;
									select.append("<option value='" + text_search + "'>" + text_search + "</option>");
								}
							}
						});

						select_list.push(select);
					}
					else if ($(column_element).hasClass("input-search")) {
						var input_search_id = $(table).attr("id") + "-" + $(column_element).text().replace(" ", "") + "-input-search";

						$(column_element).html("<input " +
							"type='search' " +
							"class='form-control' " +
							"id='" + input_search_id + "'" +
							"placeholder='Search " + $(column_element).text() + "' " +
							"aria-controls='" + $(table).attr("id") + "'" +
							"style='width: 100%;'" +
						"/>");

						$("#" + input_search_id).keyup(function (event) {
							if (event.which == 27) {
								$(this).val("");
							}
						});

						$("input", column.footer()).on("keyup change", function () {
							if (column.search() !== this.value) {
								column.search(this.value).draw();
							}
						});
					}
				});
			}
		});
		
		$("#dataTable").on("click", "tr.votar", function () {
			location.href = "votacion/" + $(this).data("id");
		});
	});
</script>
