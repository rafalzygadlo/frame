<?php

    ini_set("display_errors","on");
    ini_set('log_errors', true); // Error/Exception file logging engine.
    ini_set('error_log', 'errors.log'); // Logging file path
    ini_set("display_errors","on");
    session_name('page');
    session_start();
    error_reporting(E_ALL);

    require_once '../vendor/autoload.php';
    
    use app\core\application;

    //helper
    app\core\msg::init();
    function __($msg)
    {
        return app\core\msg::get($msg);
    }

    if(isset($argv))
        $app = new application($argv);
    else    
        $app = new application();

    // routing table
    $app->router->get("/",[app\ctrl\home_ctrl::class,'index']);
    $app->router->get("/home",[app\ctrl\home_ctrl::class,'index']);
    $app->router->get("/register",[app\ctrl\register_ctrl::class,'index']);
    
    $app->router->get("/login",[app\ctrl\login_ctrl::class,'index']);
    $app->router->post("/login/do",[app\ctrl\login_ctrl::class,'do']);


    $app->router->get("/logout",[app\ctrl\logout_ctrl::class,'index']);
    $app->router->get("/time",[app\ctrl\time_ctrl::class,'index']);
    $app->router->get("/config",[app\ctrl\config_ctrl::class,'index']);
    $app->router->get("/config/preview",[app\ctrl\config_ctrl::class,'preview']);

    $app->router->get("/account",[app\ctrl\account_ctrl::class,'index']);
    
    //command line
    $app->router->get("userexport",[app\ctrl\user_export_ctrl::class,'index']);


    //json
    $app->router->get("/json/user",[app\ctrl\json\user_ctrl::class,'index']);
    $app->router->get("/json/time",[app\ctrl\json\time_ctrl::class,'index']);

    
    //api
    $app->router->post("/api/admin/login",[app\ctrl\api\admin\login_ctrl::class,'index']);
    $app->router->get("/api/admin/user",[app\ctrl\api\admin\user_ctrl::class,'index']);
    $app->router->get("/api/admin/user/month",[app\ctrl\api\admin\user_ctrl::class,'month']);
    $app->router->post("/api/admin/user",[app\ctrl\api\admin\user_ctrl::class,'store']);
    $app->router->get("/api/admin/time", [app\ctrl\api\admin\time_ctrl::class,'index']);
    $app->router->get("/api/admin/time/work/:id", [app\ctrl\api\admin\time_ctrl::class,'work']);
    $app->router->get("/api/admin/customer", [app\ctrl\api\admin\customer_ctrl::class,'index']);
    $app->router->get("/api/admin/task", [app\ctrl\api\admin\task_ctrl::class,'index']);
    
    //admin
    $app->router->get("/admin",[app\ctrl\admin\home_ctrl::class,'index']);
    $app->router->get("/admin/login",[app\ctrl\admin\login_ctrl::class,'index']);
    $app->router->get("/admin/home",[app\ctrl\admin\home_ctrl::class,'index']);
    
    $app->router->get("/admin/config",[app\ctrl\admin\config_ctrl::class,'index']);   
    $app->router->get("/admin/config/add",[app\ctrl\admin\config_ctrl::class,'add']);
    $app->router->get("/admin/config/edit/:id",[app\ctrl\admin\config_ctrl::class,'edit']);
    $app->router->post("/admin/config",[app\ctrl\admin\config_ctrl::class,'store']);
    
    $app->router->get("/([a-z]*)",function($aa) { print 'main page'. print_r($aa); });

    
    $app->run();

?>

