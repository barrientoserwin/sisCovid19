<template>
  <div>
    <span class="ir-arriba icon-arrow-up2"></span>
    <app-header></app-header>
    <app-nav></app-nav>
    <router-view></router-view>
    <app-informacion></app-informacion>
    <app-footer></app-footer>
  </div>
</template>
<script>
import Header from "../shared/header.vue";
import Nav from "../shared/nav.vue";
import Informacion from '../shared/informacion.vue'
import Footer from '../shared/footer.vue'

export default {
  components: {
    "app-header": Header,
    "app-nav": Nav,
    "app-footer": Footer,
    "app-informacion": Informacion,
  },
mounted(){
  $(document).ready(function(){
 
	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
 
	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});
 
});

}

};
</script>
<style>
.ir-arriba {
	display:none;
	padding:20px;
	background:#024959;
	font-size:20px;
	color:#fff;
	cursor:pointer;
	position: fixed;
	bottom:20px;
	right:20px;
}

</style>