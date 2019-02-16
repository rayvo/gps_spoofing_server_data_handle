<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//define function name
function m_log($arMsg)
{

}
function m_log1($arMsg)
{

    // set the default timezone to use
    date_default_timezone_set('Asia/Seoul');
    //define empty string                                 
    $stEntry="";
    $now = date("l,Y-m-d H:i:s");
    //if message is array type
    if(is_array($arMsg))
    {  
        //concatenate msg with datetime  
        foreach($arMsg as $msg)  {
                $stEntry.="[".$now."] ".$arMsg."\n";
        }
    }
    else  
    {   //concatenate msg with datetime
        $stEntry.="[".$now."] ".$arMsg."\n";
    }  
    //create file with current date name  
    $stCurLogFileName='log.txt';  

    //open the file append mode,dats the log file will create day wise
    $fHandler=fopen("./".$stCurLogFileName,'a+');  
    //write the info into the file  
    fwrite($fHandler,$stEntry);  
    //close handler  
    fclose($fHandler);  
}


?>

