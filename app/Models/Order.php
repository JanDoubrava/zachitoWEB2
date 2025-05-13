<?php  
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\LogsActivity;

// Model pro správu objednávek
class Order extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    // Pole, která lze hromadně naplnit
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'service_id',
        'status',
        'address',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => 'string'
    ];

    /**
     * Dostupné stavy objednávky
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    /**
     * Vztah k uživateli
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Vztah ke službě
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class)->withDefault([
            'name' => 'Neznámá služba',
            'description' => 'Služba byla smazána',
            'price' => 0
        ]);
    }

    /**
     * Získá CSS třídu pro stav objednávky
     */
    public function getStatusClass(): string
    {
        return match($this->status) {
            self::STATUS_COMPLETED => 'bg-success',
            self::STATUS_CANCELLED => 'bg-danger',
            self::STATUS_PROCESSING => 'bg-info',
            default => 'bg-warning',
        };
    }

    /**
     * Získá český název stavu objednávky
     */
    public function getStatusName(): string
    {
        return match($this->status) {
            self::STATUS_COMPLETED => 'Dokončeno',
            self::STATUS_CANCELLED => 'Zrušeno',
            self::STATUS_PROCESSING => 'V procesu',
            default => 'Čeká',
        };
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Čeká',
            self::STATUS_PROCESSING => 'V procesu',
            self::STATUS_COMPLETED => 'Dokončeno',
            self::STATUS_CANCELLED => 'Zrušeno',
            default => 'Neznámý stav',
        };
    }

    public static function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'service_id' => ['required', 'exists:services,id'],
            'status' => ['required', 'in:' . implode(',', [self::STATUS_PENDING, self::STATUS_PROCESSING, self::STATUS_COMPLETED, self::STATUS_CANCELLED])],
            'address' => ['required', 'string', 'max:255']
        ];
    }

    protected static function booted()
    {
        static::created(function ($order) {
            $order->logActivity('create', 'Vytvořena nová objednávka', [
                'order_id' => $order->id,
                'email' => $order->email,
                'service_id' => $order->service_id,
            ]);
        });

        static::updated(function ($order) {
            $order->logActivity('update', 'Upravena objednávka', [
                'order_id' => $order->id,
                'email' => $order->email,
                'service_id' => $order->service_id,
                'status' => $order->status,
            ]);
        });

        static::deleted(function ($order) {
            $order->logActivity('delete', 'Smazána objednávka', [
                'order_id' => $order->id,
                'email' => $order->email,
                'service_id' => $order->service_id,
            ]);
        });
    }
}
