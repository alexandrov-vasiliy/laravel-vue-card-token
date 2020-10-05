<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="assets/js/vue.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto"  >
                <li class="nav-item"><a class="nav-link" href="#" @click="()=>{this.pageBanner = true ; this.pageCards = false; this.pageAddCards= false;}">Главная</a></li>
                <li  class="nav-item"><a class="nav-link" href="#" @click="()=>{this.pageBanner = false; this.pageCards = true; this.pageAddCards= false;}">Карточки</a></li>
                <li class="nav-item"><a class="nav-link" href="#" @click="()=>{this.pageBanner = false; this.pageCards = false; this.pageAddCards= true;}">Добавить картокч</a></li>
                <li class="nav-item"><a class="nav-link" href="#" @click="()=>{this.pageBanner = false; this.pageCards = false; this.pageAddCards= false;this.pageLogin = true}">войти</a></li>
            </ul></nav>
        <img v-if="pageBanner" src="assets/image/bg.jpg" class="banner" alt="">
        <div v-else-if=pageCards class="card-container">
            <div v-if="!savedCards" v-for="card in cards" class="card"  style="width: 18rem; ">

                <div class="card-body">
                    <a href="#" @click="deleteCard(card.id)" class="btn dell btn-danger">&times; <!--это крестик для удаления--> </a>
                    <h5 class="card-title">{{card.name}}</h5>
                    <p class="card-text">{{card.description}}</p>


                </div>
                <img :src="card.src"  alt="" class="card-img card-img-bot">
            </div>
            <div  v-for="svcards in savedCards" class="card sv" style="width: 18rem; ">
                <div class="card-body">
                    <a href="#" @click="deleteCard(svcards.id)" class="btn dell btn-danger">&times; <!--это крестик для удаления--> </a>
                    <h5 class="card-title">{{svcards.name}}</h5>
                    <p class="card-text">{{svcards.description}}</p>


                </div>
                <img :src="svcards.src"  alt="" class="card-img card-img-bot">
            </div>
        </div>
        <div v-else-if="pageAddCards" class="add-card">
            <form>
                <input type="file" class="form-control" id="input-file" @change="ImageBased(this)">
                <div class="form-group">
                    <label  for="input-name">Имя</label>
                    <input v-model="cardNameInput"  class="form-control" type="text" id="input-name">
                </div>
                <div class="form-group">
                    <label for="input-description">Описание</label>
                    <input v-model="cardDescriptionInput"  class="form-control" type="text" id="input-description">
                </div>

                <button @click.prevent="addCard">добавить карточку</button>
            </form>
        </div>
        <div v-else-if="pageLogin" class="page-login">
            <form>

                <div class="form-group">
                    <label  for="input-login">Логиен</label>
                    <input v-model="login"  class="form-control" type="text" id="input-login">
                </div>
                <div class="form-group">
                    <label for="input-password">password</label>
                    <input v-model="password"  class="form-control" type="password" id="input-password">
                </div>

                <button @click.prevent="auth">Войти</button>
            </form>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
<script src="assets/js/index.js">

</script>