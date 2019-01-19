<?php

defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
?>
<div class="codigorecibo-form">
	<div class="alert alert-danger">
        <?php
            echo ' La participacion con nº:'.$this->resultado->numeroParticipacion
                .' con la cantidad Jugada de '.$this->resultado->cantidadJugada
                .' fue pagada por usuario '.$this->resultado->cajero
                . ' el dia '.$this->resultado->modified;
        ?>
    </div>
</div>
