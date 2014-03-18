<?php    
// parameters:
//    data  - content 
//    level - error correction level ("L"ow,"M"edium,"Q"uarter,"H"igh)  
//    size  - pixels per point
//    border - in points
//    fileName - default name of the file
//    blackWhite - color set (0=color, 1=gray, 2=B&W)
    
    include "qrlib.php";    

    $fileName="qrcode.png";
    if (isset($_REQUEST["fileName"]))
      $fileName=$_REQUEST["fileName"];

    $blackWhite=0;
    if (isset($_REQUEST["blackWhite"]))
      $blackWhite=$_REQUEST["blackWhite"];

    header ("Content-Disposition: inline; filename=".$fileName);
    
    $borderSize= 2;
    if (isset($_REQUEST['border']))
        $borderSize= $_REQUEST['border'];    

    $errorCorrectionLevel = 3;
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 5;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

    if (isset($_REQUEST['data'])) { 
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('Data cannot be empty!');
            
        // user data
        QRcode::png($_REQUEST['data'], false ,$errorCorrectionLevel, $matrixPointSize, $borderSize, false, $blackWhite);    
        
    } 
    else 
    {    
        die('Data cannot be empty!');
    }    
    
?> 

