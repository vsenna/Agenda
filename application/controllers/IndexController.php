<?php
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    /**
     * List contacts
     */
    public function listAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	
    	$data  = new Application_Model_DbTable_Agenda();
    	
    	$result = $data->getAll($this->_getAllParams());

    	$this->_helper->json($result);
    }
    
    /**
     * CRUD
     */
	public function crudAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		
		$request = $this->getRequest();
		
		$dao  = new Application_Model_DbTable_Agenda();
		
		switch ($request->getParam('oper'))
		{
			case "add":
				$dao->add($this->_getAllParams());
				break;
			case "edit":
				$dao->edit($this->_getAllParams());
				break;
			case "del":
				$dao->del($this->_getAllParams());
				break;
		}
	}
}

