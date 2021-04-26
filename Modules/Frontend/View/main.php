<?php

use Core\Service\Client\Client;

$themes = 'Content/Themes/Frontend/default/';
$tpl = new Theme;
$tpl->dir = $themes;
$tpl->load_template('layout.mjt');

# Структура шаблона

$tpl->set('{lang}', Client::language());
$tpl->set('{content}', Layout::content());
$tpl->set('{header}', $tpl->sub_load_template('header.mjt'));
$tpl->set('{DIR}', $themes);

$tpl->set('{title}', $data['title']);
$tpl->set('{description}', $data['description']);
$tpl->set('{keywords}', $data['keywords']);

# Вывод результата
$tpl->result('main');

# Очистка переменных
$tpl->global_clear();
