<?php


namespace App\Models;


class Data
{
    public static function getUsers(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Alex',
                'login' => 'alex215',
                'password' => 'qwegofg1o2fdw8234sdwfq3rfq1',
                'age' => 21
            ],
            [
                'id' => 2,
                'name' => 'Mike',
                'login' => 'xmikex',
                'password' => 'qfqfgqyt12twrghwr6545567yuj6',
                'age' => 25
            ],
            [
                'id' => 3,
                'name' => 'John',
                'login' => 'johnny',
                'password' => 'w5trgfhrt6767578hj5j5wefgwwshw',
                'age' => 31
            ],
            [
                'id' => 4,
                'name' => 'Bill',
                'login' => 'bill07',
                'password' => 'sfghw4uyghe56u3usfgwe45wqtwhyhw',
                'age' => 18
            ],
            [
                'id' => 5,
                'name' => 'Sandra',
                'login' => 'lucky',
                'password' => 'wa5hhw3htwthw45hwhtsrhw4hw4hgw45',
                'age' => 24
            ],
            [
                'id' => 6,
                'name' => 'Monika',
                'login' => 'onelove',
                'password' => 'bwthwthbsrgfhbw45thwhsrghw4hwghhg',
                'age' => 19
            ]
        ];
    }

    public static function getMenu(): array
    {
        return [
            [
                'name' => 'главная',
                'path' => '/'
            ],
            [
                'name' => 'новости',
                'path' => '/news'
            ],
            [
                'name' => 'категории',
                'path' => '/news/categories'
            ],
            [
                'name' => 'добавить новость',
                'path' => '/news/add'
            ],
            [
                'name' => 'о нас',
                'path' => '/about'
            ],
            [
                'name' => 'вход',
                'path' => '/auth'
            ]
        ];
    }

    public static function getCategories(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'политика',
                'path' => '/news/category/1'
            ],
            [
                'id' => 2,
                'name' => 'спорт',
                'path' => '/news/category/2'
            ],
            [
                'id' => 3,
                'name' => 'культура',
                'path' => '/news/category/3'
            ],
            [
                'id' => 4,
                'name' => 'погода',
                'path' => '/news/category/4'
            ]
        ];
    }

    public static function GetAllNews(): array
    {
        $news = [
            [
                'id' => 1,
                'category_id' => 2,
                'date' => '13.12.2020 18:00',
                'title' => 'Завершился кубок мира по биатлону',
                'text' => 'Вчера завершился кубок мира по биатлону, наши биатлонисты заняли второе мето в общем зачете, уступив только команде из норвегии',
                'author_id' => 2
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'date' => '13.12.2020 19:35',
                'title' => 'Саммит большой двадцатки',
                'text' => 'Завтра в Брюсселе состоится саммит большой двадцатки, лидеры стран обсудят ситуацию с пандемией и утвердят список мер для востановления экономики.',
                'author_id' => 1
            ],
            [
                'id' => 3,
                'category_id' => 3,
                'date' => '14.12.2020 10:15',
                'title' => 'В театре на таганке поставят новый спектакль',
                'text' => 'В благодарность врачам за их работу уже в эту субботу пройдет премьера нового спектакля про людей на перевдовой борьбы с коронавирусом.',
                'author_id' => 2
            ],
            [
                'id' => 4,
                'category_id' => 1,
                'date' => '14.12.2020 11:00',
                'title' => 'Названы сроки окончания строительства газопровода северный поток',
                'text' => 'На заседании комиссии были определены сроки окончания строительства северного потока. Как говориться в заявлении сроки сдачи объекта установлены первым кварталом 2021 года.',
                'author_id' => 4
            ]
        ];

        $arrNews = array_map('self::changeIdToText', $news);

        return array_reverse($arrNews);
    }

    public static function getUser($id): array
    {
        $users = self::getUsers();

        return self::searchInArray($users, $id);
    }

    public static function getNews($id): array
    {
        $news = self::getAllNews();

        return self::searchInArray($news, $id);
    }

    public static function getCategory($id)
    {
        $categories = self::getCategories();

        return self::searchInArray($categories, $id);
    }

    public static function getLastThreeNews()
    {
        return array_slice(self::GetAllNews(), -0, 3);

    }

    public static function getNewsInCategory($id)
    {
        return array_filter(self::GetAllNews(), function($news) use ($id) {
           return $news['category_id']['id'] === $id;
        });
    }

    private static function changeIdToText($arr)
    {
        $arr['author_id'] = self::getUser($arr['author_id'])['name'];
        $arr['category_id'] = self::getCategory($arr['category_id']);

        return $arr;
    }

    private static function searchInArray($arr, $search)
    {
        foreach ($arr as $value) {
            if ($value['id'] == $search) {
                return $value;
            }
        }
        return null;
    }
}
