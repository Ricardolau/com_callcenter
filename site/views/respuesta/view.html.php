<?php
defined( '_JEXEC') or die( 'Restricted access');
//~ jimport( 'joomla.application.component.view');

class CallcenterViewRespuesta extends JViewLegacy
{
	protected $resultado;
    protected $form;
	//protected $item;
	//	protected $state;
	
	function display($tpl = null)
	{
        $this->resultado = $this->get('Comprobar');

        //~ $input = JFactory::getApplication()->input;

		// Get the data from POST
        
		//~ $this->resultado = JRequest::getVar('jform', array(), 'post', 'array');
        echo '<pre>';
        print_r($this->resultado);
        echo '</pre>';
		//display de la vista
		parent::display($tpl);
	}
	
}
