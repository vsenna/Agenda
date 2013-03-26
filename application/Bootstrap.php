<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initViewHelpers() {
		$view = Zend_Layout::startMvc()->getView();
		//setting page title
		$view->headTitle( 'Agenda de contatos' )
			->setSeparator(' | ');
	}
	
	protected function _initDoctype(){
		//set content
		$view = Zend_Layout::startMvc()->getView();
		$view->headMeta()->appendHttpEquiv('Content-Type','text/html; charset=UTF-8');
		//appending js files
		$view->headScript()->appendFile('/static/js/jquery-1.9.1.js');
		$view->headScript()->appendFile('/static/js/jquery-ui-1.10.1.custom.min.js');
		$view->headScript()->appendFile('/static/js/jquery.jqGrid.min.js');
		//$view->headScript()->appendFile('/static/js/jgrid.locale-pt-br.js');
		$view->headScript()->appendFile('/static/js/grid.locale-en.js');
		$view->headScript()->appendFile('/static/js/agenda.js');
		//appending stylesheets
		$view->headLink()->appendStylesheet('/static/css/style.css');
		$view->headLink()->appendStylesheet('http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css');
		$view->headLink()->appendStylesheet('/static/css/ui.jqgrid.css');
	}

	protected function _initRouters()
	{
		//setting default router
		$router = Zend_Controller_Front::getInstance()->getRouter();
	
		$route = new Zend_Controller_Router_Route(
				':action/*',
				array(
						'controller' => 'index',
						'action' => 'index'
				)
		);
	
		$router->addRoute('default', $route);
	}
}

