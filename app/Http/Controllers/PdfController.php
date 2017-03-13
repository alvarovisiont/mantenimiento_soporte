<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use PDF;

use App\Equipos;

use App\Falla;

use App\Departamentos;

class PdfController extends Controller
{
    //

    public function __Construct()
    {
        $this->middleware('validate.user');
    }

//============================================ Equipos ============================================
	public function index()
	{

		$bm_equipo = new Equipos;

		return view('pdf.equipos', ['bm_equipo' => $bm_equipo]);
	}

	public function mostrar_equipos(Request $request)
	{		
		$where = "1";
		$fecha_desde = "";
		$fecha_hasta = "";

		if($request->fecha_desde != "")
		{	
			$fecha_desde = date('Y-m-d', strtotime($request->fecha_desde));
		}

		if($request->fecha_hasta != "")
		{	
			$fecha_hasta = date('Y-m-d', strtotime($request->fecha_hasta));
		}

		if(!empty($request->bm_equipo))
		{
			if(!empty($where))
			{
				$where.= " And equipos.bm LIKE '$request->bm_equipo'";
			}
			else
			{
				$where = "equipos.bm LIKE '$request->bm_equipo'";	
			}
		}
		if(!empty($request->nom_equipo))
		{
			if(!empty($where))
			{
				$where.= " And equipos.nom_equipo LIKE '$request->nom_equipo'";
			}
			else
			{
				$where = "equipos.nom_equipo LIKE '$request->nom_equipo'";	
			}
		}

		if(!empty($request->color))
		{
			if(!empty($where))
			{
				$where.= " And equipos.color LIKE '$request->color'";
			}
			else
			{
				$where = "equipos.color LIKE '$request->color'";	
			}
		}

		if(!empty($request->bm_monitor))
		{
			if(!empty($where))
			{
				$where.= " And equipos.monitor LIKE '$request->bm_monitor'";
			}
			else
			{
				$where = "equipos.monitor LIKE '$request->bm_monitor'";	
			}
		}

		if(!empty($request->bm_raton))
		{
			if(!empty($where))
			{
				$where.= " And equipos.raton LIKE '$request->bm_raton'";
			}
			else
			{
				$where = "equipos.raton LIKE '$request->bm_raton'";	
			}
		}

		if(!empty($request->bm_teclado))
		{
			if(!empty($where))
			{
				$where.= " And equipos.teclado LIKE '$request->bm_teclado'";
			}
			else
			{
				$where = "equipos.teclado LIKE '$request->bm_teclado'";	
			}
		}

		if(!empty($fecha_desde))
		{
			if(!empty($where))
			{
				$where.= " And equipos.created_at >= '$fecha_desde'";
			}
			else
			{
				$where = "equipos.created_at >= '$fecha_desde'";	
			}
		}

		if(!empty($fecha_hasta))
		{
			if(!empty($where))
			{
				$where.= " And equipos.created_at <= '$fecha_hasta'";
			}
			else
			{
				$where = "equipos.created_at <= '$fecha_hasta'";	
			}
		}		
		
		$equipos = new Equipos;

		$datos = $equipos->datos_pdf($where);

		if($request->ajax())
		{
			if($datos == "")
			{
				$datos = "false";
			}
			return response()->json([
				'datos' => $datos
				]);
		}
		else
		{
			$this->generate_pdf($datos);
		}
	}

	function generate_pdf($datos) 
	{
	    $pdf = PDF::loadView('pdf.download_pdf.equipos', ['datos' => $datos]);
	    return $pdf->download('equipos.pdf');
	}

	//============================================ Departamentos ============================================

	public function pdf_departamentos()
	{
		$departamentos = new Departamentos;
		return view('pdf.departamentos', ['departamentos' => $departamentos]);
	}

	public function mostrar_departamentos(Request $request)
	{
		$where = "1";
		if(!empty($request->departamento))
		{
			$where = "departamentos.id = $request->departamento";
		}

		$departamentos = new Departamentos;
		$datos = $departamentos->datos_reporte($where);

		if($request->ajax())
		{
			if($datos == "")
			{
				$datos = "false";
			}
			return response()->json([
				'datos' => $datos
				]);
		}
		else
		{
			$this->generate_pdf_departamentos($datos);
		}
	}

	function generate_pdf_departamentos($datos) 
	{
	    $pdf = PDF::loadView('pdf.download_pdf.departamentos', ['datos' => $datos]);
	    return $pdf->download('departamentos.pdf');
	}

//============================================ FALLAS ============================================

	public function pdf_fallas()
	{
		$fallas = new Falla;
		return view('pdf.fallas', ['fallas' => $fallas]);	
	}

	public function mostrar_fallas(Request $request)
	{
		$where = "1";

		if(!empty($request->equipo))
		{
			if(!empty($where))
			{
				$where.= " And fallas.equipos_id = '$request->equipo'";
			}
			else
			{
				$where = "fallas.equipos_id = '$request->equipo'";	
			}
		}

		if(!empty($request->departamento))
		{
			if(!empty($where))
			{
				$where.= " And fallas.departamento_id = '$request->departamento'";
			}
			else
			{
				$where = "fallas.departamento_id = '$request->departamento'";	
			}
		}

		if(!empty($request->trabajador))
		{
			if(!empty($where))
			{
				$where.= " And fallas.trabajador_id = '$request->trabajador'";
			}
			else
			{
				$where = "fallas.trabajador_id = '$request->trabajador'";	
			}
		}
		$fallas = new Falla;

		$datos = $fallas->datos_reporte($where);

		if($request->ajax())
		{
			if($datos == "")
			{
				$datos = "false";
			}
			return response()->json([
				'datos' => $datos
				]);
		}
		else
		{
			$this->generate_pdf_fallas($datos);
		}
	}

	function generate_pdf_fallas($datos) 
	{
	    $pdf = PDF::loadView('pdf.download_pdf.fallas', ['datos' => $datos]);
	    return $pdf->download('Fallas.pdf');
	}
}
