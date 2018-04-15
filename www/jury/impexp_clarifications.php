<?php
/**
 * Code to import and export HTML formats as specified by the ICPC
 * Contest Control System Standard.
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');
require(LIBWWWDIR . '/scoreboard.php');
require(LIBWWWDIR . '/clarification.php');
require(LIBDIR . '/lib.impexp.php');

requireAdmin();

$queues = getClarQueues();
$categs = getClarCategories();
$clarifications = $DB->q('SELECT c.*, cp.shortname, p.name AS probname
            FROM clarification c
            LEFT JOIN problem p USING(probid)
            LEFT JOIN contestproblem cp USING (probid, cid)
            WHERE c.cid = %i ORDER BY category, probid, submittime, clarid', $cdata['cid']);

// Note: we're using affiliation names here for the WFs!
$team_names = $DB->q('KEYVALUETABLE SELECT t.teamid, a.name
                      FROM team t
                      LEFT JOIN team_affiliation a USING (affilid)');

$clarificationsById = [];
$grouped = [];

while ($clarification = $clarifications->next()) {
	$clarificationsById[$clarification['clarid']] = $clarification;
	$queue = $clarification['queue'];

	if (!isset($grouped[$queue])) {
		$grouped[$queue] = [];
	}

	if (isset($clarification['respid'])) {
		$originalClarification = $clarificationsById[$clarification['respid']];
		$originalQueue = $originalClarification['queue'];
		$grouped[$originalQueue][$clarification['respid']]['reply'] = $clarification;
	} else {
		$grouped[$queue][$clarification['clarid']] = $clarification;
	}
}

$title = sprintf('Clarifications for %s', $cdata['name']);
require(LIBWWWDIR . '/impexp_header.php');
?>
<?php foreach ($grouped as $queue => $clarifications): ?>
	<h2><?= $queues[$queue] ?></h2>
	<table class="table">
		<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Contest time</th>
			<th scope="col">From</th>
			<th scope="col">To</th>
			<th scope="col">Subject</th>
			<th scope="col">Contents</th>
			<th scope="col">Answered?</th>
			<th scope="col">Reply</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($clarifications as $clarification): ?>
			<?php
			if (!empty($clarification['sender'])) {
				$from = specialchars($team_names[$clarification['sender']]);
			} else {
				$from = 'Jury' . ' (' . specialchars($clarification['jury_member']) . ')';
			}
			if ($clarification['recipient'] && empty($clarification['sender'])) {
				$to = specialchars($team_names[$clarification['recipient']]);
			} else {
				$to = ($clarification['sender']) ? 'Jury' : 'All';
			}
			?>
			<tr>
				<td><?= $clarification['clarid'] ?></td>
				<td><?= printtime($clarification['submittime'], NULL, $clarification['cid']) ?></td>
				<td><?= $from ?></td>
				<td><?= $to ?></td>
				<td>
					<?php
					if (is_null($clarification['probid'])) {
						if (is_null($clarification['category'])) {
							echo 'General';
						} else {
							if (array_key_exists($clarification['category'], $categs)) {
								echo specialchars($categs[$clarification['category']]);
							} else {
								echo 'General';
							}
						}
					} else {
						echo 'Problem ' . specialchars($clarification['shortname'] . ": " . $clarification['probname']);
					}
					?>
				</td>
				<td>
					<pre><?= specialchars(wrap_unquoted($clarification['body'], 80)) ?></pre>
				</td>
				<td><?= $clarification['answered'] ? 'Yes' : 'No' ?></td>
				<td>
					<?php if (isset($clarification['reply'])): ?>
						<pre><?= specialchars(wrap_unquoted($clarification['reply']['body'], 80)) ?></pre>
					<?php else: ?>
						-
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endforeach; ?>
<?php
require(LIBWWWDIR . '/impexp_footer.php');