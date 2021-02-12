<?php


namespace App\Repository;


use App\Http\Controllers\AdminController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserRepository
{
    const LENTA = 'https://lenta.ru/rss/news';
    const YANDEX = [
        'https://news.yandex.ru/auto.rss',
        'https://news.yandex.ru/army.rss',
        'https://news.yandex.ru/gadgets.rss',
        'https://news.yandex.ru/index.rss',
        'https://news.yandex.ru/martial_arts.rss',
        'https://news.yandex.ru/communal.rss',
        'https://news.yandex.ru/health.rss',
        'https://news.yandex.ru/games.rss',
        'https://news.yandex.ru/internet.rss',
        'https://news.yandex.ru/cyber_sport.rss',
        'https://news.yandex.ru/movies.rss',
        'https://news.yandex.ru/cosmos.rss',
        'https://news.yandex.ru/culture.rss',
        'https://news.yandex.ru/music.rss'
    ];

    private $categories, $source;

    public function saveParseNews($news)
    {
        $cats = array_map([$this, 'callbackCategory'], $news['items']);

        $this->multiSaveInDatabase($cats, 'categories');

        $this->categories = Category::all();
        $this->source = $news['source'];

        $newsArray = array_map([$this, 'callbackNews'], $news['items']);

        $this->multiSaveInDatabase($newsArray, 'news');

        return redirect()->action([AdminController::class, 'index']);
    }
    public function parseYandexNews()
    {
        $result = [
            'source' => 'yandex.ru',
            'items' => []
        ];

        foreach ($this::YANDEX as $category) {
            $xml = XmlParser::load($category);
            $news = $xml->parse([
                'source' => ['uses' => 'channel.title'],
                'items' => ['uses' => 'channel.item[title,description]']
            ]);

            preg_match('/\s(.*)$/', $news['source'], $match);
            $category = $match[1];

            $news['items'] = array_map(function ($item) use ($category) {
                $item['category'] = $category;
                return $item;
            }, $news['items']);

            $result['items'] = array_merge($result['items'], $news['items']);
        }

        return $this->saveParseNews($result);
    }

    public function parseLentaNews()
    {
        $xml = XmlParser::load($this::LENTA);
        $news = $xml->parse([
            'source' => ['uses' => 'channel.title'],
            'items' => ['uses' => 'channel.item[title,description,category]']
        ]);

        return $this->saveParseNews($news);
    }

    private function callbackCategory($item): array
    {
        return [
            'name' => $item['category'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function callbackNews($item): array
    {
        return [
            'title' => $item['title'],
            'description' => $item['description'],
            'author_id' => Auth::id(),
            'source' => $this->source,
            'category_id' => $this->categories->where('name', $item['category'])->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'published'
        ];
    }

    private function multiSaveInDatabase($data, $table)
    {
        DB::table($table)->insertOrIgnore($data);
    }
}
