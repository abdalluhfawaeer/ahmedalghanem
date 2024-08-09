<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sponsor
 *
 * @property int $id
 * @property string $name
 * @property int|null $id_number
 * @property string|null $phone1
 * @property string|null $phone2
 * @property string|null $phone3
 * @property string|null $address
 * @property string|null $address2
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Customer[] $customers
 *
 * @package App\Models
 */
class Sponsor extends Model
{
	protected $table = 'sponsor';

	protected $fillable = [
		'name',
		'id_number',
		'phone1',
		'phone2',
		'phone3',
		'address',
		'address2'
	];

	public function customers()
	{
		return $this->hasMany(Customer::class, 'debtor_id');
	}
}
