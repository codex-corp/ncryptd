<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\User
 *
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
        protected $fillable = ['name', 'email', 'password', 'first_name', 'last_name', 'avatar', 'is_superuser'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
        protected $hidden = ['password', 'remember_token'];

        protected $casts = [
                'is_superuser' => 'boolean',
        ];

        public function getId()
        {
                return $this->id;
        }

        public function isSuperUser()
        {
                return (bool) ($this->is_superuser ?? false);
        }

        public function fullName()
        {
                return trim("{$this->first_name} {$this->last_name}");
        }

        public function gravatar()
        {
                $gravatar = md5(strtolower(trim($this->gravatar ?? $this->email)));
                return "//gravatar.org/avatar/{$gravatar}";
        }

}
