<?php

namespace App\Hateoas;

use App\Models\Group;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class GroupHateoas
{
    use CreatesLinks;

    /**
     * Get the HATEOAS link to view the group.
     *
     * @param \App\Models\Group $group
     *
     * @return null|\GDebrauwer\Hateoas\Link
     */
    public function self(Group $group)
    {
        return $this->link('groups.show', ['group' => $group]);
    }
    public function update(Group $group)
    {
        return $this->link('groups.update', ['group' => $group]);
    }
    public function delete(Group $group)
    {
        return $this->link('groups.destroy', ['group' => $group]);
    }
}
