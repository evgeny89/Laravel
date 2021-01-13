<?php

namespace Tests\Unit;

use App\Models\News;
use PHPUnit\Framework\TestCase;

class NewsTest extends TestCase
{
    public $news;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->news = new News();
    }

    public function testAllNews()
    {

        $all = $this->news->getAllNews();

        $this->assertIsArray($all);
        $this->assertNotEmpty($all);
    }

    public function testUserData()
    {
        $user = $this->news->getUser(1);

        $this->assertIsArray($user);
        $this->assertNotEmpty($user);
    }

    public function testFailUserData()
    {
        $failUser = $this->news->getUser(0);

        $this->assertEmpty($failUser);
        $this->assertNull($failUser);
    }

    public function testGetNews()
    {
        $news = $this->news->getNews(1);

        $this->assertIsArray($news);
        $this->assertNotEmpty($news);
    }

    public function testFailNews()
    {
        $news = $this->news->getNews(-1);

        $this->assertEmpty($news);
        $this->assertNull($news);
    }

    public function testGetCategory()
    {
        $category = $this->news->getCategory(1);

        $this->assertIsArray($category);
        $this->assertNotEmpty($category);
    }

    public function testFailCategory()
    {
        $category = $this->news->getCategory(-1);

        $this->assertEmpty($category);
        $this->assertNull($category);
    }

    public function testGetLastThreeNews()
    {
        $lastNews = $this->news->getLastThreeNews();

        $this->assertIsArray($lastNews);
    }

    public function testGetNewsInCategory()
    {
        $news = $this->news->getNewsInCategory(1);

        $this->assertIsArray($news);
        $this->assertNotEmpty($news);
    }

    public function testGetNewsInFailCategory()
    {
        $news = $this->news->getNewsInCategory(0);

        $this->assertIsArray($news);
        $this->assertEmpty($news);
    }
}
