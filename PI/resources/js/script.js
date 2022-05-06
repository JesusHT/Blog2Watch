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
    	document.getElementById("demo").innerHTML = '<i class="bi bi-check-lg"></i>';
    	document.getElementById('demo').style.color="green";
        document.getElementById("demo2").innerHTML = '<i class="bi bi-check-lg"></i>';
        document.getElementById('demo2').style.color="green";
    }else{
    	document.getElementById("demo").innerHTML = '<i class="bi bi-x-lg"></i>';
    	document.getElementById('demo').style.color="#950101";
        document.getElementById("demo2").innerHTML = '<i class="bi bi-x-lg"></i>';
        document.getElementById('demo2').style.color="#950101";
    }
});

document.getElementById("pass-confirm").addEventListener('input', function() {
    let pass = document.getElementById("pass").value;
    let passCheck = this.value;

    if (pass === passCheck) {
    	document.getElementById("demo").innerHTML = '<i class="bi bi-check-lg"></i>';
    	document.getElementById('demo').style.color="green";
        document.getElementById("demo2").innerHTML = '<i class="bi bi-check-lg"></i>';
        document.getElementById('demo2').style.color="green";
    }else{
    	document.getElementById("demo").innerHTML = '<i class="bi bi-x-lg"></i>';
    	document.getElementById('demo').style.color="#950101";
        document.getElementById("demo2").innerHTML = '<i class="bi bi-x-lg"></i>';
        document.getElementById('demo2').style.color="#950101";
    }
});
