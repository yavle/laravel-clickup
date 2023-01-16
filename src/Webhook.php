<?php

namespace Spinen\ClickUp;

use Spinen\ClickUp\Exceptions\InvalidRelationshipException;
use Spinen\ClickUp\Exceptions\ModelNotFoundException;
use Spinen\ClickUp\Exceptions\NoClientException;
use Spinen\ClickUp\Support\Model;
use Spinen\ClickUp\Support\Relations\BelongsTo;
use Spinen\ClickUp\Support\Relations\ChildOf;

/**
 * Class Webhook
 *
 * @property array $events
 * @property Folder $folder
 * @property int $folder_id
 * @property int $list_id
 * @property int $space_id
 * @property int $team_id
 * @property int $userid
 * @property Member $user
 * @property Space #space
 * @property string $id
 * @property TaskList $list
 * @property Team $team
 */
class Webhook extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'folder_id' => 'integer',
        'id' => 'string',
        'list_id' => 'integer',
        'space_id' => 'integer',
        'team_id' => 'integer',
        'userid' => 'integer',
    ];

    /**
     * Path to API endpoint.
     */
    protected string $path = '/webhook';

    /**
     * Belongs to Folder
     *
     * @throws InvalidRelationshipException
     * @throws ModelNotFoundException
     * @throws NoClientException
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * Belongs to TaskList
     *
     * @throws InvalidRelationshipException
     * @throws ModelNotFoundException
     * @throws NoClientException
     */
    public function list(): BelongsTo
    {
        return $this->belongsTo(TaskList::class);
    }

    /**
     * Belongs to Space
     *
     * @throws InvalidRelationshipException
     * @throws ModelNotFoundException
     * @throws NoClientException
     */
    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    /**
     * Child of Team
     *
     * @throws InvalidRelationshipException
     * @throws ModelNotFoundException
     * @throws NoClientException
     */
    public function team(): ChildOf
    {
        return $this->childOf(Team::class);
    }

    /**
     * Belongs to Member
     *
     * @throws InvalidRelationshipException
     * @throws ModelNotFoundException
     * @throws NoClientException
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'userid');
    }
}
