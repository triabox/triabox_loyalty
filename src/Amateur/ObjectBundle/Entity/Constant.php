<?php

namespace Amateur\ObjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constant
 */
class Constant
{
	//TIPO DE NOVEDADES DE USUARIO
	const TYPE_MAIN_NEWS = '00';
	const TYPE_PENDING_FRIEND = '01';
	const TYPE_CREATE_EVENT = '02';
	const TYPE_ENROLLED_EVENT = '03';
	const TYPE_NEW_RESULT_EVENT = '04';
	const TYPE_SEARCH_EVENT = '05';
	const TYPE_NEW_COMMENT = '06';
	
	//Notificacion vista o no por el usuario
	const NOTIFICATION_VIEW = '01';
	const NOTIFICATION_NOT_VIEW = '00';
	
	const COMMENT_CREATE_EVENT = 'Se cargo el evento';
	const COMMENT_CREATE_EVENT_RESULT = 'Nuevos resultados agregados';
	const COMMENT_ENROLLED_EVENT = 'Se inscribio al evento';
	const COMMENT_NEW_RESULT_EVENT = 'Estan disponible los resultado del evento';
	const COMMENT_PENDING_FRIEND = 'Solicitud de amistad';
	const COMMENT_SEARCH_EVENT = 'Recomienda el evento ';
}
