<?php namespace App;


use Illuminate\Auth\Authenticatable;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Model implements JWTSubject,AuthenticatableContract {
	
	
	use Authenticatable,EntrustUserTrait;
	
	
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'users';
	
	public $claims = [];
	
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	
	protected $fillable = ['name', 'email'];
	
	
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	protected $hidden = ['password'];
	
	
	public function getJWTIdentifier()
	{
		
		return $this->getKey();
		
	}
	
	
	public function getJWTCustomClaims()
	{
		
		return $this -> claims;
		
	}
	
}

