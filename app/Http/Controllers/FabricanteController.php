<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Fabricante;

class FabricanteController extends Controller {


	public function __construct(){
		$this->middleware('auth.basic',['only' => ['store','update','destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return response()->json(['datos' => Fabricante::all()],200);
	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return 'Mostrando formulario para crear un fabricante';
	}

	/** return '';
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(!$request->input('nombre') || !$request->input('telefono')) 
			return response()->json(['mensaje' => 'No se recibieron los valores','codigo' => 422],422);

		Fabricante::create($request->all());
		return response()->json(['mensaje' => 'Fabricante Insertado','codigo' => 201],201);	
		

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$fabricante = Fabricante::find($id);

		if (!$fabricante) {
			return response()->json(['mensaje' => 'No se encuentra este fabricante',
									  'codigo' => 404],404);
		}

		return response()->json(['datos' => $fabricante],200);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return 'Mostrando formulario para editar al fabricante con id:'.$id;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$metodo = $request->method();
		$fabricante = Fabricante::find($id);

		if(!$fabricante)
		return response()->json(['mensaje' => 'No existe el Fabricante con id:'.$id,'codigo' => 404],404);

		$nombre = $request->input('nombre');
		$telefono=$request->input('telefono');

		$existe_nombre=$nombre!= null && $nombre!='';
		$existe_telefono= $telefono!=null && $telefono!='';

		if($metodo=='PATCH'){	 
			
			if($existe_nombre)
			$fabricante->nombre = $nombre;

			if($existe_telefono)
			$fabricante->telefono = $telefono;

			if($existe_nombre || $existe_telefono){
			$fabricante->save();
			return response()->json(['mensaje' => 'Fabricante Editado','codigo' => 201],201);
			}else{
				return response()->json(['mensaje' => 'No se recibieron parametros','codigo' => 404],404);
			}	
		}

		if($metodo == 'PUT'){	
			
			if($existe_nombre && $existe_telefono){
			$fabricante->nombre = $nombre;
			$fabricante->telefono = $telefono;
			$fabricante->save();
			return response()->json(['mensaje' => 'Fabricante Editado','codigo' => 201],201);	
			}else{
				return response()->json(['mensaje' => 'No se recibieron todos los parametros','codigo' => 422],422);
			}

			
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$fabricante = Fabricante::find($id);
		if(!$fabricante)
		return response()->json(['mensaje' => 'No existe el Fabricante con id:'.$id,'codigo' => 404],404);

		$vehiculos = $fabricante->vehiculos;
		if(sizeof($vehiculos) > 0)
		return response()->json(['mensaje' => 'El fabricante posee :'.sizeof($vehiculos).
								 ' vehiculos asociados no se puede eliminar, debes eliminar primero sus vehiculos'
								 ,'codigo' => 409],409);


		 $fabricante->delete();
		 return response()->json(['mensaje' => 'Vehiculo Eliminado','codigo' => 200],200);

	}

}
