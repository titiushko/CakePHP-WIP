<?php
if (!class_exists('ConnectionManager') || Configure::read('debug') < 2) {
	return FALSE;
}
$noLogs = !isset($sqlLogs);
if ($noLogs):
	$sources = ConnectionManager::sourceList();

	$sqlLogs = array();
	foreach ($sources as $source):
		$db = ConnectionManager::getDataSource($source);
		if (!method_exists($db, 'getLog')):
			continue;
		endif;
		$sqlLogs[$source] = $db->getLog();
	endforeach;
endif;

if ($noLogs || isset($_forced_from_dbo_)):
	foreach ($sqlLogs as $source => $logInfo):
		$text = $logInfo['count'] > 1 ? 'queries' : 'query';
		printf(
			'<table class="table table-striped table-bordered table-hover" id="cakeSqlLog_%s" summary="Cake SQL Log" cellspacing="0">',
			preg_replace('/[^A-Za-z0-9_]/', '_', uniqid(time(), TRUE))
		);
		printf('<caption>(%s) %s %s took %s ms</caption>', $source, $logInfo['count'], $text, $logInfo['time']);
	?>
	<thead>
		<tr><th>Nr</th><th>Query</th><th>Error</th><th>Affected</th><th>Num. rows</th><th>Took (ms)</th></tr>
	</thead>
	<tbody>
	<?php
		foreach ($logInfo['log'] as $k => $i) :
			$i += array('error' => '');
			if (!empty($i['params']) && is_array($i['params'])) {
				$bindParam = $bindType = null;
				if (preg_match('/.+ :.+/', $i['query'])) {
					$bindType = TRUE;
				}
				foreach ($i['params'] as $bindKey => $bindVal) {
					if ($bindType === TRUE) {
						$bindParam .= h($bindKey) . " => " . h($bindVal) . ", ";
					} else {
						$bindParam .= h($bindVal) . ", ";
					}
				}
				$i['query'] .= " , params[ " . rtrim($bindParam, ', ') . " ]";
			}
			printf('<tr><td>%d</td><td>%s</td><td>%s</td><td style="text-align: right">%d</td><td style="text-align: right">%d</td><td style="text-align: right">%d</td></tr>%s',
				$k + 1,
				h($i['query']),
				$i['error'],
				$i['affected'],
				$i['numRows'],
				$i['took'],
				"\n"
			);
		endforeach;
	?>
	</tbody></table>
	<?php
	endforeach;
else:
	printf('<p>%s</p>', __d('cake_dev', 'Encountered unexpected %s. Cannot generate SQL log.', '$sqlLogs'));
endif;
