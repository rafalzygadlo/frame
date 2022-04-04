<?php


namespace app\ctrl\admin;


use app\core\ctrl;
use app\core\render\column\column_text;
use app\core\render\column\column_parent;
use app\view\admin\config\config_view;
use app\view\admin\config\config_edit_view;
use app\view\admin\config\config_add_view;

use app\model\admin\item_model;

use app\repository\sql\admin\item_repository;

class config_ctrl extends ctrl
{

	public function store($request)
	{
		$data = $request->get_body();
		$model = new item_model();
		$model->load_data($data);
		
		if(!$model->validate($data))
		{
			$view = new config_edit_view(array('item' => $model));
			$view->render();
			return;
		}

		$repository = new item_repository();
		$repository->update($data);
		
		$request->redirect('/admin/config?pid='.$data['parent_id']);
		
	}

	public function edit($id)
	{
		$repository = new item_repository();
		$item = $repository->get($id);
		
		$values = array
		(
			'item' => $item
		);
		
		$view = new config_edit_view($values);
		$view->render();
	}
	
	public function add($request)
	{
		$model = new item_model();
		$view = new config_add_view(array('item' => $model));
		$view->render();
	}

	public function index($request)
	{
		$columns = array
		(
			new column_text('id','items_id'),
			new column_text('label','label'),
			new column_parent('value','value'),
			new column_text('name','name'),
			new column_text('type','type'),
			new column_text('template','template'),
			new column_text('price','price'),
		);

		$repository = new item_repository();
		$item = $repository->get_parent_id($request->pid);

		if($item)
			$id = $item->parent_id;
		else
			$id = 0;

		$items = $repository->get_all($request->pid);	
		
		$view = new config_view($id, $request->pid, 'admin/config', $columns, $items);
		$view->render();
	}

}