<?php

//CallBacks

function listar_noticias(){

  $listado_noticias = array();

  $args = array(
    			'numberposts' => 10
  );
  $posts_array = get_posts( $args );

  foreach ($posts_array as $entrada){
		array_push($listado_noticias,[
    	'ID'		     		  => $entrada -> ID,
    	'fechaEntrada'    => $entrada ->post_date,
    	'tituloEntrada'   => $entrada ->post_title,
    	'tituloExtracto'  => $entrada ->post_excerpt,
    	'nombreAutor'     => get_author_name( $entrada -> post_author),
    ]);
  }
 	return $listado_noticias;

}

function noticia_por_id($data){

	$datosNoticia=array();
	$noticia=get_post($data['id']);

  $datosNoticia=[
		'fechaEntrada'   => $noticia ->post_date,
    'tituloEntrada'    => $noticia ->post_title,
	  'extractoEntrada'   => $noticia ->post_excerpt,
	  'nombreAutor'    => get_author_name( $noticia -> post_author),
		'avatarURL'	   => get_avatar_url( $noticia -> post_author ),
  ];

	return $datosNoticia;
}



// Creamos los custom endpoints
add_action( 'rest_api_init', function () {
  register_rest_route( 'wordapp/v1', '/noticias', array(
    'methods' => 'GET',
    'callback' => 'listar_noticias',
  ) );
  register_rest_route( 'WordAPP/v1', '/noticia/(?P<id>\d+)', array(
     'methods' => 'GET',
     'callback' => 'noticia_por_id',
   ) );

} );

?>
