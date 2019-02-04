<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');

?>


<div class="respuesta" style="text-align:center; display: table; margin: 0px auto;">
        
        
               
        	<?php
            if (isset($this->resultado['error'])){
                // hubo un error por lo que mostramos datos del error
                $error = $this->resultado['error'];
                if ( $error === 50030 ){
                    echo '<h1>Error sin identificar</h1>';
                    echo '<p>Debería mostrar btn para reenviar.[f5]</p>';
                }
                if ( $error === 40001 ){
                    echo '<h1>'.JText::_('COM_CALLCENTER_CREADA_PENDIENTE_LABEL').'</h1>';
                    echo '<p>'.JText::_('COM_CALLCENTER_CREADA_PENDIENTE_DESC').'</p>';

                }

            } else {
                // Todo fue correcto.
                echo '<h1>'.$this->texto_principal.'</h1>';
                echo '<p>'.$this->texto_secundario.'</p>';



            }
              
            ?>
</div>

