<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Incident;

CONST NO_RECORDS_MESSAGE = "There is no records";

class IncidentsScreenTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected $incidents = null;

    /**
     * Clean database
     *
     * @return void
     */
    private function clean_database() 
    {
        if($this->incidents) {
            Incident::truncate();
        }
    }

    /**
     * Test show incident crud screen
     *
     * @return void
     */
    public function test_show_incident_crud_screen()
    {
        $response = $this->get('/admin/incidents');
        $response->assertStatus(200);
    }

    /**
     * Test dont show list of incidents if it has no records
     *
     * @return void
     */
    public function test_dont_show_list_of_incidents_if_it_has_no_records()
    { 
        $this->clean_database();

        $response = $this->get(route('incidents.index'));
        $response->assertSee(NO_RECORDS_MESSAGE);
    }

    /**
     * Test show list of incidents if it has records
     *
     * @return void
     */
    public function test_show_list_of_incidents_if_it_has_records()
    {
        $this->incidents = Incident::factory()->count(5)->make();
        $response = $this->get(route('incidents.index'));
        $response->assertOk();
        $response->assertViewHas('incidents');
        $this->assertEquals(5, count($this->incidents));    
    }

    /**
     * Test show save incident record page
     *
     * @return void
     */
    public function test_show_save_incident_record_page() 
    {
        $response = $this->get('/admin/incidents/create');
        $response->assertOk();
        $response->assertSee('New incident');
        $response->assertSee('Name');
    }

    /**
     * Test save incident record
     *
     * @return void
     */
    public function test_save_incident_record() 
    {
        $this->clean_database();
        $name = $this->faker->name;

        $response = $this->post(route('incidents.store'), [
            'name' =>$name
        ]);
        
        $response->assertRedirect(route('incidents.create'));
        $response->assertSessionHas('sucess', "Incident saved");
    }

    /**
     * Test show incident
     *
     * @return void
     */
    public function test_show_incident() 
    {
        $this->clean_database();

        $incident = Incident::factory()->create();

        $response = $this->get(route('incidents.show', ['id'=>$incident->id]));

        $response->assertSee($incident->name);
    }

    /**
     * Test delete incident
     *
     * @return void
     */
    public function test_delete_incident() 
    {

        $incident = Incident::factory()->create();

        $response = $this->get(route('incidents.destroy',$incident->id));

        $response->assertRedirect(route('incidents.index'));
        $response->assertSessionHas('sucess', "Incident deleted");


    }
}
