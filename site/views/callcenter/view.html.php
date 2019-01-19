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
        $this->userLoteria = JFactory::getUser();
		//Consigo los parametros de opc config (btn menu toolbar dl com_nuevo)
		$params = JComponentHelper::getParams('com_callcenter');
			//$titul=$params->get('texto_principal');
		
		$this->assignRef('params',		$params);	

        //~ $t = $this->get('Totales');
        //~ $respuesta = array();
        //~ foreach ($t as $key=>$participaciones){
                 //~ $respuesta[$key]['usuario']=JFactory::getUser($key)->name;
                 //~ $respuesta[$key]['participaciones']= $participaciones;
        //~ }
        //~ $this->resultado = $respuesta;
        //~ echo '<pre>';
        //~ print_r($this->resultado);
        //~ echo '</pre>';

        		//display de la vista
		parent::display($tpl);
	}
	
}
