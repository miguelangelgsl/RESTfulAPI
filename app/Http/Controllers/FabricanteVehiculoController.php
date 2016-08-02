<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Vehiculo;
use App\Fabricante;

class FabricanteVehiculoController extends Controller {


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
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($idFabricante,$idVehiculo)
	{
		return 'Mostrando el vehiculo con id: '.$idVehiculo.' del Fabricante con id:'.$idFabricante;
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
	public function update($idFabricante,$idVehiculo)
	{
		return 'Update el vehiculo con id: '.$idVehiculo.' del Fabricante con id:'.$idFabricante;
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
