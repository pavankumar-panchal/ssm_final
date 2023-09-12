<?php
include('../functions/phpfunctions.php');
if ($_POST['username'] <> '' || $_POST['userid'] <> '') {
	if (isset($_POST['submit'])) {
		$message = '';
		$username = $_POST['username'];
		$userid = $_POST['userid'];

		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_usertime WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_usertime set ssm_usertime.userid='" . $userid . "' where ssm_usertime.userid = '" . $username . "';");

		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_callregister WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_callregister set ssm_callregister.authorizedperson='" . $userid . "' where ssm_callregister.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_callregister WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_callregister set ssm_callregister.userid='" . $userid . "' where ssm_callregister.userid = '" . $username . "';");

		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_callregister WHERE transferredto = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_callregister set ssm_callregister.transferredto='" . $userid . "' where ssm_callregister.transferredto = '" . $username . "';");




		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_emailregister WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_emailregister set ssm_emailregister.authorizedperson='" . $userid . "' where ssm_emailregister.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_emailregister WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_emailregister set ssm_emailregister.userid='" . $userid . "' where ssm_emailregister.userid = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_emailregister WHERE forwardedto = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_emailregister set ssm_emailregister.forwardedto='" . $userid . "' where ssm_emailregister.forwardedto = '" . $username . "';");



		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_errorregister WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_errorregister set ssm_errorregister.authorizedperson='" . $userid . "' where ssm_errorregister.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_errorregister WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_errorregister set ssm_errorregister.userid='" . $userid . "' where ssm_errorregister.userid = '" . $username . "';");




		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_inhouseregister WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_inhouseregister set ssm_inhouseregister.authorizedperson='" . $userid . "' where ssm_inhouseregister.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_inhouseregister WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_inhouseregister set ssm_inhouseregister.userid='" . $userid . "' where ssm_inhouseregister.userid = '" . $username . "';");

		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_inhouseregister WHERE assignedto = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_inhouseregister set ssm_inhouseregister.assignedto='" . $userid . "' where ssm_inhouseregister.assignedto = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_inhouseregister WHERE solvedby = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_inhouseregister set ssm_inhouseregister.solvedby='" . $userid . "' where ssm_inhouseregister.solvedby = '" . $username . "';");



		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_invoice WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_invoice set ssm_invoice.authorizedperson='" . $userid . "' where ssm_invoice.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_invoice WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_invoice set ssm_invoice.userid='" . $userid . "' where ssm_invoice.userid = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_invoice WHERE billedby = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_invoice set ssm_invoice.billedby='" . $userid . "' where ssm_invoice.billedby = '" . $username . "';");


		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_onsiteregister WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_onsiteregister set ssm_onsiteregister.authorizedperson='" . $userid . "' where ssm_onsiteregister.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_onsiteregister WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_onsiteregister set ssm_onsiteregister.userid='" . $userid . "' where ssm_onsiteregister.userid = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_onsiteregister WHERE assignedto = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_onsiteregister set ssm_onsiteregister.assignedto='" . $userid . "' where ssm_onsiteregister.assignedto = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_onsiteregister WHERE solvedby = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_onsiteregister set ssm_onsiteregister.solvedby='" . $userid . "' where ssm_onsiteregister.solvedby = '" . $username . "';");


		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_receipts WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_receipts set ssm_receipts.authorizedperson='" . $userid . "' where ssm_receipts.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_receipts WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_receipts set ssm_receipts.userid='" . $userid . "' where ssm_receipts.userid = '" . $username . "';");



		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_referenceregister WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_referenceregister set ssm_referenceregister.authorizedperson='" . $userid . "' where ssm_referenceregister.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_referenceregister WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_referenceregister set ssm_referenceregister.userid='" . $userid . "' where ssm_referenceregister.userid = '" . $username . "';");



		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_requirementregister WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_requirementregister set ssm_requirementregister.authorizedperson='" . $userid . "' where ssm_callregister.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_requirementregister WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_requirementregister set ssm_requirementregister.userid='" . $userid . "' where ssm_requirementregister.userid = '" . $username . "';");



		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_skyperegister WHERE authorizedperson = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_skyperegister set ssm_skyperegister.authorizedperson='" . $userid . "' where ssm_skyperegister.authorizedperson = '" . $username . "';");
		$fetch = runmysqlqueryfetch("SELECT count(*) as count from ssm_skyperegister WHERE userid = '" . $username . "'");
		if ($fetch['count'] <> 0)
			$query = runmysqlquery("update ssm_skyperegister set ssm_skyperegister.userid='" . $userid . "' where ssm_skyperegister.userid = '" . $username . "';");
	}
} else {
	$message = 'All the fields are Mandatory';
}
?>

<link rel="stylesheet" type="text/css" href="../style/main.css">
<div id="contentdiv" style="display:block;">
	<table width="100%" border="0" cellspacing="0" cellpadding="4">
		<tr>
			<td class="content-header">Update Username to Userid</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td style="padding:0">
				<table width="100%" border="0" cellspacing="0" cellpadding="0"
					style="border:1px solid #6393df; border-top:none;">
					<tr style="cursor:pointer" onClick="showhide('maindiv','toggleimg');">
						<td class="header-line" style="padding:0">&nbsp;&nbsp;Enter / Edit / View Details</td>
						<td align="right" class="header-line" style="padding-right:7px">
							<div align="right"><img src="../images/minus.jpg" border="0" id="toggleimg" name="toggleimg"
									align="absmiddle" /></div>
						</td>
					</tr>
					<tr>
						<td colspan="2" valign="top">
							<div id="maindiv">
								<form method="post" name="submitform" id="submitform" action="">
									<div id="tabgrouponsitec1">
										<table width="100%" border="0" cellspacing="0" cellpadding="2">
											<tr>
												<td valign="top">
													<table width="100%" border="0" cellspacing="0" cellpadding="3">
														<tr bgcolor="#f7faff">
															<td valign="top">User Name:</td>
															<td valign="top"><input name="username" type="text"
																	class="swifttext" id="username" size="30" />
																<input type="hidden" name="lastslno" id="lastslno"
																	value="" />
																<input type="hidden" name="loggeduser" id="loggeduser"
																	value="<?php echo ($user); ?>" />
																<input type="hidden" name="loggedusertype"
																	id="loggedusertype"
																	value="<?php echo ($usertype); ?>" />
																<input type="hidden" name="loggedreportingauthority"
																	id="loggedreportingauthority"
																	value="<?php echo ($reportingauthority); ?>" />
															</td>
														</tr>
														<tr bgcolor="#edf4ff">
															<td valign="top">Userid:</td>
															<td valign="top"><input name="userid" type="text"
																	class="swifttext" id="userid" size="30" /></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td align="right" valign="middle"
													style="padding-right:15px; border-top:1px solid #d1dceb;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0"
														height="35">
														<tr>
															<td width="68%" height="35" align="left" valign="middle">
																<div id="form-error">
																	<?php if ($message <> '')
																		echo ($message); ?>
																</div>
															</td>
															<td width="32%" height="35" align="right" valign="middle">
																<input name="submit" type="submit"
																	class="swiftchoicebutton" id="submit"
																	value="Submit" />
																&nbsp;&nbsp;&nbsp;
																<input name="reset" type="reset"
																	class="swiftchoicebutton" id="reset"
																	value="Reset" />
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</form>
							</div>
						</td>
					</tr>

				</table>
			</td>
		</tr>
		<tr>
			<td style="padding:0">&nbsp;</td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
</div>