<?php

use Core\Service\Client\Client;

$tpl = new Theme;
$tpl->dir = 'Content/Themes/Frontend/default/';
$tpl->load_template('layout.mjt');

# Структура шаблона

$tpl->set('{lang}', Client::language());
$tpl->set('{content}', Layout::content());
$tpl->set('{header}', $tpl->sub_load_template('header.mjt'));
# Вывод результата
$tpl->result('main');

# Очистка переменных
$tpl->global_clear();
