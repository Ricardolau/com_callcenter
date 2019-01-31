<?php
defined( '_JEXEC') or die( 'Restricted access');
//~ jimport( 'joomla.application.component.view');

class CallcenterViewCallcenter extends JViewLegacy
{
	protected $form;
	
	function display($tpl = null)
	{
        // Valores por defecto y obtenemos parametros.
        $this->texto_principal = JText::_('COM_CALLCENTER_TEXTO_PRINCIPAL');
        $this->texto_secundario = JText::_('COM_CALLCENTER_TEXTO_SECUNDARIO');
        $params = $this->obtenerParametros();
        // Lo primero comprobar si el callcenter funciona y está operativo.
        $estado = $this->get('Comprobar');
      

        $this->form = $this->get('Form');
        // Analizamos resultado de Comprobar para preparar los datos
        if (isset($estado['error'])){
            // No hay conexión
            
            // Cambiamos el texto_principal indicando el que indica el error.
            if ($estado['error'] ===JText::_('COM_CALLCENTER_ERRORCONEXION_LABEL')){
                // Error de conexion
                $this->texto_principal = JText::_('COM_CALLCENTER_ERRORCONEXION_LABEL');
                $this->texto_secundario = JText::_('COM_CALLCENTER_ERRORCONEXION_DESC');
            } else {
                // Error de fuera horario
                $this->texto_principal = JText::_('COM_CALLCENTER_FUERAHORARIO_LABEL');
                $this->texto_secundario = JText::_('COM_CALLCENTER_FUERAHORARIO_DESC');
            }
            $this->error= $estado['error'];
        } 
        

        $session = JFactory::getSession();
        if ($session->get('grabado_id')){
            // Entonces se envio y se grabo y volvio para enviar formulario.
            $this->texto_principal = JText::_('COM_CALLCENTER_FORMULARIOENVIADO_LABEL');
            $this->texto_secundario = JText::_('COM_CALLCENTER_FORMULARIOENVIADO_DESC');
            // Ahora ponemos solo lectura, ya que no queremos que vuelva enviar por lo menos eso mismos datos
            foreach($this->form->getFieldset() as $field){
                // Obtenemos el nombre del campo con $field->getAttribute('name');
                $this->form->setFieldAttribute($field->getAttribute('name'),'readonly','true');
            }
            

         }
        
        if ($session->get('intentos')){
            // Si existe el parametro intento en session es que ya se envio formulario al servidor.
            // Obtenemos los datos que teníamos.
            $input = JFactory::getApplication()->input;
            //~ // Get the data from POST
            $this->resultado = JRequest::getVar('jform', array(), 'post', 'array');
            if (count($this->resultado) === 0){
                // Volvio pulsar en item de menu componente, pero en la session ya envio formulario.
                // Redireccionamos a otra vista
            }
           
            // Ahora en mensajes de sistema joomla debería aparecer que esta mal y porque no paso view resultado.
            // Carga valores que pusl con anterioridad.
            $this->form->setValue('firstname','',$this->resultado['firstname']);
            $this->form->setValue('lastname','',$this->resultado['lastname']);
            $this->form->setValue('_customer_number','',$this->resultado['_customer_number']);
            $this->form->setValue('observaciones','',$this->resultado['observaciones']);
             
            // Si intentos supera el número de cinco se debe bloquear el formulario.
            // de momento no esta operativo.
           
        }
        
       if ($params->get('debug') === '1'){
            // Mostramos respuesta si Debug activo
            echo '<pre>';
            echo 'Debug de estado en views/callcenter:';
            print_r($estado);
            echo 'Intentos:'.$session->get('intentos').'<br/>';
            echo 'Id Grabado:'.$session->get('grabado_id');
            echo '</pre>';
        }

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
