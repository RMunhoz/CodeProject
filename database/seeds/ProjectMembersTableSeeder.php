<?php

use CodeProject\Entities\ProjectMembers;
use Illuminate\Database\Seeder;

class ProjectMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Project::truncate();
        factory(ProjectMembers::class, 10)->create();
    }
}
