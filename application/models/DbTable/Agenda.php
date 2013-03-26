<?php

class Application_Model_DbTable_Agenda extends Zend_Db_Table_Abstract
{

    protected $_name = 'contacts';

    //fetch all contacts from table
    public function getAll($request)
    {
    	$page 	= 	$request['page']; 	// get the requested page
    	$limit 	= 	$request['rows']; 	// get how many rows we want to have into the grid
    	$sidx 	= 	$request['sidx']; 	// get index row - i.e. user click to sort
    	$sord 	= 	$request['sord']; 	// get the direction
    
    	if(!$sidx) $sidx = 1;
    
    	$arr = array();
    
    	//setting query
    	$select = $this->select()->from($this,"count(*) as qtd");
    
    	if(isset($request['searchField'])){
    		switch($request['searchOper']){
    			case 'eq':
    				$select->where("'".$request['searchField']."'=?",$request['searchString']);
    				break;
    			case 'cn':
    				$select->where($request['searchField']." like %'".$request['searchString']."%'");
    				break;
    		}
    	}
    
    	//fetching quantity
    	try{
    		$res = $this->fetchRow($select);
    	}catch(Exception $e){
    		print ($e);
    		exit;
    	}
    	//print_r($request);//exit;
    	
    	//quantity
    	$count = $res['qtd'];
    	//calculating total pages
    	if( $count > 0 ) {
    		$total_pages = ceil($count/$limit);
    	}
    	else {
    		$total_pages = 0;
    	}
    
    	if ($page > $total_pages) $page = $total_pages;
    
    	$start = ($page*$limit-$limit); // do not put $limit*($page - 1)
    
    	$select = $this->select()->from($this);
    
    	$arr['page'] = $page;
    	$arr['total'] = $total_pages;
    	$arr['records'] = $count;
    
    	if(isset($request['searchField'])){
    		switch($request['searchOper']){
    			case 'eq':
    				$select->where("'".$request['searchField']."'=?",$request['searchString']);
    				break;
    			case 'cn':
    				$select->where($request['searchField']." like %'".$request['searchString']."%'");
    				break;
    		}
    	}
    
    	try{
    		//$con = $this->fetchAll($select);
    		$con = $this->fetchAll(null, "$sidx $sord", $limit, $start);
    	}catch(Exception $e){
    		print ($e);
    		exit;
    	}
	    
    	for($i = 0 ;$i < count($con);$i++)
    	{
	    	$arr['rows'][$i]['id'] = $con[$i]['id']; //id
	    	$arr['rows'][$i]['cell'] = array(
		    			$con[$i]['birth_date'],
		    			$con[$i]['name'],
		    			$con[$i]['phone'],
		    			$con[$i]['cellphone']
		    	);
    	}
    
    	return $arr;
    }
    
    /**
     * 
     * @param unknown_type $request
     */
    public function add($request)
    {
    	$data = array(
    			'birth_date' 	=> $request['birth_date'],
    			'name'			=> $request['name'],
    			'phone'			=> $request['phone'],
    			'cellphone'		=> $request['cellphone']
    			);
    
    	$this->insert($data);
    }
    
    /**
     * 
     * @param unknown_type $request
     */
	public function edit($request)
    {
    	$data = array(
    					'birth_date' 	=> $request['birth_date'],
		    			'name'			=> $request['name'],
		    			'phone'			=> $request['phone'],
		    			'cellphone'		=> $request['cellphone']
					);
    
    	$where = $this->getAdapter()->quoteInto('id = ?', $request['id']);
    
    	try{
    		$this->update($data, $where);
    	}
    	catch(Exception $e){
    		print($e);
    		exit;
    	}
    }
    
    /**
     * 
     * @param unknown_type $request
     */
    public function del($request)
    {
    	$where = $this->getAdapter()->quoteInto('id = ?', $request['id']);
    
    	try{
    		$this->delete($where);
    	}
    	catch(Exception $e){
    		print($e);
    		exit;
    	}
    }
}

