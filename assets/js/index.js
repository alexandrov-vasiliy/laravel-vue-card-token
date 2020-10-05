Vue.prototype.$ = $;

let app = new Vue({
    el: '#app',
    data: {
        cardNameInput: '',//переменная привязанная к дерективе v-model у инпута с названием
        cardDescriptionInput: '',//переменная привязанная к дерективе v-model у инпута с описанием
        imageSrcInput: '',//в эту переменную записываем картинку в base64
        pageBanner: true,
        pageCards:false,
        pageAddCards:false,
        pageLogin: false,
        login: '',
        password: '',
        accessToken:JSON.parse(localStorage.getItem("token")),
        cards: [
            {id: 0, name: 'name1',description: 'text1',src:''},
            {id: 1, name: 'name2',description: 'text2',src:''},
            {id: 2, name: 'name3',description: 'text3',src:''},
            {id: 3, name: 'name4',description: 'text4',src:''},
        ],//карточки))
        savedCards:  JSON.parse(localStorage.getItem("cards")),
    },
    methods: {
        //перевод в кодировку base64
        ImageBased(){


            let file    = document.querySelector('input[type=file]').files[0];
            let reader  = new FileReader();

            reader.onloadend =  () => {
                console.log(reader.result);
                this.imageSrcInput = reader.result;

            };

            reader.readAsDataURL(file);

        },

        /*метод добавления карточки создаем
            новый объект из данных с
            инпутов и если он не пустой то пушим и
            сохраняем в локал сторедж*/

        addCard(){

            const newCard = {
                id:Date.now(),
                name: this.cardNameInput,
                description: this.cardDescriptionInput,
                src: this.imageSrcInput
            };
            if(newCard.name !== '' && newCard.description !== '' && newCard.src !== ''){
                this.savedCards.push(newCard);
                localStorage.setItem("cards", JSON.stringify(this.savedCards));
            }


        },
        //метод удаления карточки через филтр (принемаем id карточки и фильтруем массив что бы не было принятого id)
        deleteCard(id){
            if(this.savedCards ){
                this.savedCards = this.savedCards.filter(cards=>cards.id !==id);
                localStorage.setItem("cards", JSON.stringify(this.savedCards));
            }else {
                this.savedCards = this.cards.filter(cards=>cards.id !==id);
                localStorage.setItem("cards", JSON.stringify(this.savedCards));
            }


        },
        auth() {
            $.ajax({
                url: 'http://lvtestauth-master/api/login',
                method: 'POST',
                data: {
                    email: this.login,
                    password: this.password,
                    functions: 'getMe()',
                },
                success: res => {
                    if(res.access_token){
                        this.accessToken = res.access_token;
                        localStorage.setItem('token',JSON.stringify(this.accessToken));
                        this.getUser();
                    }

                },
                error: err => console.log(err)
            })
        },
        getUser(){
            $.ajax({
                url: 'http://lvtestauth-master/api/getme' ,
                headers: {
                    Authorization: `Bearer ${this.accessToken}`
                },
                success: res =>{
                    console.log(res);
                },
                error: err => console.log(err)
            })
        }


    }

});
