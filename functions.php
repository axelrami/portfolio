<?php

/**
 * Funcion que captura los valores de una 
 * petición POST o GET de HTTP.
 */
function enviar_formulario_por_email(){

	// Verificamos que los 3 campos tengan valores
	if( empty( $_POST['NameInput'] ) || empty( $_POST['SubjectInput'] ) || empty( $_POST['CommentTextarea'] ) ):

		//Enviamos al usuario a la misma página con una variable GET de error.
		wp_redirect( add_query_arg( array( 'errormsg' => "Campos incompletos" ), get_home_url() . '/#contact') );
		exit;

	endif;


	// SIEMPRE SE DEBEN SANITIZAR LOS VALORES
	$name     = sanitize_text_field( $_POST['NameInput'] );
    $subject    = sanitize_text_field( $_POST['SubjectInput'] );
    $comment    = sanitize_text_field( $_POST['CommentTextarea'] );


	/*
	Una vez que tenemos los datos del formulario podemos
	hacer con ellos lo que nuestro proyecto web necesite, ej:
	a)  Enviar un email con esta información
	b)  Guardar los valores en base de datos
	c)  Hacer una nueva llamada POST a otro servicio que necesita
		esta información.

	En nuestro caso vamos a mandar un email con el nombre y el mensaje del usuario.
	*/
    wp_mail( "chelo3007@gmail.com", "Subject.- " .$subject , $name . ", te envió este mensaje: " . $comment  );

	/* Una vez que hayamos trabajado con los datos debemos
	redireccionar al usuario a la misma u a otra nueva página.
	En nuestro ejemplo, vamos a redirigirlo a la misma página
	de contacto con una variable de éxito.*/
    wp_redirect( add_query_arg( array( 'exito' => " 1" ), get_home_url() . '/#contact') ); exit;


}
add_action('admin_post_nopriv_contacto', 'enviar_formulario_por_email'); // Para usuarios no logueados
add_action('admin_post_contacto', 'enviar_formulario_por_email'); // Para usuarios logueados