<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin']="admin/dashboard";
$route['admin/logout']="admin/login/logout";
$route['admin/user-auth'] = 'admin/dashboard/auth_check';
$route['admin/notification'] = 'admin/dashboard/notification';
$route['admin/all-notifications'] = 'admin/dashboard/all_notifications';
$route['admin/notification-detail/(:num)'] = 'admin/dashboard/detail/$1';
$route['admin/my-profile'] = 'admin/myprofile/index';


$route['admin/push-notifications'] = 'admin/push/index';
$route['admin/push-notifications/send'] = 'admin/push/send';


///withdraws Routes
$route['admin/withdraws'] = 'admin/withdraws/index';
$route['admin/withdraw-status/(:num)/(:num)'] = 'admin/withdraws/status/$1/$2';


///Categories Routes
$route['admin/categories'] = 'admin/categories/index';
$route['admin/add-category'] = 'admin/categories/add';
$route['admin/category-status/(:num)/(:num)'] = 'admin/categories/status/$1/$2';
$route['admin/edit-category/(:num)'] = 'admin/categories/edit/$1';
$route['admin/delete-category/(:num)'] = 'admin/categories/delete/$1';
$route['admin/trash-categories'] = "admin/categories/trash";
$route['admin/restore-category/(:num)'] = 'admin/categories/restore/$1';
$route['admin/category-display-order'] = 'admin/categories/display_order';

///holidays Routes
$route['admin/holidays'] = 'admin/holidays/index';
$route['admin/add-holiday'] = 'admin/holidays/add';
$route['admin/delete-holiday/(:num)'] = 'admin/holidays/delete/$1';

///leaves Routes
$route['admin/leaves'] = 'admin/leaves/index';

///Brands Routes
$route['admin/brands'] = 'admin/brands/index';
$route['admin/add-brand'] = 'admin/brands/add';
$route['admin/brand-status/(:num)/(:num)'] = 'admin/brands/status/$1/$2';
$route['admin/edit-brand/(:num)'] = 'admin/brands/edit/$1';
$route['admin/delete-brand/(:num)'] = 'admin/brands/delete/$1';
$route['admin/trash-brands'] = "admin/brands/trash";
$route['admin/restore-brand/(:num)'] = 'admin/brands/restore/$1';

///colors Routes
$route['admin/colors'] = 'admin/colors/index';
$route['admin/add-color'] = 'admin/colors/add';
$route['admin/color-status/(:num)/(:num)'] = 'admin/colors/status/$1/$2';
$route['admin/edit-color/(:num)'] = 'admin/colors/edit/$1';
$route['admin/delete-color/(:num)'] = 'admin/colors/delete/$1';
$route['admin/trash-colors'] = "admin/colors/trash";
$route['admin/restore-color/(:num)'] = 'admin/colors/restore/$1';


///keys Routes
$route['admin/keys'] = 'admin/keys/index';
$route['admin/add-key'] = 'admin/keys/add';
$route['admin/key-status/(:num)/(:num)'] = 'admin/keys/status/$1/$2';
$route['admin/edit-key/(:num)'] = 'admin/keys/edit/$1';
$route['admin/delete-key/(:num)'] = 'admin/keys/delete/$1';
$route['admin/remove-key/(:num)'] = 'admin/keys/remove/$1';
$route['admin/trash-keys'] = "admin/keys/trash";
$route['admin/restore-key/(:num)'] = 'admin/keys/restore/$1';



///surveys Routes
$route['admin/surveys'] = 'admin/surveys/index';
$route['admin/add-survey'] = 'admin/surveys/add';
$route['admin/survey-status/(:num)/(:num)'] = 'admin/surveys/status/$1/$2';
$route['admin/edit-survey/(:num)'] = 'admin/surveys/edit/$1';
$route['admin/delete-survey/(:num)'] = 'admin/surveys/delete/$1';
$route['admin/remove-survey/(:num)'] = 'admin/surveys/remove/$1';
$route['admin/trash-surveys'] = "admin/surveys/trash";
$route['admin/restore-survey/(:num)'] = 'admin/surveys/restore/$1';

///languages Routes
$route['admin/languages'] = 'admin/languages/index';
$route['admin/add-language'] = 'admin/languages/add';
$route['admin/language-status/(:num)/(:num)'] = 'admin/languages/status/$1/$2';
$route['admin/language-default/(:num)/(:num)'] = 'admin/languages/default/$1/$2';
$route['admin/edit-language/(:num)'] = 'admin/languages/edit/$1';
$route['admin/delete-language/(:num)'] = 'admin/languages/delete/$1';
$route['admin/trash-languages'] = "admin/languages/trash";
$route['admin/restore-language/(:num)'] = 'admin/languages/restore/$1';


///Company Details Routes
$route['admin/company-details'] = 'admin/company_details/index';
$route['admin/add-company-detail'] = 'admin/company_details/add';
$route['admin/company-detail-status/(:num)/(:num)'] = 'admin/company_details/status/$1/$2';
$route['admin/edit-company-detail/(:num)'] = 'admin/company_details/edit/$1';
$route['admin/delete-company-detail/(:num)'] = 'admin/company_details/delete/$1';
$route['admin/trash-company-details'] = "admin/company_details/trash";
$route['admin/restore-company-detail/(:num)'] = 'admin/company_details/restore/$1';


///Payment Methods Routes
$route['admin/payment-methods'] = 'admin/payment_methods/index';
$route['admin/edit-payment-method/(:num)'] = 'admin/payment_methods/edit/$1';

///Invoice Templates Routes
$route['admin/invoice-templates'] = 'admin/invoice_templates/index';
$route['admin/view-invoice-template/(:num)'] = 'admin/invoice_templates/view/$1';
$route['admin/view-invoice-template/(:num)/(:num)'] = 'admin/invoice_templates/view/$1/$2';


///FAQs Routes
$route['admin/faqs'] = 'admin/faqs/index';
$route['admin/add-faq'] = 'admin/faqs/add';
$route['admin/faq-status/(:num)/(:num)'] = 'admin/faqs/status/$1/$2';
$route['admin/edit-faq/(:num)'] = 'admin/faqs/edit/$1';
$route['admin/delete-faq/(:num)'] = 'admin/faqs/delete/$1';
$route['admin/trash-faqs'] = "admin/faqs/trash";
$route['admin/restore-faq/(:num)'] = 'admin/faqs/restore/$1';

///Notifications Routes
$route['admin/notifications'] = 'admin/notifications/index';
$route['admin/add-notification'] = 'admin/notifications/add';
$route['admin/notification-status/(:num)/(:num)'] = 'admin/notifications/status/$1/$2';
$route['admin/edit-notification/(:num)'] = 'admin/notifications/edit/$1';
$route['admin/delete-notification/(:num)'] = 'admin/notifications/delete/$1';
$route['admin/trash-notifications'] = "admin/notifications/trash";
$route['admin/restore-notification/(:num)'] = 'admin/notifications/restore/$1';

///Admins Routes
$route['admin/admins'] = 'admin/admins/index';
$route['admin/add-admin'] = 'admin/admins/add';
$route['admin/admin-status/(:num)/(:num)'] = 'admin/admins/status/$1/$2';
$route['admin/edit-admin/(:num)'] = 'admin/admins/edit/$1';
$route['admin/trash-admins'] = 'admin/admins/trash';
$route['admin/delete-admin/(:num)'] = 'admin/admins/delete/$1';
$route['admin/restore-admin/(:num)'] = 'admin/admins/restore/$1';
$route['admin/admin-detail/(:num)'] = 'admin/admins/admin_detail/$1';
$route['admin/edit-admin-roles/(:num)'] = 'admin/admins/edit_admin_roles/$1';

///managers Routes
$route['admin/managers'] = 'admin/managers/index';
$route['admin/add-manager'] = 'admin/managers/add';
$route['admin/admin-status/(:num)/(:num)'] = 'admin/managers/status/$1/$2';
$route['admin/edit-manager/(:num)'] = 'admin/managers/edit/$1';
$route['admin/trash-managers'] = 'admin/managers/trash';
$route['admin/delete-manager/(:num)'] = 'admin/managers/delete/$1';
$route['admin/restore-manager/(:num)'] = 'admin/managers/restore/$1';
$route['admin/manager-detail/(:num)'] = 'admin/managers/admin_detail/$1';
$route['admin/edit-manager-roles/(:num)'] = 'admin/managers/edit_admin_roles/$1';


///Emails Routes
$route['admin/emails'] = 'admin/emails/index';
$route['admin/add-email'] = 'admin/emails/add';
$route['admin/email-status/(:num)/(:num)'] = 'admin/emails/status/$1/$2';
$route['admin/edit-email/(:num)'] = 'admin/emails/edit/$1';
$route['admin/delete-email/(:num)'] = 'admin/emails/delete/$1';
$route['admin/trash-emails'] = "admin/emails/trash";
$route['admin/restore-email/(:num)'] = 'admin/emails/restore/$1';


///Pages Routes
$route['admin/pages'] = 'admin/pages/index';
$route['admin/add-page'] = 'admin/pages/add';
$route['admin/page-status/(:num)/(:num)'] = 'admin/pages/status/$1/$2';
$route['admin/edit-page/(:num)'] = 'admin/pages/edit/$1';
$route['admin/delete-page/(:num)'] = 'admin/pages/delete/$1';
$route['admin/trash-pages'] = "admin/pages/trash";
$route['admin/restore-page/(:num)'] = 'admin/pages/restore/$1';



///// Location Routes
$route['admin/get-states'] = 'admin/location/get_stats_by_country_id';
$route['admin/get-cities'] = 'admin/location/get_city_by_state_id';



///users Routes
$route['admin/users'] = 'admin/users/index';
$route['admin/add-user'] = 'admin/users/add';
$route['admin/user-status/(:num)/(:num)'] = 'admin/users/status/$1/$2';
$route['admin/user-report'] = 'admin/users/report';
$route['admin/edit-user/(:num)'] = 'admin/users/edit/$1';
$route['admin/delete-user/(:num)'] = 'admin/users/delete/$1';
$route['admin/trash-users'] = "admin/users/trash";
$route['admin/restore-user/(:num)'] = 'admin/users/restore/$1';
$route['admin/reset-password-user/(:num)'] = 'admin/users/password/$1';

