<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<?php 
//~ echo '<pre>';
//~ print_r($this);
//~ echo '</pre>';
foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
			<?php echo $item->id; ?>
		</td>		
		<td>
			<?php echo $item->created; ?>
		</td>	
		<td>
			<?php echo $item->numeroParticipacion; ?>
		</td>
		<td>
			<?php echo $item->cantidadJugada; ?>
		</td>
        <td>
			<?php echo $item->vendido; ?>
		</td>
        <td>
			<?php echo $item->cajero; ?>
		</td>
        <td>
			<?php echo $item->pagada; ?>
		</td>
	</tr>
<?php endforeach; ?>
<!--JHTML :: _ es una función auxiliar capaz de mostrar varios salida HTML.
 En este caso, se mostrará una casilla de verificación para el elemento.
-->
