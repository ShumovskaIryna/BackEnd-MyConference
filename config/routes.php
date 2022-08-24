<?php

return [
    // TODO: use post, get, method not method in route.
    //Path to controllers
    'api/v1/conferences' => 'ConferencesController@indexAction',
    'api/v1/conferences/add' => 'ConferencesController@addAction',
    'api/v1/conferences/update/([0-9]+)' => 'ConferencesController@updateAction/$1',
    'api/v1/conferences/delete/([0-9]+)' => 'ConferencesController@deleteAction/$1',
    'api/v1/conferences/get-by-id/([0-9]+)' => 'ConferencesController@getOneById/$1',

];