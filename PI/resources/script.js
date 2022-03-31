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

document.getElementById("pass").addEventListener('input', function() {
    let pass = document.getElementById("pass-confirm").value;
    let passCheck = this.value;


    if (pass === passCheck) {
    	document.getElementById("demo").innerHTML = "¡Coinciden!";
    	document.getElementById('demo').style.color="rgb(53,247,149)";
    }else{
    	document.getElementById("demo").innerHTML = "¡No coinciden!";
    	document.getElementById('demo').style.color="#950101";
    }
    //document.getElementById("demo").innerHTML = pass === passCheck ? "Coinciden!" : "No coinciden!";
});

document.getElementById("pass-confirm").addEventListener('input', function() {
    let pass = document.getElementById("pass").value;
    let passCheck = this.value;


    if (pass === passCheck) {
    	document.getElementById("demo").innerHTML = "¡Coinciden!";
    	document.getElementById('demo').style.color="rgb(53,247,149)";
    }else{
    	document.getElementById("demo").innerHTML = "¡No coinciden!";
    	document.getElementById('demo').style.color="#950101";
    }
});