<?php
defined('_JEXEC') or die('Restricted Access');
$tp= $this->texto_principal
?>

<div class="codigotitulo">
<?php 
    echo '<h1>'.$tp.'</h1>';
    echo '<p>'.$this->texto_secundario.'</p>';
?>

<div class="formulario" style="display: table;margin: 0 auto;">
   <?php
        switch ($tp)
        {
        case JText::_('COM_CALLCENTER_FORMULARIOENVIADO_LABEL'):
            // El formulario fue enviado y grabado.
            echo $this->loadTemplate('repetir');
        break;
        
        case JText::_('COM_CALLCENTER_FUERAHORARIO_LABEL'):
            echo ' Debería mostrar el horario....';
        break;


        default:
            // Cargamos el formulario.
            echo $this->loadTemplate('form');

        }
    


   
    ?>
    </div>
</div>
