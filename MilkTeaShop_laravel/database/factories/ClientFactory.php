<?php

namespace Database\Factories;

use App\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         * Factory là 1 loại file dùng để generate dữ liệu giả lên database
         * definition() là phương thức định nghĩa những cột trong database sẽ có những loại dữ liệu như thế nào
         * Dùng php artisan tinker để chạy lệnh "Client::factory()->count(10)->create();"
         * Lệnh trên tạo ra 10 client có mỗi dự liệu khác nhau
         */
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'minhduc301099',
            'phone_number' => '090',
            'avatar' => null,
            'remember_token' => Str::random(10),
        ];
    }
}
