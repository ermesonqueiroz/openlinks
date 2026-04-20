<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function strlen;

/**
 * @property int $id
 * @property string $alias
 * @property string $title
 * @property string $destination_url
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $updated_at
 * @property-read User $user
 * @property-read Collection<int, Visit> $visits
 */
#[Fillable(['alias', 'title', 'destination_url'])]
final class Link extends Model
{
    use HasFactory;

    public function aliasLabel(): string
    {
        $url = url($this->alias);
        $scheme = parse_url($url, PHP_URL_SCHEME);
        return substr($url, strlen($scheme) + 3);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Visit, $this>
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
