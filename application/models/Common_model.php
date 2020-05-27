<?php
class Common_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL & ~E_NOTICE);
    }

    public $currency = "$"; //Can Use Static Variable
    public $from_mail_id = "info@smacpage.com"; // Server mail id from which mail will be forwarded
    public $company_mail_id = "info@smacpage.com"; // Company's mail id
    public $per_page = 10; //Used in Pagination => display no. of items in per page 
    public $num_links = 5; //Used in Pagination => display no. of page links in the pagination bar 
    public $costvalue = 10; //Password hashing estimated cost time

    /* insert record to database */

    public function insert_records($table, $insert_arr) {
        $insert = $this->db->insert($table, $insert_arr);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }

    /* get records from database */

    public function get_records($fields, $table, $where = '', $orderby = '', $limit = '', $start = '') {
        $this->db->select($fields);
        $this->db->from($table);

        if ($where != '')
            $this->db->where($where);

        if ($orderby != '')
            $this->db->order_by($orderby);

        if ($limit != '') {
            //if($start != '')
            $this->db->limit($limit, $start);
            //else
            //$this->db->limit($limit);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /* Join table records from database */

    public function join_records($fields, $table1, $table2, $joinon, $where = '', $orderby = '', $limit = '', $start = '') {
        $this->db->select($fields);
        $this->db->from($table1);
        $this->db->join($table2, $joinon);

        if ($where != '')
            $this->db->where($where);

        if ($orderby != '')
            $this->db->order_by($orderby);

        if ($limit != '') {
            //if($start != '')
            $this->db->limit($limit, $start);
            //else
            //$this->db->limit($limit);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /* count no. of record from database */

    public function noof_records($fields, $table, $where = '') {
        $this->db->select($fields);
        $this->db->from($table);

        if ($where != '')
            $this->db->where($where);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    /* delete record from database */

    public function delete_records($table, $where) {
        $this->db->where($where);
        $delquery = $this->db->delete($table);
        if ($delquery) {
            return true;
        } else {
            return false;
        }
    }

    /* update record in database */

    public function update_records($table, $fields, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            $this->db->where($where);
            $update = $this->db->update($table, $fields);
            if ($update) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* populate selectbox from database */

    public function populate_select($dispid = 0, $fid, $fname, $table, $where = '', $orderby = '', $joininfid = '') {
        $this->db->select($fid);
        $this->db->select($fname);
        $this->db->from($table);

        if ($where != '')
            $this->db->where($where);

        if ($orderby != '')
            $this->db->order_by($orderby);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $options = '';
            $rows = $query->result_array();
            foreach ($rows as $row) {
                $selectid = $row[$fid];
                if ($joininfid != '')
                    $selectid = $selectid . '@@' . $joininfid;

                $selectname = $row[$fname];
                if ($selectid == $dispid)
                    $options .= "<option value=\"$selectid\" selected>$selectname</option>";
                else
                    $options .= "<option value=\"$selectid\">$selectname</option>";
            }
            return $options;
        }
        else {
            return false;
        }
    }

    /* show name from an id */

    public function showname_fromid($field, $table, $where = '') {
        $this->db->select($field);
        $this->db->from($table);

        if ($where != '')
            $this->db->where($where);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$field;
        } else {
            return false;
        }
    }

    /* populate number combo box */

    public function generate_numberbox($startval, $endval, $shwval = 0, $intvl = 1) {
        for ($i = $startval; $i <= $endval; $i = $i + $intvl) {
            if ($i <= 9)
                $j = '0' . $i;
            else
                $j = $i;

            if ($shwval == $i)
                $showDetails .= "<OPTION value=\"$i\" selected>$j</OPTION>";
            else
                $showDetails .= "<OPTION value=\"$i\">$j</OPTION>";
        }
        return $showDetails;
    }

    /** Short String Cut * */
    public function short_str($inputstring, $char) {
        if (strlen($inputstring) > $char) {
            $string = explode("\n", wordwrap($inputstring, $char));
            $inputstring = $string[0] . '...';
        }
        return $inputstring;
    }

    /** Display Price * */
    public function numberformat($price) {
        if ($price > 0)
            return number_format($price, 0, "", ",");
        else
            return $price;
    }

    /** Remove White Space and replace with Underscore * */
    public function remove_whitespace($str) {
        return preg_replace('/\s+/', '_', trim($str));
    }

    public function remove_underscore($str) {
        return str_replace('_', ' ', trim($str));
    }

    /** Encode & Decode * */
    public function encode($str) {
        return base64_encode($str);
    }

    public function decode($str) {
        return base64_decode($str);
    }

}