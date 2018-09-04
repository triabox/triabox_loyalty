<?php

namespace Xtending\EntityBundle\Entity;




class XtendingConstantes
{
	
	//CONSTANTE TIPO CRITERIO DEFINICION
	const CLIENTE_EMPRESA = 'cliente_empresa';
	
	const CLIENTE_PRODUCTO = 'cliente_producto';
	
	const CLIENTE_SITE = 'cliente_site';
	
	const CLIENTE_CONTACTO = 'contactos_cliente';
	
	const PROVEEDOR_EMPRESA = 'proveedor_empresa';
	
	const PROVEEDOR_PRODUCTO = 'proveedor_producto';
	
	const PROVEEDOR_SITE = 'proveedor_site';
	
	const PROVEEDOR_CONTACTO = 'contactos_proveedor';
	
	const PROPIO_EMPRESA = 'usuario_empresa';
	
	const PROPIO_PRODUCTO = 'usuario_producto';
	
	const PROPIO_SITE = 'usuario_site';
	
	const PROPIO_CONTACTO = 'contactos_usuario';
	
	const TIPO_ENTIDAD_EMPRESA = 'EMPRESA';
	
	const TIPO_ENTIDAD_SITE = 'SITE';
	
	const TIPO_ENTIDAD_PRODUCTO = 'PRODUCTO';
	
	const TIPO_ENTIDAD_CORPORACION = 'CORPORACION';
	
	const TIPO_FILTRO_USUARIO = 'USUARIO';
	
	const TIPO_FILTRO_CLIENTE = 'CLIENTE';
	
	const TIPO_FILTRO_PROVEEDOR = 'PROVEEDOR';
	
	const VIEW_LIST = 'list';
	
	const VIEW_EXCEL = 'excel';
	
	const TIPO_LABEL_CARATULA_VALOR = 'LABEL';
	
	const TIPO_PREGUNTA_VALOR = 'PREGUNTA';
	
	const PROCESO_PROVEEDOR = 'PROCESO_PROVEEDOR';
	
	const PROCESO_CLIENTE = 'PROCESO_CLIENTE';
	
	const PROCESO_PROPIO = 'PROCESO_PROPIO';
	
	//ESTADO FORMULARIO - VARIABLE QUE DEFINE SI EL ESTADO CREA VERSION Y SI ESTA APROBADO
	
	const ESTADO_FORMULARIO_CREA_VERSION = '1';
	
	//ESTADO DE FORMULARIO ESTADO VALOR DEL REGISTRO
	
	const ESTADO_FORMULARIO_VALOR_APROBADO = '2';
	
	const ESTADO_FORMULARIO_VALOR_RECHAZADO = '1';
	
	const ESTADO_FORMULARIO_VALOR_PENDIENTE = '0';
	
	//TIPOS DE PARTICIPANTES EN EL FLUJO DE UNA AUDITORIA
	
	const AUTORES_VALOR = '1';
	
	const REVISORES_VALOR = '2';
	
	const APROBADORES_VALOR = '3';
	
	const AUTORES_LABEL = 'autores';
	
	const REVISORES_LABEL = 'revisores';
	
	const APROBADORES_LABEL = 'aprobadores';
	
	//ESTADO FORMULARIO RESULTADO
	
	const REGISTRO_CERRADO = '0';
	
	const REGISTRO_ABIERTO = '1';
	
	const REGISTRO_NOEVALUADO = '2';
	
	const REGISTRO_APROBADO = '3';
	
	public static function getEquivalencia($entrada){
		
		if(XtendingConstantes::CLIENTE_EMPRESA == $entrada or XtendingConstantes::CLIENTE_PRODUCTO == $entrada or XtendingConstantes::CLIENTE_SITE == $entrada){
			return XtendingConstantes::TIPO_FILTRO_CLIENTE;
		}
		
		if(XtendingConstantes::PROVEEDOR_EMPRESA == $entrada or XtendingConstantes::PROVEEDOR_PRODUCTO == $entrada or XtendingConstantes::PROVEEDOR_SITE == $entrada){
			return XtendingConstantes::TIPO_FILTRO_PROVEEDOR;
		}
		if(XtendingConstantes::PROPIO_EMPRESA == $entrada or XtendingConstantes::PROPIO_PRODUCTO == $entrada or XtendingConstantes::PROPIO_SITE == $entrada){
			return XtendingConstantes::TIPO_FILTRO_USUARIO;
		}
		
	}
	
	public static function getEquivalenciaFiltroYTipoUsuario($tipo_filtro_cliente,$site,$empresa,$producto,$corporacion){
	
		if(XtendingConstantes::TIPO_FILTRO_CLIENTE == $tipo_filtro_cliente and $site != ''){
			return XtendingConstantes::CLIENTE_SITE;
		}
	
		if(XtendingConstantes::TIPO_FILTRO_USUARIO == $tipo_filtro_cliente and $site != ''){
			return XtendingConstantes::PROPIO_SITE;
		}
		if(XtendingConstantes::TIPO_FILTRO_PROVEEDOR == $tipo_filtro_cliente and $site != ''){
			return XtendingConstantes::PROVEEDOR_SITE;
		}
		
		
		if(XtendingConstantes::TIPO_FILTRO_CLIENTE == $tipo_filtro_cliente and $empresa != ''){
			return XtendingConstantes::CLIENTE_EMPRESA;
		}
		
		if(XtendingConstantes::TIPO_FILTRO_USUARIO == $tipo_filtro_cliente and $empresa != ''){
			return XtendingConstantes::PROPIO_EMPRESA;
		}
		if(XtendingConstantes::TIPO_FILTRO_PROVEEDOR == $tipo_filtro_cliente and $empresa != ''){
			return XtendingConstantes::PROVEEDOR_EMPRESA;
		}
		
		if(XtendingConstantes::TIPO_FILTRO_CLIENTE == $tipo_filtro_cliente and $producto != ''){
			return XtendingConstantes::CLIENTE_PRODUCTO;
		}
		
		if(XtendingConstantes::TIPO_FILTRO_USUARIO == $tipo_filtro_cliente and $producto != ''){
			return XtendingConstantes::PROVEEDOR_PRODUCTO;
		}
		if(XtendingConstantes::TIPO_FILTRO_PROVEEDOR == $tipo_filtro_cliente and $producto != ''){
			return XtendingConstantes::PROPIO_PRODUCTO;
		}
	
	}
	
	/**
	 * Reemplaza todos los acentos por sus equivalentes sin ellos
	*
	* @param $string
	*  string la cadena a sanear
	*
	* @return $string
	*  string saneada
	*/
	public static function sanear_string($string)
	{
	
		$string = trim($string);
	
		$string = str_replace(
				array('�', '�', '�', '�', '�', '�', '�', '�', '�'),
				array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
				$string
		);
	
		$string = str_replace(
				array('�', '�', '�', '�', '�', '�', '�', '�'),
				array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
				$string
		);
	
		$string = str_replace(
				array('�', '�', '�', '�', '�', '�', '�', '�'),
				array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
				$string
		);
	
		$string = str_replace(
				array('�', '�', '�', '�', '�', '�', '�', '�'),
				array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
				$string
		);
	
		$string = str_replace(
				array('�', '�', '�', '�', '�', '�', '�', '�'),
				array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
				$string
		);
	
		$string = str_replace(
				array('�', '�', '�', '�'),
				array('n', 'N', 'c', 'C',),
				$string
		);
	
		//Esta parte se encarga de eliminar cualquier caracter extra�o
		$string = str_replace(
				array("\\", "�", "�", "-", "~",
						"#", "@", "|", "!", "\"",
						"�", "$", "%", "&", "/",
						"(", ")", "?", "'", "�",
						"�", "[", "^", "`", "]",
						"+", "}", "{", "�", "�",
						">", "< ", ";", ",", ":",
						" "),
				'',
				$string
		);
	
	
		return $string;
	}
	
}
