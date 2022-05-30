<form method="POST" id="plataformas">
    <input type="radio" name="plataforma" id="netflix" value="1" onclick="filtros()">
    <label for="netflix"> <img src="resources/img/netflix.gif" alt="Gif NETFLIX"></label><br>

    <input type="radio" name="plataforma" id="amazon" value="2" onclick="filtros()">
    <label for="amazon"><img src="resources/img/primevideo.gif" alt="Gif AMAZON PRIME VIDEO"></label><br>

    <input type="radio" name="plataforma" id="disney" value="3" onclick="filtros()" >
    <label for="disney"><img src="resources/img/disneyplus.gif" alt="Gif DISNEY+"></label><br>

    <input type="radio" name="plataforma" id="hbo" value="4" onclick="filtros()" >
    <label for="hbo"><img src="resources/img/hbo.gif" alt="Gif HBO"></label><br>

    <input type="radio" name="plataforma" id="todo" value="5" onclick="filtros()" checked>
    <label for="todo">Todo</label>
</form>