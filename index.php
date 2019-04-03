<?php 
/*
    Virtual Database
   @author  : FilthyRoot
   @date    : 03.04.2019
   @version : 1.0.1
   @github  : http://github.com/soracyberteam/
   @website : http://socyte.space/
   
   Copyright (c) FilthyRoot Sora Cyber Team
*/
include 'config.php';?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Virtual Database 1.0</title>
</head>
<center>
<body style='background-image:url("bg.jpg");'>
<font color='white'>
    <h3>Virtual Database</h3>
    <p>
    Original Code By FilthyRoot<br><br>
    Server   : <?php echo php_uname();?><br>
    Version  : <?php echo $version_cfg;?><br>
    Database : <?php echo $database_cfg;?><br>
    <form action='' method='GET'>
    <select name='opt'>
        <option value=''>Select</option>
        <option value='1'>New Database</option>
        <option value='2'>Manage Database</option>
    </select>
    <button class="btn btn-default" type='submit' name='ok'>>></button>
    </form>
    <?php
    if(isset($_GET['ok'])){
        if($_GET['opt'] == "1"){
        echo "
        <br>
    <form action='' method='GET'>
    <input type='hidden' name='ok' value='1'>
    <input type='hidden' name='opt' value='1'>
    Table Name    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <input type='text' placeholder='virtual_db' name='db_name'><br>
    Column Amount&nbsp : <input type='text' placeholder='1-10' name='table_amount'><br><br>";
    if(isset($_GET['ok2'])){
        $name=$_GET['db_name'];
        $table=$_GET['table_amount'];
        $fh=fopen("db.php","a");
        fwrite($fh,'array_push($db[\''.$database_id.'\'],\''.$name.'\');');
        fwrite($fh,"\n");
        fwrite($fh,'$db[\''.$database_id.'\'][\''.$name.'\']=array();');
        fwrite($fh,"\n");
        fclose($fh);
        echo "<input type='hidden' name='name' value='$name'>Database : $name<br>";
        for($i=0;$i < $table;$i++){
        $x=$i+1;
            echo "Column $x : <input type='text' name='table[]' placeholder=''><br>";    
        }
        echo "<input type='submit' name='ok3' value='Go'></form><script>";
    }
    if(isset($_GET['ok3'])){
        echo '</script>';
        $name=$_GET['name'];
        $table=$_GET['table'];
        $fh=fopen('db.php','a');
        foreach($table as $tbl){
        fwrite($fh,'array_push($db[\''.$database_id.'\'][\''.$name.'\'],\''.$tbl.'\');');
        fwrite($fh,"\n");
        fwrite($fh,'$db[\''.$database_id.'\'][\''.$name.'\'][\''.$tbl.'\']=array();');
        fwrite($fh,"\n");
        }
        fclose($fh);
        echo "<font color='lime'>Success!</font>";
        sleep(3);
        echo "<script>window.location='/index.php?';</script>";
    }
    echo "<input type='submit' name='ok2' value='Go'></form>";
        }elseif($_GET['opt'] == "2"){
            if(isset($_GET['additem'])){
            $dbx=$_GET['db'];
            $tblx=$_GET['tbl'];
            echo "<form action='' method='POST'>
            <input type='hidden' name='db' value='$dbx'>
            <input type='hidden' name='tbl' value='$tblx'>
            <input type='hidden' name='additem' value='true'>
            <input type='hidden' name='opt' value='2'>
            <input type='hidden' name='ok' value='true'><br>
            Item :<br>
            <textarea name='item_value' rows='7' cols='30'></textarea><br>
            <button type='submit' name='save_item'>Save</button></form>";
            if(isset($_POST['save_item'])){
                $dbx=$_POST['db'];
                $tblx=$_POST['tbl'];
                $item_value=$_POST['item_value'];
                $fh=fopen('db.php','a');
                fwrite($fh,'array_push($db[\''.$database_id.'\'][\''.$dbx.'\'][\''.$tblx.'\'],\''.$item_value.'\');');
                fwrite($fh,"\n");
                fclose($fh);
                echo "<script>alert('Success!');</script>
                <script>window.location='/index.php?db=$dbx&tbl=$tblx&opt=2&ok=true';</script>";
            }
            }elseif(isset($_GET['deletetbl'])){
            $fh=fopen('db.php','a');
            fwrite($fh,'unset($db[\''.$database_id.'\'][\''.$_GET['db'].'\'][\''.$_GET['tbl'].'\']);');
            fwrite($fh,'unset($db[\''.$database_id.'\'][\''.$_GET['db'].'\'][\''.$_GET['deletetbl'].'\']);');
            fwrite($fh, "\n");
            fclose($fh);
            echo "<script>alert('Success!');</script>
            <script>window.location='/index.php?db=".$_GET['db']."&opt=2&ok=true';</script>";
            }elseif(isset($_GET['deleteitem'])){
            $fh=fopen('db.php','a');
            fwrite($fh,'unset($db[\''.$database_id.'\'][\''.$_GET['db'].'\'][\''.$_GET['tbl'].'\']['.$_GET['deleteitem'].']);');
            fwrite($fh, "\n");
            fclose($fh);
            echo "<script>alert('Success!');</script>
            <script>window.location='/index.php?db=".$_GET['db']."&tbl=".$_GET['tbl']."&opt=2&ok=true';</script>";
            }elseif(isset($_GET['deletedb'])){
            $fh=fopen('db.php','a');
            fwrite($fh,'unset($db[\''.$database_id.'\'][\''.$_GET['db'].'\']);');
            fwrite($fh,'unset($db[\''.$database_id.'\'][\''.$_GET['deletedb'].'\']);');
            fwrite($fh, "\n");
            fclose($fh);
            echo "<script>alert('Success!');</script>
            <script>window.location='/index.php?opt=2&ok=true';</script>";
            }elseif(isset($_GET['tbl']) && isset($_GET['db'])){
            $dbx=$_GET['db'];$tblx=$_GET['tbl'];
            echo "VirtualDB>$dbx>$tblx<br><br><table border='1'>
            <tr>
            <td>ID</td>
            <td>Item</td>
            <td>Option</td>
            </tr>";
                            if(empty($db["$database_id"]["$dbx"]["$tblx"])){
                echo "<font color='red'> There is no item.</font>";
                }else{
            foreach($db["$database_id"]["$dbx"]["$tblx"] as $item_id => $item){
            echo 
            "<tr>
            <td>$item_id</td>
            <td>$item</td>
            <td><a href='?db=$dbx&tbl=$tblx&opt=2&deleteitem=$item_id&ok=true'>Delete</a></td>
            </tr>";
            }
            }
           echo "</table><br>";
            echo"<a href='?db=$dbx&tbl=$tblx&opt=2&additem=1&ok=true'>Add Item</a>";
            }elseif(isset($_GET['db'])){
                $dbz=$_GET['db'];
                $db_sel=$db["$database_id"]["$dbz"];
                echo "VirtualDB>$dbz<br>Select Table : <br>";
                echo "<table border='1'>
                <tr>
                <td>Column</td>
                <td>Option</td>
                </tr>";
                foreach($db_sel as $tbl_id => $tbl_list){
                    if(is_array($tbl_list)){
                        continue;
                    }
                    echo "<tr>
                    <td><a href='?db=$dbz&tbl=$tbl_list&opt=2&ok=true'>$tbl_list</a></td>
                    <td><a href='?db=$dbz&tbl=$tbl_list&opt=2&deletetbl=$tbl_id&ok=true'>Delete</a></td>
                    </tr>";
                }
            }else{
            echo "VirtualDB><br>Select Table :<br>";
            echo "<table border=1>
            <tr>
            <th>Table</th>
            <th>Option</th>
            </tr>";
            foreach($db["$database_id"] as $db_id => $db_list){
                if(is_array($db_list)){
                    continue;
                }else{
                    echo "
                    <tr>
                    <td><a href='?db=$db_list&opt=2&ok'>$db_list</a></td>
                    <td><a href='?db=$db_list&opt=2&deletedb=$db_id&ok=true'>Delete</a></td>
                    </tr>";
                }
            }
           echo "</table>";
        }
        }else{
        echo "<script>alert('Unknown option!');</script>";
        }
    }
    ?>
    </p>
</body>
