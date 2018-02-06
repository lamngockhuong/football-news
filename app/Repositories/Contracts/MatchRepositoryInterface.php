<?php

namespace App\Repositories\Contracts;

interface MatchRepositoryInterface extends RepositoryInterface
{
    public function matches(...$args);

    public function nextMatches($number);

    public function nextLeagueMatches($leagueId, $number);

    public function nextMatchesPagination($number);

    public function results($leagueId, $number);

    public function checkTeamHasRank($teamId, $leagueId);

    public function matchExists($team1Id, $team2Id, $leagueId);

    public function matchesForForm();

    public function isUpcommingMatch($matchId);
}
