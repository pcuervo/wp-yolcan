<?php
class ClientesModel {
	public $_wpdb;
	public $_prefix;

	function __construct() {
		global $wpdb;
		$this->_wpdb = $wpdb;
		$this->_prefix = $wpdb->prefix;
	}

	static function install()
	{
		
	}


	/**
	 * REGRESA LOS CLIENTES ACTIVOS
	 * @return [type] [description]
	 */
	public function getClientesActivos($club = 0)
	{
		$ext = '';
		if ($club != 0) {
			$ext .= ' AND club_id = '.$club;
		}
		return $this->_wpdb->get_results( "SELECT oc.* FROM (SELECT * FROM {$this->_prefix}usermeta WHERE meta_key = '{$this->_prefix}capabilities' AND meta_value LIKE '%customer%') as um
			INNER JOIN {$this->_prefix}opciones_clientes as oc
			ON um.user_id = oc.cliente_id
			WHERE suspendido = 0 $ext
			HAVING saldo >= costo_semanal_canasta;", 
	  OBJECT );
	}


	/**	
	 * REGRESA LOS CLIENTES QUE NO TIENEN COMPRAS DE PRODUCTOS
	 * @return [type] [description]
	 */
	public function getClientesInactivos()
	{
		return $this->_wpdb->get_results( "SELECT user_id as cliente_id FROM {$this->_prefix}usermeta 
			WHERE meta_key = '{$this->_prefix}capabilities' AND meta_value LIKE '%customer%' AND user_id NOT IN (SELECT cliente_id FROM {$this->_prefix}opciones_clientes)", 
	 	 OBJECT );
	}

	/**
	 * REGRESA LOS CLIENES QUE SUSPENDIERON SUS ENTREGAS 
	 */
	public function getClientesSuspendidos($club = 0)
	{
		$ext = '';
		if ($club != 0) {
			$ext .= ' AND club_id = '.$club;
		}
		return $this->_wpdb->get_results( "SELECT oc.*, se.tiempo_suspension, se.fecha_inicio_suspension as fecha_suspension, se.fecha_proximo_cobro  FROM (SELECT * FROM {$this->_prefix}usermeta WHERE meta_key = '{$this->_prefix}capabilities' AND meta_value LIKE '%customer%') as um
			INNER JOIN {$this->_prefix}opciones_clientes as oc
			ON um.user_id = oc.cliente_id
			LEFT JOIN {$this->_prefix}suspension_entregas as se
			ON oc.id_suspension = se.id
			WHERE suspendido = 1 $ext;", 
	 	 OBJECT );
	}

	/**
	 * REGRESA LOS CLIENTES QUE YA SOLO LES ALCANSA PARA UNA CANASTA
	 * @return [type] [description]
	 */
	public function getClientesProximosCaducar($club = 0)
	{
		$ext = '';
		if ($club != 0) {
			$ext .= ' WHERE club_id = '.$club;
		}
		return $this->_wpdb->get_results( "SELECT oc.*, ( costo_semanal_canasta * 2 ) as dos_semanas FROM (SELECT * FROM {$this->_prefix}usermeta WHERE meta_key = '{$this->_prefix}capabilities' AND meta_value LIKE '%customer%') as um
			INNER JOIN {$this->_prefix}opciones_clientes as oc
			ON um.user_id = oc.cliente_id $ext
			HAVING saldo >= costo_semanal_canasta AND saldo < dos_semanas;", 
	 	 OBJECT );
	}

	/**
	 * REGRESA LOS CLIENTES QUE SU SALDO NO ALCANZA NI PARA UNA CANASTA
	 * @param  integer $club [description]
	 * @return [type]        [description]
	 */
	public function getClientesSaldoInsuficiente($club = 0)
	{
		$ext = '';
		if ($club != 0) {
			$ext .= ' WHERE club_id = '.$club;
		}
		return $this->_wpdb->get_results( "SELECT oc.*, ( costo_semanal_canasta * 2 ) as dos_semanas FROM (SELECT * FROM {$this->_prefix}usermeta WHERE meta_key = '{$this->_prefix}capabilities' AND meta_value LIKE '%customer%') as um
			INNER JOIN {$this->_prefix}opciones_clientes as oc
			ON um.user_id = oc.cliente_id $ext
			HAVING saldo < costo_semanal_canasta;", 
	 	 OBJECT );
	}


	/**
	 * REGRESA LA CANTIDAD DE CLIENTE QEU EXISTEN POR CLUB
	 * @return [type] [description]
	 */
	public function getCountClientesPorClub()
	{
		return $this->_wpdb->get_results( "SELECT club_id, count(club_id) as total FROM (SELECT * FROM {$this->_prefix}usermeta WHERE meta_key = '{$this->_prefix}capabilities' AND meta_value LIKE '%customer%') as um
			INNER JOIN {$this->_prefix}opciones_clientes as oc
			ON um.user_id = oc.cliente_id
			GROUP BY club_id;", 
	 	 OBJECT );
	}


	/**	
	 * REGRESA LAS OPCIONES DEL CLIENTE
	 * @param  [type] $clienteId [description]
	 * @return [type]            [description]
	 */
	public function getOpcionesClienteById($clienteId)
	{
		return $this->_wpdb->get_row( "SELECT * FROM {$this->_prefix}opciones_clientes WHERE cliente_id = $clienteId;", 
	 	 OBJECT );
	}

	/**
	 * REGRESA EL HISTORIAL DE CANASTAS COMPRADAS DEL CLIENTE
	 * @param  [type] $this->clienteId [description]
	 * @return [type]                  [description]
	 */
	public function getHistorialCanastas($clienteId, $limit = 20)
	{
		return $this->_wpdb->get_results( "SELECT * FROM {$this->_prefix}corte_canastas 
			WHERE cliente_id = $clienteId
			ORDER BY id DESC
			LIMIT $limit;", 
	 	 OBJECT );
	}


	/**	
	 * INGREDIENTES DE LA CANASTA
	 * @param  integer $idCanasta       [id de la canasta]
	 * @param  integer $idActualizacion [id de la actualizacion de la canasta]
	 * @return object                  [ingredientes de la canasta]
	 */
	public function getIngredientesCanasta($idCanasta, $idActualizacion)
	{
		return $this->_wpdb->get_results( "SELECT * FROM {$this->_prefix}canasta_relationships 
			WHERE canasta_id = $idCanasta AND actualizacion_id = $idActualizacion;", 
	 	 OBJECT );
	}

	/**	
	 * REGRESA LOS DATOS DE LA CANASTA COMPRADA
	 * @param  integer $clienteId       [id del cliente]
	 * @param  integer $idActualizacion [id de la actualizacion]
	 * @return [object]                  [datos canasta]
	 */
	public function getCanastaCliente($clienteId, $idActualizacion)
	{
		return $this->_wpdb->get_row( "SELECT * FROM {$this->_prefix}corte_canastas 
			WHERE cliente_id = $clienteId AND actualizacion_id = $idActualizacion", 
	 	 OBJECT );
	}

}