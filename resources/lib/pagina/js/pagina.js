
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '669135653874525');
  fbq('track', 'PageView');



  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '226959791906533');
  fbq('track', 'PageView');


	$(document).ready(function() {
		// Gets the video src from the data-src on each button
		var $imageSrc;  
		$('.gallery img').click(function() {
			$imageSrc = $(this).data('bigimage');
		});
		console.log($imageSrc);
		// when the modal is opened autoplay it  
		$('#myModal').on('shown.bs.modal', function (e) {
			
		// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
		
		$("#image").attr('src', $imageSrc  ); 
	})
	  
	  
	// reset the modal image
	$('#myModal').on('hide.bs.modal', function (e) {
		// a poor man's stop video
		$("#image").attr('src',''); 
	}) 
		
	// document ready  
	});




  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-4875821-64');



function confirmSubmit()
{
var where_to= confirm("Al salir de BoliviaSegura la navegación deja de ser gratuita, seguro que desea continuar?");
if (where_to== true)
{
return true ;
}
else
{
return false ;
}
}


	$('#new_select').change(function(){
    	$('#output').val($(this).find('option:selected').val());
	});

	function fetch_select(val)
	{
	 $.ajax({
	 type: 'post',
	 url: 'municipios_proc.php',
	 data: {
	  get_option:val
	 },
	 success: function (response) {
	  document.getElementById("new_select").innerHTML=response; 
	 }
	 });
	}
	