document.getElementById("pass").addEventListener('input', function() {
    let pass = document.getElementById("pass-confirm").value;
    let passCheck = this.value;

    if (pass === passCheck) {
    	document.getElementById("demo").innerHTML = '<p class="text-success d-inline fw-bold"><i class="fa-solid fa-check"></i></p>';
        document.getElementById("demo2").innerHTML = '<p class="text-success d-inline fw-bold"><i class="fa-solid fa-check"></i></p>';
    } else {
    	document.getElementById("demo").innerHTML = '<p class="text-danger d-inline fw-bold"><i class="fa-solid fa-x"></i></p>';
        document.getElementById("demo2").innerHTML = '<p class="text-danger d-inline fw-bold"><i class="fa-solid fa-x"></i></p>';
    }
});

document.getElementById("pass-confirm").addEventListener('input', function() {
    let pass = document.getElementById("pass").value;
    let passCheck = this.value;

    if (pass === passCheck) {
    	document.getElementById("demo").innerHTML = '<p class="text-success d-inline fw-bold"><i class="fa-solid fa-check"></i></p>';
        document.getElementById("demo2").innerHTML = '<p class="text-success d-inline fw-bold"><i class="fa-solid fa-check"></i></p>';
    } else {
    	document.getElementById("demo").innerHTML = '<p class="text-danger d-inline fw-bold"><i class="fa-solid fa-x"></i></p>';
        document.getElementById("demo2").innerHTML = '<p class="text-danger d-inline fw-bold"><i class="fa-solid fa-x"></i></p>';
    }
});