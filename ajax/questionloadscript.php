<?php
ob_start("ob_gzhandler");
include('../functions/phpfunctions.php');
$selectproductname = $_POST['selectproductname'];
$searchquery = $_POST['searchquery'];
$regselect = $_POST['regselect'];
$productpiece = ($selectproductname == "")?(""):(" AND productname='".$selectproductname."'");

if($regselect <> "" && strlen($searchquery) > 0)
{
	switch($regselect)
	{
		case 'call':
		{
			$query = "SELECT ssm_callregister.problem AS problem,ssm_callregister.remarks as remarks,ssm_users.fullname as fullname, 'Call Register' AS register FROM ssm_callregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_callregister.userid WHERE problem LIKE '%".$searchquery."%' ".$productpiece." ORDER BY problem";
			
			$grid .= '<form name="questiongridform" id="questiongridform"><table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Select</td><td nowrap = "nowrap" class="td-border-grid">Query</td><td nowrap = "nowrap" class="td-border-grid">Solution</td><td nowrap = "nowrap" class="td-border-grid">Entered By</td><td nowrap = "nowrap" class="td-border-grid">Register</td></tr>';
			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
			{
				$i_n++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				static $count = 0;
				$count++;
				if($count<=50)
{
					$radioid = 'c'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadquestionsetselect(\''.$fetch['problem'].'\',\''.$fetch['remarks'].'\',\''.$fetch['register'].'\'); ">';
					$grid .= "<td nowrap='nowrap' class='td-border-grid'  width='10%'><input type='radio' name='c' value='c".$count."' id=".$radioid." onclick=\"loadquestionsetselect('".$fetch['problem']."','".$fetch['remarks']."','".$fetch['register']."');\" /></td><td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['register']."</td>";
					$grid .= '</tr>';
				}
				else
				break;
			}
			$grid .= '</table></form>';
			echo($grid);
		}
		break;
/*******************************************************************************************************************************/		
		case 'email':
		{
			$query = "SELECT ssm_emailregister.content AS content,ssm_emailregister.remarks as remarks,ssm_users.fullname as fullname, 'Email Register' AS register FROM ssm_emailregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid  WHERE ssm_emailregister.content LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_emailregister.content";
			$grid .= '<form name="questiongridform" id="questiongridform"><table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Select</td><td nowrap = "nowrap" class="td-border-grid">Query</td><td nowrap = "nowrap" class="td-border-grid">Solution</td><td nowrap = "nowrap" class="td-border-grid">Entered By</td><td nowrap = "nowrap" class="td-border-grid">Register</td></tr>';			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
{				$i_n++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				static $count = 0;
				$count++;
				if($count<=50)
{
				$radioid = 'e'.$count;
				$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadquestionsetselect(\''.$fetch['content'].'\',\''.$fetch['remarks'].'\',\''.$fetch['register'].'\'); ">';
				$grid .= "<td nowrap='nowrap' class='td-border-grid'  width='10%'><input type='radio' name='e' value='e".$count."' id=".$radioid." onclick=\"loadquestionsetselect('".$fetch['content']."','".$fetch['remarks']."','".$fetch['register']."');\" /></td><td nowrap='nowrap' class='td-border-grid'>".$fetch['content']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['register']."</td>";
				$grid .= '</tr>';
				}
				else
				break;
			}
			$grid .= '</table></form>';
			echo($grid);
		}
		break;
/******************************************************************************************************************************/		
		case 'inhouse':
		{
			$query = "SELECT ssm_inhouseregister.problem As problem,ssm_inhouseregister.remarks as remarks,ssm_users.fullname as fullname, 'Inhouse Register' AS register FROM ssm_inhouseregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid  WHERE problem LIKE '%".$searchquery."%' ".$productpiece." ORDER BY problem";
			$grid .= '<form name="questiongridform" id="questiongridform"><table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Select</td><td nowrap = "nowrap" class="td-border-grid">Query</td><td nowrap = "nowrap" class="td-border-grid">Solution</td><td nowrap = "nowrap" class="td-border-grid">Entered By</td><td nowrap = "nowrap" class="td-border-grid">Register</td></tr>';			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
{				$i_n++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				static $count = 0;
				$count++;
				if($count<=50)
{
				$radioid = 'i'.$count;
				$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadquestionsetselect(\''.$fetch['problem'].'\',\''.$fetch['remarks'].'\',\''.$fetch['register'].'\'); ">';
				$grid .= "<td nowrap='nowrap' class='td-border-grid'  width='10%'><input type='radio' name='i' value='i".$count."' id=".$radioid." onclick=\"loadquestionsetselect('".$fetch['problem']."','".$fetch['remarks']."','".$fetch['register']."');\" /></td><td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['register']."</td>";
				$grid .= '</tr>';
				}
				else
				break;
			}
			$grid .= '</table></form>';
			echo($grid);
		}
		break;
		case 'skype':
		{
			$query = "SELECT ssm_skyperegister.problem as problem,ssm_skyperegister.remarks as remarks,ssm_users.fullname as fullname, 'Skype Register' AS register FROM ssm_skyperegister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid  WHERE ssm_skyperegister.problem LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_skyperegister.problem";
			$grid .= '<form name="questiongridform" id="questiongridform"><table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Select</td><td nowrap = "nowrap" class="td-border-grid">Query</td><td nowrap = "nowrap" class="td-border-grid">Solution</td><td nowrap = "nowrap" class="td-border-grid">Entered By</td><td nowrap = "nowrap" class="td-border-grid">Register</td></tr>';			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
{				$i_n++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				static $count = 0;
				$count++;
				if($count<=50)
{
					$radioid = 's'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadquestionsetselect(\''.$fetch['problem'].'\',\''.$fetch['remarks'].'\',\''.$fetch['register'].'\'); ">';
					$grid .= "<td nowrap='nowrap' class='td-border-grid'  width='10%'><input type='radio' name='s' value='s".$count."' id=".$radioid." onclick=\"loadquestionsetselect('".$fetch['problem']."','".$fetch['remarks']."','".$fetch['register']."');\" /></td><td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['register']."</td>";
					$grid .= '</tr>';
				}
				else
				break;
			}
			$grid .= '</table></form>';
			echo($grid);
		}
		break;
		case 'onsite':
		{
			$query = "SELECT ssm_onsiteregister.problem as problem,ssm_onsiteregister.remarks as remarks,ssm_users.fullname as fullname, 'Onsite Register' AS register FROM ssm_onsiteregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid  WHERE ssm_onsiteregister.problem LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_onsiteregister.problem";
			$grid .= '<form name="questiongridform" id="questiongridform"><table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Select</td><td nowrap = "nowrap" class="td-border-grid">Query</td><td nowrap = "nowrap" class="td-border-grid">Solution</td><td nowrap = "nowrap" class="td-border-grid">Entered By</td><td nowrap = "nowrap" class="td-border-grid">Register</td></tr>';			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
{				$i_n++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				static $count = 0;
				$count++;
				if($count<=50)
{
					$radioid = 'o'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadquestionsetselect(\''.$fetch['problem'].'\',\''.$fetch['remarks'].'\',\''.$fetch['register'].'\'); ">';
					$grid .= "<td nowrap='nowrap' class='td-border-grid'  width='10%'><input type='radio' name='o' value='o".$count."' id=".$radioid." onclick=\"loadquestionsetselect('".$fetch['problem']."','".$fetch['remarks']."','".$fetch['register']."');\" /></td><td nowrap='nowrap' class='td-border-grid'>".$fetch['problem']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['remarks']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['register']."</td>";
					$grid .= '</tr>';
				}
				else
				break;
			}
			$grid .= '</table></form>';
			echo($grid);
		}
		break;
		case 'error':
		{
			$query = "SELECT ssm_errorregister.errorreported as errorreported,ssm_errorregister.solutiongiven as solutiongiven, ssm_users.fullname as fullname, 'Error Register' AS register FROM ssm_errorregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_errorregister.userid  WHERE ssm_errorregister.errorreported LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_errorregister.errorreported";
			$grid .= '<form name="questiongridform" id="questiongridform"><table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Select</td><td nowrap = "nowrap" class="td-border-grid">Query</td><td nowrap = "nowrap" class="td-border-grid">Solution</td><td nowrap = "nowrap" class="td-border-grid">Entered By</td><td nowrap = "nowrap" class="td-border-grid">Register</td></tr>';			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
{				$i_n++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				static $count = 0;
				$count++;
				if($count<=50)
{
					$radioid = 'er'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadquestionsetselect(\''.$fetch['errorreported'].'\',\''.$fetch['solutiongiven'].'\',\''.$fetch['register'].'\'); ">';
					$grid .= "<td nowrap='nowrap' class='td-border-grid'  width='10%'><input type='radio' name='er' value='er".$count."' id=".$radioid." onclick=\"loadquestionsetselect('".$fetch['errorreported']."','".$fetch['solutiongiven']."','".$fetch['register']."');\" /></td><td nowrap='nowrap' class='td-border-grid'>".$fetch['errorreported']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['solutiongiven']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['register']."</td>";
					$grid .= '</tr>';
				}
				else
				break;
			}
			$grid .= '</table></form>';
			echo($grid);
		}
		break;
		case 'requirement':
		{
			$query = "SELECT ssm_requirementregister.requirement as requirement,ssm_requirementregister.solutiongiven as solutiongiven,ssm_users.fullname as fullname, 'Requirement Register' AS register FROM ssm_requirementregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_requirementregister.userid  WHERE ssm_requirementregister.requirement LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_requirementregister.requirement";
			$grid .= '<form name="questiongridform" id="questiongridform"><table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Select</td><td nowrap = "nowrap" class="td-border-grid">Query</td><td nowrap = "nowrap" class="td-border-grid">Solution</td><td nowrap = "nowrap" class="td-border-grid">Entered By</td><td nowrap = "nowrap" class="td-border-grid">Register</td></tr>';			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
{				$i_n++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				static $count = 0;
				$count++;
				if($count<=50)
{
					$radioid = 'req'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadquestionsetselect(\''.$fetch['requirement'].'\',\''.$fetch['solutiongiven'].'\',\''.$fetch['register'].'\'); ">';
					$grid .= "<td nowrap='nowrap' class='td-border-grid'  width='10%'><input type='radio' name='req' value='req".$count."' id=".$radioid." onclick=\"loadquestionsetselect('".$fetch['requirement']."','".$fetch['solutiongiven']."','".$fetch['register']."');\" /></td><td nowrap='nowrap' class='td-border-grid'>".$fetch['requirement']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['solutiongiven']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['register']."</td>";
					$grid .= '</tr>';
				}
				else
				break;
			}
			$grid .= '</table></form>';
			echo($grid);
		}
		break;
		default:
		{
			$query = "
			(SELECT ssm_callregister.problem AS query,ssm_callregister.remarks AS solution,ssm_users.fullname as fullname, 'Call Register' AS register FROM ssm_callregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_callregister.userid  WHERE ssm_callregister.problem LIKE '%".$searchquery."%' ".$productpiece." ORDER BY  ssm_callregister.problem) 
			union 
			(SELECT ssm_emailregister.content AS query,ssm_emailregister.remarks AS solution,ssm_users.fullname as fullname, 'Email Register' AS register FROM ssm_emailregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_emailregister.userid  WHERE ssm_emailregister.content LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_emailregister.content) 
			union 
			(SELECT ssm_errorregister.errorreported AS query,ssm_errorregister.solutiongiven AS solution,ssm_users.fullname as fullname, 'Error Register' AS register FROM ssm_errorregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_errorregister.userid  WHERE ssm_errorregister.errorreported LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_errorregister.errorreported) 
			union 
			(SELECT ssm_inhouseregister.problem AS query,ssm_inhouseregister.remarks AS solution, ssm_users.fullname as fullname, 'Inhouse Register' AS register FROM ssm_inhouseregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_inhouseregister.userid  WHERE ssm_inhouseregister.problem LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_inhouseregister.problem)  
			union 
			(SELECT ssm_onsiteregister.problem AS query,ssm_onsiteregister.remarks AS solution,ssm_users.fullname as fullname, 'Onsite Register' AS register FROM ssm_onsiteregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_onsiteregister.userid  WHERE ssm_onsiteregister.problem LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_onsiteregister.problem)  
			union 
			(SELECT ssm_requirementregister.requirement AS query,ssm_requirementregister.solutiongiven AS solution, ssm_users.fullname as fullname, 'Requirement Register' AS register FROM ssm_requirementregister LEFT JOIN ssm_users ON ssm_users.slno = ssm_requirementregister.userid  WHERE ssm_requirementregister.requirement LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_requirementregister.requirement) 
			union 
			(SELECT ssm_skyperegister.problem AS query,ssm_skyperegister.remarks AS solution,ssm_users.fullname as fullname, 'Skype Register' AS register FROM ssm_skyperegister LEFT JOIN ssm_users ON ssm_users.slno = ssm_skyperegister.userid  WHERE ssm_skyperegister.problem LIKE '%".$searchquery."%' ".$productpiece." ORDER BY ssm_skyperegister.problem);";
			
			$grid .= '<form name="questiongridform" id="questiongridform"><table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Select</td><td nowrap = "nowrap" class="td-border-grid">Query</td><td nowrap = "nowrap" class="td-border-grid">Solution</td><td nowrap = "nowrap" class="td-border-grid">Entered By</td><td nowrap = "nowrap" class="td-border-grid">Register</td></tr>';			$result = runmysqlquery($query);
			$i_n = 0;
			while($fetch = mysqli_fetch_array($result))
{				$i_n++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				static $count = 0;
				$count++;
				if($count<=50)
{
					$radioid = 'req'.$count;
					$grid .= '<tr class="gridrow" onclick="javascript: document.getElementById(\''.$radioid.'\').checked=true; loadquestionsetselect(\''.$fetch['query'].'\',\''.$fetch['solution'].'\',\''.$fetch['register'].'\'); ">';
					$grid .= "<td nowrap='nowrap' class='td-border-grid'  width='10%'><input type='radio' name='req' value='req".$count."' id=".$radioid." onclick=\"loadquestionsetselect('".$fetch['query']."','".$fetch['solution']."','".$fetch['register']."');\" /></td><td nowrap='nowrap' class='td-border-grid'>".$fetch['query']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['solution']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['fullname']."</td><td nowrap='nowrap' class='td-border-grid'>".$fetch['register']."</td>";
					$grid .= '</tr>';
				}
				else
				break;
			}
			$grid .= '</table></form>';
			echo($grid);
		}
		break;
	}
}
?>