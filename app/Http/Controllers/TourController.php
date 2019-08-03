<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $tours = Tour::paginate(20);
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
            'title' => 'nullable|string|max:100',
            'url' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'location_id' => 'nullable|int|max:11',
            'duration' => 'nullable|string|max:100',
            'is_live' => 'nullable|string|max:1',
            'is_promoted' => 'nullable|string|max:1',
            'seo_id' => 'nullable|string|max:45',
            'booking_count' => 'nullable|int|max:11',
        ]);

        Tour::create($request->all());

        return redirect('/admin/tour')->with('message', 'New tour has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        $tour = Tour::find($id);
        if (!$tour) {
            return redirect('admin/tour')->with('alert-type', 'error')->with('message', 'tour id does not exist.!');
        }
        return $this->view("edit", ['row' => $tour]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'nullable|string|max:100',
            'url' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'location_id' => 'nullable|int|max:11',
            'duration' => 'nullable|string|max:100',
            'is_live' => 'nullable|string|max:1',
            'is_promoted' => 'nullable|string|max:1',
            'seo_id' => 'nullable|string|max:45',
            'booking_count' => 'nullable|int|max:11',
        ]);

        $tour = Tour::find($id);
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
    public function destroy($id)
    {
        $response = array();
        if ($id == '') {
            $response['status'] = 'ERROR';
            $response['msg'] = 'There was an error deleting Tour!';
            return json_encode($response);
        }

        $tour = Tour::find($id);
        $tour->delete();
        $response['status'] = 'OK';
        $response['msg'] = 'Tour has been deleted successfully!';
        return json_encode($response);
    }
}
