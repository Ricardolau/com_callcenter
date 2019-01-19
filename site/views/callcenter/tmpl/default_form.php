<?php

defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
 if (isset($this->error)) : ?>
	<div class="contact-error">
		<?php echo $this->error; ?>
	</div>
<?php endif; ?>
<div class="callcenter-form">
	<form id="callcenter-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form well">
		<fieldset>
			
			
			<?php foreach($this->form->getFieldset() as $field): ?>
                    <?php echo $field->label;?>
                    <dl><dd><?php echo $field->input;?></dd></dl>
			<?php  endforeach; ?>
				
				<div class="controls">
                    <button class="btn btn-primary" type="submit"><?php echo JText::_('COM_CALLCENTER_SEND'); ?></button>
                    <a class="btn" href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>">
					<?php echo JText::_('JCANCEL'); ?>
                    </a>
					<input type="hidden" name="option" value="com_callcenter" />
					<?php // El siguiente input, añade task a objeto controller y indica la controlador expecifico y funcion ;?>
					<input type="hidden" name="task" value="submit" />
					<?php echo JHtml::_( 'form.token' ); ?>
				</div>
			</div>
		</fieldset>
	</form>
</div>
