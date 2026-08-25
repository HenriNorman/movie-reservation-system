<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CategoryMovie> $category_movies
 * @property-read int|null $category_movies_count
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $category_id
 * @property int $movie_id
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Movie $movie
 * @method static \Database\Factories\CategoryMovieFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryMovie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryMovie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryMovie query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryMovie whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryMovie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryMovie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryMovie whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryMovie whereUpdatedAt($value)
 */
	class CategoryMovie extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int $rating
 * @property int $location_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Hall> $halls
 * @property-read int|null $halls_count
 * @property-read \App\Models\Location $location
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Showtime> $showtimes
 * @property-read int|null $showtimes_count
 * @method static \Database\Factories\CinemaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cinema whereUpdatedAt($value)
 */
	class Cinema extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $number
 * @property string $name
 * @property bool $is_vip
 * @property int $cinema_id
 * @property-read \App\Models\Cinema $cinema
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Seat> $seats
 * @property-read int|null $seats_count
 * @method static \Database\Factories\HallFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall whereCinemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall whereIsVip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hall whereUpdatedAt($value)
 */
	class Hall extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $street
 * @property string $city
 * @property string $state
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cinema> $cinemas
 * @property-read int|null $cinemas_count
 * @method static \Database\Factories\LocationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereUpdatedAt($value)
 */
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $description
 * @property string|null $poster_image
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CategoryMovie> $category_movies
 * @property-read int|null $category_movies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Showtime> $showtimes
 * @property-read int|null $showtimes_count
 * @method static \Database\Factories\MovieFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie wherePosterImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movie whereUpdatedAt($value)
 */
	class Movie extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $hall_id
 * @property-read \App\Models\Hall $hall
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ReservationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUserId($value)
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $row
 * @property int $number
 * @property bool $is_vip
 * @property int $hall_id
 * @property-read \App\Models\Hall $hall
 * @method static \Database\Factories\SeatFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat whereIsVip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat whereRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Seat whereUpdatedAt($value)
 */
	class Seat extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $movie_id
 * @property int $hall_id
 * @property string $start_time
 * @property string $end_time
 * @property numeric $price
 * @property string $language
 * @property string $status
 * @property-read \App\Models\Hall|null $cinema
 * @property-read \App\Models\Movie $movie
 * @method static \Database\Factories\ShowtimeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Showtime whereUpdatedAt($value)
 */
	class Showtime extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $profile_picture
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

