<?php

namespace App\Hateoas;

use App\Models\Project;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class ProjectHateoas
{
    use CreatesLinks;

    /**
     * Get the HATEOAS link to view the group.
     *
     * @param \App\Models\Project $project
     *
     * @return null|\GDebrauwer\Hateoas\Link
     */
    public function self(Project $project)
    {
        return $this->link('projects.show', ['project' => $project]);
    }
    public function update(Project $project)
    {
        return $this->link('projects.update', ['project' => $project]);
    }
    public function delete(Project $project)
    {
        return $this->link('projects.destroy', ['project' => $project]);
    }
}
