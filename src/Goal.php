<?php

namespace Spinen\ClickUp;

use Carbon\Carbon;
use Spinen\ClickUp\Exceptions\InvalidRelationshipException;
use Spinen\ClickUp\Exceptions\ModelNotFoundException;
use Spinen\ClickUp\Exceptions\NoClientException;
use Spinen\ClickUp\Support\Collection;
use Spinen\ClickUp\Support\Model;
use Spinen\ClickUp\Support\Relations\BelongsTo;
use Spinen\ClickUp\Support\Relations\ChildOf;

/**
 * Class Goal
 *
 * @package Spinen\ClickUp
 *
 * @property array $history
 * @property array $key_results
 * @property array $reactions
 * @property boolean $archived
 * @property boolean $multiple_owners
 * @property boolean $pinned
 * @property boolean $private
 * @property Carbon $date_created
 * @property Carbon $due_date
 * @property Carbon $last_update
 * @property Carbon $start_date
 * @property Collection $members
 * @property Collection $owners
 * @property float $percent_completed
 * @property Folder $folder
 * @property integer $creator
 * @property integer $folder_id
 * @property integer $key_result_count
 * @property integer $owner
 * @property integer $pretty_id
 * @property integer $team_id
 * @property string $color
 * @property string $description
 * @property string $id
 * @property string $name
 * @property Team $team
 */
class Goal extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'archived'          => 'boolean',
        'creator'           => 'integer',
        'date_created'      => 'datetime:U',
        'due_date'          => 'datetime:U',
        'folder_id'         => 'integer',
        'id'                => 'string',
        'key_result_count'  => 'integer',
        'last_update'       => 'datetime:U',
        'multiple_owners'   => 'boolean',
        'owner'             => 'integer',
        'percent_completed' => 'float',
        'pinned'            => 'boolean',
        'pretty_id'         => 'integer',
        'private'           => 'boolean',
        'start_date'        => 'datetime:U',
        'team_id'           => 'integer',
    ];

    // TODO: Setup creator & owner as a "BelongsTo" (need API resource to look up a Member)

    /**
     * Path to API endpoint.
     *
     * @var string
     */
    protected $path = '/goal';

    /**
     * Accessor for Owners.
     *
     * @param array $owners
     *
     * @return Collection
     * @throws NoClientException
     */
    public function getOwnersAttribute(array $owners): Collection
    {
        return $this->givenMany(Member::class, $owners);
    }

    /**
     * Accessor for Members.
     *
     * @param array $members
     *
     * @return Collection
     * @throws NoClientException
     */
    public function getMembersAttribute(array $members): Collection
    {
        return $this->givenMany(Member::class, $members, true);
    }

    /**
     * @return BelongsTo
     * @throws InvalidRelationshipException
     * @throws ModelNotFoundException
     * @throws NoClientException
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * @return ChildOf
     * @throws InvalidRelationshipException
     * @throws ModelNotFoundException
     * @throws NoClientException
     */
    public function team(): ChildOf
    {
        return $this->childOf(Team::class);
    }
}
