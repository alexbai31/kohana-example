<?php defined('SYSPATH') or die('No direct script access.');
?>
<html>
<head>
    <title><?= $title ?></title>
    <? foreach ($css as $style) { ?>
    <link rel="stylesheet" type="text/css" href="<?= $css_path . $style ?>" />
    <? } ?>
    <? foreach ($js as $script) { ?>
    <script type="text/javascript" src="<?= $js_path . $script ?>"></script>
    <? } ?>
    <? foreach ($meta as $tag => $value) { ?>
    <meta name="<?= $tag ?>" content="<?= $value ?>">
    <? } ?>
    <script type="text/javascript">
    var url_base = "<?=URL::base(TRUE, TRUE);?>";
    </script>
</head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="<?= URL::base(TRUE, TRUE) ?>">
                    Tovaroved
                </a>
                <ul class="nav menu">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            Магазины
                            <b class="caret"></b>
                            &nbsp;
                        </a>
                        <ul role="menu" area-labelledby="dLabel" class="dropdown-menu">
                            <li><a href="<?=URL::base(TRUE, TRUE);?>store">Магазины</a></li>                                    
                            <?OUT::_('<li><a href="' . URL::base(TRUE, TRUE) . 'store/add">Добавить магазин</a></li>', 'add_store');?>    
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            Товары
                            <b class="caret"></b>
                            &nbsp;
                        </a>
                        <ul role="menu" area-labelledby="dLabel" class="dropdown-menu">
                            <li><a href="<?=URL::base(TRUE, TRUE);?>goods">Товары</a></li>                                    
                            <?OUT::_('<li><a href="' . URL::base(TRUE, TRUE) . 'goods/add">Добавить товар</a></li>', 'add_goods');?>     
                        </ul>
                    </li>
                    <li class="dropdown">
                     <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                        Цены
                        <b class="caret"></b>
                        &nbsp;
                    </a>
                    <ul role="menu" area-labelledby="dLabel" class="dropdown-menu">
                        <?OUT::_('<li><a href="' . URL::base(TRUE, TRUE) . 'price/add">Добавить цену</a></li>', 'add_prices');?>    
                    </ul>
                </li>
            </ul>
            <ul class="nav pull-right">
                <? if (!$logged): ?>
                <li>
                   <form action="<?= URL::base(TRUE, TRUE) ?>buyer/login" method="POST" class="navbar-form">
                       <input class="input-small" name="buyer_email" type="text" placeholder="Email">
                       <input class="input-small" name="buyer_password" type="password"  placeholder="Password">
                       <button type="submit" class="btn">Войти</button>
                   </form>
               </li>
           <? else: ?>
           <li> <a href="<?=URL::base(TRUE, TRUE)?>buyer/profile/<?=Session::instance()->get('id')?>">Hello, <?= Session::instance()->get("username"); ?></a></li>
           <li> <a href="<?= URL::base(TRUE, TRUE); ?>buyer/logout">Выйти</a></li>
       <? endif; ?>
   </ul>
   <? if (!$logged): ?>
   <ul class="nav pull-right">
       <li><a href="<?= URL::base(TRUE, TRUE) ?>buyer/create">Зарегистрироваться</a></li>
   </ul>
<? endif; ?>
</div>
</div>
</div>
<div class="container page">
    <? foreach (Message::get_errors() as $error) { ?>
    <div class="alert alert-error">
       <?= $error ?>
   </div>
   <? } ?>

   <? foreach (Message::get_notices() as $notice) { ?>
   <div class="alert alert-info">
       <?= $notice ?>
   </div>
   <? } ?>
   <?= $content ?>
</div>
</body>
</html>