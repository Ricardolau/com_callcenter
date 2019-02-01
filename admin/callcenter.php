<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_callcenter
 *
 * @copyright   Copyright (C) 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */ 
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tabstate');
// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_callcenter')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Configurar algunas propiedades globales
$document = JFactory::getDocument();
// importar librería de controladores de Joomla
//~ jimport('joomla.application.component.controller');

// codigorecibo esta en la nomenclatura de la class en controller.php 
$controller = JControllerLegacy::getInstance('Callcenter');

// Ejecutar la tarea de solicitud
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirigir si está configurado por el controlador
$controller->redirect();
