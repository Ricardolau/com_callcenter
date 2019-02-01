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
        $params = $this->obtenerParametros();
        if ($params->get('debug') === '1'){
            // Mostramos respuesta si Debug activo
            echo '<pre>';
            echo 'debug de view/respuesta/view.html';
            print_r($this->resultado);
            echo '</pre>';
        }
        // Añadimos las texto principal y secundario por defecto, que cuando _ok_title= Ok
        $this->texto_principal = JText::_('COM_CALLCENTER_RESPUESTA_OK_LABEL');
        $this->texto_secundario = JText::_('COM_CALLCENTER_RESPUESTA_OK_DESC');
        
        
		//display de la vista
		parent::display($tpl);
	}

    public function obtenerParametros () {
        $app = JFactory::getApplication();
        // Nosotros vamos comprobar si esta operativo el callCenter.
        // Obtenemos parametros del componente.
        $params = $app->getParams('com_callcenter');
		//~ $this->assignRef('params',		$params);
        return $params;

    }
	
}
