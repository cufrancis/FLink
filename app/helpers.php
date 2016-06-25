<?php 

/*数据库setting表操作*/
if (! function_exists('Setting')) {

    function Setting(){
        return app('App\Setting');
    }

}
