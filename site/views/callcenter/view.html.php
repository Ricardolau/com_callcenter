<?php
defined( '_JEXEC') or die( 'Restricted access');
//~ jimport( 'joomla.application.component.view');

class CallcenterViewCallcenter extends JViewLegacy
{
	protected $form;
	
	function display($tpl = null)
	{
		$item = $this->get('Item');

        $this->form = $this->get('Form');
		//Consigo los parametros de opc config (btn menu toolbar dl com_nuevo)
		$params = JComponentHelper::getParams('com_callcenter');
			//$titul=$params->get('texto_principal');
		
		$this->assignRef('params',		$params);	

        $session = JFactory::getSession();
        if ($session->get('intentos')){
            // Obtenemos los datos que teníamos.
            $input = JFactory::getApplication()->input;
            //~ // Get the data from POST
            $this->resultado = JRequest::getVar('jform', array(), 'post', 'array');
            // Ahora en mensajes de sistema joomla debería aparecer que esta mal y porque no paso view resultado.
            
        }
       

        		//display de la vista
		parent::display($tpl);
	}
	
}
