<?php

namespace Tests\Feature\Repositories;

use App\Http\Services\News\NewsDeleteImageService;
use App\Http\Services\News\NewsUploadImageService;
use App\Models\News;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\Factories\NewsTestFactoryTrait;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use WithFaker, NewsTestFactoryTrait;
    private $token;

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

    public function test_news_function_index_is_successfully_with_token()
    {
        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->get(route('auth.news.index'))
            ->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_news_function_index_is_failed_without_token()
    {
        $this
            ->get(route('auth.news.index'))
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_successful_with_all_data()
    {
        $data = [
            'title' => $this->faker->word,
            'image' => UploadedFile::fake()->image('news.png'),
            'date' => $this->faker->date,
            'description' => $this->faker->paragraph
        ];

        $this->mock(NewsUploadImageService::class, function (MockInterface $mock) {
            $mock->shouldReceive('uploadImage')->once()->andReturn('news.png');
        });

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_OK]);
    }

    public function test_news_function_create_is_failure_without_any_data()
    {
        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'))
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_without_title()
    {
        $data = [
            'image' => UploadedFile::fake()->image('news.png'),
            'date' => $this->faker->date,
            'description' => $this->faker->paragraph
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_without_image()
    {
        $data = [
            'title' => $this->faker->word,
            'date' => $this->faker->date,
            'description' => $this->faker->paragraph
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_without_date()
    {
        $data = [
            'title' => $this->faker->word,
            'image' => UploadedFile::fake()->image('news.png'),
            'description' => $this->faker->paragraph
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_without_description()
    {
        $data = [
            'title' => $this->faker->word,
            'image' => UploadedFile::fake()->image('news.png'),
            'date' => $this->faker->date
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_when_set_title_any_data_type_another_string()
    {
        $data = [
            'title' => $this->faker->numberBetween(0, 10),
            'image' => UploadedFile::fake()->image('news.png'),
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_when_write_title_has_character_greater_than_255()
    {
        $data = [
            'title' => $this->faker->paragraphs(10, true),
            'image' => UploadedFile::fake()->image('news.png'),
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_when_send_to_image_field_any_data_type_without_image()
    {
        $data = [
            'title' => $this->faker->word,
            'image' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_when_send_to_image_field_image_with_extension_without_png_jpg_webp_jpeg()
    {
        $data = [
            'title' => $this->faker->word,
            'image' => UploadedFile::fake()->image('news.txt'),
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_when_send_to_date_field_data_type_without_date()
    {
        $data = [
            'title' => $this->faker->word,
            'image' => UploadedFile::fake()->image('news.png'),
            'description' => $this->faker->paragraph,
            'date' => $this->faker->word
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_create_is_failure_when_send_to_description_field_data_type_without_string()
    {
        $data = [
            'title' => $this->faker->word,
            'image' => UploadedFile::fake()->image('news.png'),
            'description' => $this->faker->numberBetween(0, 10),
            'date' => $this->faker->date
        ];

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.create'), $data)
            ->assertJson(['status' => Response::HTTP_UNPROCESSABLE_ENTITY]);
    }

    public function test_news_function_delete_is_successful_with_exists_id()
    {
        $news = $this->generateRandomNews();
        $news_id = $news->id;

        $this->mock(NewsDeleteImageService::class, function (MockInterface $mock) {
            $mock->shouldReceive('deleteImageInLocal')->once();
        });

        $this
            ->withHeader('Authorization', 'Bearer' . $this->token)
            ->post(route('auth.news.delete'), [
                'id' => $news_id
            ])
            ->assertJson(['status' => Response::HTTP_OK]);
        $this->assertDatabaseMissing('news', [
            'id' => $news_id
        ]);
    }

    public function test_news_function_update_is_successful_with_exists_id_and_all_data()
    {
        $news = $this->generateRandomNews();
        $news_id = $news->id;

        $data = [
            'id' => $news_id,
            'title' => $this->faker->word,
            'image' => UploadedFile::fake()->image('news.png'),
            'date' => $this->faker->date,
            'description' => $this->faker->paragraph
        ];

        $this->mock(NewsUploadImageService::class, function (MockInterface $mock) {
            $mock->shouldReceive('uploadImage')->once()->andReturn('news.png');
        });

        $this
            ->withHeader('Authorization', 'Bearer'. $this->token)
            ->post(route('auth.news.update'), $data)
            ->assertJson(['status' => Response::HTTP_OK]);
    }
}
