<?php
include('../functions/phpfunctions.php');
if ($_POST['fromtable'] <> '' || $_POST['fromtablefields'] <> '' || $_POST['totable'] <> '' || $_POST['totablefields'] <> '') {
  if (isset($_POST['submit'])) {
    $message = '';
    $table_name = $_POST['fromtable'];
    $table_name_value = $_POST['fromtablefields'];
    $backup_table_name = $_POST['totable'];
    $backup_table_name_value = $_POST['totablefields'];
    $sql = "SELECT * from $table_name";
    $result = runmysqlquery($sql);
    while ($row = mysqli_fetch_row($result)) {
      backup_table_data($table_name, $backup_table_name, $table_name_value, $backup_table_name_value);
    }
  }
} else {
  $message = 'All the fields are Mandatory';
}
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Database Portal</title>
  <link rel="stylesheet" type="text/css" href="../style/main.css">
</head>

<body>
  <?php
  /* $todb = "testssm";
      $fromdb = "testssm1";

      $sql = "SHOW TABLES";
      $result = runmysqlquery($sql);
    while($row = mysqli_fetch_array($result)) 
    {
      $table = $row[0];
      $sql = "DROP TABLE IF EXISTS $todb.$table";
      runmysqlquery($sql);
      $sql = "CREATE TABLE `$todb.$table` LIKE `$fromdb.$table`";
      runmysqlquery($sql);
      $sql = "INSERT INTO $todb.$table SELECT * FROM $fromdb.$table";
      runmysqlquery($sql);
    } */


  /*    function backup_table($table_name, $backup_table_name){
  db_query("DROP TABLE IF EXISTS $backup_table_name");
          db_query("CREATE TABLE $backup_table_name LIKE $table_name");
          db_query("ALTER TABLE $backup_table_name DISABLE KEYS");
          db_query("INSERT INTO $backup_table_name SELECT * FROM $table_name");
          db_query("ALTER TABLE $backup_table_name ENABLE KEYS");
      }  
      function db_query($query){
          $output = mysqli_query($query) or die('<h1 style="color: red;">MySQL Error:</h1>Please copy and paste between the lines and email to YOUREMAIL@ADDRESS.COM<br><br>------------------------------------------------------------------------------------<h3>Query:</h3><pre>' . htmlentities($query) . '</pre><h3>MySQL Error:</h3>' . mysqli_error() . '<br><br>------------------------------------------------------------------------------------');
          return $output;
      }

backup_table('testssm.ssm_callregister', 'testssm1.ssm_callregister')*/

  /*include('../functions/phpfunctions.php');
  $sql = "SHOW TABLES";
  $result = runmysqlquery($sql);
  while($row = mysqli_fetch_row($result)) 
  {
    for($i = 0; $i < count($row); $i++)
    {
      $table_name = 'ssm.'.$row[$i];
      $backup_table_name = 'testssm1.'.$row[$i];
      backup_table($table_name, $backup_table_name,'customername,customerid,date,time,calledby,category,dealercustomer,productname,productversion,problem,status,remarks,transferredto,userid,compliantid','customername,customerid,date,time,personname,category,callertype,productname,productversion,problem,status,remarks,transferredto,userid,compliantid');
      $gridrow .= "<li>".$row[$i]."</li>";
    }
  }
  echo($gridrow);
  echo("<br />");
  /*backup_table('testssm.ssm_callregister', 'testssm1.ssm_callregister');*/
  ?>
  <table width="75%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td>
        <form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0" cellspacing="0" cellpadding="4">
            <tr>
              <td colspan="2" align="center">
                <?php if ($message <> '')
                  echo ($message); ?>
              </td>
            </tr>
            <tr>
              <td>From Table Name:</td>
              <td><input name="fromtable" type="text" class="swifttext" id="fromtable" size="30" /></td>
            </tr>
            <tr>
              <td>From Table Fields</td>
              <td><input name="fromtablefields" type="text" class="swifttext" id="fromtablefields" size="60" /></td>
            </tr>
            <tr>
              <td>Destination Table Name:</td>
              <td><input name="totable" type="text" class="swifttext" id="totable" size="30" /></td>
            </tr>
            <tr>
              <td>Destination Table Fields:</td>
              <td><input name="totablefields" type="text" class="swifttext" id="totablefields" size="60" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="submit" id="submit" value="Submit" /></td>
            </tr>
          </table>
        </form>
      </td>
    </tr>
  </table>
</body>

</html>