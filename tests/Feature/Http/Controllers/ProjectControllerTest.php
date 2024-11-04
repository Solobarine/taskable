<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

uses(RefreshDatabase::class);

beforeEach(function () {
    Route::getRoutes()->refreshNameLookups();
});

it('displays a list of projects', function () {
    Project::factory()->count(3)->create();

    $response = $this->get(route('projects'));

    $response->assertStatus(200);
    $response->assertViewIs('projects.index');
    $response->assertViewHas('projects');
});

it('displays the create project form', function () {
    $response = $this->get(route('projects.create'));

    $response->assertStatus(200);
    $response->assertViewIs('projects.create');
});

it('stores a new project', function () {
    $data = [
        'name' => 'Test Project',
        'description' => 'Test Description',
    ];

    $response = $this->post(route('projects.store'), $data);

    $response->assertRedirect(route('projects'));
    $response->assertSessionHas('status', 'Project created successfully');
    $this->assertDatabaseHas('projects', $data);
});

it('fails to store a project with missing name', function () {
    $data = [
        'description' => 'Test Description',
    ];

    $response = $this->post(route('projects.store'), $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name']);
    $this->assertDatabaseMissing('projects', ['description' => 'Test Description']);
});

it('fails to store a project with too long name', function () {
    $data = [
        'name' => str_repeat('A', 256),
        'description' => 'Test Description',
    ];

    $response = $this->post(route('projects.store'), $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name']);
    $this->assertDatabaseMissing('projects', ['description' => 'Test Description']);
});

it('displays a single project', function () {
    $project = Project::factory()->create();

    $response = $this->get(route('projects.show', $project));

    $response->assertStatus(200);
    $response->assertViewIs('projects.show');
    $response->assertViewHas('project', $project);
});

it('displays the edit form for a project', function () {
    $project = Project::factory()->create();

    $response = $this->get(route('projects.edit', $project));

    $response->assertStatus(200);
    $response->assertViewIs('projects.edit');
    $response->assertViewHas('project', $project);
});

it('updates a project', function () {
    $project = Project::factory()->create();
    $data = [
        'name' => 'Updated Project Name',
        'description' => 'Updated Description',
    ];

    $response = $this->patch(route('projects.update', $project), $data);

    $response->assertRedirect(route('projects.show', $project));
    $response->assertSessionHas('success', 'Project updated successfully');
    $this->assertDatabaseHas('projects', $data);
});

it('fails to update a project with missing name', function () {
    $project = Project::factory()->create();
    $data = [
        'description' => 'Updated Description',
    ];

    $response = $this->patch(route('projects.update', $project), $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name']);
});

it('fails to update a project with too long name', function () {
    $project = Project::factory()->create();
    $data = [
        'name' => str_repeat('A', 256),
        'description' => 'Updated Description',
    ];

    $response = $this->patch(route('projects.update', $project), $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name']);
});

it('deletes a project', function () {
    $project = Project::factory()->create();

    $response = $this->delete(route('projects.destroy', $project));

    $response->assertRedirect(route('projects'));
    $response->assertSessionHas('status', 'Project deleted successfully');
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});

it('fails to delete a non-existent project', function () {
    $nonExistentProductId = 999;

    $response = $this->delete(route('projects.destroy', $nonExistentProductId));

    $response->assertStatus(404);
});
