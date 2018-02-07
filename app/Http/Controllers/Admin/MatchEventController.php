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

    public function trashed(Request $request)
    {
        $this->authorize('access', MatchEvent::class);
        // q: query parameter
        $keyword = $request->q;
        $match = $request->match;
        $user = $request->user;
        
        if (isset($keyword)) {
            $events = $this->matchEventRepository->searchOnlyTrash($keyword);
            $events->appends($request->only('q'));
        } else {
            if (isset($match)) {
                $events = $this->matchEventRepository->eventsByMatchOnlyTrash($match);
            } else if (isset($user)) {
                $events = $this->matchEventRepository->eventsByUserOnlyTrash($user);
            } else {
                $events = $this->matchEventRepository->eventsOnlyTrash();
            }
        }

        return view('admin.match-event.trash', compact('events'));
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

            $message = trans('admin.event.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
            
            return redirect()->route('match-events.index')->with('notification', $notification);
        } catch (Exception $e) {
            Storage::delete($path);
            $message = trans('admin.event.add.message.add_error');
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
            $event = $this->matchEventRepository->find($id); // throw RepositoryException when can not found
            $matches = $this->matchRepository->matchesForForm();

            return view('admin.match-event.edit', compact('event', 'matches'));
        } catch (RepositoryException $e) {
            $message = trans('admin.event.edit.message.not_found');
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
        $event = $this->matchEventRepository->find($request->id); // throw RepositoryException when can not found
        $this->matchEventRepository->update(['is_actived' => (int) $request->is_actived], $event);
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
            $event = $this->matchEventRepository->find($id); // throw RepositoryException when can not found
            $path = $this->upload($request, config('setting.public_match_event_image'));
            
            $inputs = $request->all();
            if ($path) {
                Storage::delete($event->image);
                $inputs['image'] = $path;
            }

            $this->matchEventRepository->update($inputs, $event);
            $message = trans('admin.event.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('match-events.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            Storage::delete($path);
            $message = trans('admin.event.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->withInput()->with('notification', $notification);
        }
    }

    public function trash($id)
    {
        $this->authorize('access', MatchEvent::class);
        try {
            $this->matchEventRepository->find($id); // throw RepositoryException when can not found
            $this->matchEventRepository->delete($id);

            $message = trans('admin.event.trash.message.trash_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.event.trash.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.event.trash.message.trash_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    public function untrash($id)
    {
        $this->authorize('access', MatchEvent::class);
        try {
            $event = $this->matchEventRepository->withTrashed()->find($id); // throw RepositoryException when can not found
            $event->restore();

            $message = trans('admin.event.untrash.message.untrash_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.event.untrash.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.event.untrash.message.untrash_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
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
            $event = $this->matchEventRepository->withTrashed()->find($id); // throw RepositoryException when can not found
            Storage::delete($event->image);
            $event->forceDelete();

            $message = trans('admin.event.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.event.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.event.delete.message.delete_error');
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
