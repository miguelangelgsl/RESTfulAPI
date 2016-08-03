<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Vehiculo;
use App\Fabricante;

class FabricanteVehiculoController extends Controller {


	public function __construct(){
		$this->middleware('auth.basic',['only' => ['store','update','destroy']]);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$fabricante = Fabricante::find($id); 

		if (!$fabricante) {
			return response()->json(['mensaje' => 'No se encuentra este fabricante',
									  'codigo' => 404],404);
		}
		return response()->json(['datos' => $fabricante->vehiculos],200);
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request,$id)
	{


		if( !$request->input('color') || 
			!$request->input('cilindraje') || 
			!$request->input('potencia') || 
			!$request->input('peso')) 
			return response()->json(['mensaje' => 'No se recibieron los valores requeridos','codigo' => 422],422);

			$fabricante = Fabricante::find($id);

			if(!$fabricante)
			return response()->json(['mensaje' => 'No existe el Fabricante Asociado:'.$id,'codigo' => 404],404);


			$fabricante->vehiculos()->create($request->all());
			return response()->json(['mensaje' => 'Vehiculo Insertado','codigo' => 201],201);	

		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($idFabricante,$idVehiculo){
		$vehiculo = Vehiculo::find($idVehiculo);

		if (!$vehiculo) {
			return response()->json(['mensaje' => 'No se encuentra este vehiculo',
									  'codigo' => 404],404);
		}

		return response()->json(['datos' => $vehiculo],200);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($idFabricante,$idVehiculo)
	{
		return 'formulario Edit el vehiculo con id: '.$idVehiculo.' del Fabricante con id:'.$idFabricante;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$idFabricante,$idVehiculo)
	{
				
		$metodo = $request->method();
		$fabricante = Fabricante::find($idFabricante);

		if(!$fabricante)
		return response()->json(['mensaje' => 'No existe el Fabricante con id:'.$idFabricante,'codigo' => 404],404);

		$vehiculo = Vehiculo::find($idVehiculo);
		if(!$vehiculo)
		return response()->json(['mensaje' => 'No existe el Vehiculo con id:'.$idVehiculo.' asociado al Fabricante con id:'.$idFabricante,'codigo' => 404],404);


		$color = $request->input('color');
		$cilindraje=$request->input('cilindraje');
		$potencia=$request->input('potencia');
		$peso=$request->input('peso');


		$existe_color=$color!= null && $color!='';
		$existe_cilindraje= $cilindraje!=null && $cilindraje!='';
		$existe_potencia= $potencia!=null && $potencia!='';
		$existe_peso= $peso!=null && $peso!='';

		if($metodo=='PATCH'){	 
			
			if($existe_color)
			$vehiculo->color = $color;

			if($existe_cilindraje)
			$vehiculo->cilindraje = $cilindraje;

			if($existe_potencia)
			$vehiculo->potencia = $potencia;

			if($existe_peso)
			$vehiculo->peso = $peso;

			if($existe_color || $existe_cilindraje || $existe_potencia || $existe_peso){
			$vehiculo->save();
			return response()->json(['mensaje' => 'Vehiculo Editado','codigo' => 201],201);
			}else{
				return response()->json(['mensaje' => 'No se recibieron parametros','codigo' => 200],200);
			}	
		}

		if($metodo == 'PUT'){	
			
			if($existe_color && $existe_cilindraje && $existe_potencia && $existe_peso){

				$vehiculo->color = $color;
				$vehiculo->cilindraje = $cilindraje;
				$vehiculo->potencia = $potencia;
				$vehiculo->peso = $peso;


			$vehiculo->save();
			return response()->json(['mensaje' => 'Vehiculo Editado','codigo' => 201],201);
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
		//
	}

}
