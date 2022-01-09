<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Twilio\Rest\Client;

/**
 * handles the admins
 *
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
class Api extends ADMIN_Controller
{
    private $guest_id;
    public function __construct()
    {
        parent::__construct();
    }

    public function salon_signup()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $data = array(
            "sal_name" => $post->sal_name, // man
            "sal_address" => $post->sal_address, // man
            "sal_country" => $post->sal_country, // man
            "sal_city" => $post->sal_city, // man
            "sal_zip" => $post->sal_zip, // man
            "sal_contact_person" => $post->sal_contact_person, // man
            "sal_email" => $post->sal_email, // man
            "sal_phone" => $post->sal_phone, // man
            "sal_hours" => serialize($post->sal_hours), // man
            "sal_type" => $post->sal_type, // man
            "sal_pic" => $post->sal_pic,
            "sal_profile_pic" => $post->sal_profile_pic,
            "sal_password" => md5($post->password),
            "push_id" => $post->push_id,
            "sal_lat" => $post->sal_lat,
            "sal_lng" => $post->sal_lng,
            "sal_specialty" => $post->sal_specialty,
            "sal_facebook" => $post->sal_facebook,
            "sal_instagram" => $post->sal_instagram,
            "sal_twitter" => $post->sal_twitter,
            "sal_reviews" => $post->sal_reviews,
            "sal_rating" => $post->sal_rating,
            "sal_website" => $post->sal_website,
            "sal_search_words" => $post->sal_search_words,
            "sal_description" => $post->sal_description,
            "sal_area" => $post->sal_area,
            "sal_state" => $post->sal_state,
            "sal_paypal_email" => $post->sal_paypal_email,
            "steps" => $post->step,
        );

        if ($data["sal_name"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter salon name",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["sal_address"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter address",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["sal_city"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter city",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["sal_zip"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please postal code",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["sal_contact_person"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter contact person",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["sal_phone"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter phone",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["sal_hours"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter salon hours",
                "error_type" => 1,
            ));
            return;
        }
        $does_email_exists = $this->db->where('sal_email', $data['sal_email'])->count_all_results('salons') > 0 ? true : false;

        if ($data["sal_email"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Email is required",
                "error_type" => 1,
            ));
            return;
        }

        if ($does_email_exists) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Email already exists, please choose different one",
                "error_type" => 1,
            ));
            exit;
        }
        $make_salon_keyword = $data["sal_name"] . " " . $data["sal_address"] . " " . $data["sal_country"] . " " . $data["sal_city"] . " " . $data["sal_state"];
        $data["sal_search_words"] = $make_salon_keyword;

        $this->db->insert('salons', $data);
        $id = $this->db->insert_id();

        $rand = 1234;

        $this->do_sure_salon_login($id);

    }

    public function login()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user = $this->db
        // ->group_start()
            ->where('email', $post->email)
            // ->group_end()
            // ->group_start()
            ->where('password', md5($post->password))
            ->where('status', 1)
            ->where('is_deleted', 0)
            // ->group_end()
            ->get('users')
            ->result_object();
        // $user = $this->db->query("SELECT * FROM `users` where email = ? and password = ? and status = 1 and is_deleted = 0", [$post->email, $post->password])->result_object();

        // echo json_encode(array(
        //     "action" => "failed",
        //     "error" => "Invalid login credentials",
        //     "user" => $user
        // ));

        if (empty($user)) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",
                "user" => $user,
            ));
            exit;
        }

        $this->do_sure_login($user[0]->id);
    }

    public function signup()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $data = array(
            "name" => $post->username,
            "username" => $post->username,
            "email" => $post->email,
            "password" => md5($post->password),
            "created_at" => date("Y-m-d H:i:s"),
            "profile_pic" => $post->profile_pic,
        );

        if ($data["name"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter name",
                "error_type" => 1,

            ));
            return;
        }

        if ($data["username"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter username",
                "error_type" => 1,

            ));
            return;
        }

        $does_email_exists = $this->db->where('email', $data['email'])->count_all_results('users') > 0 ? true : false;

        if ($data["email"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Email is required",
                "error_type" => 1,
            ));
            return;
        }

        if ($does_email_exists) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Email already exists, please choose different one",
                "error_type" => 1,
            ));
            exit;
        }

        if ($data["password"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter password",
                "error_type" => 1,

            ));
            return;
        }

        $this->db->insert('users', $data);
        $id = $this->db->insert_id();

        $rand = 1234;

        $this->do_sure_login($id);

    }

    public function logout()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user = $this->do_auth($post);

        $login_data = array(
            "api_logged_sess" => md5(guid()),
            "push_id" => "",
        );

        $this->db->where('id', $user->id)->update('users', $login_data);

        echo json_encode(array(
            "action" => "success",
        ));
    }

    private function do_auth($post)
    {
        $user =
        $this->db->where('api_logged_sess', $post->token)
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->get('users')
            ->result_object();

        if (empty($user) || $post->token == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",
            ));
            exit;
        }

        return $user[0];
    }

    private function do_sure_login($id)
    {
        $user = $this->db->where('id', $id)->get('users')->result_object();

        if (empty($user)) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",

            ));
            return;
        }

        $user = $user[0];

        $login_data = array(
            "api_logged_sess" => md5(guid()),
            "api_logged_time" => date("Y-m-d H:i:s"),
        );

        $this->db->where('id', $id)->update('users', $login_data);

        $this->print_user_data($id);
    }

    private function do_sure_salon_login($id)
    {
        $user = $this->db->where('sal_id', $id)->get('salons')->result_object();
        if (empty($user)) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",
                "sal_id" => $id,

            ));
            return;
        }

        $user = $user[0];

        $login_data = array(
            "api_logged_sess" => md5(guid()),
            "api_logged_time" => date("Y-m-d H:i:s"),
        );

        $this->db->where('sal_id', $id)->update('salons', $login_data);

        $this->print_salon_data($id);
    }

    private function print_salon_data($id)
    {

        $user = $this->db->where('sal_id', $id)->get('salons')->result_object();
        if (empty($user)) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",

            ));
            return;
        }

        $user = $this->db->where("sal_id", $id)->get("salons")->result_object()[0];
        $services = $this->db->where("sal_id", $id)->get("sal_services")->result_object();
        echo json_encode(array(
            "action" => "success",
            "data" => array(

                "sal_id" => $user->sal_id,
                "sal_name" => $user->sal_name,
                "sal_contact_person" => $user->sal_contact_person,

                "sal_address" => $user->sal_address,
                "sal_city" => $user->sal_city,
                "sal_country" => $user->sal_country,
                "sal_zip" => $user->sal_zip,
                "sal_lat" => $user->sal_lat,
                "sal_lng" => $user->sal_lng,
                "sal_state" => $user->sal_state,
                "sal_type" => $user->sal_type,

                "sal_reviews" => $user->sal_reviews,
                "sal_rating" => $user->sal_rating,
                "sal_website" => $user->sal_website,
                "sal_search_words" => $user->sal_search_words,
                "sal_description" => $user->sal_description,

                "token" => $user->api_logged_sess,
                "sal_email" => $user->sal_email,
                "sal_pic" => $user->sal_pic ? withUrl($user->sal_pic) : "dummy_image.png",
                "sal_profile_pic" => withUrl($user->sal_profile_pic),
                "sal_phone" => $user->sal_phone ? $user->sal_phone : "",
                "sal_created_datetime" => $user->sal_created_datetime,
                "step" => $user->steps,
                "sal_hours" => unserialize($user->sal_hours),
                "sal_services" => $services,

            ),
        )
        );
    }

    private function print_user_data($id)
    {

        $user = $this->db->where('id', $id)->get('users')->result_object();
        if (empty($user)) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",

            ));
            return;
        }

        // $about_page = $this->db->where("slug", "about")->get("pages")->result_object()[0];
        // $settings = $this->db->get("settings")->result_object()[0];

        $user = $user[0];

        // $final = array();
        // $all_cats = $this->db->where("is_deleted", 0)->where("status", 1)->order_by("display_priority", "ASC")->limit(20)->get("categories")->result_object();
        // foreach ($all_cats as $one_cat) {
        //     $final[] = array(
        //         "id" => $one_cat->id,
        //         "title" => $one_cat->title,
        //     );
        // }

        echo json_encode(array(
            "action" => "success",
            "data" => array(
                "id" => $user->id,
                "name" => $user->name,
                "username" => $user->username,
                "token" => $user->api_logged_sess,
                "email" => $user->email,
                "profile_pic" => $user->profile_pic ? $user->profile_pic : "dummy_image.png",
                "profile_pic_url" => withUrl($user->profile_pic),
                "phone" => $user->phone ? $user->phone : "",
                "created_at" => $user->created_at,
            ),
        )
        );
    }

    public function add_salon_services()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user_logged = $this->do_auth_salon($post);
        $data = array(
            "s_name" => $post->s_name,
            "s_time_mins" => $post->s_time_mins,
            "s_price" => $post->s_price,
            "s_desc" => $post->s_desc,
            "sal_id" => $user_logged->sal_id,
        );

        if ($data["s_name"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter service name",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["s_time_mins"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter service duration",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["s_price"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter service price",
                "error_type" => 1,

            ));
            return;
        }
        if ($data["sal_id"] == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Please enter salon",
                "error_type" => 1,

            ));
            return;
        }

        $data1 = array(
            "steps" => "8",
        );

        $this->db->insert('sal_services', $data);
        $this->db->where('sal_id', $user_logged->sal_id)->update('salons', $data1);

        $id = $this->db->insert_id();
        $this->print_salon_data($user_logged->sal_id);

        $rand = 1234;

    }

    public function del_salon_service()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user_logged = $this->do_auth_salon($post);
        $this->db->where("id", $post->id)->delete('sal_services');
        $count = $this->db->query("SELECT count(*) as count FROM sal_services where sal_id = ? ", [$user_logged->sal_id])->result_object()[0];
        if (count == 0) {
            $data1 = array(
                "steps" => "7",
            );
            $this->db->where('sal_id', $user_logged->sal_id)->update('salons', $data1);
        }
        $this->print_salon_data($user_logged->sal_id);

    }

    public function update_salon()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user_logged = $this->do_auth_salon($post);
        $data = array(
            "sal_pic" => $post->sal_pic,
            "steps" => $post->step,
            "sal_profile_pic" => $post->sal_profile_pic,
            "payment_method" => $post->payment_method,
        );

        $this->db->where("sal_id", $user_logged->sal_id)->update("salons", $data);
        $this->print_salon_data($user_logged->sal_id);

    }

    public function check_sal_email_exists()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
            // test comment
        }

        $does_email_exists = $this->db->where('sal_email', $post->sal_email)->count_all_results('salons') > 0 ? true : false;
        if ($does_email_exists) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Email already exists, please choose different one",
                "error_type" => 1,
            ));
            exit;
        } else {
            echo json_encode(array(
                "action" => "success",
            ));
        }
    }

    private function make_salons_b($salons)
    {
        $data;
        $i = 0;
        foreach ($salons as $salon) {
            $data[$i] = [
                "sal_id" => $salon->sal_id,
                "sal_name" => $salon->sal_name,
                "sal_contact_person" => $salon->sal_contact_person,

                "sal_address" => $salon->sal_address,
                "sal_city" => $salon->sal_city,
                "sal_country" => $salon->sal_country,
                "sal_zip" => $salon->sal_zip,
                "sal_lat" => $salon->sal_lat,
                "sal_lng" => $salon->sal_lng,
                "sal_state" => $salon->sal_state,

                "sal_reviews" => $salon->sal_reviews,
                "sal_rating" => $salon->sal_rating,
                "sal_website" => $salon->sal_website,
                "sal_search_words" => $salon->sal_search_words,
                "sal_description" => $salon->sal_description,
                "sal_type" => $salon->sal_type,

                // "token" => $salon->api_logged_sess,
                "sal_email" => $salon->sal_email,
                "sal_pic" => withUrl($salon->sal_pic),
                "sal_profile_pic" => withUrl($salon->sal_profile_pic),
                "sal_phone" => $salon->sal_phone ? $salon->sal_phone : "",
                "sal_created_datetime" => $salon->sal_created_datetime,
                "is_fav" => $salon->is_fav,
                // "step" => $salon->steps,
                "sal_hours" => unserialize($salon->sal_hours),
                "sal_services" => $salon->sal_services,
            ];
            $i++;
        }
        return $data;
        // echo json_encode(array(
        //     "action" => "success",
        //     "data" => $data,
        // ));
    }

    public function get_salons()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user = $this->do_auth($post);

        if ($post->search_keyword) {
            $salons = $this->db->query("SELECT * FROM salons WHERE sal_search_words LIKE '%" . $post->search_keyword . "%'")->result_object();
            $data = $salons;

            $i = 0;
            foreach ($salons as $salon) {
                $data[$i]->sal_services = $this->db->query("SELECT * FROM sal_services WHERE sal_id = ? ", [$salon->sal_id])->result_object();
                $i++;
            }
            $data = $this->make_salons_b($data);
            echo json_encode(array(
                "action" => "success",
                "data" => $data,
            ));

        } else {
            // foreach ($sal_mens as $sal_men) {

            //     $sal_mens_final[$i]->sal_services = $this->db->query("SELECT * FROM sal_services WHERE sal_id = ? ", [$sal_men->sal_id])->result_object();
            //     $i++;
            // }
            // $sal_mens_final = $sal_mens;
            // $sal_womens = $this->db->query("SELECT s.*,count(fav_id) as is_fav FROM salons s LEFT JOIN favourites f ON (s.sal_id = f.sal_id and f.user_id = ?) WHERE sal_type = 'women' ", [$user->id])->result_object();
            // $sal_womens_final = $sal_womens;
            // $i = 0;

            // foreach ($sal_womens as $sal_women) {
            //     $sal_womens_final[$i]->sal_services = $this->db->query("SELECT * FROM sal_services WHERE sal_id = ? ", [$sal_women->sal_id])->result_object();
            //     $i++;
            // }

            $salons = $this->db->query("SELECT s.*, count(f.fav_id) as is_fav FROM salons s LEFT JOIN favourites f  ON (s.sal_id = f.sal_id and f.user_id = ?)  ", [$user->id])->result_object();
            $salon_f = $salons;
            $sal_mens_final;
            $sal_womens_final;
            $i = 0;
            foreach ($salons as $salon) {
                $salon_f[$i]->sal_services = $this->db->query("SELECT * FROM sal_services WHERE sal_id = ? ", [$salon->sal_id])->result_object();
                if ($salon->sal_type == 'Men') {
                    $sal_mens_final[$i] = $salon_f[$i];

                } else {
                    $sal_womens_final[$i] = $salon_f[$i];
                }
                $i++;
            }

            $sal_mens_final = $this->make_salons_b($sal_mens_final);
            $sal_womens_final = $this->make_salons_b($sal_womens_final);
            $recommended = array();

            $final = array(
                "mens" => $sal_mens_final,
                "womens" => $sal_womens_final,
                "recommended" => $recommended,
            );

            echo json_encode(array(
                "action" => "success",
                "data" => $final,
            ));
        }

    }

    public function update_password()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user_logged = $this->do_auth($post);

        $cupass = $this->db
            ->where("id", $user_logged->id)
            ->where("password", md5($post->cupassword))
            ->get("users")->result_object()[0];
        // $cupass = $this->db->query("SELECT * FROM users WHERE password = ? ", [$post->cupassword]);
        $temp = md5('25d55ad283aa400af464c76d713c07ad');
        if (!$cupass) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Current password is incorrect",
                "pass" => $temp,
            ));
            return;
        }

        $data = array(
            "password" => md5($post->password),
        );
        // $this->db->query("UPDATE users SET password = ? WHERE id = ? ", [$post->password, $user_logged->id]);
        $this->db->where("id", $user_logged->id)->update('users', $data);

        $this->print_user_data($user_logged->id);
    }

    public function terms_and_services()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user_logged = $this->do_auth($post);
        $resp = $this->db
            ->where("name", 'terms_of_services')
            ->get("configs")->result_object()[0];

        echo json_encode(array(
            "action" => "success",
            "data" => $resp->value,
        ));

    }

    public function edit_profile()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user_logged = $this->do_auth($post);

        $exists = $this->db->where("username", $post->username)->where("id !=", $user_logged->id)->count_all_results("users");
        if ($exists > 0) {
            echo json_encode(array("action" => "failed", "error" => "Username is already taken"));
            return;
        }

        $data = array(
            "username" => $post->username,
            "phone" => $post->phone,
        );

        if ($post->profile_pic != "") {
            $data["profile_pic"] = $post->profile_pic;
        }

        $this->db->where("id", $user_logged->id)->update('users', $data);
        $this->print_user_data($user_logged->id);
    }

    public function do_fav_salon()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user_logged = $this->do_auth($post);
        $data = array(
            "user_id" => $user_logged->id,
            "sal_id" => $post->sal_id,
        );

        if (!$data["user_id"]) {
            echo json_encode(array("action" => "failed", "error" => "missing user_id"));
            return;
        }

        if (!$data["sal_id"]) {
            echo json_encode(array("action" => "failed", "error" => "missing sal_id"));
            return;
        }
        $fav = $this->db
            ->where("sal_id", $data["sal_id"])
            ->where("user_id", $data["user_id"])
            ->get("favourites")->result_object()[0];
        $done = 1;
        if (!$fav) {
            $user = $this->db->query("SELECT count(*) as count FROM users WHERE id = ? ", [$data["user_id"]])->result_object()[0];
            if ($user->count == 0) {
                echo json_encode(array("action" => "failed", "error" => "no user exists against this id"));
                return;
            }
            $salon = $this->db->query("SELECT count(*) as count FROM salons WHERE sal_id = ? ", [$post->sal_id])->result_object()[0];
            if ($salon->count == 0) {
                echo json_encode(array("action" => "failed", "error" => "no salon exists against this id"));
                return;
            }
            $this->db->insert("favourites", $data);
        } else {
            $this->db->query("DELETE FROM favourites WHERE fav_id =  ?", [$fav->fav_id]);
            $done = 0;
        }

        echo json_encode(array(
            "action" => "success",
            "done" => $done,
        ));

    }

    public function get_favs()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user_logged = $this->do_auth($post);
        $salons = $this->db->query("SELECT f.sal_id, f.user_id, s.* FROM favourites f INNER JOIN salons s ON f.sal_id = s.sal_id   WHERE user_id = ? ", [$user_logged->id])->result_object();
        $i = 0;
        $sal_womens_final = $salons;
        foreach ($salons as $salon) {
            $sal_womens_final[$i]->sal_services = $this->db->query("SELECT * FROM sal_services WHERE sal_id = ? ", [$salon->sal_id])->result_object();
            $i++;
        }
        $sal_womens_final = $this->make_salons_b($sal_womens_final);

        echo json_encode(array("action" => "success", "data" => $sal_womens_final));

    }

    // ///// salon apis

    public function send_otp()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $country_code = $post->c_code;
        $phone = $post->phone;
        if (substr($phone, 0, 1) == "0") {
            $phone = ltrim($phone, '0');
        }

        $to = "+" . ((string) $country_code) . $phone;

        // Your Account SID and Auth Token from twilio.com/console
        $twillio_db = $this->db->where("id", 1)->get("settings")->result_object()[0];
        $sid = $twillio_db->twillio_pub;
        $token = $twillio_db->twillio_sec;

        $twilio = new Client($sid, $token);

        try {

            $service = $twilio->verify->v2->services
                ->create(settings()->site_title . " verification service");

            $verification = $twilio->verify->v2->services($service->sid)
                ->verifications
                ->create($to, "sms");

        } catch (Exception $e) {
            echo json_encode(array("action" => "failed", "err" => "Sorry, twillio seems busy"));
            return;
        }

        $this->db->where(array("code" => $post->c_code, "phone" => $post->phone))->delete("temp_phones");
        $this->db->insert("temp_phones",
            array(
                "sid" => $service->sid,
                "code" => $post->c_code,
                "phone" => $post->phone,
                "code_text" => $post->c_code_text,
            )
        );

        echo json_encode(array("action" => "success", "slip" => $this->db->insert_id()));

    }

    // public function resend_otp()
    // {
    //     $post = json_decode(file_get_contents("php://input"));
    //     if(empty($post))
    //     $post = (object) $_POST;

    //     $user = $this->do_auth($post);

    //     $sid = $user->sid;

    //     if(!$sid)
    //     {
    //         echo json_encode(array("action"=>"failed","err"=>"Invalid request"));
    //         return;
    //     }

    //     $country_code = $user->country_code;
    //     $phone =$user->phone;

    //     $to = "+" . ( (string) $user->country_code) . $user->phone;

    //     // Your Account SID and Auth Token from twilio.com/console
    //     $twillio_db = $this->db->where("id",1)->get("settings")->result_object()[0];
    //     $sid = $twillio_db->twillio_pub;
    //     $token = $twillio_db->twillio_sec;

    //     $twilio = new Client($sid, $token);

    //     try{

    //     $service = $twilio->verify->v2->services
    //                                   ->create("Cute Shop verification service");

    //     $verification = $twilio->verify->v2->services($service->sid)
    //                                ->verifications
    //                                ->create($to, "sms");
    //     }
    //     catch(Exception $e)
    //     {
    //         echo json_encode(array("action"=>"failed","err"=>"Sorry, twillio seems busy"));
    //         return;
    //     }
    //     $this->db->where( array("code"=>$post->c_code,"phone"=>$post->phone))->delete("temp_phones");
    //     $this->db->insert("temp_phones",
    //         array(
    //             "sid"=>$service->sid,
    //             "code"=>$post->c_code,
    //             "phone"=>$post->phone,
    //             "code_text"=>$post->c_code_text
    //         )
    //     );

    //     echo json_encode(array("action"=>"success","slip"=>$this->db->insert_id()));

    // }

    public function verify_otp()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $slip = $post->slip;

        $temp_phone = $this->db->where("id", $slip)->get("temp_phones")->result_object()[0];

        $s_id = $temp_phone->sid;
        $code = $post->code;

        if (!$s_id) {
            echo json_encode(array("action" => "failed", "err" => "Invalid request"));
            return;
        }

        $twillio_db = $this->db->where("id", 1)->get("settings")->result_object()[0];
        $sid = $twillio_db->twillio_pub;
        $token = $twillio_db->twillio_sec;
        $twilio = new Client($sid, $token);

        try {

            $verification_check = $twilio->verify->v2->services($s_id)
                ->verificationChecks
                ->create($code, array('to' => '+' . $temp_phone->code . $temp_phone->phone));
        } catch (Exception $e) {
            echo json_encode(array("action" => "failed", "err" => "Invalid request, catch"));
            return;
        }

        if ($verification_check->status == "approved") {

            $user = $this->db->where(array("code" => $temp_phone->code, "phone" => $temp_phone->phone))->get("users")->result_object()[0];

            if (!$user) {
                $arr = array(
                    "code" => $temp_phone->code,
                    "phone" => $temp_phone->phone,
                    "code_text" => $temp_phone->code_text,
                    "is_guest" => 0,
                );

                if ($post->is_guest == 1) {
                    $user_logged = $this->do_auth($post);
                    $this->db->db->where("id", $user_logged->id)->update("users", $arr);

                    $user_id = $user_logged->id;
                } else {
                    $this->db->insert("users", $arr);

                    $user_id = $this->db->insert_id();
                }

            } else {
                $user_id = $user->id;
            }
            $this->db->where(array("code" => $temp_phone->c_code, "phone" => $temp_phone->phone))->delete("temp_phones");

            $this->do_sure_login($user_id);
        } else {
            echo json_encode(array("action" => "failed", "err" => "Invalid code"));
            return;
        }
    }

    public function update_account()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $data = array(
            "first_name" => $post->fname,
            "last_name" => $post->lname,
            "phone" => $post->phone,
            "street" => $post->street,
            "city" => $post->city,
            "zip" => $post->zip,
        );
        $this->db->where("id", $user_logged->id)->update('users', $data);

        $this->print_user_data($user_logged->id);
    }

    public function report_post()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $data = array(
            "post_id" => $post->id,
            "report" => $post->report_text,
            "type" => "POST",
            "user_id" => $user_logged->id,
        );
        $this->db->insert('reports', $data);

//         $settings = settings();

//         $final = "<b>Reports</b>:\n";
        //         $rport = (array) $post->reportTypes;
        //         $keys = array_keys($rport);
        //         $i = 1;
        //         foreach($keys as $key)
        //         {
        //             if($rport[$key]->selected)
        //             {

//                 $final .= ($i. " "). $rport[$key]->title . " \n";
        //                 $i++;
        //             }
        //         }

//         $final .= "<b>User</b>: ".$user_logged->username."\n";
        //         $final .= "<b>Post ID</b>: ".$post->id."";

//          $this->load->library('email');
        //          $this->email->set_mailtype("html");
        //          $this->email->from(settings()->email, 'Heresay');
        //          $this->email->to($post->email);

//          $this->email->subject("Report");
        //          $this->email->message($final);

//          $x = $this->email->send();

// //      mail($settings->email,"Post Report",$final);

        echo json_encode(array("action" => "success"));
    }

    public function delete_post()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $data = array(
            "id" => $post->id,
            "user_id" => $user_logged->id,
        );
        $this->db->delete('posts', $data);

        echo json_encode(array("action" => "success"));
    }

    public function contact_us()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $data = array(
            "name" => $post->name,
            "email" => $post->email,
            "phone" => $post->phone,
            "des" => $post->des,
            "issue" => $post->issue,
            "created_at" => date("Y-m-d H:i:s"),
            "user_id" => $user_logged->id,
        );

        $this->db->insert('issues', $data);
        echo json_encode(array("action" => "success"));
    }

    public function get_keys()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        // $my_keys = $this->db->where("user_id",$user_logged->id)->get("user_keys")->result_object();
        $my_keys = $this->db->where("user_id", $user_logged->id)->get("user_keys")->result_object();

        foreach ($my_keys as $index => $my_key) {
            $the_real_key = $this->db->where("id", $my_key->key_id)->get("keyys")->result_object()[0];
            // if(!$the_real_key)
            // {
            //     unset($my_keys[$index]);
            //     continue;
            // }
            $my_keys[$index] = $this->b_key($the_real_key);
        }
        echo json_encode(array("action" => "success", "keys" => $my_keys));
    }
    public function get_sub_posts()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $page = $post->page > 0 ? $post->page : 1;
        $limit = $post->limit > 0 ? $post->limit : 10;

        $list_id = $post->id;

        $q = "select
        posts.*,
        users.username,
        users.profile_pic,
        categories.title as cat_title,
        lists.title as list_title,
        count(DISTINCT comments.id) as 'comments_count'
        from posts


        join users on users.id=posts.user_id
        join categories on categories.id  = posts.cat_id
        join lists on lists.id = posts.list_id
        left join comments on comments.post_id=posts.id

        where posts.status=1
        and posts.is_deleted=0
        and posts.list_id=$list_id
        and lists.status=1
        and categories.status=1


        group by posts.id
        order by posts.points desc
        ";
        if ($page != 0) {
            $page--;
        }

        $nextPage = $page + 1;
        $nextOffset = $nextPage * $limit;
        $cq = $q . " limit $nextOffset,$limit";

        $more_available = count($this->db->query($cq)->result_object()) > 0;

        $offset = $page * $limit;
        $q = $q . " limit $offset,$limit";

        $cats = $this->db->query($q)->result_object();
        $final = $this->bposts($cats, $user_logged);

        echo json_encode(array("action" => "success", "posts" => $final, "more_available" => $more_available));
    }

    public function get_ranked_posts()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $page = $post->page > 0 ? $post->page : 1;
        $limit = $post->limit > 0 ? $post->limit : 10;

        $list_id = $post->id;

        $q = "SELECT
        posts.*,
        users.username,
        users.profile_pic,
        categories.title as cat_title,
        lists.title as list_title,
        count(DISTINCT comments.id) as 'comments_count',
        count(DISTINCT likes.id) as likes_count," .
        $user_logged->id . " = likes.user_id as is_liked
        from posts


        join users on users.id=posts.user_id
        join categories on categories.id  = posts.cat_id

        join lists on lists.id = posts.list_id
        left join comments on comments.post_id=posts.id
        left join likes on likes.post_id = posts.id

        where posts.status=1
        where posts.points>0
        and posts.is_deleted=0
        and posts.cat_id=$list_id
        and lists.status=1
        and categories.status=1


        group by posts.id
        order by posts.points desc
        limit 20
        ";
        if ($page != 0) {
            $page--;
        }

        $nextPage = $page + 1;
        $nextOffset = $nextPage * $limit;
        $cq = $q . " limit $nextOffset,$limit";

        $more_available = count($this->db->query($cq)->result_object()) > 0;

        $offset = $page * $limit;
        $q = $q . " limit $offset,$limit";

        $cats = $this->db->query($q)->result_object();
        $final = $this->bposts($cats, $user_logged);

        echo json_encode(array("action" => "success", "posts" => $final, "more_available" => $more_available));
    }

    public function get_categories()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $page = $post->page > 0 ? $post->page : 1;
        $limit = $post->limit > 0 ? $post->limit : 10;

        $q = "select
        categories.*,
        cfollowers.user_id as follower_user_id
        from categories

        left join cfollowers on cfollowers.cat_id=categories.id and cfollowers.user_id=$user_logged->id

        where categories.status=1
        and categories.is_deleted=0

        order by display_priority asc
        ";
        if ($page != 0) {
            $page--;
        }

        $nextPage = $page + 1;
        $nextOffset = $nextPage * $limit;
        $cq = $q . " limit $nextOffset,$limit";

        $more_available = count($this->db->query($cq)->result_object()) > 0;

        $offset = $page * $limit;
        $q = $q . " limit $offset,$limit";

        $cats = $this->db->query($q)->result_object();
        $final = $this->bcats($cats, $user_logged);

        echo json_encode(array("action" => "success", "cats" => $final, "moreCats" => $more_available));
    }

    public function get_categories_all()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $page = $post->page > 0 ? $post->page : 1;
        $limit = $post->limit > 0 ? $post->limit : 10;

        $q = "select
        categories.*,
        cfollowers.user_id as follower_user_id
        from categories

        left join cfollowers on cfollowers.cat_id=categories.id and cfollowers.user_id=$user_logged->id

        where categories.status=1
        and categories.is_deleted=0

        order by display_priority asc
        ";
        if ($page != 0) {
            $page--;
        }

        $nextPage = $page + 1;
        $nextOffset = $nextPage * $limit;
        $cq = $q . " limit $nextOffset,$limit";

        $more_available = count($this->db->query($cq)->result_object()) > 0;

        $offset = $page * $limit;
        $q = $q . " limit $offset,$limit";

        $cats = $this->db->query($q)->result_object();
        $final = $this->bcats($cats, $user_logged);

        echo json_encode(array("action" => "success", "cats" => $final, "moreCats" => $more_available));
    }

    private function get_lists($id, $user_logged, $thepage = 1, $thelimit = 100)
    {

        $page = $thepage > 0 ? $thepage : 1;
        $limit = $thelimit > 0 ? $thelimit : 100;

        $q = "select
        lists.*,
        lfollowers.user_id as follower_user_id
        from lists

        left join lfollowers on lfollowers.list_id=lists.id and lfollowers.user_id=$user_logged->id

        where lists.status=1
        and lists.is_deleted=0
        and lists.cat_id = $id

        order by display_priority asc
        ";
        if ($page != 0) {
            $page--;
        }

        $nextPage = $page + 1;
        $nextOffset = $nextPage * $limit;
        $cq = $q . " limit $nextOffset,$limit";

        $more_available = count($this->db->query($cq)->result_object()) > 0;

        $offset = $page * $limit;
        $q = $q . " limit $offset,$limit";

        $cats = $this->db->query($q)->result_object();
        $final = $this->bcats($cats, $user_logged);

        return [$final, $more_available];
    }

    private function bcats($cats, $user_logged)
    {

        $to_return = array();

        foreach ($cats as $cat) {
            $theListsObj = $this->get_lists($cat->id, $user_logged);
            $color = $this->db->where("id", $cat->color_id)->get("colors")->result_object()[0];

            if (!$color) {
                $fcolor = $cat->forground_color != "" ? $cat->forground_color : "#000";
                $bcolor = $cat->background_color != "" ? $cat->background_color : "#fff";
            } else {
                $fcolor = $color->forground_color != "" ? $color->forground_color : "#000";

                $bcolor = $color->background_color != "" ? $color->background_color : "#000";
            }
            $to_return[] = array(
                "id" => $cat->id,
                "title" => $cat->title,
                "fcolor" => $fcolor,
                "bcolor" => $bcolor,
                "do_i_follow" => $cat->follower_user_id > 0,
                "expanded" => false,
                "posts" => array(),
                "posts_loaded" => false,
                "posts_loading" => true,
                "is_error" => false,
                "more_posts" => false,
                "lists" => $theListsObj[0],
                "more_lists" => $theListsObj[1],
                "error_text" => "",
            );
        }

        return $to_return;
    }

    private function bposts($posts, $user_logged)
    {

        $to_return = array();

        foreach ($posts as $post) {
            $i_liked = $this->db->where("user_id", $user_logged->id)->where("post_id", $post->id)->count_all_results("likes");
            $cannotVote = $this->db->where("user_id", $user_logged->id)->where("post_id", $post->id)->count_all_results("votes");

            $to_return[] = array(
                "id" => $post->id,
                "title" => $post->title,
                "image" => withUrl($post->image),
                "ago" => ago($post->created_at),
                "cat_id" => $post->cat_id,
                "cat_title" => $post->cat_title,
                "list_id" => $post->list_id,
                "list_title" => $post->list_title,
                "description_expanded" => false,
                "comments_expanded" => false,
                "comments_count" => $post->comments_count,
                "likes_count" => $post->likes_count,
                // "is_liked" => $post->is_liked,
                "i_liked" => $i_liked > 0 ? 1 : 0,
                "cannotVote" => $cannotVote > 0,
                "user" => array(
                    "id" => $post->user_id,
                    "name" => $post->username,
                    "profile_pic" => withUrl($post->profile_pic),
                ),
            );
        }

        return $to_return;
    }

    private function blists($lists, $user_logged)
    {

        $to_return = array();

        foreach ($lists as $list) {
            $to_return[] = array(
                "id" => $list->id,
                "title" => $list->title,

                "do_i_follow" => $list->follower_user_id > 0,
                "expanded" => false,
                "posts" => array(),
                "posts_loaded" => false,
                "posts_loading" => true,
                "more_posts" => false,
                "is_error" => false,
                "error_text" => "",
            );
        }

        return $to_return;
    }

    public function follow_unfollow()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $id = $post->id;
        $action = $post->action == 1 ? 1 : 0;

        if ($action == 0) {
            $this->db->where("user_id", $user_logged->id)->where("cat_id", $id)->delete("cfollowers");
        } else {
            $this->db->insert("cfollowers", array(
                "user_id" => $user_logged->id,
                "cat_id" => $id,
                "created_at" => date("Y-m-d H:i:s"),
            ));
        }

        echo json_encode(array("action" => "success"));
    }

    public function follow_unfollow_list()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $id = $post->id;
        $action = $post->action == 1 ? 1 : 0;

        if ($action == 0) {
            $this->db->where("user_id", $user_logged->id)->where("list_id", $id)->delete("lfollowers");
        } else {
            $this->db->insert("lfollowers", array(
                "user_id" => $user_logged->id,
                "list_id" => $id,
                "created_at" => date("Y-m-d H:i:s"),
            ));
        }

        echo json_encode(array("action" => "success"));
    }

    public function create_list()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $this->db->insert("lists", array(
            "user_id" => $user_logged->id,
            "cat_id" => $post->id,
            "title" => $post->title,
            "public" => $post->public == 1 ? 1 : 0,
            "created_at" => date("Y-m-d H:i:s"),
        ));

        $id = $this->db->insert_id();

        $this->db->insert("lfollowers", array(
            "user_id" => $user_logged->id,
            "list_id" => $id,
            "created_at" => date("Y-m-d H:i:s"),
        ));

        echo json_encode(array("action" => "success"));
    }

    public function do_vote()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $id = $post->id;
        $type = $post->type;

        $points = $type; // type 1 has 1 point, 2 has 2 and 3 has 3 points only.
        $post = $this->db->where("id", $id)->get("posts")->result_object()[0];
        if (!$post) {
            echo json_encode(array("action" => "failed", "error" => "Invalid request"));

            return;
        }

        $this->db->insert("votes", array(
            "user_id" => $user_logged->id,
            "post_id" => $id,
            "type" => $type,
            "points" => $points,
            "created_at" => date("Y-m-d H:i:s"),
        ));

        $updates = array("points" => ($post->points + $points));

        if ($type == 1) {
            $updates["a_points"] = $post->a_points + $points;
        }

        if ($type == 2) {
            $updates["b_points"] = $post->b_points + $points;
        }

        if ($type == 3) {
            $updates["c_points"] = $post->c_points + $points;
        }

        $this->db->where("id", $id)->update("posts", $updates);

        echo json_encode(array("action" => "success"));
    }

    public function get_votes()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $id = $post->id;

        $post = $this->db->where("id", $id)->get("posts")->result_object()[0];

        if (!$post) {
            echo json_encode(array("action" => "failed", "error" => "Invalid request"));

            return;
        }
        $updates = array("points" => (int) $post->points);

        $min_width = 15;

        $pointss = $post->a_points;
        $width = $min_width;
        $width += ($post->a_points);
        if ($width > 100) {
            $width = 100;
        }

        $updates["one"] = array(
            "points" => (int) $this->db->where("post_id", $post->id)->where("type", 1)->count_all_results("votes"),
            "width" => $width,
        );

        $pointss = $post->b_points;
        $width = $min_width;
        $width += ($post->b_points);
        if ($width > 100) {
            $width = 100;
        }

        $updates["two"] = array(
            "points" => (int) $this->db->where("post_id", $post->id)->where("type", 2)->count_all_results("votes"),
            "width" => $width,
        );

        $pointss = $post->c_points;
        $width = $min_width;
        $width += ($post->c_points);
        if ($width > 100) {
            $width = 100;
        }

        $updates["three"] = array(
            "points" => (int) $this->db->where("post_id", $post->id)->where("type", 3)->count_all_results("votes"),
            "width" => $width,
        );

        echo json_encode(array("action" => "success", "data" => array(
            "votes" => $updates,
        )));
    }

    public function create_post()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $this->db->insert("posts", array(
            "user_id" => $user_logged->id,
            "cat_id" => $post->id,
            "list_id" => $post->list_id,
            "title" => $post->title,
            "image" => $post->file,
            "created_at" => date("Y-m-d H:i:s"),
        ));

        $id = $this->db->insert_id();
        $posts = $this->db->where("id", $id)->get("posts")->result_object();

        $fposts = $this->bposts($posts, $user_logged);

        echo json_encode(array("action" => "success", "post" => $fposts[0]));
    }

    // code by mughees
    public function save_post()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $thePost = array(
            "user_id" => $user_logged->id,
            "post_id" => $post->id,
        );
        $this->db->where($thePost)->delete("saved_posts");

        $this->db->insert("saved_posts", $thePost);

        echo json_encode(array("action" => "success"));
    }

    public function get_profile_tabs()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);
        $thePost = array(
            "user_id" => $user_logged->id,
        );
        try {
            $data;
            $saved_posts = $this->db->query("SELECT * FROM saved_posts s INNER JOIN posts p ON s.post_id = p.id WHERE s.user_id = ? ", [$thePost])->result_object();
            $posts = $this->db->query("SELECT * FROM posts WHERE user_id = ? and is_deleted = 0 ", [$thePost])->result_object();
            $lists = $this->db->query("SELECT * FROM lists WHERE user_id = ? ", [$thePost])->result_object();

            $posts = $this->bposts($posts, $user_logged);
            $saved_posts = $this->bposts($saved_posts, $user_logged);

            // $image = withUrl($posts->image);
            $data->saved_posts = $saved_posts;
            $data->posts = $posts;
            $data->lists = $lists;

        } catch (Exception $e) {

        }

        echo json_encode(array(
            "action" => "success",
            "data" => $data,
        ));
    }

    public function get_saved_posts()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);
        $thePost = array(
            "user_id" => $user_logged->id,
        );
        // $query = $this->db->where($thePost)->get("saved_posts")->result_object();
        // $query = $this->db->query("SELECT * FROM saved_posts WHERE user_id = ? ",[$thePost]);
        $query = $this->db->query("SELECT * FROM saved_posts s INNER JOIN posts p ON s.post_id = p.id WHERE s.user_id = ? ", [$thePost])->result_object();
        // $data = [];
        // $i = 0;
        // foreach ($query->result_array() as $row) {
        //     $data[$i] = $row;
        //     $i++;
        // }
        echo json_encode(array(
            "action" => "success",
            "data" => $query,
        ));
    }

    public function get_user_post()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        if (!strlen($post->id)) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "missing post id",
            ));
            return;
        }

        $user_logged = $this->do_auth($post);

        // $page = $post->page > 0 ? $post->page : 1;
        // $limit = $post->limit > 0 ? $post->limit : 10;

        $list_id = $post->id;

        $q = "SELECT
        posts.*,
        users.username,
        users.profile_pic,
        categories.title as cat_title,
        lists.title as list_title,
        count(DISTINCT comments.id) as 'comments_count'
        from posts


        join users on users.id=posts.user_id
        join categories on categories.id  = posts.cat_id
        join lists on lists.id = posts.list_id
        left join comments on comments.post_id=posts.id

        where posts.id =?
        ";

        $cats = $this->db->query($q, [$post->id])->result_object();
        if (strlen($cats[0]->id)) {
            $final = $this->bposts($cats, $user_logged);
        } else {
            echo json_encode(array(
                "action" => "failed",
                "posts" => []
            ));
            return;
        }

        echo json_encode(array(
            "action" => "success",
            "posts" => $final,
            "data" => $cats,
        ));
    }

    public function like_post()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $fav = $this->db->where("post_id", $post->post_id)->where("user_id", $user_logged->id)->get("likes")->result_object()[0];
        $done = 1;
        if (!$fav) {
            $this->db->insert("likes", array(
                "post_id" => $post->post_id,
                "user_id" => $user_logged->id,
            ));
            echo json_encode(array("action" => "success", "done" => $done));
        } else {
            $this->db->query("DELETE FROM likes WHERE user_id = ?", [$user_logged->id]);
            echo json_encode(array("action" => "success", "done" => $done));
        }

    }

    public function install_guest()
    {

        // echo json_encode(array("action"=>"success","done"=>'done'));
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $data = array(
            "name" => "New User",
            "phone" => "",
            "email" => time() . rand(111, 999) . time() . "@creamapp.com",
            "password" => md5(time() . "kauye" . time() . rand(222, 9393)),
            "created_at" => date("Y-m-d H:i:s"),
            "is_guest" => 1,
        );

        $this->db->insert('users', $data);
        $id = $this->db->insert_id();

        $rand = 1234;

        $this->do_sure_login($id);
    }

    // public function delete_post()
    // {
    //     $post = json_decode(file_get_contents("php://input"));
    //     if (empty($post)) {
    //         $post = (object) $_POST;
    //     }
    //     $user_logged = $this->do_auth($post);
    //     try {
    //         $query = $this->db->query("UPDATE posts SET is_deleted = 1 WHERE id = ? ", [$post->post_id]);
    //     } catch (Exception $e) {
    //         echo json_encode(array(
    //             "action" => "error",
    //             "error" => $e,
    //         ));
    //     }
    //     echo json_encode(array(
    //         "action" => "success",

    //         "thePost->post_id" => $post->post_id,
    //         "query" => $query
    //     ));

    // }

    // <---!--->

    public function mark_survey_done()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $filled_survey = $this->db->where("id", $post->survey_id)->get("surveys")->result_object()[0];
        $already_filled = $this->db->where("survey_id", $post->survey_id)->where("user_id", $user_logged->id)->get("filled_surveys")->result_object()[0];
        if ($filled_survey && !$already_filled) {

            $fill = array(
                "status" => 0,
                "user_id" => $user_logged->id,
                "survey_id" => $post->survey_id,
                "key_id" => $post->key_id,
                "created_at" => date("Y-m-d H:i:s"),
            );

            $this->db->insert("filled_surveys", $fill);
        }

        $searched_keys = $this->db->where("key_id", $post->key_id)->get("survey_keys")->result_object();

        $searched_keys_index = array(-1);

        foreach ($searched_keys as $searched_key) {
            $searched_keys_index[] = $searched_key->survey_id;
        }

        $surveys = $this->db->where_in("id", $searched_keys_index)
            ->where("status", 1)
            ->where("is_deleted", 0)
            ->get("surveys")->result_object();

        foreach ($surveys as $index => $my_key) {

            $surveys[$index] = $this->b_survey($my_key, $user_logged->id);
        }
        echo json_encode(array("action" => "success", "keys" => $surveys));
    }

    public function get_surveys()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $searched_keys = $this->db->where("key_id", $post->key_id)->get("survey_keys")->result_object();

        $searched_keys_index = array(-1);

        foreach ($searched_keys as $searched_key) {
            $searched_keys_index[] = $searched_key->survey_id;
        }

        $surveys = $this->db->where_in("id", $searched_keys_index)
            ->where("status", 1)
            ->where("is_deleted", 0)
            ->get("surveys")->result_object();

        foreach ($surveys as $index => $my_key) {

            $surveys[$index] = $this->b_survey($my_key, $user_logged->id);
        }
        echo json_encode(array("action" => "success", "keys" => $surveys));
    }

    public function get_notifs()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $surveys = $this->db->where("user_id", $user_logged->id)
            ->get("user_notifs")->result_object();

        foreach ($surveys as $index => $survey) {

            $key = (Object) array();

            $key_db = $this->db->where("id", $survey->key_id)->get("keyys")->result_object()[0];

            $key->title = $key_db->title;
            $key->id = $survey->key_id;

            $surveys[$index]->key = $key;

        }

        echo json_encode(array("action" => "success", "notifs" => $surveys));
    }

    public function completed_surveys()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $searched_keys = $this->db->where("user_id", $user_logged->id)->get("filled_surveys")->result_object();

        $searched_keys_index = array(-1);

        foreach ($searched_keys as $searched_key) {
            $searched_keys_index[] = $searched_key->survey_id;
        }

        $surveys = $this->db->where_in("id", $searched_keys_index)
            ->where("status", 1)
            ->where("is_deleted", 0)
            ->get("surveys")->result_object();

        foreach ($surveys as $index => $my_key) {

            $surveys[$index] = $this->b_survey($my_key, $user_logged->id);
        }
        echo json_encode(array("action" => "success", "keys" => $surveys));
    }

    public function search_keys()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $this->db->where("status", 1);
        $this->db->where("is_deleted", 0);
        $this->db->like("LOWER(title)", strtolower($post->search));
        $searched_keys = $this->db->get("keyys")->result_object();

        // $searched_keys_index = array(-1);

        // foreach($searched_keys as $searched_key) $searched_keys_index[] = $searched_key->id;

        //->where("user_id",$user_logged->id)
        // $my_keys = $this->db->where_in("key_id",$searched_keys_index)->get("user_keys")->result_object();

        foreach ($searched_keys as $index => $my_key) {
            $searched_keys[$index] = $this->b_key($my_key);
        }
        echo json_encode(array("action" => "success", "keys" => $searched_keys));
    }
    public function attach_key()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        //
        $my_keys = $this->db->where("key_id", $post->key_id)->where("user_id", $user_logged->id)->get("user_keys")->result_object();

        $the_key = $this->db->where("id", $post->key_id)->get("keyys")->result_object()[0];
        if (count($my_keys) > 0) {

        } else {
            $this->db->insert("user_keys", array(
                "key_id" => $post->key_id,
                "user_id" => $user_logged->id,
                "search_elem" => $the_key->title,
            ));
        }

        echo json_encode(array('action' => "success"));

    }
    private function b_key($key)
    {
        $count = $this->db->where("key_id", $key->id)->count_all_results("survey_keys");
        $sub_title = $count . " total surveys";
        $key->sub_title = $sub_title;
        $key->key_id = $key->id;

        return $key;
    }

    private function b_survey($key, $user_id)
    {
        $sub_title = "Tap to expand";
        $key->sub_title = $sub_title;
        $key->status_text = $this->get_status($key->id, $user_id);
        $key->expanded = false;
        return $key;
    }

    private function get_status($id, $user_id)
    {
        $filled = $this->db->where("survey_id", $id)->where("user_id", $user_id)->get("filled_surveys")->result_object()[0];

        if ($filled) {

            if ($filled->status == 0) {
                return "Submitted";
            }

            if ($filled->status == 1) {
                return "Approved";
            }

            if ($filled->status == 2) {
                return "Rejected";
            }

        }

        return "Incomplete";
    }

    public function get_chat()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $chat = $this->db->where("user_id", $user_logged->id)->order_by("id", "DESC")->get("chat")->result_object();

        $msgs = array();

        if ($chat->sender_id == $user_logged->id) {
            $name = $user_logged->first_name . ' ' . $user_logged->last_name;
        } else {
            $name = "Admin";
        }

        foreach ($chat as $key => $value) {

            $msgs[] = array(
                "_id" => $value->id,
                "text" => $value->msg,
                "createdAt" => date("Y-m-d H:i:s", strtotime($value->created_at)),
                "user" => array(
                    "_id" => $value->sender_id,
                    "name" => $name,
                ),
            );
            # code...
        }

        echo json_encode(array("action" => "success", "data" => array(
            "messages" => $msgs,
        )));
    }

    public function send_msg()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $chat = array(
            "msg" => $post->msg,
            "sender_id" => $user_logged->id,
            "user_id" => $user_logged->id,
            "admin_id" => 1,
            "created_at" => date("Y-m-d H:i:s"),
        );

        $this->db->insert("chat", $chat);

        $id = $this->db->insert_id();

        $inserted_chat = $this->db->where("id", $id)->get("chat")->result_object()[0];

        $to_print = array(
            "_id" => $inserted_chat->id,
            "text" => $inserted_chat->msg,
            "createdAt" => date("Y-m-d H:i:s", strtotime($inserted_chat->created_at)),
            "user" => array(
                "_id" => $user_logged->id,
                "name" => $user_logged->first_name . ' ' . $user_logged->last_name,
            ),
        );
        echo json_encode(array("action" => "success", "data" => array(
            "to_print" => $to_print,
        )));
    }

    public function social_connect()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $data = array(

            "email" => $post->email,
            "name" => $post->name,
            "signup_type" => $post->type,
            "social_id" => $post->token,
            "password" => md5($post->username . time() . rand(05405, 4594059)),
            "created_at" => date("Y-m-d H:i:s"),

        );

        $already_user = $this->db->where('email', $data['email'])
            ->where('signup_type', $data['signup_type'])
            ->where('social_id', $data['social_id'])
            ->get('users')->result_object()[0];

        if ($already_user) {
            $this->do_sure_login($already_user->id, true);
            return;
        }

        $this->db->insert('users', $data);

        $id = $this->db->insert_id();

        $this->do_sure_login($id);
    }

    public function forgot_pw()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $email = $post->email;
        $user_logged = $this->db->where('email', $email)->get('users')->result_object();

        if (empty($user_logged)) {
            echo json_encode(array(
                "action" => "failed",
                "error" => "It seems this email is not registered with us",
                "email" => $email,
            ));
            return;
        }
        $user_logged = $user_logged[0];

        // print_r($post);exit;

        // print_r(file_get_contents("php://input"));exit;

        $new_pass = gen_rand(8);

        $mmmsg = "Hi " . $user_logged->username . ", your new password for Golf is: " . $new_pass;

        $this->load->library('email');

        $this->email->from(settings()->email, 'Golf');
        $this->email->to($post->email);

        $this->email->subject("Reset Password");
        $this->email->message($mmmsg);

        $x = $this->email->send();

        if ($x) {
            $this->db->where('id', $user_logged->id)->update('users', array("password" => md5($new_pass)));
        }

        echo json_encode(array("action" => "success", "error" => "Your password has been sent successfully", "q" => $this->db->last_query()));
        return;

    }

    public function do_store_notifiation_key()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $push_id = $post->notif_key;

        $user_logged = $this->do_auth($post);
        $data["push_id"] = $push_id;
        $this->db->where('id', $user_logged->id)->update('users', $data);
        echo json_encode(array("action" => "success", "error" => "Your push_id has been updated successfully", "q" => $this->db->last_query()));
        return;
    }

    private function currency()
    {
        $settings = $this->db->get("settings")->result_object()[0];

        return $settings->currency;
    }

    private function do_auth_salon($post)
    {
        $user =
        $this->db->where('api_logged_sess', $post->token)
            ->where('sal_status', 1)
            ->where('is_deleted', 0)
            ->get('salons')
            ->result_object();

        if (empty($user) || $post->token == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",
            ));
            exit;
        }

        return $user[0];
    }

    public function check_login()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user =
        $this->db->where('api_logged_sess', $post->token)
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->get('users')
            ->result_object();

        if (empty($user) || $post->token == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",
            ));
            exit;
        }
        $user = $user[0];

        $this->print_user_data($user->id);

    }

    public function check_login_vendor()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }
        $user = $this->db->where('api_logged_sess', $post->token)
            ->where('sal_status', 1)
            ->where('is_deleted', 0)
            ->get('salons')
            ->result_object();

        if (empty($user) || $post->token == "") {
            echo json_encode(array(
                "action" => "failed",
                "error" => "Invalid login credentials",
            ));
            exit;
        }
        $user = $user[0];

        $this->print_salon_data($user->sal_id);

    }

    public function public_image()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        // $user_logged = $this->do_auth($post);

        $final = $_FILES;
        $final_2 = $_POST;
        $final_3 = $post;

        $config['upload_path'] = './resources/uploads/public' . $post->path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {
            echo json_encode(array("action" => "failed", "error" => strip_tags($this->upload->display_errors())));
        } else {
            $data = $this->upload->data();

            // $image_data =   $this->upload->data();

            // $this->load->library('image_lib');
            // $configer =  array(
            //   'image_library'   => 'gd2',
            //   'source_image'    =>  $image_data['full_path'],
            //   'maintain_ratio'  =>  TRUE,
            //   'width'           =>  100,
            //   'height'          =>  100,
            // );
            // $this->image_lib->clear();
            // $this->image_lib->initialize($configer);
            // $this->image_lib->resize();

            // $this->db->where("id",$user_logged->id)->update("users",array("profile_pic"=>$data["file_name"]));

            echo json_encode(array(
                "action" => "success",
                "error" => "done",
                "filename" => $data["file_name"],
                "url" => withUrl($data["file_name"]),
            ));
        }
    }
    public function profile_pic()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $final = $_FILES;
        $final_2 = $_POST;
        $final_3 = $post;

        $config['upload_path'] = './resources/uploads/' . $post->path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {
            echo json_encode(array("action" => "failed", "error" => strip_tags($this->upload->display_errors())));
        } else {
            $data = $this->upload->data();

            $image_data = $this->upload->data();

            $this->load->library('image_lib');
            $configer = array(
                'image_library' => 'gd2',
                'source_image' => $image_data['full_path'],
                'maintain_ratio' => true,
                'width' => 500,
                'height' => 500,
            );
            $this->image_lib->clear();
            $this->image_lib->initialize($configer);
            $this->image_lib->resize();

            $this->db->where("id", $user_logged->id)->update("users", array("profile_pic" => $data["file_name"]));

            echo json_encode(array("action" => "success", "error" => "done", "filename" => $data["file_name"]));
        }
    }

    public function get_important_data()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $settings = $this->db->get("settings")->result_object()[0];

        $lang = $this->db->where('id', $post->clang)->where('status', 1)->get("languages")->result_object()[0];

        if (!$lang) {
            $lang = dlang();
        }

        $imp_data = array(
            "currency" => get_currency(),
            "currency_position" => $settings->currency_position,
            "currency_space" => $settings->currency_space,
            "shipping_fee" => $settings->shipping_fee,
            "tax" => $settings->tax,
            "snapchat" => $settings->snapchat,
            "instagram" => $settings->instagram,
            "support_page" => $settings->support_page,
            "langs" => langs(),
            "active_lang" => $lang,
        );

        echo json_encode(array("action" => "success",
            "data" => $imp_data));
    }

    public function get_profile()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $this->guest_id = $user_logged->id;
        $guest_id = $user_logged->id;
        $id = $post->id;

        $profile = $this->db->where("id", $id)->get("users")->result_object()[0];

        $profile = $this->b_profile($profile, $user_logged->id);

        $has_reqs = $this->db->where("status", 0)->where("follow_id", $user_logged->id)->count_all_results("followers");

        $profile->has_reqs = $has_reqs;

        $profile->recordings = $this->get_recordings($id);

        echo json_encode(array("action" => "success", "data" => array("profile" => $profile)));
    }

    public function get_page()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $this->db->where("slug", $post->slug);
        $this->db->where("status", 1);
        $this->db->where("is_deleted", 0);
        $page = $this->db->get('pages')->result_object()[0];
        $lang_page = $page;
        // if($page->lang_id!=$lang_id)
        // {
        //     $lang_page = $this->db->where("lparent",$page->id)->where("lang_id",$lang_id)->get("pages")->result_object()[0];
        // }
        $content = $lang_page->descriptions == "" ? $page->descriptions : $lang_page->descriptions;
        $content = strip_tags($content);
        $data = array(
            "title" => $lang_page->title == "" ? $page->title : $lang_page->title,
            "content" => $content,
        );
        echo json_encode(array("data" => $data, "action" => "success"));
    }

    public function post_comment()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        $new = array(
            "user_id" => $user_logged->id,
            "post_id" => $post->post_id,
            "text" => $post->text,
            "created_at" => date("Y-m-d H:i:s"),
            "parent" => $post->parent,
        );

        $this->db->insert("comments", $new);

        $post_object = $this->db->where("id", $post->post_id)->get("posts")->result_object()[0];
        $post_owner = $this->db->where("id", $post_object->user_id)->get("users")->result_object()[0];
        $pushId = $post_owner->push_id;
        $sendPush = false;
        if ($post_owner->push_id != "") {
            $sendPush = true;
        }

        if ($post_owner->id == $user_logged->id) {
            $sendPush = false;
        }

        if ($sendPush) {
            $by = $post_owner->id == $user_logged->id ? " You" : ($user_logged->name ?? $user_logged->username);
            $notif["data"] = (Object) array("post_id" => $post_object->id, "open" => "post");
            $notif["tag"] = "Updates";
            $notif["title"] = $by . " commented on your post";
            $notif["msg"] = $by . ': ' . $new["text"];

            try {
                $x = push_notif($pushId, $notif);
                $notif['data'] = json_encode($notif['data']);
                $notif["user_id"] = $post_owner->id;
                $notif["created_at"] = date("Y-m-d H:i:s");
                $this->db->insert("notifs", $notif);
            } catch (Exception $e) {
            }

        }

        $this->get_comments($user_logged, $post->post_id);
    }

    public function get_comments()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (empty($post)) {
            $post = (object) $_POST;
        }

        $user_logged = $this->do_auth($post);

        echo $this->do_get_comments($user_logged, $post->post_id);
    }

    private function get_last_comment($post_id, $user_logged)
    {
        $comment = $this->db->where("parent", 0)->where("post_id", $post_id)->order_by("id", "DESC")->get("comments")->result_object()[0];
        if ($comment) {
            $comm = $this->b_comment($comment, $user_logged);
            return $comm;

        }
        return false;
    }

    private function do_get_comments($user_logged, $post_id)
    {
        $comments = $this->db->where("parent", 0)->where("post_id", $post_id)->order_by("id", "ASC")->get("comments")->result_object();
        $final = array();
        foreach ($comments as $index => $comment) {

            $comm = $this->b_comment($comment, $user_logged);
            $comm->childs = $this->comment_childs($comment, $user_logged);
            $final[] = $comm;
        }
        return json_encode(array("action" => "success", "comments" => $final));
    }
    private function comment_childs($comment, $user_logged)
    {
        $comments = $this->db->where("parent", $comment->id)->get("comments")->result_object();
        $final = array();
        foreach ($comments as $index => $commentt) {

            $comm = $this->b_comment($commentt, $user_logged);
            $final[] = $comm;
        }

        return $final;
    }

    private function b_comment($comment, $user_logged)
    {
        $user = $this->db->where("id", $comment->user_id)->get("users")->result_object()[0];
        $to_return = (Object) array(
            "id" => $comment->id,
            "text" => $comment->text,
            "user" => $this->b_user($user, $user_logged),
            "ago" => ago($comment->created_at),
        );

        return $to_return;
    }

    private function b_user($user, $user_logged)
    {

        $user_final = array(
            "id" => $user->id,
            "name" => $user->name ? $user->name : "New User",
            "username" => $user->username ? $user->username : "user",

            "email" => $user->email,
            "profile_pic" => $user->profile_pic ? $user->profile_pic : "dummy_image.png",
            "profile_pic_url" => withUrl($user->profile_pic),
            "created_at" => $user->created_at,
        );
        return $user_final;
    }

}

// {

//     "user_id"  : "3"
//     "token" : "82427adecb9546cd2ffbe030ac9b4b15",
//     // "name" : "faisalff",
//     // "username" : "faisalf",
//     // "email" : "faisal@gmail.com",
//     // "password" : "12345678"
//     // "phone" : "03134081068",
//     // "address" : "Lahore"
// }
