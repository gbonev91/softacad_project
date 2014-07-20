<?php

class Pagination {

	private $data = array();
	private $limit;

	public function __construct($data, $limit) {
		$this->data = $data;
		$this->limit = $limit;
		$this->check();
	}
	// get the sliced array
	public function pieces() {
		if (isset($_GET['page']))
		{
		    $page = $_GET['page']-1;
		}
		else
		{
		    $page = 0;
		}

		return array_slice($this->data, $this->limit * $page, $this->limit);

	}
	// get the max pages
	public function getMaxPage() {
		return ceil(count($this->data) / $this->limit);
	}
	// show pagination
	public function pages(){
		$pagination = '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']-1).'">&lt;</a>';
		for($i = 0; $i < $this->getMaxPage(); $i++)
		{	
		    $pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($i+1).'">'.($i+1).'</a>';
		}
		$pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($_GET['page']+1).'">&gt;</a>';
		return $pagination;
	}
	// check for errors in NEXT and PREV pagination links
	public function check() {
		if ($_GET['page'] < 0 || $_GET['page'] > $this->getMaxPage()) redirect($_SERVER['PHP_SELF']);
	}

}