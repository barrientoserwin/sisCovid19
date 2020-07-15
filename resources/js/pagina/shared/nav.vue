<template>
    	<nav class="navbar navbar-expand-lg navbar-light bg-light row">
			<div class="Derecha" wfd-id="152">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" wfd-id="190">☰</button>
			</div> 
		  	<div class="collapse navbar-collapse" id="navbar-collapse" wfd-id="136">
			<ul class="navbar-nav mr-auto" wfd-id="141">
				<li class="nav-item active" :wfd-id="url.id" v-for="url in array_url" :key="url.id">
					<router-link :to='url.url' class="nav-link" href="#">{{ url.nombre }}</router-link>
				</li>
			</ul>
		 	</div>
		</nav>
</template>
<script>
export default {
	data(){
		return{
			array_url:[
				{
					url:'inicio',
					nombre:'Pagina de Inicio',
					id:'150'
				},
				{
					url:'medida',
					nombre:'Medias de Seguridad',
					id:'149'
				},
				
			]
		}
	}
};
</script>