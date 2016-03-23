<?php

return array(
    "queries" => array(
        array(
            "text" => "сильпо",
            "output" => array(
                "max_points" => 10,
                "min_points" => 0,
                "max_to_min_overflow" => 2,
                "order_matters" => true,
                "items_weight" => array(
                    "max_points" => 10,
                    "min_points" => 0
                ),
                "items" => array(
                    array("id" => 1, "max_points" => 50, "min_points" => 5, "max_to_min_displacement" => 1),
                    array("id" => 2, "max_points" => 50, "min_points" => 5, "max_to_min_displacement" => 1),
                    array("id" => 3, "max_points" => 50, "min_points" => 5, "max_to_min_displacement" => 2),
                    array("id" => 4, "max_points" => 50, "min_points" => 5, "max_to_min_displacement" => 1),
                    array("id" => 5, "max_points" => 50, "min_points" => 5, "max_to_min_displacement" => 1),
                )
            ),
            "accepted_minimum" => 250,
            "accepted_maximum" => 260
        ),
        array(
            "text" => "проспект Победы",
            "output" => array(
                "max_points" => 10,
                "min_points" => 0,
                "max_to_min_overflow" => 1,
                "order_matters" => true,
                "items_weight" => array(
                    "max_points" => 10,
                    "min_points" => 0
                ),
                "items" => array(
                    array("id" => 2, "max_points" => 50, "min_points" => 5, "max_to_min_displacement" => 1),
                )
            ),
            "accepted_minimum" => 50,
            "accepted_maximum" => 60
        ),
    )

);