<?php
/**
 * 路由注册
 *
 * 以下代码为了尽量简单，没有使用路由分组
 * 实际上，使用路由分组可以简化定义
 * 并在一定程度上提高路由匹配的效率
 */

//Sample
Route::get('api/:version/sample/:key', 'api/:version.Sample/getSample');
Route::post('api/:version/sample/test3', 'api/:version.Sample/test3');

//Miss 404
//Miss 路由开启后，默认的普通模式也将无法访问
//Route::miss('api/v1.Miss/miss');

//Banner
Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');

//Theme
// 如果要使用分组路由，建议使用闭包的方式，数组的方式不允许有同名的key
//Route::group('api/:version/theme',[
//    '' => ['api/:version.Theme/getThemes'],
//    ':t_id/product/:p_id' => ['api/:version.Theme/addThemeProduct'],
//    ':t_id/product/:p_id' => ['api/:version.Theme/addThemeProduct']
//]);

Route::group('api/:version/theme', function () {
    Route::get('/:id', 'api/:version.Theme/getComplexOne');
    Route::get('', 'api/:version.Theme/getSimpleList');
    Route::post(':t_id/product/:p_id', 'api/:version.Theme/addThemeProduct');
    Route::delete(':t_id/product/:p_id', 'api/:version.Theme/deleteThemeProduct');
});
Route::group('api/:version/brand', function () {
    Route::get('/by_service/paginate', 'api/:version.Brand/getBrandService');
    Route::get('/by_service', 'api/:version.Brand/getAllInService');

});
Route::group('api/:version/servicecategory', function () {
    Route::get('/:id', 'api/:version.servicecategory/getServiceCategory', [], ['id' => '\d+']);
    Route::get('/:id/services', 'api/:version.servicecategory/getCategory', [], ['id' => '\d+']);
    Route::get('/all', 'api/:version.servicecategory/getAllCategories');
});

Route::group('api/:version/service', function () {
    Route::get('/:id/provider/by_type', 'api/:version.Service/getMerchants');
    Route::get('/servicetype/by_service', 'api/:version.Service/getServiceTypesByService');
    Route::get('/by_servicename', 'api/:version.Service/getMerchantsByServiceName');
    Route::get('/by_category', 'api/:version.Service/getAllInCategory');
    //ServiceOrder
    Route::post('/order', 'api/:version.ServiceOrder/placeOrder');
    Route::get('/order/:id', 'api/:version.ServiceOrder/getDetail', [], ['id' => '\d+']);
    Route::put('/order/delivery', 'api/:version.ServiceOrder/delivery');
    Route::delete('/order/cancle', 'api/:version.ServiceOrder/cancleOrder');
    Route::put('/order/update', 'api/:version.ServiceOrder/refreshOrder');
    Route::get('/order/by_user', 'api/:version.ServiceOrder/getSummaryByUser');
    Route::get('/order/paginate', 'api/:version.ServiceOrder/getSummary');

    Route::get('/:id', 'api/:version.Service/getOne');
    Route::get('/:id/engineers', 'api/:version.Service/getEngineers');
    Route::get('', 'api/:version.Service/getSimpleList');
    Route::post(':t_id/product/:p_id', 'api/:version.Service/addServiceProduct');
    Route::delete(':t_id/product/:p_id', 'api/:version.Service/deleteServiceProduct');

});

Route::group('api/:version/merchant', function () {
    Route::post('', 'api/:version.Merchant/createOne');
    Route::delete('/:id', 'api/:version.Merchant/deleteOne');
    Route::get('/by_category/paginate', 'api/:version.Merchant/getByCategory');
    Route::get('/by_category', 'api/:version.Merchant/getAllInCategory');
    Route::get('/services/:id', 'api/:version.Merchant/getServices', [], ['id' => '\d+']);
    Route::get('/:id', 'api/:version.Merchant/getOne', [], ['id' => '\d+']);
    Route::get('/recent', 'api/:version.Merchant/getRecent');
});

Route::group('api/:version/user', function () {
    Route::post('', 'api/:version.User/createOne');
    Route::get('/info', 'api/:version.User/getUserInfo');
    Route::delete('/:id', 'api/:version.User/deleteOne');
    Route::get('/by_category/paginate', 'api/:version.User/getByCategory');
    Route::get('/by_category', 'api/:version.User/getAllInCategory');
    Route::get('/by_service', 'api/:version.User/getByService');
    Route::get('/:id', 'api/:version.User/getOne', [], ['id' => '\d+']);
    Route::get('/recent', 'api/:version.User/getRecent');
});

//Route::get('api/:version/theme', 'api/:version.Theme/getThemes');
//Route::post('api/:version/theme/:t_id/product/:p_id', 'api/:version.Theme/addThemeProduct');
//Route::delete('api/:version/theme/:t_id/product/:p_id', 'api/:version.Theme/deleteThemeProduct');

//Product
Route::post('api/:version/product', 'api/:version.Product/createOne');
Route::delete('api/:version/product/:id', 'api/:version.Product/deleteOne');
Route::get('api/:version/product/by_category/paginate', 'api/:version.Product/getByCategory');
Route::get('api/:version/product/by_category', 'api/:version.Product/getAllInCategory');
Route::get('api/:version/product/:id', 'api/:version.Product/getOne', [], ['id' => '\d+']);
Route::get('api/:version/product/recent', 'api/:version.Product/getRecent');

//Category
// Route::get('api/:version/category', 'api/:version.Category/getCategories');
// 正则匹配区别id和all，注意d后面的+号，没有+号将只能匹配个位数
Route::get('api/:version/category/:id', 'api/:version.Category/getCategory', [], ['id' => '\d+']);
//Route::get('api/:version/category/:id/products', 'api/:version.Category/getCategory',[], ['id'=>'\d+']);
Route::get('api/:version/category/all', 'api/:version.Category/getAllCategories');

//Token
Route::post('api/:version/token/user', 'api/:version.Token/getToken');
Route::post('api/:version/token/app', 'api/:version.Token/getAppToken');

//File
Route::post('api/:version/file/upload', 'api/:version.File/upload');

Route::post('api/:version/token/app', 'api/:version.Token/getAppToken');
Route::post('api/:version/token/verify', 'api/:version.Token/verifyToken');

//Address
Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');
Route::get('api/:version/address', 'api/:version.Address/getUserAddress');

//Order
Route::post('api/:version/order', 'api/:version.Order/placeOrder');
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail', [], ['id' => '\d+']);
Route::put('api/:version/order/delivery', 'api/:version.Order/delivery');

//不想把所有查询都写在一起，所以增加by_user，很好的REST与RESTFul的区别
Route::get('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');
Route::get('api/:version/order/paginate', 'api/:version.Order/getSummary');

//Pay
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify', 'api/:version.Pay/receiveNotify');
Route::post('api/:version/pay/re_notify', 'api/:version.Pay/redirectNotify');
Route::post('api/:version/pay/concurrency', 'api/:version.Pay/notifyConcurrency');

//Message
Route::post('api/:version/message/delivery', 'api/:version.Message/sendDeliveryMsg');

//Login
Route::post('api/:version/login', 'api/:version.Account/doLogin');

//Register
Route::post('api/:version/register', 'api/:version.Account/register');

//sms
Route::post('api/:version/getTimestamp', 'api/:version.Account/getServerTimestamp');
Route::post('api/:version/getVerifyCode', 'api/:version.Account/getVerifyCode');
Route::post('api/:version/getDoc', 'api/:version.Doc/getDoc');

//return [
//        ':version/banner/[:location]' => 'api/:version.Banner/getBanner'
//];

//Route::miss(function () {
//    return [
//        'msg' => 'your required resource are not found',
//        'error_code' => 10001
//    ];
//});
