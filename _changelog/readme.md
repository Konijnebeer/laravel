# Changelog

## [0.0.6] - 2025-10-23

### Changed

- Home page
    - Redone Post and Blog cards
    - Cards have Liked and Follow buttons
- Admin Dashboard
    - Publish and Un publish (Posts and Blogs)
- Blogs
    - Blog view (with current Posts)
        - Owner and Admin management panel

### Added

- Blogs
    - Publish/Unpublish
- Posts
    - Publish/Unpublish
    - Post view

## [0.0.5] - 2025-10-22

### Added

- Home Page
    - Random selection of resent (Blogs and Posts)
    - Masonry Grid (Blogs Post and filler)

### Fixed

- Seeding
    - Images
    - 1 Blog per user

## [0.0.4] - 2025-10-21

### Updated

- Seeding
    - Users
        - Tags
        - Blogs
            - Posts

### Added

- Blogs
    - Index
    - Create
    - Detail
    - Edit
    - Policy Rules
    - Store Rules (user first needs to follow 5 blogs)
    - Update Rules

- Tags
    - Model
    - Migration
    - Request
    - Controller
    - Policy
    - Factory
    - Seeder
    - Pivot table with Blog
    - Pivot table with Post
    - Create
    - Detail
    - Index

- Posts
    - Index

- Home
    - Controller (Random post and blogs based on rules)

- Following
    - Follow and unfollow option Blog

- Liking
    - Liking and unliking option Post

## [0.0.3] - 2025-10-18

### Added

- Roles
    - Factory
- Blogs
    - Factory
    - Seeder
    - Policy
    - Form Request
- Posts
    - Factory
    - Seeder
    - Policy
    - Form Request

## [0.0.2] - 2025-10-15

### Updated

- Users
    - role_id
    - Default role_id
- Blogs
    - user_id
- Posts
    - user_id
    - blog_id

### Added

- Roles
    - Model
    - Controller
    - Seeder
- Blogs
    - Model
    - Controller
- Posts
    - Model
    - Controller
- Middleware
    - Admin check

## [0.0.2] - 2025-10-14

### Updated

- ERD
  ![img.png](images/ERDV2.png)

### Added

- ERD
    - Post_User Table
    - Blog_User Table
    - Relations Table

- Roles
    - Model
    - Migration
    - Request
    - Controller
    - Policy

### Removed

- ERD
    - Likes Table
    - Images Table

## [0.0.1] - 2025-10-13

### Added

- User Stories
    - Log in
    - Blog creation
    - Post creation
    - Comment creation
    - Admin dashboard
    - Blog confirmation

![img.png](images/user_storiesV1)

- ERD
    - User Table
    - Images Table
    - Blog Table
    - Posts Table
    - Comments Table
    - Tags Table
    - Likes Table

![ERD.png](images/ERDV1.png)

### Updated

- User Table

# Template

## [0.0.0] - yyyy-mm-dd

### Added

- list

### Changed

- list

### Removed

- list

### Fixed

- list
