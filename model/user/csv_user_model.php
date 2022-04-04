<?php


 namespace app\model\user;


 define("COLUMN_ARBEITER_ID",0);
 define("COLUMN_EMPL_ID",1);
 define("COLUMN_STATUS",2);
 define("COLUMN_FIRST_NAME",3);
 define("COLUMN_LAST_NAME",4);
 define("COLUMN_BEGIN_DATE",6);

 use app\core\model;

class csv_user_model 
{

    public $arbeiter_id;
    
    public $empl_id;

    public $first_name;

    public $last_name;

    public $begin_date;
    
    public $email;
    
    public $status;

    
    public function __construct($row)
    {
	    $this->arbeiter_id  = $row[COLUMN_ARBEITER_ID];
        $this->empl_id      = trim($row[COLUMN_EMPL_ID]);
        $this->first_name   = $row[COLUMN_FIRST_NAME];
        $this->last_name    = addslashes($row[COLUMN_LAST_NAME]);
        $this->begin_date   = date("Y-m-d",strtotime($row[COLUMN_BEGIN_DATE]));
        
        $status = $row[COLUMN_STATUS];

	    if($status == "Aktiv")
    	    $this->status = 1;
	    else
	        $this->status = 0;
    
    }

   
}
