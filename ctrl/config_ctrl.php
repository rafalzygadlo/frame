<?php


namespace app\ctrl;

use app\core\ctrl;
use app\view\config_view;
use app\model\item_model;
use app\repository\sql\item_repository;

class config_ctrl extends ctrl
{

	private function form_tree($list, $nkey, $level)
	{
		$repository = new item_repository();
				
		foreach($list as $key => $value)
		{
			if(is_array($value))
			{
				$this->form_tree($value, $key, $value);
			}
			else
			{
				if($nkey > 0)
					$key = $nkey;
				
				$item = $repository->get($key);
				$item_value = $repository->get($value);
				print $item->value.'->'.$item_value->value.'<br>';
		
			}
			
		}

	}

	//POST
	public function preview($request)
	{
		//print_r($request);
		
		$list = $request->get_body();
		print '<pre>';
		print_r($list);
		print '</pre>';
		
		$this->form_tree($list, 0, 0);
	}

	public function index($request)
	{
	
		$repository = new item_repository();
		
		if($request->pid == 0)
			$request->pid = 52;
		
		$item = $repository->get($request->pid);
		$items = $repository->get_all($item->items_id);


		$tree = new item_model();
		$tree->items_id = $request->pid;
		$repository->get_tree($tree);
		
		$values = array
		(
			'current_item' => $item,
			'items' => $items,
			'tree' => $tree,
            'render' => new \app\core\render()
		);

		
		$view = new config_view($item->template, $values);
		$view->render();

		
	}

}