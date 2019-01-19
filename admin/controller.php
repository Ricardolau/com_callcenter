<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
//~ jimport('joomla.application.component.controller');

//es obligatorio que herede JController
class CallcenterController extends JControllerLegacy
{	
	//~ protected $view = 'CodigoRecibo';
	
	public function display($cachable = false, $urlparams = false) 
	{
	
		//programar una vista por defecto si no se establece
		$input = JFactory::getApplication()->input;
		//set establece y get toma
		$input->set('view', $input->getCmd('view', 'callcenter'));
		
		
		//ESTO NO ME HACE NADA
			// Compruebe formulario de edición .
		if ($view == 'vista' && $layout == 'edit' && !$this->checkEditId('com_callcenter.edit.vista', $id)) 
		{
			
			$this->setRedirect(JRoute::_('index.php?option=com_callcenter&view=callcenter', false));
			return false;
		}
		
		
		
		// call parent behavior
//		parent::display($cachable);
	
		parent::display();
	}
}
