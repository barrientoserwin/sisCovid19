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
                    <i class="fa fa-align-justify"></i> Usuarios
                    <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                <option value="nombre">Nombre</option>
                                <option value="ci">Nro Identidad</option>
                                <option value="telefono">Telefono</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarPersona(1, buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarPersona(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Cedula de Identidad</th>
                                <th>Celular</th>
                                <th>Especialidad</th>
                                <th>Turno</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="persona in arrayPersona" :key="persona.id">
                                <td>
                                    <button type="button" @click="abrirModal('persona','modificar',persona)" class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="persona.estado=='activo'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(persona.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(persona.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="persona.nombre"></td>
                                <td v-text="persona.ci"></td>
                                <td v-text="persona.telefono"></td>
                                <td v-text="persona.especialidad"></td>                                
                                <td v-text="persona.turno"></td>
                                <td v-text="persona.nomb_usuario"></td>
                                <td v-text="persona.rol"></td>                           
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
                                <label class="col-md-3 form-control-label" for="text-input">Nombre y Apellidos</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.nombre" class="form-control" placeholder="Nombre de la Persona">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cedula de Identidad</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.ci" class="form-control" placeholder="Nro de identidad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.telefono" class="form-control" placeholder="Numero de telefono">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Especialidad</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.especialidad" class="form-control" placeholder="especialidad medica">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Turno Laboral</label>
                                <div class="col-md-9">
                                    <select type="text" v-model="datos.turno" class="form-control">
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Rol (*)</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="datos.id_rol">
                                        <option value="0" disabled>Seleccione un Rol</option>
                                        <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Usuario (*)</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="datos.nomb_usuario" class="form-control" placeholder="Nombre de usuario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Password (*)</label>
                                <div class="col-md-9">
                                    <input type="password" v-model="datos.password" class="form-control" placeholder="Contraseña">
                                </div>
                            </div>
                            <div v-show="errorMostrarMsjPersona" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error[0]">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarPersona()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="modificarPersona()">Modificar</button>
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
                    ci : '',
                    telefono : '',
                    especialidad : '',
                    turno : '',
                    id_rol : 0,
                    nomb_usuario : '',
                    password : '',
                },                                
                arrayPersona : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMostrarMsjPersona : [],
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
            listarPersona(page, buscar, criterio){
                let me=this;
                var url='/usuario?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayPersona=response.data.data.data;
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
            selectRol(){
                let me=this;
                var url='/rol/selectRol';
                axios.get(url).then(function(response){
                    var respuesta =response.data;
                    me.arrayRol=respuesta.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me=this;
                me.pagination.current_page=page;
                me.listarPersona(page, buscar, criterio);
            },
            guardarPersona(){
                let me = this;
                axios.post('/usuario/guardar',this.datos).then(function(response){
                    me.cerrarModal();
                    me.listarPersona(1, '', 'nombre');
                }).catch(function(error){
                    me.errorMostrarMsjPersona=error.response.data.errorMessages;
                    console.log(error);
                });
            },
            modificarPersona(){
                let me = this;
                axios.put('/usuario/modificar',this.datos).then(function(response){
                    me.cerrarModal();
                    me.listarPersona(1, '', 'nombre');
                }).catch(function(error){
                    me.errorMostrarMsjPersona=error.response.data.errorMessages;
                    console.log(error);
                });
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = ''; 
                this.errorMostrarMsjPersona =[];             
                this.datos = {
                    id : 0,
                    nombre : '',
                    ci : '',
                    telefono : '',
                    especialidad : '',
                    turno : '',
                    id_rol : 0,
                    nomb_usuario : '',
                    password : '',
                } 
            },
            abrirModal(modelo, accion, data=[]){
                this.selectRol();
                switch(modelo){
                    case "persona":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal='Registrar Usuario'
                                        this.id_rol =0;
                                        this.nomb_usuario ='';
                                        this.password =''; 
                                        this.nombre = '';
                                        this.ci = '';
                                        this.telefono = '';
                                        this.especialidad = '';
                                        this.turno = '';                                       
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'modificar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'Modificar Usuario';
                                        this.tipoAccion = 2;
                                        this.datos.id = data['id'];
                                        this.datos.id_rol = data['id_rol'];
                                        this.datos.nomb_usuario = data['nomb_usuario'];
                                        this.datos.password = data['password'];
                                        this.datos.nombre = data['nombre'];
                                        this.datos.ci = data['ci'];
                                        this.datos.telefono = data['telefono'];
                                        this.datos.especialidad = data['especialidad'];
                                        this.datos.turno = data['turno'];                                                                                
                                        break;
                                    }
                            }
                        }
                }
            },
            desactivarUsuario(id){
                swal({
                title: 'Esta seguro de desactivar este Usuario?',
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

                    axios.put('/usuario/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1, '', 'nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
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
            activarUsuario(id){
                swal({
                title: 'Esta seguro de activar este Usuario?',
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

                    axios.put('/usuario/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1, '', 'nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
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
            }
        },
        mounted() {
            this.listarPersona(1, this.buscar, this.criterio);
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