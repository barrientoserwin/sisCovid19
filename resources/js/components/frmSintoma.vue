<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Admin</a></li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Sintomas
                    <button type="button" @click="abrirModal('sintoma','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Sintoma</option>
                                    <option value="nivel">Gravedad/Sintoma</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarSintoma(1, buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarSintoma(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Gravedad/Sintoma</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="sintoma in arraySintoma" :key="sintoma.id">
                                <td>
                                    <button type="button" @click="abrirModal('sintoma','modificar',sintoma.id)" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" class="btn btn-danger btn-sm" @click="eliminarSintoma(sintoma.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </td>
                                <td v-text="sintoma.nombre"></td>
                                <td v-text="sintoma.nivel"></td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active' :'']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page">1</a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' :modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.nombre" class="form-control" placeholder="Nombre del Sintoma">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Gravedad Sintoma</label>
                                <div class="col-md-9">
                                     <select class="form-control col-md-12" v-model="datos.nivel">
                                        <option disabled value="">Seleccione</option>
                                        <option value="leve">Leve</option>
                                        <option value="moderada">Moderado</option>
                                        <option value="severa">Severo</option>
                                    </select>
                                </div>
                            </div>
                            <div v-show="errorMostrarMsjSintoma" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjSintoma" :key="error" v-text="error[0]">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarSintoma()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="modificarSintoma()">Modificar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->   
    </main>
</template>

<script>
    export default {
        data(){
            return {
                datos : {
                    id : 0,
                    nombre : '',
                    nivel : '',
                },
                tipoAccion : 0,
                arraySintoma : [],
                modal : 0,
                tituloModal : '',
                errorMostrarMsjSintoma : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
            }
        },
        computed : {
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
            listarSintoma(page, buscar, criterio){
                let me=this;
                var url='/sintoma?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arraySintoma=response.data.data.data;
                    me.pagination={total:response.data.data.total, 
                        current_page:response.data.data.current_page,
                        per_page: response.data.data.per_page,
                        last_page: response.data.data.last_page,
                        from: response.data.data.from,
                        to: response.data.data.to
                    }
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me=this;
                me.pagination.current_page=page;
                me.listarSintoma(page, buscar, criterio);
            },
            guardarSintoma(){
                let me = this;
                axios.post('/sintoma/guardar',this.datos).then(function(response){
                    me.cerrarModal();
                    me.listarSintoma(1, '', 'nombre');            
                })
                .catch(function(error){
                    me.errorMostrarMsjSintoma=error.response.data.errorMessages;
                    console.log(error);
                });
            },
            modificarSintoma(){
                let me = this;
                axios.put('/sintoma/modificar',this.datos).then(function(response){
                    me.cerrarModal();
                    me.listarSintoma(1, '', 'nombre');                     
                }).catch(function(error){
                    me.errorMostrarMsjSintoma=error.response.data.errorMessages;
                    console.log(error);
                });
            },
            eliminarSintoma(id){
                swal({
                title: 'Esta seguro de eliminar este Sintoma?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.delete('/sintoma/eliminar/'+id).then(function (response) {
                        me.listarSintoma(1, '', 'nombre');
                        swal(
                        'Eliminado!',
                        'El registro ha sido eliminado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                })
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.errorMostrarMsjSintoma = [];
                this.datos = {
                    id : 0,
                    nombre : '',
                    nivel : '',
                }
            },
            cargarDatos(id){
                let me=this;
                var url= '/sintoma/getDatos/'+id;
                axios.get(url).then(function (response) {
                    me.datos=response.data.data;          
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            abrirModal(modelo, accion, id){
                switch(modelo){
                    case "sintoma":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal='Registrar Sintoma'
                                this.datos = {
                                    id : 0,
                                    nombre : '',
                                    nivel : '',
                                }
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'modificar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Modificar Sintoma';
                                this.tipoAccion = 2;
                                this.cargarDatos(id);
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarSintoma(1, this.buscar, this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>