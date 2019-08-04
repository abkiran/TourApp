<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transformers\TourTransformer;
use Dingo\Api\Routing\Helpers;
use App\Models\Tour;
use App\Models\Seo;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $tours = Tour::with(['location', 'seo'])
                ->paginate(10);
        return $tours;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'url' => 'required|string|max:50|unique:tour,url',
            'description' => 'nullable|string',
            'location_id' => 'nullable|int||exists:location,id',
            'duration' => 'nullable|string|max:100',
            'is_live' => 'required|string|max:1',
            'is_promoted' => 'nullable|string|max:1',
            'booking_count' => 'nullable|int',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ]);
        
        $seo = new Seo();
        $seo->title = $request->title;
        $seo->description = $request->description;
        $seo->keywords = $request->keywords;
        $seo_id = $seo->save();

        $request->request->add();
        Tour::create($request->all() + ['seo_id' => $seo_id]);

        // return redirect('/admin/tour')->with('message', 'New tour has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTour($str)
    {
        $tour = Tour::where('id', $str)->orWhere('url', $str)->firstOrFail();
        return $tour;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'id' => 'required|int',
            'title' => 'required|string|max:100',
            'url' => 'required|string|max:50|unique,tours,url',
            'description' => 'nullable|string',
            'location_id' => 'nullable|int|exists:location,id',
            'duration' => 'nullable|string|max:100',
            'is_live' => 'nullable|boolean|max:1',
            'is_promoted' => 'nullable|boolean|max:1',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'booking_count' => 'nullable|int',
        ];

        $payload = app('request')->only('title', 'url', 'description', 'location_id', 'duration', 'is_live', 'is_promoted', 'booking_count');

        $validator = app('validator')->make($payload, $rules);

        if ($validator->fails()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new Tour.', $validator->errors());
        }

        $tour = Tour::findOrFail($id);
        $tour->title = $request->get('title');
        $tour->url = $request->get('url');
        $tour->description = $request->get('description');
        $tour->location_id = $request->get('location_id');
        $tour->duration = $request->get('duration');
        $tour->is_live = $request->get('is_live');
        $tour->is_promoted = $request->get('is_promoted');
        $tour->seo_id = $request->get('seo_id');
        $tour->booking_count = $request->get('booking_count');
        $tour->save();
        return redirect('admin/tour')->with('message', 'Tour details are updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyTour($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();
        
        return response()->json([
            'message' => 'Tour Deleted!'], 200);
    }
}
