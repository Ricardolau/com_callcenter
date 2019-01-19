<?php //$this es el assignref que declaramos en view.html.php
		//con el mensaje recogido del modelo para mostrar
			//	echo $this->mensaje;
				//~ echo '<pre>';
				//~ print_r($this);
				//~ echo '</pre>';
//https://docs.joomla.org/J2.5:Developing_a_MVC_Component/Basic_backend   COMPLETA
defined('_JEXEC') or die('Restricted Access');
// cargar de tooltip
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_callcenter'); ?>" method="post" name="adminForm" id="adminForm">
	<table class="table table-striped">
		<?php/*se llama varias sub-layout ( cabeza , pies y cuerpo ).
		 * Cada sub-diseño corresponde a un archivo con el prefijo 
		 * del nombre de la presentación principal (por defecto), y un guión bajo.
		 * */?>
		<thead><?php echo $this->loadTemplate('head');?></thead>
		<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
		<tbody><?php echo $this->loadTemplate('body');?></tbody>
	</table>
	<div>
		<?php//task , es una propiedad de formulario se establece
		//cuando clickeas en uno de ls btnes de toolbar
		//boxchecked, lleva la cuenta dl nº de casillas k se seleccionen
		//ultimo campo, controlador, se usa para especificar k las tareas
		//de ls disparadores dsd este modelo seran tratads por el controlador  ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="controller" value="callcenter"/>
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
