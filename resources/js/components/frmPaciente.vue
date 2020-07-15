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
                    <i class="fa fa-align-justify"></i> Paciente
                    <button type="button" @click="btnNuevoPaciente()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>

                <!-- Listado y busqueda de pacientes -->
                <template v-if="listado==0">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="nombre">Nombre</option>
                                        <option value="ci">Ci</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPaciente(1, buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPaciente(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Telefono</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Zona</th>
                                    <th>Localidad</th>
                                    <th>Direccion</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="paciente in arrayPaciente" :key="paciente.id">
                                    <td>
                                        <button type="button" @click="abrirModal(paciente)" class="btn btn-warning btn-sm">
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarPaciente(paciente.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="paciente.nombre"></td>
                                    <td v-text="paciente.sexo"></td>
                                    <td v-text="paciente.telefono"></td>
                                    <td v-text="paciente.fecha_nacimiento"></td>
                                    <td v-text="paciente.nombre_mun +' - '+ paciente.nombre_prov"></td>
                                    <td v-text="paciente.localidad"></td>
                                    <td v-text="paciente.direccion"></td>
                                    <td v-text="paciente.estado"></td>
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
                </template>
                
                <template v-if="listado==1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <center><h3>Registrar Paciente</h3></center>
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.nombre" class="form-control" placeholder="Nombre completo del paciente">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Sexo</label>
                                        <div class="col-md-9">
                                            <input type="radio" id="rbtMasculino" value="M" v-model="datos.sexo" checked>
                                            <label for="M">Masculino</label>
                                            <input type="radio" id="rbtFemenino" value="F" v-model="datos.sexo">
                                            <label for="F">Femenino</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Cédula de Identidad</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.ci" class="form-control" placeholder="Cedula de identidad">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="datos.telefono" class="form-control" placeholder="Nro Telefonico">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                                        <div class="col-md-9">
                                            <input type="date" v-model="datos.fecha_nacimiento" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Zona</label>
                                        <div class="col-md-9">                                            
                                            <v-select
                                                @search="selectZona"
                                                label="nombre_mun"
                                                v-model="zona"
                                                :options="arrayZona"
                                                placeholder="Seleccione su Municipio..."
                                                @input="getDatosZona"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Localidad</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.localidad" class="form-control" placeholder="comunidad/localidad">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="datos.direccion" class="form-control" placeholder="nro casa/calle/avenida">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Estado</label>
                                        <div class="col-md-9">
                                            <select class="form-control col-md-12" v-model="datos.estado">
                                                <option disabled value="">Seleccione</option>
                                                <option value="sospechoso">Sospechoso</option>
                                                <option value="confirmado">Confirmado</option>
                                                <option value="recuperado">Recuperado</option>
                                                <option value="deceso">Deceso</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div v-show="errorMostrarMsjPaciente" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjPaciente" :key="error" v-text="error[0]">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 col-xs-9">
                                <center><h3>Enfermedades base del paciente</h3></center>                            
                                <div class="col-md-12">
                                    <button type="button" @click="agregarEnfermedad()" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;Agregar</button>
                                </div>
                                <br>
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Enfermedad</th>
                                                <th>Observación</th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="arrayEnfermedad.length">
                                            <tr v-for="(enfermedad,index) in arrayEnfermedad" :key="enfermedad.id">
                                                <td>
                                                    <button @click="quitarEnfermedad(index)" type="button" class="btn btn-danger btn-sm">
                                                        <i class="icon-close"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <input v-model="enfermedad.nombre_enf" type="text" class="form-control" placeholder="Nombre de la enfermedad">
                                                </td>
                                                <td>
                                                    <input v-model="enfermedad.observacion" type="text" class="form-control" placeholder="Descripcion de la observacion">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody v-else>
                                            <tr>
                                                <td colspan="3">
                                                    No tiene enfermedad base, agregados..
                                                </td>
                                            </tr>
                                        </tbody>                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarListado1()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="guardarPaciente()">Guardar Paciente</button>
                            </div>
                        </div>
                    </div>
                </template>
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
                                    <input type="text" v-model="datos.nombre" class="form-control" placeholder="Nombre completo del paciente">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sexo</label>
                                <div class="col-md-9">
                                    <input type="radio" id="rbtMasculino" value="M" v-model="datos.sexo" checked>
                                    <label for="M">Masculino</label>
                                    <input type="radio" id="rbtFemenino" value="F" v-model="datos.sexo">
                                    <label for="F">Femenino</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cédula de Identidad</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.ci" class="form-control" placeholder="Cedula de identidad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="datos.telefono" class="form-control" placeholder="Nro Telefonico">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="datos.fecha_nacimiento" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Zona</label>
                                <div class="col-md-9">
                                    
                                    <v-select
                                        @search="selectZona"
                                        label="nombre_mun"
                                        v-model="zona"
                                        :options="arrayZona"
                                        placeholder="Seleccione su Municipio..."
                                        @input="getDatosZona"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Localidad</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.localidad" class="form-control" placeholder="comunidad/localidad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.direccion" class="form-control" placeholder="nro casa/calle/avenida">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Estado</label>
                                <div class="col-md-9">
                                    <select class="form-control col-md-12" v-model="datos.estado">
                                        <option disabled value="">Seleccione</option>
                                        <option value="sospechoso">Sospechoso</option>
                                        <option value="confirmado">Confirmado</option>
                                        <option value="recuperado">Recuperado</option>
                                        <option value="deceso">Deceso</option>
                                    </select>
                                </div>
                            </div>
                            <div v-show="errorMostrarMsjPaciente" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPaciente" :key="error" v-text="error[0]">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="modificarPaciente()">Modificar</button>
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
                    datos:{
                        id : 0,
                        id_zona : 0,
                        nombre : '',
                        sexo : '',
                        ci : '',
                        telefono : '',
                        fecha_nacimiento : '',
                        localidad : '',
                        direccion : '',
                        estado : '', 
                    },
                    detalle:[]
                },
                zona : '',                               
                arrayPaciente : [],
                arrayEnfermedad : [],
                arrayZona : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMostrarMsjPaciente : [],
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
                buscar : '',
                listado: 0,
                nombre_enf: '',
                observacion: ''
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
            listarPaciente(page, buscar, criterio){
                let me=this;
                var url='/paciente?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayPaciente=response.data.data.data;
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
                me.datos.id_zona = val1.id;
                me.zona = val1.nombre_mun +' / '+ val1.nombre_prov;
            },
            cambiarPagina(page, buscar, criterio){
                let me=this;
                me.pagination.current_page=page;
                me.listarPaciente(page, buscar, criterio);
            },
            quitarEnfermedad(index){
                let me = this;
                me.arrayEnfermedad.splice(index,1);
            },
            agregarEnfermedad(){
                let me = this;
                me.arrayEnfermedad.push({
                    nombre_enf :'',
                    observacion : ''
                });
            },
            ocultarListado1(){
                this.listado=0;
            },
            guardarPaciente(){
                let me = this;
                me.datos.detalle= me.arrayEnfermedad;
                axios.post('/paciente/guardar',this.datos).then(function (response) {
                    me.listado =0;
                    me.listarPaciente('', '', 'nombre');
                    me.datos.datos = {
                        id : 0,
                        id_zona : 0,
                        nombre : '',
                        sexo : '',
                        ci : '',
                        telefono : '',
                        fecha_nacimiento : '',
                        localidad : '',
                        direccion : '',
                        estado : '', 
                    },
                    me.datos.detalle=[];
                    me.zona = '';
                    me.arrayZona = [];
                    me.arrayPaciente = [];                    
                    me.arrayEnfermedad = [];
                }).catch(function (error) {
                    me.errorMostrarMsjPaciente=error.response.data.errorMessages;
                    console.log(error);
                });
            },
            modificarPaciente(){
                let me = this;
                axios.put('/paciente/modificar',this.datos).then(function (response) {
                    me.modal = 0;
                    me.listarPaciente('', '', 'nombre');
                    me.datos = {
                        id : 0,
                        id_zona : 0,
                        nombre : '',
                        sexo : '',
                        ci : '',
                        telefono : '',
                        fecha_nacimiento : '',
                        localidad : '',
                        direccion : '',
                        estado : '', 
                    },
                    me.zona = '';
                    me.arrayZona = [];
                    me.arrayPaciente = [];
                }).catch(function (error) {
                    me.errorMostrarMsjPaciente=error.response.data.errorMessages;
                    console.log(error);
                });
            },
            eliminarPaciente(id){
                swal({
                title: 'Esta seguro de eliminar este paciente?',
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

                    axios.delete('/paciente/eliminar/'+id).then(function (response) {
                        me.listarPaciente('', '', 'nombre');
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
            abrirModal(data=[]){
                this.modal = 1;
                this.tituloModal='Modificar Datos del Paciente';
                this.datos.id = data['id'];
                this.datos.id_zona = data['id_zona'];
                this.zona = data['nombre_mun']+' / '+data['nombre_prov'];
                this.datos.nombre = data['nombre'];  
                this.datos.sexo = data['sexo'];      
                this.datos.ci = data['ci'];
                this.datos.telefono = data['telefono'];                                     
                this.datos.fecha_nacimiento = data['fecha_nacimiento'];
                this.datos.localidad = data['localidad'];   
                this.datos.direccion = data['direccion']; 
                this.datos.estado = data['estado'];  
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.errorMostrarMsjPaciente = [];
                this.datos = {
                    id : 0,
                    id_zona : 0,
                    nombre : '',
                    sexo : '',
                    ci : '',
                    telefono : '',
                    fecha_nacimiento : '',
                    localidad : '',
                    direccion : '',
                    estado : '', 
                };
            },
            btnNuevoPaciente(){
                let me = this;
                me.listado=1;

                me.datos = {
                    id : 0,
                    id_zona : 0,
                    nombre : '',
                    sexo : '',
                    ci : '',
                    telefono : '',
                    fecha_nacimiento : '',
                    localidad : '',
                    direccion : '',
                    estado : '', 
                };
                me.zona = '';
                me.arrayEnfermedad = [];
            }
        },
        mounted() {
            this.listarPaciente(1, this.buscar, this.criterio);
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