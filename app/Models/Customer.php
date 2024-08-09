<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 *
 * @property int $id
 * @property int $serial_number
 * @property Carbon $date_of_sale
 * @property int $pawned_id
 * @property int $sponsor_id
 * @property int $debtor_id
 * @property int $car_id
 * @property float $total_price
 * @property float $first_batch
 * @property float $monthly_installment
 * @property Carbon $first_installment_date
 * @property int $status
 * @property int $delete
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Car $car
 * @property Sponsor $sponsor
 * @property Pawned $pawned
 * @property Debtor $debtor
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customer';

	protected $casts = [
		'date_of_sale' => 'datetime',
		'pawned_id' => 'int',
		'sponsor_id' => 'int',
		'debtor_id' => 'int',
		'car_id' => 'int',
		'total_price' => 'float',
		'first_batch' => 'float',
		'monthly_installment' => 'float',
		'first_installment_date' => 'datetime',
		'status' => 'int',
		'delete' => 'int'
	];

	protected $fillable = [
		'serial_number',
		'date_of_sale',
		'pawned_id',
		'sponsor_id',
		'debtor_id',
		'car_id',
		'total_price',
		'first_batch',
		'monthly_installment',
		'first_installment_date',
		'status',
		'delete'
	];

	public function car()
	{
		return $this->belongsTo(Car::class);
	}

	public function sponsor()
	{
		return $this->belongsTo(Sponsor::class, 'sponsor_id');
	}

	public function pawned()
	{
		return $this->belongsTo(Pawned::class);
	}

	public function debtor()
	{
		return $this->belongsTo(Debtor::class, 'debtor_id');
	}
}
