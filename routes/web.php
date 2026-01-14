<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*Route::get('/', function () {
    return view('frontend.index');
});*/

Route::get('/', [FrontendController::class, 'index']);
Route::get('/about-us', [FrontendController::class, 'about']);

/*Blog Routers*/
Route::get('/blogs', [FrontendController::class, 'blogs']);
Route::get('/post/{slog?}', [FrontendController::class, 'postArticle']);

/*facilities Routers*/
Route::get('/facilities', [FrontendController::class, 'facilities']);
Route::get('/facilities/{type}', [FrontendController::class, 'facilities']);
Route::get('/facility/{slog}', [FrontendController::class, 'facilityDetails']);

/*Events Routers*/
Route::get('/events', [FrontendController::class, 'events']);
Route::get('/event/{slog?}', [FrontendController::class, 'eventDetails']);

Route::get('/contact-us', [FrontendController::class, 'contact']);

Route::get('/tennis', [FrontendController::class, 'tennis']);
Route::get('/billiards', [FrontendController::class, 'billiards']);
Route::get('/functional-training', [FrontendController::class, 'functionalTraining']);
Route::get('/table-tennis', [FrontendController::class, 'tableTennis']);
Route::get('/card-room', [FrontendController::class, 'cardRoom']);
Route::get('/childrens-play-area', [FrontendController::class, 'childrensPlayArea']);
Route::get('/wodehouse-chambers', [FrontendController::class, 'wodehouseChambers']);
Route::get('/wodehouse-lounge', [FrontendController::class, 'wodehouseLounge']);
Route::get('/wodehouse-courtyard', [FrontendController::class, 'wodehouseCourtyard']);
Route::get('/dining-bar', [FrontendController::class, 'diningBar']);
Route::get('/gymkhana-affiliation', [FrontendController::class, 'gymkhanaAffiliation']);

/*Website signup/login pages*/
Route::get('/login', [FrontendController::class, 'login']);
Route::post('/login', [FrontendController::class, 'loginPost'])->name('login');
Route::get('/login-otp', [FrontendController::class, 'loginOtp']);
Route::post('/login-otp', [FrontendController::class, 'loginOtpPost'])->name('loginOtp');
Route::get('/signup', [FrontendController::class, 'signup']);
Route::post('/signup', [FrontendController::class, 'signupPost'])->name('signup');
Route::get('/otp', [FrontendController::class, 'otp']);
Route::post('/verify-otp', [FrontendController::class, 'verifyOtp'])->name('otp');
Route::get('/forgot-password', [FrontendController::class, 'forgotPassword']);
Route::post('/forgot-password', [FrontendController::class, 'forgotPasswordPost'])->name('forgotPassword');
Route::get('/create-new-password', [FrontendController::class, 'createNewPassword']);
Route::post('/create-new-password', [FrontendController::class, 'createNewPasswordPost']);

// User Panel (Default Guard: web)
Route::middleware('auth:member')->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
    Route::get('/member/agm', [MemberController::class, 'agm'])->name('member.agm');
    Route::get('/member/subscriptions', [MemberController::class, 'subscriptions'])->name('member.subscriptions');
    Route::get('/member/payment_history', [MemberController::class, 'payment_history'])->name('member.payment_history');
    Route::get('/member/events', [MemberController::class, 'events'])->name('member.events');
    Route::get('/member/events/{id}', [MemberController::class, 'eventDetails'])->name('member.events.details');
    Route::post('/member/events/{id}/register', [MemberController::class, 'registerEvent'])->name('member.events.register');
    Route::get('/member/menu', [MemberController::class, 'menu'])->name('member.menu');
    Route::get('/member/food/cart', [MemberController::class, 'cart'])->name('member.food.cart');
    Route::post('/member/cart/add', [MemberController::class, 'add'])->name('member.food.cart.add');

    Route::post('/member/cart/update', [MemberController::class, 'update'])
        ->name('member.food.cart.update');

    Route::post('/member/cart/remove', [MemberController::class, 'remove'])
        ->name('member.food.cart.remove');

    Route::get('/member/food/checkout', [MemberController::class, 'checkout'])
        ->name('member.food.checkout');

    Route::post('/member/food/place-order', [MemberController::class, 'placeOrder'])
        ->name('member.food.placeOrder');

    Route::get('/member/food/order/{id}', [MemberController::class, 'orderDetails'])
        ->name('member.food.order.details');


    Route::get('/member/facility_availability', [MemberController::class, 'facility_availability'])->name('member.facility_availability');
    Route::get('/member/get-facility-days/{id}', [MemberController::class, 'getFacilityDays'])->name('get.facility.days');
    Route::get('/member/get-available-slots', [MemberController::class, 'getAvailableSlots'])->name('get.slots');
    Route::post('/member/book-facility', [MemberController::class, 'storeBooking'])->name('member.book.facility');
    Route::get('/member/booking-summary/{id}', [MemberController::class, 'bookingSummary'])->name('member.booking.summary');

    Route::get('/member/invoice/{id}', [MemberController::class, 'viewInvoice'])
        ->name('invoice.view')
        ->middleware('auth');

    Route::post('/member/booking/cancel', [MemberController::class, 'cancelBooking'])
        ->name('member.booking.cancel');

    Route::get('/member/profile', [MemberController::class, 'profile'])->name('member.profile');
    Route::post('/member/profile', [MemberController::class, 'updateProfile'])->name('member.profile.update');
    Route::get('/member/change_password', [MemberController::class, 'change_password'])->name('member.change_password');
    Route::post('/member/change_password', [MemberController::class, 'changePasswordPost'])->name('member.change_password.post');
    Route::get('/member/logout', [MemberController::class, 'logout']);
});

/*Admin Login/Register Details*/
Route::get('/admin/', [AuthController::class, 'login'])->name('admin.login');
Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'loginPost'])->name('admin.login');
Route::get('/admin/register', [AuthController::class, 'register'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'registerPost'])->name('admin.register.post');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // POSTS
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::get('/admin/manage-post/{id?}', [AdminController::class, 'managePost'])->name('admin.managePost');
    Route::post('/admin/manage-post', [AdminController::class, 'submitManagePost'])->name('admin.managePost.submit');
    Route::delete('/admin/delete-post/{id}', [AdminController::class, 'deletePost']);
    Route::post('/admin/toggle-post-status/{id}', [AdminController::class, 'togglePostStatus']);

    // POST CATEGORIES
    Route::get('/admin/post-category', [AdminController::class, 'postCategory'])->name('admin.postCategory');
    Route::get('/admin/manage-post-category/{id?}', [AdminController::class, 'managePostCategory'])->name('admin.managePostCategory');
    Route::post('/admin/manage-post-category', [AdminController::class, 'submitManagePostCategory'])->name('admin.managePostCategory.submit');
    Route::delete('/admin/delete-category/{id}', [AdminController::class, 'deleteCategory']);
    Route::post('/admin/toggle-category-status/{id}', [AdminController::class, 'toggleCategoryStatus']);


    // Facilities
    Route::get('/admin/facilities', [AdminController::class, 'facilities'])->name('admin.facilities');
    Route::get('/admin/manage-facility/{id?}', [AdminController::class, 'manageFacility'])->name('admin.manageFacility');
    Route::post('/admin/manage-facility', [AdminController::class, 'submitManageFacility'])->name('admin.submitManageFacility');
    Route::delete('/admin/delete-facility/{id}', [AdminController::class, 'deleteFacility'])->name('admin.deleteFacility');
    Route::post('/admin/toggle-facility-status/{id}', [AdminController::class, 'toggleFacilityStatus'])->name('admin.toggleFacilityStatus');

    Route::get('/admin/availability', [AdminController::class, 'availabilityIndex'])->name('admin.facilityAvailability');
    Route::post('/admin/save-availability', [AdminController::class, 'saveAvailability'])->name('admin.saveAvailability');
    Route::delete('/admin/delete-availability/{id}', [AdminController::class, 'deleteAvailability'])->name('admin.deleteAvailability');

    // Facility Categories
    Route::get('/admin/facility-category', [AdminController::class, 'facilityCategory'])->name('admin.facilityCategory');
    Route::get('/admin/manage-facility-category/{id?}', [AdminController::class, 'manageFacilityCategory'])->name('admin.manageFacilityCategory');
    Route::post('/admin/manage-facility-category', [AdminController::class, 'submitManageFacilityCategory'])->name('admin.submitManageFacilityCategory');
    Route::delete('/admin/delete-facility-category/{id}', [AdminController::class, 'deleteFacilityCategory'])->name('admin.deleteFacilityCategory');
    Route::post('/admin/toggle-facility-category-status/{id}', [AdminController::class, 'toggleFacilityCategoryStatus'])->name('admin.toggleFacilityCategoryStatus');


    // Facility Categories
    Route::get('/admin/food-beverage-category', [AdminController::class, 'foodCategory'])
        ->name('admin.foodCategory');

    // Create (This fixes your error)
    Route::get('/admin/manage-food-beverage-category', [AdminController::class, 'manageFoodCategory'])
        ->name('admin.food-category.create');

    // Edit
    Route::get('/admin/manage-food-beverage-category/{id}', [AdminController::class, 'manageFoodCategory'])
        ->name('admin.food-category.edit');

    // Submit (Store/Update)
    Route::post('/admin/manage-food-beverage-category', [AdminController::class, 'submitManageFoodCategory'])
        ->name('admin.submitManageFoodCategory');

    // AJAX Actions
    Route::delete('/admin/food-category/delete/{id}', [AdminController::class, 'deleteFoodCategory'])
        ->name('admin.deleteFoodCategory');
    Route::post('/admin/food-category/toggle-status/{id}', [AdminController::class, 'toggleFoodCategoryStatus'])
        ->name('admin.toggleFoodCategoryStatus');

    // Food Items List
    Route::get('/admin/food-beverage', [AdminController::class, 'foodItem'])->name('admin.foodItem');

    // Manage Items (Create/Edit)
    Route::get('/admin/manage-food-item/{id?}', [AdminController::class, 'manageFoodItem'])->name('admin.manageFoodItem');
    Route::post('/admin/submit-food-item', [AdminController::class, 'submitFoodItem'])->name('admin.submitFoodItem');

    // Actions
    Route::delete('/admin/delete-food-item/{id}', [AdminController::class, 'deleteFoodItem'])->name('admin.deleteFoodItem');
    Route::post('/admin/toggle-food-item-status/{id}', [AdminController::class, 'toggleFoodItemStatus'])->name('admin.toggleFoodItemStatus');



    // Event list
    Route::get('/admin/events', [AdminController::class, 'events'])->name('admin.events');
    Route::get('/admin/manage-event/{id?}', [AdminController::class, 'manageEvent'])->name('admin.manageEvent');
    Route::post('/admin/manage-event', [AdminController::class, 'submitManageEvent'])->name('admin.manageEvent.submit');

    // Event Category list
    Route::get('/admin/event-category', [AdminController::class, 'eventCategory'])->name('admin.eventCategory');
    Route::get('/admin/manage-event-category/{id?}', [AdminController::class, 'manageEventCategory'])->name('admin.manageEventCategory');
    Route::post('/admin/manage-event-category', [AdminController::class, 'submitManageEventCategory'])->name('admin.manageEventCategory.submit');
    Route::delete('/admin/delete-event/{id}', [AdminController::class, 'deleteEvent'])->name('admin.deleteEvent');
    Route::post('/admin/toggle-event-status/{id}', [AdminController::class, 'toggleEventStatus'])->name('admin.toggleEventStatus');


    // USERS
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::get('/admin/members', [AdminController::class, 'members']);
    Route::get('/admin/staff', [AdminController::class, 'staff']);

    Route::get('/admin/manage-user/{id?}', [AdminController::class, 'manageUser'])->name('admin.manageUser');
    Route::post('/admin/manage-user', [AdminController::class, 'submitManageUser'])->name('admin.submitManageUser');

    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser']);
    Route::post('/admin/toggle-user-status/{id}', [AdminController::class, 'toggleUserStatus']);


    //...
    Route::get('/admin/agm', [AdminController::class, 'agm'])->name('admin.agm');
    Route::get('/admin/subscriptions', [AdminController::class, 'subscriptions'])->name('admin.subscriptions');
    Route::get('/admin/payment_history', [AdminController::class, 'payment_history'])->name('admin.payment_history');
    Route::get('/admin/events', [AdminController::class, 'events'])->name('admin.events');
    Route::get('/admin/menu', [AdminController::class, 'menu'])->name('admin.menu');
    Route::get('/admin/facility_availability', [AdminController::class, 'facility_availability'])->name('admin.facility_availability');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/change_password', [AdminController::class, 'change_password'])->name('admin.change_password');
    Route::get('/admin/logout', [AdminController::class, 'logout']);

    // Admin Food Orders
    Route::get('/admin/food-orders', [AdminController::class, 'foodOrders'])->name('admin.foodOrders');
    Route::post('/admin/food-order/update/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.foodOrder.update');

    // Admin Event Registrations
    Route::get('/admin/event-registrations', [AdminController::class, 'eventRegistrations'])->name('admin.eventRegistrations');

    // Admin Facility Bookings
    Route::get('/admin/facility-bookings', [AdminController::class, 'facilityBookings'])->name('admin.facilityBookings');
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'DONE';
});