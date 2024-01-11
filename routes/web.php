<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CssController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminMemberPlanController;
use App\Http\Controllers\BasicUiController;
use App\Http\Controllers\AdvanceUiController;
use App\Http\Controllers\ExtraComponentsController;
use App\Http\Controllers\BasicTableController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\ProfileTypeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\LoginController as adminLoginController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\MessagesController;

/**

 * front routes

 */

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RequestController;

use App\Http\Controllers\LikeProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\MatchmakingProfileController;


/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



Route::get('admin/login', [adminLoginController::class, 'showLoginForm']);

Auth::routes(['verify' => true]);

 // Authentication Route
 Route::get('/login', [LoginController::class, 'login'])->name('login');
 Route::post('/member-login', [LoginController::class, 'memberLogin'])->name('member-login');

 //Forget password
 Route::get('/forgot-password', [ForgotPasswordController::class, 'forgot_password'])->name('forgot-password');
 Route::post('/forgot-password-form', [ForgotPasswordController::class, 'forgot_password_request'])->name('forgot-password-form');
 Route::get('/password-reset/{token}', [ForgotPasswordController::class, 'password_reset_email'])->name('password-reset');
 Route::post('create-password',[ForgotPasswordController::class,'create_new_password'])->name('create-password');

 //Signup Route
 Route::get('/signup/{id?}', [RegistrationController::class, 'signup'])->name('signup');
 Route::post('/signup', [RegistrationController::class, 'create_user'])->name('registration');
 Route::get('/emailcheck', [RegistrationController::class, 'email_check'])->name('emailcheck');
 Route::get('/usernamecheck', [RegistrationController::class, 'usernamecheck'])->name('usernamecheck');

 // Misc Route
 Route::get('/page-404', [MiscController::class, 'page404']);
 Route::get('/page-maintenance', [MiscController::class, 'maintenancePage']);
 Route::get('/page-500', [MiscController::class, 'page500']);

// term and condition
Route::get('/termscondition', [HomeController::class, 'termscondition']);

//Google
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

//Facebook
Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

//LinkedIn
Route::get('/login/linkedin', [App\Http\Controllers\Auth\LoginController::class, 'redirectToLinkedIn'])->name('login.linkedin');
Route::get('/login/linkedin/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleLinkedInCallback']);

//Github
Route::get('/login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('/login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);

Route::get('/', [HomeController::class, 'landing_page'])->name('landing-page');

Route::get('/chat-test', [HomeController::class, 'testchat'])->name('chat-test');


// front user route 
Route::group(['middleware' => ['auth','isuser']], function () {
  
  // my events in calendar
  Route::get('my-events',[FullCalenderController::class,'index'])->name('full-calendar');
  Route::post('my-calender/action', [FullCalenderController::class, 'action'])->name('full-calender-update');
  
  // linkedin invite people
  Route::get('/linkedin_connect', [ZoomController::class, 'linkedin_connect'])->name('linkedin_connect');
  
  Route::get('/match-making', [MatchmakingProfileController::class, 'index'])->name('match-making');

  Route::post('/match-making-create', [MatchmakingProfileController::class, 'create'])->name('match-making-create');

  Route::get('/match-making-profile', [MatchmakingProfileController::class, 'match_profile'])->name('match-making-profile');

  Route::post('/question-image', [MatchmakingProfileController::class, 'questionCropImage'])->name('question-image');
  Route::get('/match-making-profile-reject/{profile_id?}', [MatchmakingProfileController::class, 'profile_reject'])->name('match-making-profile-reject');
  /**
   * zoom meeting routes
   * start
  */
  Route::get('/testrequest', [ZoomController::class, 'testrequest'])->name('testrequest');
  Route::get('/generate-token', [ZoomController::class, 'generate_token'])->name('generate-token');
  Route::get('/oauth-token', [ZoomController::class, 'zoomauthtoken_generate'])->name('oauth-token');
  Route::get('/getmeetings', [ZoomController::class, 'getmeetings'])->name('getmeetings');
  Route::post('/createmeeting', [ZoomController::class, 'createmeeting'])->name('createmeeting');
  Route::get('/meet', [ZoomController::class, 'meet'])->name('meet');
  Route::get('/generatesdk', [ZoomController::class, 'generatesdk'])->name('generatesdk');
  /**
   * zoom meeting routes
   * end
   */

  // Visitors
  Route::get('visitors', [VisitorsController::class, 'visitors'])->name('visitors');

  // Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
  Route::post('/save_chatid', [MessagesController::class, 'save_chatid'])->name('save_chatid');
  
  Route::get('/messages', [MessagesController::class, 'newchat'])->name('messages');
  Route::get('/messages_group', [MessagesController::class, 'groupchat'])->name('messages_group');
  Route::post('/memberdetail', [MessagesController::class, 'memberdetail'])->name('memberdetail');
  
  
  
  Route::get('/logout',[HomeController::class,'logout'])->name('logout');
  Route::get('/home',[HomeController::class,'index'])->name('home');
  // Route::get('/',[HomeController::class,'recent_join'])->name('recent-join');


  //Request Route
  Route::post('sent-request', [RequestController::class, 'sent_request'])->name('sent-request');
  Route::get('/notifications',[RequestController::class,'notifications'])->name('notifications');
  Route::get('/request-list',[RequestController::class,'requestlist'])->name('requestlist');
  Route::get('/update-request-status/{id?}/{status?}',[RequestController::class,'update_request_status'])->name('update-request-status');
  
  Route::post('/send-recommended-request',[RequestController::class,'send_recommended_request'])->name('send-recommended-request');

// Meeting List
  Route::get('meetinglist', [MeetingController::class, 'meetinglist'])->name('meetinglist');

  Route::get('profile/{username?}/{matchprofile?}',[ProfileController::class,'profile'])->name('profile');

  Route::get('myaccount',[MyAccountController::class,'myaccount'])->name('myaccount');
  Route::post('/myaccount-update', [MyAccountController::class, 'myaccount_update'])->name('myaccount-update');
  Route::post('/myaccount-profile-image', [MyAccountController::class, 'uploadCropImage'])->name('myaccount-profile-image');
  Route::get('membership',[MyAccountController::class,'membership'])->name('membership');
  Route::get('/friends-list',[MyAccountController::class,'friends_list'])->name('friends-list');

  
  Route::get('personal-detail/{id?}',[MyAccountController::class,'personal_details'])->name('personal-detail');
  Route::post('personal-detail-update',[MyAccountController::class,'personal_details_update'])->name('personal-detail-update');

  // Professional Details

  Route::get('professional-detail/{id?}',[MyAccountController::class,'professional_details'])->name('professional-detail');
  Route::post('professional-detail-update',[MyAccountController::class,'professional_details_update'])->name('professional-detail-update');


  // friend list
  Route::post('friend-list',[MyAccountController::class,'friend_list'])->name('friend-list');
  Route::post('create-group',[MyAccountController::class,'create_group'])->name('create-group');
  // Route::get('group-list',[MyAccountController::class,'group_list'])->name('group-list');
  Route::post('recommend-friend-list',[MyAccountController::class,'recommend_friend_list'])->name('recommend-friend-list');
  
  // group -member

  
  
  Route::get('group-list',[GroupController::class,'index'])->name('group-list');
  Route::get('group-add',[GroupController::class,'create'])->name('group-add');
  Route::post('group-store',[GroupController::class,'store'])->name('group-store');
  Route::get('group/{slug?}',[GroupController::class,'group_detail'])->name('group-detail');
  Route::get('group-delete/{group_id?}',[GroupController::class,'group_delete'])->name('group-delete');
  
  Route::get('group-edit/{slug?}',[GroupController::class,'group_edit'])->name('group-edit');
  Route::get('group-member-remove/{mid?}/{grpid?}',[GroupController::class,'group_member_remove'])->name('group-member-remove');


  //password change
  Route::get('/password-update',[MyAccountController::class,'password_update'])->name('password-update');
  Route::post('change-password',[MyAccountController::class,'change_password'])->name('change-password');


  Route::get('membership-plan', [MembershipController::class, 'index_front'])->name('membership-plan');
  Route::post('request-members-list',[MembershipController::class,'get_request_members_list'])->name('request-members-list');



  //all-members 
  Route::get('all-members',[MembershipController::class,'all_members'])->name('all-members');
  
  
  // load more for members profile
  Route::get('loadmore-business', [MembershipController::class, 'loadmore_business'])->name('loadmore-business');
  Route::get('loadmore-personal', [MembershipController::class, 'loadmore_personal'])->name('loadmore-personal');
  

  
  //Terms and condition
  Route::get('/terms-condition', [UserController::class, 'terms_condition'])->name('terms-condition');
  Route::get('/terms-condition-accept', [UserController::class, 'terms_condition_accept'])->name('terms-condition-accept');

  
  //Payment Route
  Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
  Route::post('/payment_savstrip', [PaymentController::class, 'payment_savstrip'])->name('payment_savstrip');
  Route::post('/payment_save', [PaymentController::class, 'payment_save'])->name('payment_save');
  Route::get('/payment_status', [PaymentController::class, 'payment_status'])->name('payment_status');

  Route::get('/payment_popup', [PaymentController::class, 'payment_popup'])->name('payment_popup');
  Route::get('/payment-details/{id?}', [PaymentController::class, 'payment_details'])->name('payment_details');
  Route::get('/payment-success', [PaymentController::class, 'payment_successful'])->name('payment-success');
  Route::get('/payment_page', [PaymentController::class, 'payment_page'])->name('payment_page');

  Route::get('stripe', [PaymentController::class, 'stripe']);
  Route::post('stripe', [PaymentController::class, 'stripePost'])->name('stripe.post');

  Route::get('/billing', [PaymentController::class, 'billing'])->name('billing');

  //Like profile Controller

  Route::get('/likeprofile', [LikeProfileController::class, 'like_profile'])->name('likeprofile');
  Route::post('/like-profile', [RequestController::class, 'like_profile'])->name('like-profile');
  Route::get('loadmore-likeprofile', [LikeProfileController::class, 'loadmore_likeprofile'])->name('loadmore-likeprofile');

// Meeting Controller 

  Route::post('meeting/{username?}',[MeetingController::class,'meeting'])->name('meeting');





});


Route::group(['middleware' => ['auth','admin'],'prefix'=>'admin'], function () {

  Route::get('/logout',[DashboardController::class,'logout'])->name('admin.logout');
  Route::get('/', [DashboardController::class, 'dashboardModern'])->name('admin');
  //Patner Route

  Route::get('patner-add', [PartnersController::class, 'index_patner'])->name('patner-add');
  Route::post('patner_create', [PartnersController::class, 'patneradd'])->name('patner_create');
  Route::get('patner-list/{id?}', [PartnersController::class, 'patnerlist'])->name('patner-list');
  Route::get('patner_edit/{id}', [PartnersController::class, 'patneredit'])->name('patner_edit');
  Route::post('patner_update', [PartnersController::class, 'patnerupdate'])->name('patner_update');
  Route::get('patner-status/{id}/{status}', [PartnersController::class, 'update_status'])->name('patner-status');
  Route::get('patner-delete/{id}', [PartnersController::class, 'delete_patner'])->name('patner-delete');


  
  //Profile-Type Route 

  Route::resource('profile-type', ProfileTypeController::class);
  Route::get('profile-type-status/{id}/{status}', [ProfileTypeController::class, 'update_status'])->name('profile-type-status');

  //Membership Route

  Route::resource('membership-type', MembershipController::class);
  Route::get('membership-type-status/{id}/{status}', [MembershipController::class, 'update_status'])->name('membership-type-status');
  Route::get('membership-delete/{id}', [MembershipController::class, 'delete_membership'])->name('membership-delete');

  
  //Position  Route

  Route::resource('position', PositionController::class);
  Route::get('position-status/{id}/{status}', [PositionController::class, 'update_status'])->name('position-status');

  //Industry Route

  Route::resource('industry', IndustryController::class);
  Route::get('industry-status/{id}/{status}', [IndustryController::class, 'update_status'])->name('industry-status');

  
  //Social Link

  Route::resource('social', SettingController::class);

  //Member Plan
  
  Route::resource('member-plan', AdminMemberPlanController::class);
  Route::get('admin-group-list', [AdminMemberPlanController::class, 'group_list'])->name('admin-group-list');

//calender routes


  
  // Dashboard Route

  // Route::get('/', [DashboardController::class, 'dashboardModern'])->middleware('verified');

  // Route::get('/', [DashboardController::class, 'dashboardModern']);

  // User Route

  Route::get('/users-list', [UserController::class, 'usersList']);
  Route::get('user-detail/{id?}',[UserController::class,'user_view'])->name('user-detail');
  Route::get('/page-users-view', [UserController::class, 'usersView']);

  Route::get('/page-users-edit', [UserController::class, 'usersEdit']);

  Route::get('users-status/{id}/{active_status}', [UserController::class, 'update_status'])->name('users-status');
  Route::get('users-approve/{id}/{admin_approve}', [UserController::class, 'update_approve'])->name('users-approve');
  

  Route::get('/modern', [DashboardController::class, 'dashboardModern']);

  Route::get('/ecommerce', [DashboardController::class, 'dashboardEcommerce']);

  Route::get('/analytics', [DashboardController::class, 'dashboardAnalytics']);



  // Application Route

  Route::get('/app-email', [ApplicationController::class, 'emailApp']);

  Route::get('/app-email/content', [ApplicationController::class, 'emailContentApp']);

  Route::get('/app-chat', [ApplicationController::class, 'chatApp']);

  Route::get('/app-todo', [ApplicationController::class, 'todoApp']);

  Route::get('/app-kanban', [ApplicationController::class, 'kanbanApp']);

  Route::get('/app-file-manager', [ApplicationController::class, 'fileManagerApp']);

  Route::get('/app-contacts', [ApplicationController::class, 'contactApp']);

  Route::get('/app-calendar', [ApplicationController::class, 'calendarApp']);

  Route::get('/app-invoice-list', [ApplicationController::class, 'invoiceList']);

  Route::get('/app-invoice-view', [ApplicationController::class, 'invoiceView']);

  Route::get('/app-invoice-edit', [ApplicationController::class, 'invoiceEdit']);

  Route::get('/app-invoice-add', [ApplicationController::class, 'invoiceAdd']);

  Route::get('/eCommerce-products-page', [ApplicationController::class, 'ecommerceProduct']);

  Route::get('/eCommerce-pricing', [ApplicationController::class, 'eCommercePricing']);



  // User profile Route

  Route::get('/user-profile-page', [UserProfileController::class, 'userProfile']);



  // Page Route

  Route::get('/page-contact', [PageController::class, 'contactPage']);

  Route::get('/page-blog-list', [PageController::class, 'pageBlogList']);

  Route::get('/page-search', [PageController::class, 'searchPage']);

  Route::get('/page-knowledge', [PageController::class, 'knowledgePage']);

  Route::get('/page-knowledge/licensing', [PageController::class, 'knowledgeLicensingPage']);

  Route::get('/page-knowledge/licensing/detail', [PageController::class, 'knowledgeLicensingPageDetails']);

  Route::get('/page-timeline', [PageController::class, 'timelinePage']);

  Route::get('/page-faq', [PageController::class, 'faqPage']);

  Route::get('/page-faq-detail', [PageController::class, 'faqDetailsPage']);

  Route::get('/page-account-settings', [PageController::class, 'accountSetting']);

  Route::get('/page-blank', [PageController::class, 'blankPage']);

  Route::get('/page-collapse', [PageController::class, 'collapsePage']);



  // Media Route

  Route::get('/media-gallery-page', [MediaController::class, 'mediaGallery']);

  Route::get('/media-hover-effects', [MediaController::class, 'hoverEffect']);



  // Card Route

  Route::get('/cards-basic', [CardController::class, 'cardBasic']);

  Route::get('/cards-advance', [CardController::class, 'cardAdvance']);

  Route::get('/cards-extended', [CardController::class, 'cardsExtended']);



  // Css Route

  Route::get('/css-typography', [CssController::class, 'typographyCss']);

  Route::get('/css-color', [CssController::class, 'colorCss']);

  Route::get('/css-grid', [CssController::class, 'gridCss']);

  Route::get('/css-helpers', [CssController::class, 'helpersCss']);

  Route::get('/css-media', [CssController::class, 'mediaCss']);

  Route::get('/css-pulse', [CssController::class, 'pulseCss']);

  Route::get('/css-sass', [CssController::class, 'sassCss']);

  Route::get('/css-shadow', [CssController::class, 'shadowCss']);

  Route::get('/css-animations', [CssController::class, 'animationCss']);

  Route::get('/css-transitions', [CssController::class, 'transitionCss']);



  // Basic Ui Route

  Route::get('/ui-basic-buttons', [BasicUiController::class, 'basicButtons']);

  Route::get('/ui-extended-buttons', [BasicUiController::class, 'extendedButtons']);

  Route::get('/ui-icons', [BasicUiController::class, 'iconsUI']);

  Route::get('/ui-alerts', [BasicUiController::class, 'alertsUI']);

  Route::get('/ui-badges', [BasicUiController::class, 'badgesUI']);

  Route::get('/ui-breadcrumbs', [BasicUiController::class, 'breadcrumbsUI']);

  Route::get('/ui-chips', [BasicUiController::class, 'chipsUI']);

  Route::get('/ui-chips', [BasicUiController::class, 'chipsUI']);

  Route::get('/ui-collections', [BasicUiController::class, 'collectionsUI']);

  Route::get('/ui-navbar', [BasicUiController::class, 'navbarUI']);

  Route::get('/ui-pagination', [BasicUiController::class, 'paginationUI']);

  Route::get('/ui-preloader', [BasicUiController::class, 'preloaderUI']);



  // Advance UI Route

  Route::get('/advance-ui-carousel', [AdvanceUiController::class, 'carouselUI']);

  Route::get('/advance-ui-collapsibles', [AdvanceUiController::class, 'collapsibleUI']);

  Route::get('/advance-ui-toasts', [AdvanceUiController::class, 'toastUI']);

  Route::get('/advance-ui-tooltip', [AdvanceUiController::class, 'tooltipUI']);

  Route::get('/advance-ui-dropdown', [AdvanceUiController::class, 'dropdownUI']);

  Route::get('/advance-ui-feature-discovery', [AdvanceUiController::class, 'discoveryFeature']);

  Route::get('/advance-ui-media', [AdvanceUiController::class, 'mediaUI']);

  Route::get('/advance-ui-modals', [AdvanceUiController::class, 'modalUI']);

  Route::get('/advance-ui-scrollspy', [AdvanceUiController::class, 'scrollspyUI']);

  Route::get('/advance-ui-tabs', [AdvanceUiController::class, 'tabsUI']);

  Route::get('/advance-ui-waves', [AdvanceUiController::class, 'wavesUI']);

  Route::get('/fullscreen-slider-demo', [AdvanceUiController::class, 'fullscreenSlider']);



  // Extra components Route

  Route::get('/extra-components-range-slider', [ExtraComponentsController::class, 'rangeSlider']);

  Route::get('/extra-components-sweetalert', [ExtraComponentsController::class, 'sweetAlert']);

  Route::get('/extra-components-nestable', [ExtraComponentsController::class, 'nestAble']);

  Route::get('/extra-components-treeview', [ExtraComponentsController::class, 'treeView']);

  Route::get('/extra-components-ratings', [ExtraComponentsController::class, 'ratings']);

  Route::get('/extra-components-tour', [ExtraComponentsController::class, 'tour']);

  Route::get('/extra-components-i18n', [ExtraComponentsController::class, 'i18n']);

  Route::get('/extra-components-highlight', [ExtraComponentsController::class, 'highlight']);



  // Basic Tables Route

  Route::get('/table-basic', [BasicTableController::class, 'tableBasic']);



  // Data Table Route

  Route::get('/table-data-table', [DataTableController::class, 'dataTable']);



  // Form Route

  Route::get('/form-elements', [FormController::class, 'formElement']);

  Route::get('/form-select2', [FormController::class, 'formSelect2']);

  Route::get('/form-validation', [FormController::class, 'formValidation']);

  Route::get('/form-masks', [FormController::class, 'masksForm']);

  Route::get('/form-editor', [FormController::class, 'formEditor']);

  Route::get('/form-file-uploads', [FormController::class, 'fileUploads']);

  Route::get('/form-layouts', [FormController::class, 'formLayouts']);

  Route::get('/form-wizard', [FormController::class, 'formWizard']);



  // Charts Route

  Route::get('/charts-chartjs', [ChartController::class, 'chartJs']);

  Route::get('/charts-chartist', [ChartController::class, 'chartist']);

  Route::get('/charts-sparklines', [ChartController::class, 'sparklines']);





  // locale route

});

Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::get('/clear-cache', function() {
  $exitCode = Artisan::call('cache:clear');
  $exitCode = Artisan::call('config:cache');
  return 'DONE'; //Return anything
});