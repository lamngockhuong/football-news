<?php

return [
    'public_images_asset' => 'templates/public/images/',
    'public_team_logo' => 'team/logo',
    'public_player_avatar' => 'player/avatar',
    'public_user_avatar' => 'user/avatar',
    'public_post_image' => 'news/image',
    'public_match_event_image' => 'event/image',
    'users' => [
        'coin_default' => 0,
        'is_actived_default' => 0,
        'is_admin_default' => 0,
        'actived' => 1,
        'non_actived' => 0,
        'is_member' => 0,
        'is_admin' => 1,
    ],
    'categories' => [
        'parent_default' => 0,
    ],
    'posts' => [
        'view_count_default' => 0,
        'is_actived_default' => 0,
        'category_id_default' => 0,
        'user_id_default' => 0,
        'active' => 1,
    ],
    'comments' => [
        'status_default' => 0,
    ],
    'ranks' => [
        'won_default' => 0,
        'drawn_default' => 0,
        'lost_default' => 0,
        'goals_for_default' => 0,
        'goals_against_default' => 0,
        'score_default' => 0,
    ],
    'matches' => [
        'team1_goal_default' => 0,
        'team2_goal_default' => 0,
    ],
    'match_events' => [
        'view_count_default' => 0,
        'is_actived_default' => 0,
    ],
    'bets' => [
        'team1_goal_default' => 0,
        'team2_goal_default' => 0,
        'coin_default' => 0,
    ],
    'next_match' => 4,
    'upcoming_pagination' => 10,
    'result_pagination' => 10,
    'upcoming_match_banner' => 1,
    'time_zero' => '00',
    'bet' => [
        'coins' => [10, 20, 30, 40, 50, 100, 150, 250, 350, 500, 1000],
    ],
];
