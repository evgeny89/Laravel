<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Orchestra\Parser\Xml\Facade as XmlParser;

class NewsParser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $link;

    /**
     * @var Category|Model
     */
    protected $category;

    /**
     * Create a new job instance.
     *
     * @param $name
     * @param $link
     */
    public function __construct($name, $link)
    {
        $this->link = $link;
        $this->category = Category::firstOrCreate(['name' => $name]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $xml = XmlParser::load($this->link);
        $news = $xml->parse([
            'items' => ['uses' => 'channel.item[title,description]']
        ]);

        $newsArray = array_map([$this, 'callbackNews'], $news['items']);

        $this->multiSaveInDatabase($newsArray, 'news');
    }

    private function callbackNews($item): array
    {
        return [
            'title' => $item['title'],
            'description' => $item['description'],
            'source' => 'yandex.ru',
            'category_id' => $this->category->id,
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
