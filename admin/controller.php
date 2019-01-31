<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
//~ jimport('joomla.application.component.controller');

//es obligatorio que herede JController
class CallcenterController extends JControllerLegacy
{	
	
	public function display($cachable = false, $urlparams = false) 
	{
	
		//programar una vista por defecto si no se establece
		$input = JFactory::getApplication()->input;
		//set establece y get toma
		$input->set('view', $input->getCmd('view', 'callcenter'));
		
		
	
		parent::display();
	}
}
