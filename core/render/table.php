<?php


namespace app\core\render;


class table
{
    private $id;

    private $pid;

    public $ctrl_name;

    private $columns;

    private $items;

    private $order;

    public function __construct($id, $pid, $ctrl_name, $columns, $items, $order = null)
    {
        $this->id = $id;
        $this->pid = $pid;
        $this->ctrl_name = $ctrl_name;
        $this->columns = $columns;
        $this->items = $items;
        $this->order = $order;
    }

    private function header()
    {    
        // dodac do requesta
        $order_column_id = 0;
        $asc = SORT_ASC;

        //print '<th>';
        //print count($this->items);
        //print '</th>';

        print '<thead>';
        print '<tr>';
        print '<th><center><input type="checkbox" id="select_all"></center>';
        print '</th>';  //checkbox select
    
       

        print '<th>';
        print '<a href="'.$this->ctrl_name.'/add?'.$this->id.'" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i></span></a> ';
        if ($this->pid > 0)
            print '<a href="'.$this->ctrl_name.'?pid='.$this->id.'" class="btn btn-primary btn-sm"><i class="bi bi-arrow-90deg-up"></i></span></a>';
        print '</th>';
    
        print '<th></th>'; // liczba porządkowa
    
        $id = 0;

        foreach ($this->columns as $column)
        {
            if ($column->visible)
            {
                if ($column->name == $this->order)
                {
                    if ($asc == SORT_ASC)
                    {
                        print '<th><a href="/' . $this->ctrl_name . '?order=' . $column->field_name . '&asc=' . SORT_DESC . '">' . $column->name . '</a>';
                        print '<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></th>';
                    }
                    else
                    {
                        print '<th><a href="/' . $this->ctrl_name . '?order=' . $column->field_name . '&asc=' . SORT_ASC . '">' . $column->name . '</a>';
                        print '<span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span></th>';
                    }
                }
                else
                {
                    print '<th><a href="/' . $this->ctrl_name . '?order=' . $column->field_name . '&asc=' . SORT_ASC . '">' . $column->name . '</a></th>';
                }
            }
                $id++;
        }
    
        print '</tr>';
        print '</thead>';
    }

    private function empty()
    {
        print '<div class="row">';
        print '<div class="col-md-12 text-center">';
        print '<div class="alert text-center"><h2>'. __("NoItems").'</h1></div>';
        print '</div>';
        print '<div class="col-md-12 text-center">';
        print '<a href="'.$this->ctrl_name.'/add" class="btn btn-primary">'.__("New").'</a>';
        print '</div>';
        print '</div>';

    }

    private function body()
    {
    
        $id = 0;
        //($view->Page * $view->Limit) - $view->Limit + 1;

        foreach ($this->items as $item)
        {
            if ($item->get_active() == 0)
                $strikeout = 'strikeout';
            else
                $strikeout = '';

			if ($this->id == $item->get_id())
                print '<tr id="tr' . $item->get_id() . '" class="success ' . $strikeout . ' ">';
            else
                print '<tr id="tr' . $item->get_id() . '" class="' . $strikeout . '">';
            
			
            print '<td width="50px;" id="column_select"><center><input type="checkbox" name="selected" value="'.$item->get_id().'"></center></td>';
            print '<td width="100px;">';
            $this->row_menu($item);
            print '</td>';
            print '<td class="text-right">' . $id . '</td>';

            foreach ($this->columns as $column)
            {
                if ($column->visible)
                {
                    print '<td>';
                    print $column->render($item, $this);
                    print '</td>';
                }
            }

            print '</tr>';
            $id++;
        }

        print '</tbody>';
    }

    private function row_menu($item)
    {
        print '<a class="btn btn-primary btn-sm" href="'.$this->ctrl_name.'/edit/'.$item->get_id().'"><i class="bi-pencil"></i></a> ';
        print '<a class="btn btn-primary btn-sm" href="'.$this->ctrl_name.'/delete/'.$item->get_id().'"><i class="bi-trash"></i></a>';
    }

    public function render()
    {
        if(count($this->items) == 0)
        {
            $this->empty();
            return;
        }
        
        $this->header();
        $this->body();
    }

}
    

   
