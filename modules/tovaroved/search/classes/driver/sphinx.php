<?php

class Driver_Sphinx extends Client_Sphinx
{


	private $_search_query = "";

	private $_query_filters = array();

	public function __construct()
	{
		parent::__construct();

		$this->SetServer(Kohana::$config->load("search.sphinx.host"), Kohana::$config->load("search.sphinx.port"));
		$this->SetMatchMode(SPH_MATCH_EXTENDED2);
	}

	public function search($query_string){
		$this->_search_query = $query_string;	
		return $this;	
	}

	public function filter($name, $filters = []){
		$this->SetFilter($name, $filters);
		return $this;
	}

	public function execute(){
		$result = $this->query($this->_search_query);

		if ( $result === false )
			throw new Kohana_Exception( '[SPHINX] Query failed: ' . $this->GetLastError() );
		elseif ( $this->GetLastWarning() ) 
			throw new Kohana_Exception( '[SPHINX] WARNING: ' .  $this->GetLastWarning() );

		return $result;
	}
}
