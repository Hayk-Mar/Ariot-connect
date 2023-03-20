<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function selectInfo($table, $where = FALSE, $order = FALSE, $parent_option = FALSE, $array_keys = FALSE, $order_opt = 'DESC')
    {
        if (!empty($where)) $this->db->where($where);
        !empty($order) ? $this->db->order_by($order, $order_opt) : $this->db->order_by("id", "desc");

        $query = $this->db->get($table);

        $data = $query->result_array();
        $info = array();
        foreach ($data as $key) {
            if (empty($parent_option)) {
                $info[$key['id']] = $key;
                continue;
            } 

            if (!empty($array_keys)) {
                $info[$key[$parent_option]][] = $key;
                continue;
            }
             
            $info[$key[$parent_option]][$key['id']] = $key;
        }

        return $info;
    }

    function Select($table, $select, $where, $limit = FALSE, $order_opt = 'ASC', $order_field = FALSE, $get_first = FALSE)
    {
        if (!empty($select)) $this->db->select($select);
        if (!empty($order_field)) $this->db->order_by($order_field, $order_opt);

        $query = $this->db->get_where($table, $where, $limit);
        $result = $query->result_array();

        return $get_first && $result ? $result[0] : $result;
    }

    function selectIn($table, $select, $in_filde, $value)
    {
        if (!empty($select)) $this->db->select($select);

        $this->db->where_in($in_filde, $value);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function selectOrIn($table, $select, $in_or_filde, $value)
    {
        if (!empty($select)) $this->db->select($select);

        $this->db->or_where_in($in_or_filde, $value);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function selectLikeSearch($table, $select, $filde_array)
    {
        if (!empty($select)) $this->db->select($select);

        $this->db->like($filde_array);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function update($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        return TRUE;
    }

    function delete($table, $where)
    {
        $this->db->delete($table, $where);
        return TRUE;
    }

    public function upload_img_new($file, $uid, $name, $folder, $resize = FALSE, $copy = false)
    {
        $img_type = pathinfo($file[$name]['name'][0]);
        $img_type_result = $img_type['extension'];
        $valid_formats = array("jpg", "jpeg", "png", "gif", "svg");

        if (in_array($img_type_result, $valid_formats)) {
            $id_uniq = uniqid();
            $total = count($file[$name]['name']);
            $pathname = $folder . '/' . $uid;

            if (!is_dir($pathname)) mkdir($pathname);

            //            print_r($file[$name]['name']);
            for ($i = 0; $i < $total; $i++) {
                $tmpFilePath = $file[$name]['tmp_name'][$i];
                if ($tmpFilePath != "") {
                    $newFilePath = $folder . "/" . $uid . '/' . $id_uniq . $file[$name]['name'][$i];
                    $newFilePathResize = $folder . "/" . $uid . '/' . $id_uniq;

                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                        if ($resize === FALSE) {
                            $targetFile = $newFilePathResize;
                            $newWidth = $resize;
                            $originalFile = $newFilePath;
                            list($width, $height) = getimagesize($originalFile);
                            if ($newWidth < $width) {
                                $info = getimagesize($newFilePath);
                                $mime = $info['mime'];

                                switch ($mime) {
                                    case 'image/jpeg':
                                        $image_create_func = 'imagecreatefromjpeg';
                                        $image_save_func = 'imagejpeg';
                                        $new_image_ext = 'jpg';
                                        break;

                                    case 'image/png':
                                        $image_create_func = 'imagecreatefrompng';
                                        $image_save_func = 'imagepng';
                                        $new_image_ext = 'png';
                                        break;

                                    case 'image/gif':
                                        $image_create_func = 'imagecreatefromgif';
                                        $image_save_func = 'imagegif';
                                        $new_image_ext = 'gif';
                                        break;

                                    default:
                                        throw new Exception('Unknown image type.');
                                }

                                $imgSave = $image_create_func($originalFile);

                                $newHeight = ($height / $width) * $newWidth;
                                $tmp = imagecreatetruecolor($newWidth, $newHeight);
                                imagesavealpha($tmp, true);
                                $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
                                imagecolortransparent($tmp, $transparent);
                                imagefill($tmp, 0, 0, $transparent);
                                imagefilledrectangle($tmp, 0, 0, $newWidth, $newHeight, $transparent);
                                imagecopyresampled($tmp, $imgSave, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                                if (file_exists($targetFile)) {
                                    unlink($targetFile);
                                }
                                $ff_name = $file[$name]['name'][$i];
                                echo $file[$name]['name'][$i];
                                $image_save_func($tmp, "$targetFile$ff_name-resize-$resize.$new_image_ext");
                                $img[] = $id_uniq . $ff_name . "-resize-$resize." . $new_image_ext;
                                $final_name = $id_uniq . $ff_name . "-resize-$resize." . $new_image_ext;
                                unlink($newFilePath);
                            } else {
                                chmod($folder . "/" . $uid . '/' . $id_uniq . $file[$name]['name'][$i], 0777);
                                $img[] = $id_uniq . $file[$name]['name'][$i];
                                $final_name = $id_uniq . $file[$name]['name'][$i];
                            }
                        } else {
                            $img[] = $id_uniq . $file[$name]['name'][$i];
                            $final_name = $id_uniq . $file[$name]['name'][$i];
                        }

                        if ($copy == 1) {
                            $final_name_path = $pathname . '/' . $final_name;

                            $path_200 = $pathname . '/size_200/';
                            if (!is_dir($path_200)) {
                                mkdir($path_200);
                            }
                            $new_all_path = $path_200 . '/' . $id_uniq . $file[$name]['name'][$i];
                            copy($final_name_path, $new_all_path);

                            $this->resize_img($path_200, 200, $new_all_path, $final_name);

                            $path_80 = $pathname . '/size_80/';
                            if (!is_dir($path_80)) {
                                mkdir($path_80);
                            }
                            $new_all_path = $path_80 . '/' . $id_uniq . $file[$name]['name'][$i];
                            copy($final_name_path, $new_all_path);

                            $this->resize_img($path_80, 80, $new_all_path, $final_name);
                        }
                    }
                }
            }
            return $img;
        } 

        return 0;
    }

    function resize_img($newFilePathResize, $resize, $newFilePath, $final_name)
    {
        $targetFile = $newFilePathResize;
        $newWidth = $resize;
        $originalFile = $newFilePath;
        list($width, $height) = getimagesize($originalFile);
        if ($newWidth < $width) {
            $info = getimagesize($newFilePath);
            $mime = $info['mime'];

            switch ($mime) {
                case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

                case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

                case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

                default:
                    throw new Exception('Unknown image type.');
            }

            $imgSave = $image_create_func($originalFile);

            $newHeight = ($height / $width) * $newWidth;
            $tmp = imagecreatetruecolor($newWidth, $newHeight);
            imagesavealpha($tmp, true);
            $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagecolortransparent($tmp, $transparent);
            imagefill($tmp, 0, 0, $transparent);
            imagefilledrectangle($tmp, 0, 0, $newWidth, $newHeight, $transparent);
            imagecopyresampled($tmp, $imgSave, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // if (file_exists($targetFile)) {
            //     unlink($targetFile);
            // }
            // unlink($newFilePath);

            $image_save_func($tmp, "$targetFile$final_name");
        }
    }

    function email($message, $mail)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 0,
            'smtp_user' => '',
            'smtp_pass' => '',
            'mailtype' => 'html',
            'charset' => 'utf-8',
        );
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        // Set to, from, message, etc.

        $this->email->from('info@example.com', '');
        $this->email->to('');

        $this->email->subject('');
        $this->email->message($message);

        $this->email->send();
    }


    function get_query($sql, $res = false)
    {
        $query = $this->db->query($sql);
        if ($res == false) {
            return $query->result_array();
        }
    }
}
