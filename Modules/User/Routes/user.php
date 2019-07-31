<?php

Route::domain('portal.huizhonglianhe.com')->group(function () {
// 登录
Route::post('/sign-in', 'User/LoginController@login');
});
