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
			<?php echo $item->apellidos; ?>
		</td>
		<td>
			<?php echo $item->nombre; ?>
		</td>
        <td>
			<?php echo $item->telefono; ?>
		</td>
        <td>
			<?php echo $item->estado; ?>
		</td>
        <td>
			<?php echo $item->intentos; ?>
		</td>
	</tr>
<?php endforeach; ?>
<!--JHTML :: _ es una función auxiliar capaz de mostrar varios salida HTML.
 En este caso, se mostrará una casilla de verificación para el elemento.
-->
