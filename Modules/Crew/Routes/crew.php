<?php

Route::domain('oa.huizhonglianhe.com')->group(function () {
// 后台登录
Route::post('/sign-in', 'Crew/LoginController@crewLogin');
});
