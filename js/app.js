var app = new Vue({
    el: '#app',
    data: {
        dir: 'files',
        cantidad: 30,
        archivos: {},
        archivo: false,
        src_music: false,
        info_archivos: {},
        show_config: false,
        pista: {}
    },
    methods: {
        listar_archivos: function(){
            $.post('server.php?req=files', {
                dir: this.dir,
                cantidad: this.cantidad
            }).then(function(response){
                // console.log(response);
                this.archivos = eval(response);
            }.bind(this))
        },
        info_archivo: function(nombre){
            this.src_music = false;
            $.post('server.php?req=fileinfo', {
                filename: nombre
            }).then(function(response){
                this.archivo = JSON.parse(response);
                // console.log(this.archivo);
                this.src_music = true;
            }.bind(this))
        }
    },
    created: function(){
        this.listar_archivos();
    }
})