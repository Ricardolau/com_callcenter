<?php
defined('_JEXEC') or die;

/* Instancia objecto controller , pero no entra dentro de funciones 
 * de controlador controller.php
 * */
$controller = JControllerLegacy::getInstance('Callcenter');

$controller->execute(JFactory::getApplication()->input->get('task'));
// Si existe resultado , entonces asignamos vista...
if  (isset($controller->resultado)){
    $view = $controller->view;
    $controller->execute(JFactory::getApplication()->input->set('view', $view));
}

// Pienso que está lines suelta el componente, es decir continua montando la pagina.. pie pagina por ejemplo
$controller->redirect();
