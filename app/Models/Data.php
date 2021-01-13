<?php


namespace App\Models;


class Data
{
    public function getUsers(): array
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

    public function getCategories(): array
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

    public function GetAllNews(): array
    {
        return [
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
    }
}
