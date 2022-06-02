document.getElementById('eye').addEventListener('change', function() {
    this.checked ? document.getElementById('pass').setAttribute('type', 'text') : document.getElementById('pass').setAttribute('type', 'password');
});