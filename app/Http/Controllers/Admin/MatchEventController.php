<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Illuminate\Database\QueryException;
use App\Models\MatchEvent;
use Illuminate\Http\Request;
use App\Http\Requests\MatchEventRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\MatchEventRepositoryInterface;

class MatchEventController extends Controller
{
    protected $matchRepository;
    protected $matchEventRepository;

    public function __construct(
        MatchRepositoryInterface $matchRepository,
        MatchEventRepositoryInterface $matchEventRepository
    ) {
        $this->matchRepository = $matchRepository;
        $this->matchEventRepository = $matchEventRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('access', MatchEvent::class);
        // q: query parameter
        $keyword = $request->q;
        $match = $request->match;
        $user = $request->user;
        
        if (isset($keyword)) {
            $events = $this->matchEventRepository->search($keyword);
            $events->appends($request->only('q'));
        } else {
            if (isset($match)) {
                $events = $this->matchEventRepository->eventsByMatch($match);
            } else if (isset($user)) {
                $events = $this->matchEventRepository->eventsByUser($user);
            } else {
                $events = $this->matchEventRepository->events();
            }
        }

        return view('admin.match-event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matches = $this->matchRepository->matchesForForm();
        return view('admin.match-event.create', compact('matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MatchEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatchEventRequest $request)
    {
        $this->authorize('access', MatchEvent::class);
        try {
            $path = $this->upload($request, config('setting.public_match_event_image'));
            $inputs = $request->all();
            $inputs['image'] = $path;
            $inputs['user_id'] = auth()->user()->id;
            $this->matchEventRepository->create($inputs);

            $message = trans('admin.match-event.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
            
            return redirect()->route('match-events.index')->with('notification', $notification);
        } catch (Exception $e) {
            Storage::delete($path);
            $message = trans('admin.match-event.add.message.add_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return back()->withInput()->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('access', MatchEvent::class);
        try {
            $matchEvent = $this->matchEventRepository->find($id); // throw RepositoryException when can not found
            $matches = $this->matchRepository->categoriesForForm();

            return view('admin.match-event.edit', compact('matchEvent', 'matches'));
        } catch (RepositoryException $e) {
            $message = trans('admin.match-event.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return redirect()->back()->with('notification', $notification);
        }
    }

    public function active(Request $request)
    {
        $this->authorize('access', MatchEvent::class);
        $matchEvent = $this->matchEventRepository->find($request->id); // throw RepositoryException when can not found
        $this->matchEventRepository->update(['is_actived' => (int) $request->is_actived], $matchEvent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MatchEventRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatchEventRequest $request, $id)
    {
        $this->authorize('access', MatchEvent::class);
        try {
            $matchEvent = $this->matchEventRepository->find($id); // throw RepositoryException when can not found
            $path = $this->upload($request, config('setting.public_match_event_image'));
            
            $inputs = $request->all();
            if ($path) {
                Storage::delete($matchEvent->image);
                $inputs['image'] = $path;
            }

            $this->matchEventRepository->update($inputs, $matchEvent);
            $message = trans('admin.match-event.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('match-events.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            Storage::delete($path);
            $message = trans('admin.match-event.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->withInput()->with('notification', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('access', MatchEvent::class);
        try {
            $matchEvent = $this->matchEventRepository->find($id); // throw RepositoryException when can not found
            Storage::delete($matchEvent->image);
            $this->matchEventRepository->delete($id);

            $message = trans('admin.match-event.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.match-event.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.match-event.delete.message.delete_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    private function upload(Request $request, $directory, $directoryWithDate = true)
    {
        if ($request->hasFile('image')) {
            if ($directoryWithDate) {
                $directory .= date('/Y/m/d');
            }

            $fileName = str_slug($request->title) . '-' . time() . '.' . $request->image->extension();

            return $request->image->storeAs($directory, $fileName);
        }

        return null;
    }
}
