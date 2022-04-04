<?php

namespace app\view;

use app\core\view;

class config_view extends view
{

    public function __construct($template = 'config/index', $values)
    {
        parent::__construct($template, $values);
    }

	public function get_title()
    {
        return __("Config");
    }

    private function render_check_box($item)
	{		
		print '<div class="form-check">';
  		print '<input class="form-check-input" type="checkbox" data-price="'.$item->price.'" name="'.$item->name.'[]" id="'.$item->value.'" value="'.$item->items_id.'" onchange="price(this);">';
  		print '<label class="form-check-label" for="'.$item->value.'">'.$item->label.'</label>';
		if($item->tooltip)  
		print '<a class="btn" data-bs-toggle="popover" data-container="body" data-bs-placement="top" data-bs-content="'.$item->tooltip.'"><i class="bi-question-circle"></i></a>';
		print '</div>';
	}

	private function render_radio($item)
	{
		print '<div class="form-check">';
		print '<input required class="form-check-input" type="radio" data-price="'.$item->price.'" name="'.$item->name.'" id="'.$item->value.'" value="'.$item->items_id.'" onchange="price(this);">';
  		print '<label class="form-check-label" for="'.$item->value.'">'.$item->label.'</label>';
		if($item->tooltip)  
		print '<a class="btn" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="'.$item->tooltip.'"><i class="bi-question-circle"></i></a>';
		print '</div>';
		
	}

	private function render_link($item)
	{
		print '<a  href="/config/?pid='.$item->items_id.'">'.$item->value.'</a><br>';
	}

	private function render_header($item)
	{
		print $item->label;
		if($item->tooltip)  
		print '<a class="btn" data-bs-toggle="popover" data-container="body" data-bs-placement="top" data-bs-content="'.$item->tooltip.'"><i class="bi-question-circle"></i></a>';
	}

	private function render_html($item)
	{
		print $item->value;
	}

	public function render_form($tree, $level = 0)
	{
		
		switch($tree->type)
		{
			case 0: $this->render_header($tree, $level); break;
			case 1: $this->render_check_box($tree); break;
			case 2: $this->render_radio($tree); break;
			case 3: $this->render_link($tree); break;
			case 4: $this->render_html($tree); break;
		}
		
		$level++;
		
		foreach($tree->items as $item)
		{
			$this->render_form($item, $level);
		}
	}

    
    
    
    
}

