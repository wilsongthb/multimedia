// Constantes
INI_CARPETA = 'files/'

Vue.component('archivos', {
    template: '#archivos',
    data: function(){
        return {
            msg: 'Player Music App in VueJS',
            carpeta: INI_CARPETA,
            items: []
        }
    },
    methods: {
        getCarpetas: function(){
            $.getJSON('player.php', {
                archivos: this.carpeta
            }).done(function(response){
                console.log(response)
                this.items = response.data
            }.bind(this))
        }
    },
    created: function(){
        this.getCarpetas();
    }
})
Vue.component('carpetas', {
    template: '#carpetas',
    data: function(){
        return {
            msg: 'Player Music App in VueJS',
            carpeta: INI_CARPETA,
            items: []
        }
    },
    methods: {
        getCarpetas: function(){
            $.getJSON('player.php', {
                carpeta: this.carpeta
            }).done(function(response){
                console.log(response)
                this.items = response.data
            }.bind(this))
        },
        setCarpeta: function(item){
            console.log('emit')
            this.$emit('setCarpeta', item)
        }
    },
    created: function(){
        this.getCarpetas();
    }
})
Vue.component('App', {
    template: '#App',
    data: function(){
        return {
            msg: 'Player Music App in VueJS',
            carpeta: INI_CARPETA
        }
    },
    methods: {
        setCarpeta: function(item){
            console.log('xd')
            console.log(item)
            // this.carpeta = item
        }
    }
})

new Vue({
    el: '#root'
})