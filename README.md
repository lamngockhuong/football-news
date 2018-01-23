# ffn_08

# [Football News]
## [Users]
- Can sign up
- Can login/logout
- Authenticate via Facebook, Google
- Can view profile
- Can update profile/ change password
- Can view football news
- Can make/edit/delete comment below each news
- Can share social-network below each news
- View football team information
- View player information
- View match information
- View league schedule
- View ranking table
- View match result in a league
- Can view transfer information
- Can search team/league by keyword such as: country, continents
- Can bet for football match

# [Admin]
- Login
- Can update profile.
- Users manage (can delete user).
- Can view users’profile.
- Manage football news.
- Manage Leagues Season.
- Manage football team.
- Manage Matches in a league.
- Manage Matching event.
- Manage Players in a football team.
- Manage Team Achievements.
- Manage Ranking table.
- Manage player awards in matches of a league.
- Manage access statistics.

# [System]
- Send verify email when users signup success.
- Send message to admin when users made a bet.
- Send message via email to users made a bet when the match ended.

# Step by step
1. Design database
2. Add tasks on redmine + estimate time
3. Init project
4. Init models, add relationship
5. Design static pages
6. Signup / Login / Logout
7. Other pulls

# Step to update task on redmine
1. Change Status to "In Progress", "Due date"
2. Update  "Spent time", "% Done (100)",  before send pull request to trainer 
3. If trainer COMMENT, change "% Done (80)", after that continue to fix comment; if not, move to step 4
4. After MERGED, update task infomation "spent time", "% Done (100)", Status to "Resolved" 

# Notice: 
Trừ pull init project và init model, các pull khác không quá 15 files thay đổi
Các bạn trong team review chéo cho nhau + comment OK vào pull sau khi review xong mà không có lỗi nào

# [Framgia Coding Standard PHP]
https://github.com/framgia/coding-standards/tree/master/vn/php

# PHP-Code-Sniffer check code convention with Sublime Text 
1. https://gist.github.com/tuanpht/98da682333dd1bc8e4516417653158aa 
2. https://github.com/wataridori/framgia-php-codesniffer
