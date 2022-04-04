<?php

namespace app\core;

class render
{


    public function _()
    {
        
    }


    function RenderTile($href, $title, $icon)
    {
        print '<div class="col-4 col-md-3 col-lg-2 col-sm-3" >';
        print '<a class="d-block text-dark" href="'.$href.'">';
        print '<div class="card">';
        print '<div class="text-center">';
        print '<i class="'.$icon.'" style="font-size: 35px;"></i>';
        print '<h6>'.$title.'</h6>';
        print '</div>';
        print '</div>';
        print '</a>';
        print '</div>';
    }

    function render_tile($href, $title, $icon)
    {
        print '<li class="col mb-4" data-tags="reading book label tag category" data-categories="miscellaneous">';
        print '<a class="d-block text-dark text-decoration-none" href="'.$href.'">';
        print '<div class="p-3 py-4 mb-2 bg-light text-center rounded">';
        print '<i class="'.$icon.'" style="font-size: 35px;"></i>';
        print '</div>';
        print '<div class="name text-muted text-decoration-none text-center pt-1">'.$title.'</div>';
        print '</a>';
        print '</li>';
    }

    function render_login_error($error)
    {
        if ($error)
        {
            print '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            print  __("LoginError");
            print '<span aria-hidden="true">&times;</span>';
            print '</button></div>';
        }
    }
 


function RenderMonth($date)
{
    
    print $start = Date("w",strtotime($date)); 
    if($start == 0)
        $start = 6;
    else
        $start -=1;    

    print $start;
    list($year, $month) = explode('-', $date);
    
    $curr_month_days = Date("t", mktime(0, 0, 0, $month, 1, $year));    

    $weeks = array();
    $days = array();
    $ndays = array();
    
    //prev month
    $counter = 1;
    for($j = 0;$j < $start; $j++)
    {
        array_push($days,'');
    }
    
    //curent month
    $day = 1;
    for($i = 0;$i < $curr_month_days ; $i++)
    {
        array_push($days,$day++);        
    }

    $count = 1;
    foreach($days as $day)
    {
        array_push($ndays, $day);
        if($count == 7)
        {
            array_push($weeks, $ndays);
            $ndays = array();
            $count = 0;
        }

        $count++;
    }

    array_push($weeks, $ndays);

    print '<table class="table table-stripped table-bordered">';
    print '<tr><td>PN</td> <td>WT</td> <td>SR</td> <td>CZ</td> <td>PT</td> <td>SO</td> <td>ND</td>';
    foreach($weeks as $week)
    {
        print '<tr>';   
        foreach($week as $day)
        { 
            print '<td><h2>'.$day.'</h2></td>';
        }
        print '</tr>';
    }

    print '</table>';
    
    
}


public function render_tree($items, $id = 0, $label = '', $name = '', $level = 0) 
{
    if($level == 0)
    {
        print '<div class="form-group">';
        print '<label class="control-label">'.$label.'</label>';
        //print '<select class="form-control" id="'.$name.'" name="'.$name.'" >';
    }

    
    foreach ($items as $item) 
    { 

        //print_r($item);
        print str_repeat(' - ', $level).$item->value.'<br>';
        
        $level++;
        $this->render_tree ($item->items, $id, $label, $name, $level);
        $level--;
    }

    if($level == 0)
    {
        //print '</select>';
        print '</div>';
    }

}




}

