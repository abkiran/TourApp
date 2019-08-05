<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transformers\TourTransformer;
use Dingo\Api\Routing\Helpers;
use App\Models\Tour;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourController extends Controller
{
    public function success($message)
    {
        $return = [
            'success' => [
                'status_code' => 200,
                'message' => $message
            ]
        ];
        return $return;
    }
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
            'url' => 'required|string|max:100|unique:tour',
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
        $seo->title = $request->title??'';
        $seo->description = $request->description??'';
        $seo->keywords = $request->keywords??'';
        $seo_id = $seo->save();

        $request->request->add();
        Tour::create($request->all() + ['seo_id' => $seo_id]);
        
        return $this->success("Created");
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
        $id = null;
        if ($request->id) {
            $id = $request->id;
        }
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'url' => 'required|string|max:100|unique:tour,url,'.$id,
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
        
        $tour = Tour::findOrFail($id);

        $seo_id = $tour->seo_id;
        $seo = Seo::find($seo_id);
        if (!$seo) {
            $seo = new Seo();
        }
        $seo->title = $request->title??'';
        $seo->description = $request->description??'';
        $seo->keywords = $request->keywords??'';
        $seo = $seo->save();
        if (!$seo_id) {
            $seo_id = $seo->id;
        }

        $tour->title = $request->get('title');
        $tour->url = $request->get('url');
        $tour->description = $request->get('description');
        $tour->location_id = $request->get('location_id');
        $tour->duration = $request->get('duration');
        $tour->is_live = $request->get('is_live');
        $tour->is_promoted = $request->get('is_promoted');
        $tour->seo_id = $seo_id;
        $tour->booking_count = $request->get('booking_count');
        $tour->save();

        return $this->success("Updated");
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
