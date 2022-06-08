<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'general_setting_access',
            ],
            [
                'id'    => 34,
                'title' => 'user_manager_access',
            ],
            [
                'id'    => 35,
                'title' => 'cars_setting_access',
            ],
            [
                'id'    => 36,
                'title' => 'make_create',
            ],
            [
                'id'    => 37,
                'title' => 'make_edit',
            ],
            [
                'id'    => 38,
                'title' => 'make_show',
            ],
            [
                'id'    => 39,
                'title' => 'make_delete',
            ],
            [
                'id'    => 40,
                'title' => 'make_access',
            ],
            [
                'id'    => 41,
                'title' => 'modele_create',
            ],
            [
                'id'    => 42,
                'title' => 'modele_edit',
            ],
            [
                'id'    => 43,
                'title' => 'modele_show',
            ],
            [
                'id'    => 44,
                'title' => 'modele_delete',
            ],
            [
                'id'    => 45,
                'title' => 'modele_access',
            ],
            [
                'id'    => 46,
                'title' => 'setting_access',
            ],
            [
                'id'    => 47,
                'title' => 'version_create',
            ],
            [
                'id'    => 48,
                'title' => 'version_edit',
            ],
            [
                'id'    => 49,
                'title' => 'version_show',
            ],
            [
                'id'    => 50,
                'title' => 'version_delete',
            ],
            [
                'id'    => 51,
                'title' => 'version_access',
            ],
            [
                'id'    => 52,
                'title' => 'color_create',
            ],
            [
                'id'    => 53,
                'title' => 'color_edit',
            ],
            [
                'id'    => 54,
                'title' => 'color_show',
            ],
            [
                'id'    => 55,
                'title' => 'color_delete',
            ],
            [
                'id'    => 56,
                'title' => 'color_access',
            ],
            [
                'id'    => 57,
                'title' => 'feature_create',
            ],
            [
                'id'    => 58,
                'title' => 'feature_edit',
            ],
            [
                'id'    => 59,
                'title' => 'feature_show',
            ],
            [
                'id'    => 60,
                'title' => 'feature_delete',
            ],
            [
                'id'    => 61,
                'title' => 'feature_access',
            ],
            [
                'id'    => 62,
                'title' => 'code_model_create',
            ],
            [
                'id'    => 63,
                'title' => 'code_model_edit',
            ],
            [
                'id'    => 64,
                'title' => 'code_model_show',
            ],
            [
                'id'    => 65,
                'title' => 'code_model_delete',
            ],
            [
                'id'    => 66,
                'title' => 'code_model_access',
            ],
            [
                'id'    => 67,
                'title' => 'vehicle_access',
            ],
            [
                'id'    => 68,
                'title' => 'car_create',
            ],
            [
                'id'    => 69,
                'title' => 'car_edit',
            ],
            [
                'id'    => 70,
                'title' => 'car_show',
            ],
            [
                'id'    => 71,
                'title' => 'car_delete',
            ],
            [
                'id'    => 72,
                'title' => 'car_access',
            ],
            [
                'id'    => 73,
                'title' => 'contact_access',
            ],
            [
                'id'    => 74,
                'title' => 'company_create',
            ],
            [
                'id'    => 75,
                'title' => 'company_edit',
            ],
            [
                'id'    => 76,
                'title' => 'company_show',
            ],
            [
                'id'    => 77,
                'title' => 'company_delete',
            ],
            [
                'id'    => 78,
                'title' => 'company_access',
            ],
            [
                'id'    => 79,
                'title' => 'individual_create',
            ],
            [
                'id'    => 80,
                'title' => 'individual_edit',
            ],
            [
                'id'    => 81,
                'title' => 'individual_show',
            ],
            [
                'id'    => 82,
                'title' => 'individual_delete',
            ],
            [
                'id'    => 83,
                'title' => 'individual_access',
            ],
            [
                'id'    => 84,
                'title' => 'entity_create',
            ],
            [
                'id'    => 85,
                'title' => 'entity_edit',
            ],
            [
                'id'    => 86,
                'title' => 'entity_show',
            ],
            [
                'id'    => 87,
                'title' => 'entity_delete',
            ],
            [
                'id'    => 88,
                'title' => 'entity_access',
            ],
            [
                'id'    => 89,
                'title' => 'address_create',
            ],
            [
                'id'    => 90,
                'title' => 'address_edit',
            ],
            [
                'id'    => 91,
                'title' => 'address_show',
            ],
            [
                'id'    => 92,
                'title' => 'address_delete',
            ],
            [
                'id'    => 93,
                'title' => 'address_access',
            ],
            [
                'id'    => 94,
                'title' => 'tag_contact_create',
            ],
            [
                'id'    => 95,
                'title' => 'tag_contact_edit',
            ],
            [
                'id'    => 96,
                'title' => 'tag_contact_show',
            ],
            [
                'id'    => 97,
                'title' => 'tag_contact_delete',
            ],
            [
                'id'    => 98,
                'title' => 'tag_contact_access',
            ],
            [
                'id'    => 99,
                'title' => 'crm_access',
            ],
            [
                'id'    => 100,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 101,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 102,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 103,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 104,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 105,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 106,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 107,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 108,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 109,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 110,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 111,
                'title' => 'task_create',
            ],
            [
                'id'    => 112,
                'title' => 'task_edit',
            ],
            [
                'id'    => 113,
                'title' => 'task_show',
            ],
            [
                'id'    => 114,
                'title' => 'task_delete',
            ],
            [
                'id'    => 115,
                'title' => 'task_access',
            ],
            [
                'id'    => 116,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 117,
                'title' => 'task_setting_access',
            ],
            [
                'id'    => 118,
                'title' => 'team_create',
            ],
            [
                'id'    => 119,
                'title' => 'team_edit',
            ],
            [
                'id'    => 120,
                'title' => 'team_show',
            ],
            [
                'id'    => 121,
                'title' => 'team_delete',
            ],
            [
                'id'    => 122,
                'title' => 'team_access',
            ],
            [
                'id'    => 123,
                'title' => 'order_access',
            ],
            [
                'id'    => 124,
                'title' => 'proforma_access',
            ],
            [
                'id'    => 125,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 126,
                'title' => 'shippment_access',
            ],
            [
                'id'    => 127,
                'title' => 'shippmentslist_create',
            ],
            [
                'id'    => 128,
                'title' => 'shippmentslist_edit',
            ],
            [
                'id'    => 129,
                'title' => 'shippmentslist_show',
            ],
            [
                'id'    => 130,
                'title' => 'shippmentslist_delete',
            ],
            [
                'id'    => 131,
                'title' => 'shippmentslist_access',
            ],
            [
                'id'    => 132,
                'title' => 'crm_setting_access',
            ],
            [
                'id'    => 133,
                'title' => 'shipp_status_create',
            ],
            [
                'id'    => 134,
                'title' => 'shipp_status_edit',
            ],
            [
                'id'    => 135,
                'title' => 'shipp_status_show',
            ],
            [
                'id'    => 136,
                'title' => 'shipp_status_delete',
            ],
            [
                'id'    => 137,
                'title' => 'shipp_status_access',
            ],
            [
                'id'    => 138,
                'title' => 'shipp_line_create',
            ],
            [
                'id'    => 139,
                'title' => 'shipp_line_edit',
            ],
            [
                'id'    => 140,
                'title' => 'shipp_line_show',
            ],
            [
                'id'    => 141,
                'title' => 'shipp_line_delete',
            ],
            [
                'id'    => 142,
                'title' => 'shipp_line_access',
            ],
            [
                'id'    => 143,
                'title' => 'orders_list_create',
            ],
            [
                'id'    => 144,
                'title' => 'orders_list_edit',
            ],
            [
                'id'    => 145,
                'title' => 'orders_list_show',
            ],
            [
                'id'    => 146,
                'title' => 'orders_list_delete',
            ],
            [
                'id'    => 147,
                'title' => 'orders_list_access',
            ],
            [
                'id'    => 148,
                'title' => 'truck_create',
            ],
            [
                'id'    => 149,
                'title' => 'truck_edit',
            ],
            [
                'id'    => 150,
                'title' => 'truck_show',
            ],
            [
                'id'    => 151,
                'title' => 'truck_delete',
            ],
            [
                'id'    => 152,
                'title' => 'truck_access',
            ],
            [
                'id'    => 153,
                'title' => 'order_status_create',
            ],
            [
                'id'    => 154,
                'title' => 'order_status_edit',
            ],
            [
                'id'    => 155,
                'title' => 'order_status_show',
            ],
            [
                'id'    => 156,
                'title' => 'order_status_delete',
            ],
            [
                'id'    => 157,
                'title' => 'order_status_access',
            ],
            [
                'id'    => 158,
                'title' => 'cond_reglement_create',
            ],
            [
                'id'    => 159,
                'title' => 'cond_reglement_edit',
            ],
            [
                'id'    => 160,
                'title' => 'cond_reglement_show',
            ],
            [
                'id'    => 161,
                'title' => 'cond_reglement_delete',
            ],
            [
                'id'    => 162,
                'title' => 'cond_reglement_access',
            ],
            [
                'id'    => 163,
                'title' => 'mode_reglement_create',
            ],
            [
                'id'    => 164,
                'title' => 'mode_reglement_edit',
            ],
            [
                'id'    => 165,
                'title' => 'mode_reglement_show',
            ],
            [
                'id'    => 166,
                'title' => 'mode_reglement_delete',
            ],
            [
                'id'    => 167,
                'title' => 'mode_reglement_access',
            ],
            [
                'id'    => 168,
                'title' => 'shipping_method_create',
            ],
            [
                'id'    => 169,
                'title' => 'shipping_method_edit',
            ],
            [
                'id'    => 170,
                'title' => 'shipping_method_show',
            ],
            [
                'id'    => 171,
                'title' => 'shipping_method_delete',
            ],
            [
                'id'    => 172,
                'title' => 'shipping_method_access',
            ],
            [
                'id'    => 173,
                'title' => 'service_create',
            ],
            [
                'id'    => 174,
                'title' => 'service_edit',
            ],
            [
                'id'    => 175,
                'title' => 'service_show',
            ],
            [
                'id'    => 176,
                'title' => 'service_delete',
            ],
            [
                'id'    => 177,
                'title' => 'service_access',
            ],
            [
                'id'    => 178,
                'title' => 'order_line_create',
            ],
            [
                'id'    => 179,
                'title' => 'order_line_edit',
            ],
            [
                'id'    => 180,
                'title' => 'order_line_show',
            ],
            [
                'id'    => 181,
                'title' => 'order_line_delete',
            ],
            [
                'id'    => 182,
                'title' => 'order_line_access',
            ],
            [
                'id'    => 183,
                'title' => 'proforma_list_create',
            ],
            [
                'id'    => 184,
                'title' => 'proforma_list_edit',
            ],
            [
                'id'    => 185,
                'title' => 'proforma_list_show',
            ],
            [
                'id'    => 186,
                'title' => 'proforma_list_delete',
            ],
            [
                'id'    => 187,
                'title' => 'proforma_list_access',
            ],
            [
                'id'    => 188,
                'title' => 'proforma_line_create',
            ],
            [
                'id'    => 189,
                'title' => 'proforma_line_edit',
            ],
            [
                'id'    => 190,
                'title' => 'proforma_line_show',
            ],
            [
                'id'    => 191,
                'title' => 'proforma_line_delete',
            ],
            [
                'id'    => 192,
                'title' => 'proforma_line_access',
            ],
            [
                'id'    => 193,
                'title' => 'invoices_list_create',
            ],
            [
                'id'    => 194,
                'title' => 'invoices_list_edit',
            ],
            [
                'id'    => 195,
                'title' => 'invoices_list_show',
            ],
            [
                'id'    => 196,
                'title' => 'invoices_list_delete',
            ],
            [
                'id'    => 197,
                'title' => 'invoices_list_access',
            ],
            [
                'id'    => 198,
                'title' => 'invoice_line_create',
            ],
            [
                'id'    => 199,
                'title' => 'invoice_line_edit',
            ],
            [
                'id'    => 200,
                'title' => 'invoice_line_show',
            ],
            [
                'id'    => 201,
                'title' => 'invoice_line_delete',
            ],
            [
                'id'    => 202,
                'title' => 'invoice_line_access',
            ],
            [
                'id'    => 203,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 204,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 205,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
