<?php

namespace App\Models\User;

use App\Models\Admin\Usuarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = "ticket";
    public $timestamps = false;

    public static function Tickets(){
        $tickets = DB::Select("SELECT * FROM ticket WHERE id_estado IN (1,2) AND finalizado = 0");
        return $tickets;
    }

    public static function TicketsUsuario($id_user,$IdRolUSer){
        $categoria = DB::SELECT("SELECT * FROM USER WHERE ID = $id_user");
        foreach($categoria as $valor){
            $id_categoria = $valor->id_categoria;
        }
        if($IdRolUSer === 2){
            if(($id_categoria === 1) || ($id_categoria === 2)){
                $tickets = DB::Select("SELECT * FROM ticket WHERE id_estado IN (1,2) AND finalizado = 0 AND id_categoria IN (1,2,5)");
            }else{
                $tickets = DB::Select("SELECT * FROM ticket WHERE id_estado IN (1,2) AND finalizado = 0 AND asignado_a = $id_user");
            }
        }else{
            $tickets = DB::Select("SELECT * FROM ticket WHERE id_estado IN (1,2) AND finalizado = 0 AND asignado_a = $id_user");
        }


        return $tickets;
    }

    public static function Tipo($id_tipo){
        $tickets = DB::Select("SELECT nombre FROM tipo where id = $id_tipo");
        return $tickets;
    }

    public static function ListarTipo(){
        $tickets = DB::Select("SELECT * FROM tipo");
        return $tickets;
    }

    public static function Categoria($id_categoria){
        $tickets = DB::Select("SELECT nombre FROM categoria where id = $id_categoria");
        return $tickets;
    }

    public static function ListarCategoria(){
        $tickets = DB::Select("SELECT * FROM categoria WHERE activo = 1 AND id NOT IN (7)");
        return $tickets;
    }

    public static function Prioridad($id_prioridad){
        $tickets = DB::Select("SELECT nombre FROM prioridad where id = $id_prioridad");
        return $tickets;
    }

    public static function ListarPrioridad(){
        $tickets = DB::Select("SELECT * FROM prioridad");
        return $tickets;
    }

    public static function Estado($id_estado){
        $tickets = DB::Select("SELECT name FROM estado where id = $id_estado");
        return $tickets;
    }

    public static function ListarEstado(){
        $tickets = DB::Select("SELECT * FROM estado");
        return $tickets;
    }

    public static function ListarCargo(){
        $tickets = DB::Select("SELECT * FROM cargo_usuario WHERE activo = 1");
        return $tickets;
    }

    public static function ListarEstadoA(){
        $tickets = DB::Select("SELECT * FROM estado WHERE id not in (3,4)");
        return $tickets;
    }

    public static function ListarEstadoUpd(){
        $tickets = DB::Select("SELECT * FROM estado");
        return $tickets;
    }

    public static function EnDesarrollo(){
        $desarrollo = DB::Select("SELECT count(*) as total FROM ticket WHERE id_estado = 2");
        return $desarrollo;
    }
    public static function EnDesarrolloUsuario($id_user){
        $desarrollo = DB::Select("SELECT count(*) as total FROM ticket WHERE id_estado = 2 AND asignado_a = $id_user");
        return $desarrollo;
    }

    public static function Pendientes(){
        $pendientes = DB::Select("SELECT count(*) as total FROM ticket WHERE id_estado = 1");
        return $pendientes;
    }
    public static function PendientesUsuario($id_user){
        $pendientes = DB::Select("SELECT count(*) as total FROM ticket WHERE id_estado = 1 AND asignado_a = $id_user");
        return $pendientes;
    }

    public static function Terminados(){
        $terminados = DB::Select("SELECT count(*) as total FROM ticket WHERE id_estado = 3 AND finalizado = 1");
        return $terminados;
    }
    public static function TerminadosUsuario($id_user){
        $terminados = DB::Select("SELECT count(*) as total FROM ticket WHERE id_estado = 3 AND finalizado = 1 AND actualizado_por = $id_user");
        return $terminados;
    }

    public static function Cancelados(){
        $cancelados = DB::Select("SELECT count(*) as total FROM ticket WHERE id_estado = 4 AND finalizado = 1");
        return $cancelados;
    }
    public static function CanceladosUsuario($id_user){
        $cancelados = DB::Select("SELECT count(*) as total FROM ticket WHERE id_estado = 4 AND finalizado = 1 AND actualizado_por = $id_user");
        return $cancelados;
    }

    public static function TicketsXMes(){
        $ticketsMes = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at) = MONTH(CURDATE())");
        return $ticketsMes;
    }

    public static function GuardarMes($mesActual){
        $ticketsMes     = DB::Select("SELECT count(*) as total FROM mes_graficas WHERE nombre like '%$mesActual%'");
        $Tickets        = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE())");
        $Incidentes     = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND id_tipo = 1");
        $Requerimientos = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND id_tipo = 2");

        foreach($ticketsMes as $value){
            $total = $value->total;
        }
        foreach($Incidentes as $value){
            $totalIncidentes = $value->total;
        }
        foreach($Tickets as $value){
            $totalTickets = $value->total;
        }
        foreach($Requerimientos as $value){
            $totalRequerimientos = $value->total;
        }

        if($total === 0){
            if($totalTickets > 0){
                $guardarMes = DB::insert('INSERT INTO mes_graficas (nombre,incidentes,requerimientos) VALUES (?,?,?)', [$mesActual,$totalIncidentes,$totalRequerimientos]);
                if($guardarMes){
                    return true;
                }
            }else{
                return false;
            }

        }else{
            $guardarMes = DB::Update("UPDATE mes_graficas SET incidentes = $totalIncidentes,requerimientos = $totalRequerimientos where NOMBRE like '%$mesActual%'");
            if($guardarMes){
                return true;
            }
        }

    }

    public static function GuardarMesUsuario($mesActual,$id_user){
        $ticketsMes     = DB::Select("SELECT count(*) as total FROM mes_graficas_user WHERE nombre like '%$mesActual%' AND id_user = $id_user");
        $Tickets        = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND asignado_a = $id_user");
        $Incidentes     = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND id_tipo = 1 AND asignado_a = $id_user AND id_estado = 3");
        $Requerimientos = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND id_tipo = 2 AND asignado_a = $id_user AND id_estado = 3");

        foreach($ticketsMes as $value){
            $total = $value->total;
        }
        foreach($Incidentes as $value){
            $totalIncidentes = $value->total;
        }
        foreach($Tickets as $value){
            $totalTickets = $value->total;
        }
        foreach($Requerimientos as $value){
            $totalRequerimientos = $value->total;
        }

        if($total === 0){
            if($totalTickets > 0){
                $guardarMes = DB::insert('INSERT INTO mes_graficas_user (nombre,incidentes,requerimientos,id_user) VALUES (?,?,?,?)', [$mesActual,$totalIncidentes,$totalRequerimientos,$id_user]);
                if($guardarMes){
                    return true;
                }
            }else{
                return false;
            }

        }else{
            $guardarMes = DB::Update("UPDATE mes_graficas_user SET incidentes = $totalIncidentes,requerimientos = $totalRequerimientos where NOMBRE like '%$mesActual%' AND id_user = $id_user");
            if($guardarMes){
                return true;
            }
        }

    }

    public static function BuscarMes(){
        $ticketsMes = DB::Select("SELECT * FROM mes_graficas");
        return $ticketsMes;
    }
    public static function BuscarMesUsuario($id_user){
        $ticketsMes = DB::Select("SELECT * FROM mes_graficas_user WHERE id_user = $id_user");
        return $ticketsMes;
    }

    public static function Infraestructura(){
        $infraestructura = DB::Select("SELECT count(*) as total FROM ticket WHERE id_categoria = 1 AND id_estado = 3");
        return $infraestructura;
    }

    public static function Redes(){
        $redes = DB::Select("SELECT count(*) as total FROM ticket WHERE id_categoria = 2 AND id_estado = 3");
        return $redes;
    }

    public static function Aplicaciones(){
        $aplicaciones = DB::Select("SELECT count(*) as total FROM ticket WHERE id_categoria = 3 AND id_estado = 3");
        return $aplicaciones;
    }

    public static function Desarrollo(){
        $desarrollo = DB::Select("SELECT count(*) as total FROM ticket WHERE id_categoria = 4 AND id_estado = 3");
        return $desarrollo;
    }

    public static function Soporte(){
        $soporte = DB::Select("SELECT count(*) as total FROM ticket WHERE id_categoria = 5 AND id_estado = 3");
        return $soporte;
    }

    public static function CrearTicket($idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,$CargoUsuario,
    $IdZona,$IdSede,$IdArea,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor,$NombreJefe,$TelefonoJefe){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        if(($Estado === 3) || ($Estado === 4) ){
            $finalizado = 1;
        }else{
            $finalizado = 0;
        }
        $crearTicket = DB::insert('INSERT INTO ticket (titulo,descripcion,created_at,id_tipo,creado_por,asignado_a,id_categoria,
                                                    id_zona,id_sede,id_area,nombre_usuario,telefono_usuario,email_usuario,cargo_usuario,
                                                    nombre_jefe,telefono_jefe,id_prioridad,id_estado,session_id,finalizado,actualizado_por)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                    [$Asunto,$Descripcion,$fechaCreacion,$idTipo,$creadoPor,$AsignadoA,$Categoria,$IdZona,$IdSede,
                                    $IdArea,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,$CargoUsuario,$NombreJefe,$TelefonoJefe,$Prioridad,$Estado,$creadoPor,$finalizado,$creadoPor]);
        DB::Insert('INSERT INTO notificaciones (creado_por, asignado_a,leido,fecha_notificacion)
                    VALUES (?,?,?,?)',
                    [$creadoPor,$AsignadoA,0,$fechaCreacion]);
        return $crearTicket;
    }

    public static function ActualizarTicket($idTicket,$idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,$CargoUsuario,
                                            $IdZona,$IdSede,$IdArea,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor,$comentario,$NombreJefe,$TelefonoJefe){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));

        $actualizarTicket = DB::Update("UPDATE ticket SET
                                        titulo = '$Asunto',
                                        descripcion = '$Descripcion',
                                        updated_at = '$fechaActualizacion',
                                        id_tipo = $idTipo,
                                        creado_por = $creadoPor,
                                        asignado_a = $AsignadoA,
                                        id_categoria = $Categoria,
                                        id_zona = $IdZona,
                                        id_sede = $IdSede,
                                        id_area = $IdArea,
                                        nombre_usuario = '$NombreUsuario',
                                        telefono_usuario = '$TelefonoUsuario',
                                        email_usuario = '$CorreUsuario',
                                        cargo_usuario = '$CargoUsuario',
                                        nombre_jefe = '$NombreJefe',
                                        telefono_jefe = '$TelefonoJefe',
                                        id_prioridad = $Prioridad,
                                        id_estado = $Estado,
                                        session_id = $creadoPor,
                                        actualizado_por = $creadoPor
                                        WHERE id = $idTicket");

        if($actualizarTicket){
            if(($Estado === 3) || ($Estado === 4)){
                $actualizarEstado = DB::Update("UPDATE ticket SET finalizado = 1 WHERE id = $idTicket");
            }
            $buscarUsuario = Usuarios::BuscarNombre($creadoPor);
            foreach($buscarUsuario as $row){
                $nombre_usuario = $row->nombre;
            }
            DB::insert('INSERT INTO historial_ticket (id_ticket,observacion,id_estado,id_user,nombre_usuario,creado)
                        VALUES (?,?,?,?,?,?)', [$idTicket,$comentario,$Estado,$creadoPor,$nombre_usuario,$fechaActualizacion]);
        }

        return $actualizarTicket;
    }

    public static function BuscarLastTicket($idUser){
        $buscarUltimo = DB::Select("SELECT max(id) as id FROM ticket WHERE creado_por = $idUser");
        return $buscarUltimo;
    }

    public static function Evidencia($idticket,$nombrearchivo){
        $Evidencia = DB::insert('INSERT INTO evidencia_tickets (nombre_evidencia,id_ticket) VALUES (?, ?)', [$nombrearchivo,$idticket]);
        return $Evidencia;

    }

    public static function buscarGestion(){
        $usuarios = DB::Select("SELECT * FROM user WHERE activo = 1 AND id_categoria NOT IN (7)");
        foreach($usuarios as $row){
            $id_user = $row->id;
            $nombre_user = $row->nombre;
            $ticketsDesarrollo  = DB::Select("SELECT * FROM ticket WHERE asignado_a = $id_user AND id_estado = 2 AND finalizado = 0;");
            $tDesarrollo        = count($ticketsDesarrollo);
            $ticketsPendientes  = DB::Select("SELECT * FROM ticket WHERE asignado_a = $id_user AND id_estado = 1 AND finalizado = 0;");
            $tPendientes        = count($ticketsPendientes);
            $ticketsTerminados  = DB::Select("SELECT * FROM ticket WHERE asignado_a = $id_user AND id_estado = 3 AND finalizado = 1;");
            $tTerminados        = count($ticketsTerminados);
            $ticketsCancelados  = DB::Select("SELECT * FROM ticket WHERE asignado_a = $id_user AND id_estado = 4 AND finalizado = 1;");
            $tCancelados        = count($ticketsCancelados);
            $buscarUsuario      = DB::Select("SELECT * FROM gestion WHERE id_user = $id_user");
            if($buscarUsuario){
                $actualizarGestion = DB::Update("UPDATE gestion SET desarrollo = $tDesarrollo,pendientes = $tPendientes,terminados = $tTerminados,cancelados = $tCancelados WHERE id_user = $id_user");
            }else{
                $ingresarGestion = DB::insert('INSERT INTO gestion (nombre_usuario,desarrollo,pendientes,terminados,cancelados,id_user)
                                                VALUES (?,?,?,?,?,?)', [$nombre_user,$tDesarrollo,$tPendientes,$tTerminados,$tCancelados,$id_user]);
            }

        }
        $gestion = DB::Select("SELECT * FROM gestion");
        return $gestion;
    }

    public static function buscarGestionTotal(){
        $gestion = DB::Select("SELECT count(*) as total FROM gestion");
        return $gestion;
    }
    public static function buscarGestionTotalUsuario($id_user){
        $gestion = DB::Select("SELECT count(*) as total FROM gestion WHERE id_user = $id_user");
        return $gestion;
    }

    public static function EvidenciaTicket($id_ticket){
        $evidencia = DB::Select("SELECT * FROM evidencia_tickets WHERE id_ticket = $id_ticket");
        return $evidencia;
    }

    public static function HistorialTicket($id_ticket){
        $historial = DB::Select("SELECT * FROM historial_ticket WHERE id_ticket = $id_ticket");
        return $historial;
    }

    public static function Reporte($idTipo,$idCategoria,$idUsuarioC,$idUsuarioA,$idPrioridad,$idEstado,$idZona,$idSede,$idArea,$finicio,$ffin){
        $fechaInicio    = date('Y-m-d H:i', strtotime($finicio));
        $fechaFin       = date('Y-m-d H:i', strtotime($ffin));
        // dd($fechaInicio);
        if (!empty($idTipo)) {
            $tipo   = 'id_tipo';
            $vtipo  = $idTipo;
        }
        else{
            $tipo   = '1';
            $vtipo  = '1';
        }
        if (!empty($idCategoria)) {
            $categoria   = 'id_categoria';
            $vcategoria  = $idCategoria;
        }
        else{
            $categoria   = '1';
            $vcategoria  = '1';
        }
        if (!empty($idUsuarioC)) {
            $usuarioC   = 'creado_por';
            $vusuarioC  = $idUsuarioC;
        }
        else{
            $usuarioC   = '1';
            $vusuarioC  = '1';
        }
        if (!empty($idUsuarioA)) {
            $usuarioA   = 'asignado_a';
            $vusuarioA  = $idUsuarioA;
        }
        else{
            $usuarioA   = '1';
            $vusuarioA  = '1';
        }
        if (!empty($idPrioridad)) {
            $prioridad   = 'id_prioridad';
            $vprioridad  = $idPrioridad;
        }
        else{
            $prioridad   = '1';
            $vprioridad  = '1';
        }
        if (!empty($idEstado)) {
            $estado   = 'id_estado';
            $vestado  = $idEstado;
        }
        else{
            $estado   = '1';
            $vestado  = '1';
        }
        if (!empty($idZona)) {
            $zona   = 'id_zona';
            $vzona  = $idZona;
        }
        else{
            $zona   = '1';
            $vzona  = '1';
        }
        if (!empty($idSede)) {
            $sede   = 'id_sede';
            $vsede  = $idSede;
        }
        else{
            $sede   = '1';
            $vsede  = '1';
        }
        if (!empty($idArea)) {
            $area   = 'id_area';
            $varea  = $idArea;
        }
        else{
            $area   = '1';
            $varea  = '1';
        }
        $reporteTicket = DB::Select("SELECT * FROM ticket
                                WHERE created_at BETWEEN '$fechaInicio' AND '$fechaFin'
                                AND $tipo = $vtipo
                                AND $categoria = $vcategoria
                                AND $usuarioC = $vusuarioC
                                AND $usuarioA = $vusuarioA
                                AND $prioridad = $vprioridad
                                AND $estado = $vestado
                                AND $zona = $vzona
                                AND $sede = $vsede
                                AND $area = $varea");

        return $reporteTicket;
    }

    public static function Apertura($idTicket,$idCategoria,$idUsuario,$idPrioridad,$idEstado,$User,$desrcipcion){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $aperturaTicket = DB::Update("UPDATE ticket SET id_categoria = $idCategoria,
                                                        asignado_a = $idUsuario,
                                                        id_prioridad = $idPrioridad,
                                                        id_estado = $idEstado,
                                                        actualizado_por = $User,
                                                        updated_at = '$fechaActualizacion',
                                                        finalizado = 0
                                                    WHERE id = $idTicket");

        $buscarUsuario = Usuarios::BuscarNombre($User);
        foreach($buscarUsuario as $row){
            $nombre_usuario = $row->nombre;
        }

        if($aperturaTicket){
            DB::insert('INSERT INTO historial_ticket (id_ticket,observacion,id_estado,id_user,nombre_usuario,creado)
                    VALUES (?,?,?,?,?,?)', [$idTicket,$desrcipcion,$idEstado,$User,$nombre_usuario,$fechaActualizacion]);
        }

        return $aperturaTicket;
    }

    public static function BuscarTicket($idTicket){
        $busqueda = DB::Select("SELECT * FROM ticket WHERE id = $idTicket");
        return $busqueda;
    }

    public static function UpdateNotificacion($asignado_a){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        DB::Update("UPDATE notificaciones SET leido = 1, fecha_lectura = '$fechaActualizacion' WHERE asignado_a = $asignado_a");
    }

    public static function Notificaciones($asignado_a){
        $notificaciones = DB::Select("SELECT * FROM notificaciones WHERE asignado_a = $asignado_a AND leido = 0");
        return $notificaciones;
    }

    public static function BuscarCalificacion($idTicket,$ip){
        $buscarCalificacion = DB::Select("SELECT * FROM calificacion_ticket WHERE id_ticket = $idTicket AND ip_cliente = '$ip'");
        return $buscarCalificacion;
    }

    public static function Calificar($idTicket,$ip,$UserName,$puntuacion){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCalificacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $Calificar = DB::insert('INSERT INTO calificacion_ticket (id_ticket,puntuacion,ip_cliente,nombre_maquina,fecha_calificacion)
                                 VALUES (?,?,?,?,?)',
                                 [$idTicket,$puntuacion,$ip,$UserName,$fechaCalificacion]);
        return $Calificar;
    }

}
