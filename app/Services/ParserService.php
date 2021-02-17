<?php


namespace App\Services;


use App\Jobs\NewsParser;

class ParserService
{
    const YANDEX = [
        'Авто'          => 'https://news.yandex.ru/auto.rss',
        'Армия'         => 'https://news.yandex.ru/army.rss',
        'Технологии'    => 'https://news.yandex.ru/gadgets.rss',
        'Главное'       => 'https://news.yandex.ru/index.rss',
        'Единоборства'  => 'https://news.yandex.ru/martial_arts.rss',
        'ЖКХ'           => 'https://news.yandex.ru/communal.rss',
        'Здоровье'      => 'https://news.yandex.ru/health.rss',
        'Игры'          => 'https://news.yandex.ru/games.rss',
        'Интернет'      => 'https://news.yandex.ru/internet.rss',
        'Кибер спорт'   => 'https://news.yandex.ru/cyber_sport.rss',
        'Кино'          => 'https://news.yandex.ru/movies.rss',
        'Космос'        => 'https://news.yandex.ru/cosmos.rss',
        'Культура'      => 'https://news.yandex.ru/culture.rss',
        'Музыка'        => 'https://news.yandex.ru/music.rss'
    ];

    public function parse(): \Illuminate\Http\RedirectResponse
    {
        foreach ($this::YANDEX as $category => $link) {
            NewsParser::dispatch($category, $link);
        }

        return back();
    }
}
