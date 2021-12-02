<?php

namespace App\Hateoas;

use App\Models\Grouplink;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class GrouplinkHateoas
{
    use CreatesLinks;

    /**
     * Get the HATEOAS link to view the group.
     *
     * @param \App\Models\Grouplink $group
     *
     * @return null|\GDebrauwer\Hateoas\Link
     */
    public function self(Grouplink $grouplink)
    {
        return $this->link('grouplinks.show', ['grouplink' => $grouplink]);
    }
    public function update(Grouplink $grouplink)
    {
        return $this->link('grouplinks.update', ['grouplink' => $grouplink]);
    }
    public function delete(Grouplink $grouplink)
    {
        return $this->link('grouplinks.destroy', ['grouplink' => $grouplink]);
    }
}
