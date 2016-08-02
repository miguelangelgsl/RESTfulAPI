<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model{
	
	protected $table='fabricantes';
	protected $primaryKey ='id';
	protected $fillable = array('nombre','telefono');
	public $timestamps = true;

	protected $hidden = ['created_at', 'updated_at'];


	public function vehiculos(){

		return $this->hasMany('App\Vehiculo');

	}
}