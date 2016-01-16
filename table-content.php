<?php
require_once("poke_reader.php");

if ($pokemons !== null) {
	foreach ($pokemons as $key => $value) { ?>
	<tr>
		<th><?php echo $key+1; ?></th>
		<th><?php echo $value['num']; ?></th>
		<th><a href="http://www.pokepedia.fr<?php echo $value['href']; ?>" target="_blank"><?php echo $value['name']; ?></a></th>
		<td><?php echo $value['pv']; ?></td>
		<td><?php echo $value['atk']; ?></td>
		<td><?php echo $value['def']; ?></td>
		<td><?php echo $value['atks']; ?></td>
		<td><?php echo $value['defs']; ?></td>
		<td><?php echo $value['spd']; ?></td>
		<td><?php echo $value['total']; ?></td>
	</tr>
	<?php }
} else { ?>
<tr>
	<td colspan="10" class="text-center">Maybe you are Offline.</td>
</tr>
<?php } ?>
