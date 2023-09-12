// JavaScript Document
function displaydescriptions(headertext,descriptiontext)
{
	document.getElementById('description-header').innerHTML = headertext;
	document.getElementById('description').innerHTML = descriptiontext;
}

function clearinnerhtml()
{
	document.getElementById('form-error').innerHTML = '';
}