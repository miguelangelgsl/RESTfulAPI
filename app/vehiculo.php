<?php namespace App;


use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model{

	protected $table='vehiculos';
	protected $primaryKey ='serie';
	protected $fillable = array('color','cilindraje','potencia','peso','fabricante_id');
	public $timestamps = true;


	public function fabricante(){
		$this->belongsTo('Fabricante');
	}
}

