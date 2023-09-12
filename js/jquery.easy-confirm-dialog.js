// JavaScript Document
function delete_record(my_prdid)
{
$("#yesno").easyconfirm({locale: { title: 'Select Yes or No', button: ['No','Yes']}});
	$("#yesno").click(function() {
		(deletesubmit(my_prdid));
	});
}