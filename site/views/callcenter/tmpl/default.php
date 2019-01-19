<?php
defined('_JEXEC') or die('Restricted Access');
?>

<div class="codigotitulo">
<h1> 
	<?php // opc del componente PROBLEMA: solo tiene acceso el administrador
		//params esta asignado en la view.html para poder recoger los parametros de opc dl componente
	//	echo '************'.$this->params->get('page_heading').'<br/>';
		echo JText::_('COM_CALLCENTER_DEFAULT_CALLCENTER');
		
		?>
</h1>
    <div class="formulario" style="display: table;margin: 0 auto;">
   <?php
        echo '<pre>';
        print_r($this->document->base);
        echo '</pre>';

        echo $this->loadTemplate('form');
    ?>
    </div>
</div>
