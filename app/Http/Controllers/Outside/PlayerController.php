<?php

namespace App\Http\Controllers\Outside;

use App\Repositories\Contracts\PlayerRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    protected $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function show(Request $request)
    {
        try {
            $player = $this->playerRepository->find($request->id);

            if ($player->slug !== $request->slug) {
                throw new RepositoryException();
            }

            return view('public.player.show', compact('player'));
        } catch (RepositoryException $e) {
            return view('errors.404');
        }
    }
}
