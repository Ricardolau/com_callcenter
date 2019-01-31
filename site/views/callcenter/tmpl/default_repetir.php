<?php

defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');


?>
<div class="callcenter-form">
	<form id="callcenter-repetir" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form well">
		<fieldset>
			
			
			<?php 
            // hay error no se muestra boton de formulario.
            if (!isset($this->error)){
            ?>
				
				<div class="controls">
                    <button class="btn btn-primary" type="submit"><?php echo JText::_('COM_CALLCENTER_REPETIR'); ?></button>
                    <a class="btn" href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>">
					<?php echo JText::_('JCANCEL'); ?>
                    </a>
					<input type="hidden" name="option" value="com_callcenter" />
					<?php // El siguiente input, añade task a objeto controller y indica la controlador expecifico y funcion ;?>
					<input type="hidden" name="task" value="repetir" />
					<?php echo JHtml::_( 'form.token' ); ?>
				</div>
            <?php
            }
            ?>
			</div>
		</fieldset>
	</form>
</div>
