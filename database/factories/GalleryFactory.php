<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Gallery::class;
    public function definition()
    {
        return [
            'img_url' => $this->faker->randomElement([
                'https://cdn.cnn.com/cnnnext/dam/assets/171109145534-08-cozy-hotels-redefining-luxury-full-169.jpg',
                'https://media.istockphoto.com/photos/3d-rendering-beautiful-luxury-bedroom-suite-in-hotel-with-tv-picture-id1066999762?k=20&m=1066999762&s=612x612&w=0&h=BitPXyhBFZQHMfpC9ikX_DReVK6Rd28hH9pRoZW8YAs=',
                'https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'https://i.pinimg.com/736x/c4/3a/13/c43a131aaa0993376fc7668285de77c9.jpg',
                'https://www.ndhl.jp/en/wp-content/uploads/2019/05/s%E3%80%80%E9%83%A8%E5%B1%8B%E3%80%80%E3%82%B9%E3%83%BC%E3%83%98%E3%82%9A%E3%83%AA%E3%82%A2%E5%92%8C%E5%AE%A4IMG_817616tai9-1024x576.jpg'
            ]),
        ];
    }
}
