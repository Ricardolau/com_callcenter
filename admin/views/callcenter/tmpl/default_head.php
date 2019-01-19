<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// Definimos texto de cabeceras vista listado 
$campo1 = JText::_( 'COM_CALLCENTER_NOMBRE_LABEL');
$campo2 = JText::_( 'COM_CALLCENTER_APELLIDOS_LABEL');
$campo3 = JText::_( 'COM_CALLCENTER_TELEFONO_LABEL');
$campo4 = JText::_( 'COM_CALLCENTER_ESTADO_LABEL');
$campo5 = JText::_( 'COM_CALLCENTER_INTENTOS_LABEL');
?>

<tr>

	<th width="1%">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
	</th>
	<th width="2%">
		<?php echo  JHTML::_('grid.sort', 'Id', 'id', $listDirn, $listOrder); ?>
	</th>			
	<th width="2%">
		<?php echo  JHTML::_('grid.sort', 'Fecha', 'created', $listDirn, $listOrder); ?>
	</th>			
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', $campo2, 'apellidos', $listDirn, $listOrder); ?>
	</th>
	<th width="5%">
		<?php echo  JHTML::_('grid.sort', $campo1, 'nombre', $listDirn, $listOrder); ?>
	</th>
    <th width="5%">
		<?php echo  JHTML::_('grid.sort', $campo3, 'telefono', $listDirn, $listOrder); ?>
	</th>
    <th width="5%">
		<?php echo  JHTML::_('grid.sort', $campo4, 'estado', $listDirn, $listOrder); ?>
	</th>
     <th width="5%">
		<?php echo  JHTML::_('grid.sort', $campo5, 'intentos', $listDirn, $listOrder); ?>
	</th>
	
	
</tr>
