<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InitController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PreRegistrationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportedController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\ClientController;
use App\Http\Controllers\Company\DisabledClientController;
use App\Http\Controllers\Company\UnRegisteredClientController;
use App\Http\Controllers\Company\ApprovedClientController;
use App\Http\Controllers\Company\RegisteredClientController;
use App\Http\Controllers\Company\VerifiedClientController;
use App\Http\Controllers\Company\SuperSededClientController;
use App\Http\Controllers\HRM\RoleController;
use App\Http\Controllers\HRM\UserController;
use App\Http\Controllers\Packages\PackageController;
use App\Http\Controllers\Settings\CategoryController;
use App\Http\Controllers\Settings\CountryController;
use App\Http\Controllers\Settings\DocumentController;
use App\Http\Controllers\Settings\RegionController;
use App\Http\Controllers\Settings\RelativeSubCategoryController;
use App\Http\Controllers\Settings\SectorController;
use App\Http\Controllers\Settings\SubCategoryController;
use App\Http\Controllers\ContentController;

use App\Http\Controllers\CustomerSupport\AppFaqCategoriesController;
use App\Http\Controllers\CustomerSupport\AppFaqController;
use App\Http\Controllers\CustomerSupport\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. 
|
*/

Route::get('/', [InitController::class, 'index']);

Auth::routes(['verify' => true]);
//'permission'

/* Authenticated User Starts */
Route::group(['middleware' => ['auth']], function() {

       Route::get('/home', [HomeController::class, 'index'])->name('home');
       // Settings 

          // Location 
             Route::resource('country',CountryController::class);
             Route::resource('region',RegionController::class);
             Route::resource('sector',SectorController::class);

          // Services   
             Route::get('create-subcategory',[CategoryController::class,'createSubcategory'])->name('category.create-subcategory');
             Route::get('service',[CategoryController::class,'service'])->name('category.service');
             Route::get('subcatlist/{id}',[CategoryController::class,'subcatList'])->name('category.subcatlist');
             Route::resource('category',CategoryController::class);
             Route::post('subname-fetch', [SubCategoryController::class,'fetchName'])->name('fetchSubName');
             Route::get('delete-keyword/{id}', [SubCategoryController::class,'deleteKeyword'])->name('deleteKeyword');
             Route::post('catname-fetch', [CategoryController::class,'fetchName'])->name('fetchCatNames');
             Route::get('addsubcategory/{id}',[SubCategoryController::class,'addSubcategory'])->name('category.addsubcategory');
             Route::post('getLatestCode',[SubCategoryController::class,'getLatestCode'])->name('getLatestCode');
             Route::get('disable/{id}',[CategoryController::class,'disable'])->name('category.disable');
             Route::get('subcatdisable/{id}',[SubCategoryController::class,'disable'])->name('subcategory.subcatdisable');
             Route::get('subcategory/edit/{cat_id}/{subcat_id}',[SubCategoryController::class,'editSubcategory'])->name('subcategory.editSubcategory');
             Route::get('subcategory/show/{cat_id}/{subcat_id}',[SubCategoryController::class,'viewSubcategory'])->name('subcategory.viewSubcategory');
             Route::get('subcategory/relative/{id}/{cat_id}',[RelativeSubCategoryController::class,'show'])->name('subcategory.relatives');
             Route::resource('subcategory',SubCategoryController::class);

          // Relative Subcategory   
             Route::get('relative',[RelativeSubCategoryController::class,'index'])->name('relative.index');
             Route::get('relative/create',[RelativeSubCategoryController::class,'create'])->name('relative.create');
             Route::post('relative/fetch-subcategories',[RelativeSubCategoryController::class,'fetchSubCategories'])->name('relative.fetchSubCategories');
             Route::post('relative/store',[RelativeSubCategoryController::class,'store'])->name('relative.store');
             Route::get('relative/show/{id}',[RelativeSubCategoryController::class,'show'])->name('relative.show');
             Route::get('relative/unlink/{id}',[RelativeSubCategoryController::class,'unlink'])->name('relative.unlink');
       
          // Document   
             Route::resource('document',DocumentController::class);

          // Package   
             Route::resource('packages',PackageController::class);   


       // Registration
          Route::get('registration/to-do',[TodoController::class,'index'])->name('registration.todo');
          Route::get('registration/to-do/{id}',[TodoController::class,'show'])->name('registration.todo.show');
          Route::get('registration/to-do/checklist/{id}',[TodoController::class,'checklist'])->name('registration.todo.checklist');
          Route::post('registration/to-do/verify-checklist',[TodoController::class,'verifyChecklist'])->name('registration.todo.verifyChecklist'); 
 

          Route::post('registration/verify-checklist',[RegistrationController::class,'verifyChecklist'])->name('registration.verifyChecklist'); 
          Route::get('registration/checklist/{id}',[RegistrationController::class,'checklist'])->name('registration.checklist');
          
          Route::resource('registration',RegistrationController::class); 

       // Pre-Registration   
          Route::post('search-category',[PreRegistrationController::class,'serachCategory'])->name('search-category');
          Route::post('search-alpha-category',[PreRegistrationController::class,'serachAlphaCategory'])->name('search-alpha-category');
          Route::post('search-sub-category',[PreRegistrationController::class,'getSubCategory'])->name('search-sub-category');
          Route::post('save-category',[PreRegistrationController::class,'saveCategory'])->name('save-category');
          Route::post('get-categories',[PreRegistrationController::class,'getCategories'])->name('get-categories');
          Route::get('pre-registration/company/assign-category/{id}',[PreRegistrationController::class,'assignCategory'])->name('pre-registration.assign-category');
          Route::delete('pre-registration/delete/{id}',[PreRegistrationController::class,'delete'])->name('pre-registration.delete');
          Route::post('pre-registration/import',[PreRegistrationController::class,'import'])->name('pre-registration.import');
          Route::resource('pre-registration',PreRegistrationController::class);

       // Client
         //  Route::resource('client',ClientController::class);

          Route::get('/client/unregistered',[UnRegisteredClientController::class,'index'])->name('clients.unregistered.index');
          Route::get('/client/unregistered/{id}',[UnRegisteredClientController::class,'show'])->name('clients.unregistered.show');

          Route::get('/client/approved',[ApprovedClientController::class,'index'])->name('clients.approved.index');
          Route::get('/client/approved/{id}',[ApprovedClientController::class,'show'])->name('clients.approved.show');
          Route::get('/client/approved/checklist/{id}',[ApprovedClientController::class,'checklist'])->name('clients.approved.checklist');
          Route::post('/client/revert-approved',[ApprovedClientController::class,'revert'])->name('clients.approved.revert');
          

          Route::get('/client/registered',[RegisteredClientController::class,'index'])->name('clients.registered.index');
          Route::get('/client/registered/{id}',[RegisteredClientController::class,'show'])->name('clients.registered.show');
          Route::get('/client/registered/checklist/{id}',[RegisteredClientController::class,'checklist'])->name('clients.registered.checklist');
          Route::get('/client/registered/non-mandatory-checklist/{id}',[RegisteredClientController::class,'nonMandatoryChecklist'])->name('clients.registered.nonMandatoryChecklist');
          Route::post('/client/registered/non-mandatory-data-request',[RegisteredClientController::class,'nonMandatoryDataRequest'])->name('clients.registered.nonMandatoryDataRequest');
          

          Route::get('/client/verified',[VerifiedClientController::class,'index'])->name('clients.verified.index');
          Route::get('/client/verified/{id}',[VerifiedClientController::class,'show'])->name('clients.verified.show');

          Route::get('/client/superseded',[SuperSededClientController::class,'index'])->name('clients.superseded.index');
          Route::get('/client/superseded/{id}',[SuperSededClientController::class,'show'])->name('clients.superseded.show');

          Route::get('/client/disabled',[DisabledClientController::class,'index'])->name('clients.disabled.index');
          Route::get('/client/disabled/{id}',[DisabledClientController::class,'show'])->name('clients.disabled.show');
          Route::post('/client/disable',[DisabledClientController::class,'disable'])->name('clients.disable');
          Route::get('/client/disabled/checklist/{id}',[DisabledClientController::class,'checklist'])->name('clients.disabled.checklist');
          Route::post('/client/disable/revert',[DisabledClientController::class,'revert'])->name('clients.disable.revert');
          

       // Users
          Route::resource('role',RoleController::class);
          Route::resource('permission',PermissionController::class);
          Route::resource('user',UserController::class);

       // Reported Enquiries
          Route::get('reported-enquiries',[ReportedController::class,'index'])->name('reported.index');    
          Route::get('reported-enquiries/{id}',[ReportedController::class,'show'])->name('reported.show');    
          
        // FAQ      
          Route::resource('faq-categories',AppFaqCategoriesController::class);
          Route::resource('faqs',AppFaqController::class);
          Route::get('community-guidelines', [ContentController::class,'communityGuidelines'])->name('community-guidelines');
          Route::post('community-guidelines/save', [ContentController::class,'saveCommunityGuidelines'])->name('save-community-guidelines');
          Route::get('privacy-policy', [ContentController::class,'privacyPolicy'])->name('privacy-policy');
          Route::post('privacy-policy/save', [ContentController::class,'savePrivacyPolicy'])->name('save-privacy-policy');
          Route::get('user-agreement', [ContentController::class,'userAgreement'])->name('user-agreement');
          Route::post('user-agreement/save', [ContentController::class,'saveUserAgreement'])->name('save-user-agreement');
          Route::resource('notifications',NotificationController::class);

});

/* Authenticated User Ends */

//Route::view('/mailpage','test.mail');