<?php

/*
 * This file is part of questocat/laravel-rally package.
 *
 * (c) questocat <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    /*
     * Table name of followable relations.
     */
    'followable_table' => 'followables',

    /*
     * Table name of follower table.
     */
    'follower_table' => 'users',

    /*
     * Prefix of many-to-many Poly relation fields.
     */
    'followable_prefix' => 'followable',

    /*
     * Prefix of follower field
     */
    'follower_prefix' => 'follower',

    /*
     * Model class name of follower.
     */
    'follower_model' => 'App\User',
];
