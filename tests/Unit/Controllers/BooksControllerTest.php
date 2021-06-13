<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Mockery as m;
use App\Models\Book;
use Illuminate\Database\Connection;
use App\Http\Controllers\BooksController;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Http\Request;
use App\Http\Requests\BooksRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\Assert;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksControllerTest extends TestCase
{
    protected $db;

    public function setUp() :void
    {
        $this->afterApplicationCreated(function () {
            $this->db = m::mock(
                Connection::class.'[select,update,insert,delete]',
                [m::mock(\PDO::class)]
            );

            $manager = $this->app['db'];
            $manager->setDefaultConnection('mock');

            $r = new \ReflectionClass($manager);
            $p = $r->getProperty('connections');
            $p->setAccessible(true);
            $list = $p->getValue($manager);
            $list['mock'] = $this->db;
            $p->setValue($manager, $list);

        });

        parent::setUp();
    }

    public function test_index_returns_view()
    {
        $controller = new BooksController();

        $this->db->shouldReceive('select')->once()->withArgs([
            'select count(*) as aggregate from "books" where "books"."deleted_at" is null',
            [],
            m::any(),
        ])->andReturn((object) ['aggregate' => 10]);

        $view = $controller->index();

        $this->assertEquals('admin.books.index', $view->getName());
        $this->assertArrayHasKey('books', $view->getData());
    }

    public function test_it_stores_new_book()
    {
        $controller = new BooksController();

        $data = [
            'name' => 'Tam Cam',
            'amount' => 14,
            'puplisher' => 1,
            'status' => 2,
            'authors' => [2],
            'categories' => [2],
            'thumbnail' => UploadedFile::fake()->image('photo1.jpg'),
        ];

        $request = new BooksRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollBack', 'commit');
        
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(2);

        $this->db->shouldReceive('insert')->once()
            ->withArgs([
                'insert into "books" ("name", "amount", "status_id", "puplisher_id", "thumbnail", "updated_at", "created_at") values (?, ?, ?, ?, ?, ?, ?)',
                m::on(function ($arg) {

                    return is_array($arg) ;
                })
            ])
            ->andReturn(true);

        $response = $controller->store($request);
      
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('books.index'), $response->headers->get('Location'));
        $this->assertEquals(trans('books.successcreate'), $response->getSession()->get('success'));
    }

    public function test_create_returns_view()
    {
        $controller = new BooksController();
        $this->db->shouldReceive('select');
        $view = $controller->create();

        $this->assertEquals('admin.books.create', $view->getName());
        $this->assertArrayHasKey('puplishers', $view->getData());
        $this->assertArrayHasKey('authors', $view->getData());
        $this->assertArrayHasKey('categories', $view->getData());
        $this->assertArrayHasKey('statuses', $view->getData());
    }

    public function test_edit_book()
    {
        $this->db->shouldReceive('select')->andReturn(true);
        $this->db->shouldReceive('select')->with(1)->andReturn(new Book);
        $controller = new BooksController();
       
        $view = $controller->edit(1);

        $this->assertEquals('admin.books.edit', $view->getName());
        $this->assertArrayHasKey('puplishers', $view->getData());
        $this->assertArrayHasKey('authors', $view->getData());
        $this->assertArrayHasKey('categories', $view->getData());
        $this->assertArrayHasKey('statuses', $view->getData());
        $this->assertArrayHasKey('book', $view->getData());
    }

    public function test_destroy_existing_city()
    {
        $controller = new BooksController();
        $this->db->shouldReceive('select')->andReturn(true);
        $this->db->shouldReceive('select')->with(1)->andReturn(new Book);
        $this->db->shouldReceive('delete')->andReturn(true);
        $this->db->shouldReceive('update')->andReturn(true);
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollBack', 'commit');

        $response = $controller->destroy(1);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('books.index'), $response->headers->get('Location'));
        $this->assertEquals(trans('books.deletesuccess'), $response->getSession()->get('success'));
    }
}
