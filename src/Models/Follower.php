<?php

namespace Emanci\Rally\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    /**
     * Follower construct.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config('rally.followable_table', 'followables');
        parent::__construct($attributes);
    }

    /**
     * Returns the entity that followed this entity.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function followable()
    {
        return $this->morphTo(config('rally.followable_prefix', 'followable'));
    }
}
