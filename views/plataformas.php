<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="radio" name="plataforma" id="netflix" value="1" onchange="this.form.submit()">
    <label for="netflix"> <img src="resources/img/netflix.gif" alt="Gif NETFLIX"></label><br>

    <input type="radio" name="plataforma" id="amazon" value="2" onchange="this.form.submit()">
    <label for="amazon"><img src="resources/img/primevideo.gif" alt="Gif AMAZON PRIME VIDEO"></label><br>

    <input type="radio" name="plataforma" id="disney" value="3" onchange="this.form.submit()">
    <label for="disney"><img src="resources/img/disneyplus.gif" alt="Gif DISNEY+"></label><br>

    <input type="radio" name="plataforma" id="hbo" value="4" onchange="this.form.submit()">
    <label for="hbo"><img src="resources/img/hbo.gif" alt="Gif HBO"></label><br>

    <input type="radio" name="plataforma" id="todo" value="5" onchange="this.form.submit()">
    <label for="todo">Todo</label>
</form>