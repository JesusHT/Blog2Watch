function to_open() {
	document.getElementById('vent').style.display="block";
	document.getElementById('mailbox-closed').style.display="none";
	document.getElementById('mailbox-open').style.display="block";
}

function close() {
	document.getElementById('vent').style.display="none";
	document.getElementById('mailbox-closed').style.display="block";
	document.getElementById('mailbox-open').style.display="none";
}