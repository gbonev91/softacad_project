<?php

interface ICRUD {

	public function add(IItem $item);
	public function update($id, IItem $item);
	public function delete($id);
	public function get($id);
	public function getAll();

}