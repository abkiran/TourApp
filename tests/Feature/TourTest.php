<?php

namespace Tests\Unit;

use App\Models\Tour;
use App\Models\Location;
use App\Models\Seo;
use Tests\TestCase;

class TourTest extends TestCase
{
    public function test_can_create_tour()
    {
        $data = [
            'title' => $this->faker->title,
            'url' => $this->faker->slug,
            'description' => $this->faker->text($maxNbChars = 200),
            'location_id' => Location::orderByRaw('RANDOM()')->first()->id,
            'duration' => '03:00',
            'is_live' => $this->faker->boolean,
            'is_promoted' => $this->faker->boolean,
            'seo_id' => factory(Seo::class)->create()->id,
            'booking_count' => $this->faker->randomDigitNotNull
        ];
        $this->call('POST', '/tours', $data)
            ->assertJson($data);
    }
    
    public function test_can_update_tour()
    {
        $tour = factory(Tour::class)->create();
        $data = [
            'id' => $tour->id,
            'title' => $this->faker->title,
            'url' => $this->faker->slug,
            'description' => $this->faker->text($maxNbChars = 200),
            'location_id' => Location::orderByRaw('RANDOM()')->first()->id,
            'duration' => '03:00',
            'is_live' => $this->faker->boolean,
            'is_promoted' => $this->faker->boolean,
            'seo_id' => factory(Seo::class)->create()->id,
            'booking_count' => $this->faker->randomDigitNotNull
        ];
        $this->put(route('tours.update'), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    public function test_can_show_tour()
    {
        $tour = factory(Tour::class)->create();
        $this->get(route('tours.view', $tour->id))
            ->assertStatus(200);
    }
    public function test_can_delete_tour()
    {
        $tour = factory(Tour::class)->create();
        $this->delete(route('tours.delete', $tour->id))
            ->assertStatus(200);
    }
    public function test_can_list_tours()
    {
        $tours = factory(Tour::class, 2)->create()->map(function ($tour) {
            return $tour->only(['id', 'title', 'description']);
        });
        $this->get(route('tours.list'))
            ->assertStatus(200)
            ->assertJson($tours->toArray())
            ->assertJsonStructure([
                '*' => [ 'id', 'title', 'description' ],
            ]);
    }
}
