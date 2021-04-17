<?php

$tpl = new Theme;
$tpl->dir = 'Content/Themes/Frontend/default/';
$tpl->load_template('dashboard.mjt');

# Структура шаблона

# Вывод результата
$tpl->result('dashboard');

# Очистка переменных
$tpl->global_clear();
