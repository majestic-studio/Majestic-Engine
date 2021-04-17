<?php

$tpl = new Theme;
$tpl->dir = 'Content/Themes/Frontend/default/';
$tpl->load_template('404.mjt');

# Структура шаблона

# Вывод результата
$tpl->result('page404');

# Очистка переменных
$tpl->global_clear();
