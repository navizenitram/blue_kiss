<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $aMetas['title']?></title>
    </head>
    <body>
        <div id="breadcrumb">
        <?php foreach ($aBreadcrumb as $crumb) {
                echo "<a href='".$crumb['href']."'>".$crumb['value']."</a>&nbsp;";  
              }?>    
        </div>    
        <!-- HEADER -->    

