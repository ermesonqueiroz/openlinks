<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $referer_host
 * @property string $referer_url
 * @property string $user_agent
 * @property string $platform
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $updated_at
 * @property-read Visit $visit
 */
#[Fillable(['referer_host', 'referer_url', 'user_agent', 'platform'])]
final class Visit extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo<Link, $this>
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
