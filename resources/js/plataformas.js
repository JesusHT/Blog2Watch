let html = `<form method="POST" action="">
                <input type="radio" name="plataforma" id="netflix" value="1" onchange="this.form.submit()">
                <label for="netflix"> <img src="resources/pictures/netflix.gif"></label><br>

                <input type="radio" name="plataforma" id="amazon" value="2" onchange="this.form.submit()">
                <label for="amazon"><img src="resources/pictures/primevideo.gif"></label><br>

                <input type="radio" name="plataforma" id="disney" value="3" onchange="this.form.submit()">
                <label for="disney"><img src="resources/pictures/disneyplus.gif"></label><br>

                <input type="radio" name="plataforma" id="hbo" value="4" onchange="this.form.submit()">
                <label for="hbo"><img src="resources/pictures/hbo.gif"></label><br>

                <input type="radio" name="plataforma" id="todo" value="5" onchange="this.form.submit()">
                <label for="todo">Todo</label>
            </form>`;

document.querySelector("#menu").innerHTML = html;