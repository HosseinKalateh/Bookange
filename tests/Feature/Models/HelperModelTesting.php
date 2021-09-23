<?php

namespace Tests\Feature\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

trait HelperModelTesting {

    /**
     * @test
     */
    public function create_model()
    {
        $data = $this->model()::factory()->make()->toArray();

        $this->model()::create($data);

        $table = $this->model()->getTable();
        $this->assertDatabaseHas($table, $data);
        $this->assertDatabaseCount($table, 1);
    }

    abstract function model() : Model;
}
