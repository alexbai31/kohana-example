<?php

 return array(
            "email" => array(
                       "not_empty" => "Введите ваш email пожалуйста",
                       "email" => "Введите валидный e-mail",
                       "Buyer::_is_unique" => "Пользователь с этим почтовым адресом уже зарегистрирован в системе"
            ),
            "password" => array(
                       "not_empty" => "Введите пароль"
            ),
            "username" => array(
                       "not_empty" => "Введите имя пользователя"
            )
 );

 