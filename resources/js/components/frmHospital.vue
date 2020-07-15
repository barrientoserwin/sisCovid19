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
                    <i class="fa fa-align-justify"></i> Hospitales
                    <button type="button" @click="abrirModal('hospital','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                <option value="nombre">Nombre</option>
                                <option value="localidad">Localidad</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarHospital(1, buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarHospital(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Hospital</th>
                                <th>Contacto</th>
                                <th>Localidad</th>
                                <th>Direccion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="hospital in arrayHospital" :key="hospital.id">
                                <td>
                                    <button type="button" @click="abrirModal('hospital','modificar',hospital.id)" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" class="btn btn-danger btn-sm" @click="eliminarHospital(hospital.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </td>
                                <td v-text="hospital.nombre"></td>
                                <td v-text="hospital.telefono"></td>
                                <td v-text="hospital.localidad"></td>
                                <td v-text="hospital.direccion"></td>
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
                                    <input type="text" v-model="datos.nombre" class="form-control" placeholder="Nombre del hospital">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Contactos</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.telefono" class="form-control" placeholder="Tel: 34518002, Cel:78490474">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Localidad</label>
                                <div class="col-md-9">
                                    <v-select
                                        @search="selectZona"
                                        label="nombre_mun"
                                        v-model="datos.localidad"
                                        :options="arrayZona"
                                        placeholder="Seleccione su Municipio..."
                                        @input="getDatosZona"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.direccion" class="form-control" placeholder="Direccion del hospital">
                                </div>
                            </div>
                            <div v-show="errorMostrarMsjHospital" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjHospital" :key="error" v-text="error[0]">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarHospital()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="modificarHospital()">Actualizar</button>
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
    import Vue from "vue";
    import vSelect from "vue-select";    
    import "vue-select/dist/vue-select.css";
    Vue.component("v-select", vSelect);

    export default {
        data(){
            return {
                datos : {
                    id : 0,
                    nombre : '',
                    telefono : '',
                    localidad : '',
                    direccion : '',
                },
                arrayHospital : [],
                arrayZona : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMostrarMsjHospital : [],
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
            listarHospital(page, buscar, criterio){
                let me=this;
                var url='/hospital?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayHospital=response.data.data.data;
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
            selectZona(search,loading){
                let me=this;
                loading(true);
                var url= '/zona/selectZona?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;                    
                    q: search
                    me.arrayZona=respuesta.data;
                    loading(false);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosZona(val1){
                let me = this;
                me.loading = true;
                me.datos.localidad = val1.nombre_mun +'/'+ val1.nombre_prov;
            },
            cambiarPagina(page, buscar, criterio){
                let me=this;
                me.pagination.current_page=page;
                me.listarHospital(page, buscar, criterio);
            },
            guardarHospital(){
                let me = this;
                axios.post('/hospital/guardar',this.datos).then(function(response){
                    me.cerrarModal();
                    me.listarHospital(1, '', 'nombre');            
                })
                .catch(function(error){
                    me.errorMostrarMsjHospital=error.response.data.errorMessages;
                    console.log(error);
                });
            },
            modificarHospital(){
                let me = this;
                axios.put('/hospital/modificar',this.datos).then(function(response){
                    me.cerrarModal();
                    me.listarHospital(1, '', 'nombre');                     
                }).catch(function(error){
                    me.errorMostrarMsjHospital=error.response.data.errorMessages;
                    console.log(error);
                });
            },
            eliminarHospital(id){
                swal({
                title: 'Esta seguro de eliminar esta hospital?',
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

                    axios.delete('/hospital/eliminar/'+id).then(function (response) {
                        me.listarHospital(1, '', 'nombre');
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
                this.errorMostrarMsjHospital = [];
                this.datos = {
                    id : 0,
                    nombre : '',
                    telefono : '',
                    localidad : '',
                    direccion : '',
                }
            },
            cargarDatos(id){
                let me=this;
                var url= '/hospital/getDatos/'+id;
                axios.get(url).then(function (response) {
                    me.datos=response.data.data;          
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            abrirModal(modelo, accion, id){
                switch(modelo){
                    case "hospital":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal='Registrar Hospital'
                                this.datos = {
                                    id : 0,
                                    nombre : '',
                                    telefono : '',
                                    localidad : '',
                                    direccion : '',
                                },
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'modificar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Modificar Hospital';
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
            this.listarHospital(1, this.buscar, this.criterio);
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