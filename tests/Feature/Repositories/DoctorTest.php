<?php

namespace Repositories;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Tests\Factories\CountryTestFactoryTrait;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    use WithFaker, CountryTestFactoryTrait;
    private $token;
    private $country_id;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $data = [
            'email' => 'ibrahim@test.com',
            'password' => '123'
        ];
        $response = $this->call('POST', route('auth.login'), $data);
        $this->token = $response['data']['token'];
    }

    public function test_doctor_function_index_is_successfully_with_token()
    {
        $this
            ->withHeader('Authorization' , 'Bearer' . $this->token)
            ->get(route('auth.doctor.index'))
            ->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_doctor_function_index_is_failure_without_token()
    {
        $this
            ->get(route('auth.doctor.index'))
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_successfully_with_all_data()
    {
        $country = $this->generateRandomCountry();
        $this->country_id = $country->id;
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_doctor_function_create_is_failure_without_any_data()
    {
        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'))
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_name()
    {
        $data = [
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_email()
    {
        $data = [
            'name' => $this->faker->name,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_image()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_gender()
    {

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_highest_certificate()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_syndicate_number()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_country_id()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_description()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png')
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_without_medical_syndicate_card()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_when_send_name_not_as_string()
    {
        $data = [
            'name' => $this->faker->numberBetween(1, 100),
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png'),
            'status' => 'available'
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_when_send_name_has_greater_than_255_characters()
    {
        $data = [
            'name' => $this->faker->paragraphs(5, true),
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png'),
            'status' => 'available'
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_doctor_function_create_is_failure_when_send_email_not_as_email()
    {
        $data = [
            'name' => $this->faker->numberBetween(1, 100),
            'email' => $this->faker->unique()->email,
            'image' => UploadedFile::fake()->image('doctor.png'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'highest_certificate' => $this->faker->randomElement(['msc', 'md', 'diploma', 'mbbch']),
            'syndicate_number' => $this->faker->unique()->numberBetween(12000000, 120000999),
            'country_id' => $this->country_id,
            'description' => $this->faker->paragraph,
            'medical_syndicate_card' => UploadedFile::fake()->image('doctor_card.png'),
            'status' => 'available'
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.doctor.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }


}
