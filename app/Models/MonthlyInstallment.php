<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MonthlyInstallment
 *
 * @property int $id
 * @property int $customer_id
 * @property string $month
 * @property float $value
 * @property int $status
 * @property float|null $deferred_value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Customer $customer
 *
 * @package App\Models
 */
class MonthlyInstallment extends Model
{
	protected $table = 'monthly_installments';

	protected $casts = [
		'customer_id' => 'int',
		'value' => 'float',
		'status' => 'int',
		'deferred_value' => 'float'
	];

	protected $fillable = [
		'customer_id',
		'month',
		'value',
		'status',
		'deferred_value',
		'note',
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}
}
