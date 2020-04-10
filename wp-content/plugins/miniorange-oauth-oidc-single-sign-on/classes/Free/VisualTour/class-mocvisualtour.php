<?php


namespace MoOauthClient\Free;

require_once "\166\x74\55\143\157\156\163\x74\163\56\160\150\160";
class MOCVisualTour
{
    protected $nonce;
    protected $nonce_key;
    protected $tour_ajax_action;
    public function __construct()
    {
        $this->nonce = "\155\x6f\x5f\x61\144\155\x69\x6e\x5f\x61\x63\x74\151\x6f\x6e\x73";
        $this->nonce_key = "\x73\x65\x63\x75\162\x69\x74\171";
        $this->tour_ajax_action = "\155\x69\x6e\x69\157\162\141\x6e\147\145\x2d\x74\157\165\x72\55\164\x61\x6b\x65\x6e";
        add_action("\141\x64\155\x69\x6e\137\145\x6e\x71\x75\145\165\x65\137\x73\x63\162\x69\x70\164\163", array($this, "\145\x6e\x71\165\x65\165\145\x5f\166\x69\163\165\x61\154\x5f\x74\x6f\165\162\x5f\163\x63\x72\151\x70\164"));
        add_action("\x77\x70\137\141\152\141\x78\137{$this->tour_ajax_action}", array($this, "\x75\x70\144\x61\x74\x65\137\164\157\165\x72\x5f\x74\141\x6b\145\156"));
        add_action("\167\160\137\141\152\x61\x78\137\156\157\x70\162\x69\166\x5f{$this->tour_ajax_action}", array($this, "\x75\160\144\x61\164\x65\x5f\x74\x6f\x75\162\137\164\141\153\145\x6e"));
    }
    public function update_tour_taken()
    {
        global $xW;
        $this->validate_ajax_request();
        $xW->mo_oauth_client_update_option("\x74\x6f\165\x72\124\x61\x6b\x65\x6e\137" . $_POST["\x70\x61\147\145\111\104"], $_POST["\144\x6f\156\145\x54\157\x75\x72"]);
        $xW->mo_oauth_client_update_option("\155\x6f\x63\137\164\x6f\165\162\124\141\153\145\x6e\137\x66\151\x72\163\x74", true);
        die;
    }
    private function validate_ajax_request()
    {
        if (check_ajax_referer($this->nonce, $this->nonce_key)) {
            goto sA;
        }
        wp_send_json(array("\155\145\163\163\x61\x67\145" => "\x49\156\x76\141\154\151\144\x20\117\x70\145\162\x61\164\151\157\x6e\x2e\40\120\154\x65\141\163\x65\x20\x74\162\171\x20\141\x67\141\151\156\x2e", "\162\x65\163\x75\x6c\x74" => "\145\162\x72\157\x72"));
        die;
        sA:
    }
    public function enqueue_visual_tour_script()
    {
        global $xW;
        wp_register_script("\164\157\x75\x72\137\x73\x63\162\x69\160\x74", TOUR_RES_JS . "\x76\151\163\x75\x61\x6c\x54\157\x75\x72\x2e\152\x73", array("\152\161\x75\145\162\x79"));
        $Dn = isset($_GET["\x74\141\142"]) && '' !== $_GET["\x74\x61\142"] ? $_GET["\x74\x61\x62"] : '';
        wp_localize_script("\x74\x6f\x75\x72\x5f\163\x63\162\x69\x70\164", "\x6d\x6f\124\x6f\165\x72", array("\163\x69\x74\x65\x55\x52\x4c" => admin_url("\141\x64\x6d\151\x6e\55\141\152\141\x78\56\160\150\160"), "\164\156\x6f\x6e\143\x65" => \wp_create_nonce($this->nonce), "\x70\141\x67\145\x49\104" => $Dn, "\164\x6f\165\x72\x44\141\x74\141" => $this->get_tour_data($Dn), "\x74\x6f\165\x72\x54\x61\153\x65\156" => $xW->mo_oauth_client_get_option("\x74\x6f\165\x72\124\141\x6b\145\x6e\137" . $Dn), "\x61\152\141\170\101\143\x74\x69\157\156" => $this->tour_ajax_action, "\x6e\157\x6e\x63\145\113\145\x79" => \wp_create_nonce($this->nonce_key)));
        wp_enqueue_script("\164\x6f\165\162\x5f\163\143\162\151\x70\x74");
        wp_enqueue_style("\155\x6f\143\137\166\151\x73\x75\x61\x6c\x5f\x74\x6f\165\162\x5f\163\164\x79\x6c\x65", TOUR_RES_CSS . "\166\151\163\x75\141\x6c\x54\x6f\x75\x72\56\143\163\163");
    }
    public function tour_template($Nh, $jm, $I_, $r4, $WX, $Lz, $Rh)
    {
        $W3 = array("\163\x6d\141\154\154", "\155\x65\144\x69\x75\155", "\142\151\147");
        return array("\x74\141\x72\147\x65\x74\x45" => $Nh, "\x70\x6f\x69\156\x74\124\x6f\x53\x69\x64\145" => $jm, "\164\x69\164\154\145\110\x54\115\x4c" => $I_, "\143\157\x6e\x74\x65\156\164\x48\124\x4d\114" => $r4, "\x62\x75\164\x74\157\156\124\145\x78\x74" => $WX, "\x69\x6d\x67" => $Lz ? TOUR_RES_IMG . $Lz : $Lz, "\143\141\x72\x64\x53\151\172\145" => $W3[$Rh]);
    }
    private function get_tour_data($Dn = '')
    {
        global $xW;
        $Q_ = array();
        if (boolval($xW->mo_oauth_client_get_option("\155\157\x63\x5f\164\157\x75\162\x54\141\153\145\156\137\x66\151\x72\163\x74"))) {
            goto XI;
        }
        $Q_ = array($this->tour_template('', '', "\x3c\x68\61\76\x57\x65\154\143\x6f\x6d\145\41\x3c\x2f\150\x31\76", "\106\x61\x73\164\x65\156\x20\171\157\x75\162\x20\x73\145\x61\x74\x20\x62\x65\154\x74\x73\40\x66\x6f\x72\x20\141\x20\161\x75\151\x63\x6b\40\x72\x69\x64\x65\x2e", "\x4c\x65\164\x27\163\40\107\157\x21", "\x73\164\141\162\164\124\157\165\x72\x2e\163\166\147", 2));
        $Q_ = array_merge($Q_, $this->get_tab_pointers());
        XI:
        if (!("\143\157\156\x66\151\x67" === $Dn)) {
            goto H9;
        }
        if (!(isset($_GET["\x61\x63\164\x69\x6f\x6e"]) && "\x75\x70\144\x61\164\x65" === $_GET["\x61\x63\164\x69\x6f\x6e"])) {
            goto wk;
        }
        $Q_ = array_merge($Q_, $this->get_updateui_pointers());
        wk:
        $rj = $xW->mo_oauth_client_get_option("\155\x6f\137\157\x61\x75\164\x68\x5f\x61\160\160\163\x5f\x6c\x69\x73\x74") ? $xW->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\165\164\150\137\141\160\x70\163\x5f\154\151\163\164") : false;
        if ($rj && is_array($rj) && 0 < count($rj) && !isset($_GET["\x61\160\160\x49\x64"])) {
            goto Ay;
        }
        if (!isset($_GET["\141\x70\160\x49\x64"])) {
            goto Wg;
        }
        goto pA;
        Ay:
        $Q_ = array_merge($Q_, $this->get_applist_pointers());
        goto pA;
        Wg:
        $Q_ = array_merge($Q_, $this->get_defaultapps_pointers());
        pA:
        if (!(isset($_GET["\141\160\x70\x49\x64"]) && '' !== $_GET["\141\x70\x70\x49\144"])) {
            goto FZ;
        }
        $Q_ = array_merge($Q_, $this->get_addapp_pointers());
        FZ:
        H9:
        if (!("\x73\x69\147\x6e\x69\x6e\x73\145\164\x74\151\x6e\x67\x73" === $Dn)) {
            goto Zv;
        }
        $Q_ = array_merge($Q_, $this->get_signinsettings_pointers());
        Zv:
        return $Q_;
    }
    private function get_tab_pointers()
    {
        return array($this->tour_template("\155\157\137\x73\x75\160\x70\x6f\x72\x74\x5f\x6c\141\171\x6f\165\164", "\x72\151\147\150\164", "\74\x68\x31\76\x57\145\40\141\x72\145\x20\x68\145\162\145\x21\x21\x3c\57\x68\61\x3e", "\107\145\x74\40\x69\156\40\x74\157\x75\x63\150\40\x77\151\x74\150\40\x75\163\x20\x61\156\144\x20\x77\145\40\x77\x69\154\x6c\x20\x68\145\x6c\x70\40\171\157\165\x20\163\x65\164\165\160\x20\164\150\x65\x20\160\x6c\x75\x67\x69\x6e\40\x69\156\x20\156\157\40\164\x69\155\145\x2e", "\x4e\x65\170\x74", "\150\145\x6c\160\x2e\163\x76\x67", 2), $this->tour_template("\164\141\x62\55\143\157\x6e\146\x69\147", "\x75\x70", "\74\x68\x31\x3e\x43\157\x6e\146\x69\x67\x75\162\141\164\151\157\156\40\124\x61\x62\74\57\150\61\x3e", "\x59\157\165\x20\143\141\156\x20\143\150\x6f\157\163\x65\x20\141\156\144\40\143\x6f\156\146\151\x67\x75\x72\x65\40\141\156\x79\x20\x4f\101\x75\x74\x68\x2f\x4f\x70\145\156\111\104\x20\141\x70\160\154\x69\x63\141\164\x69\157\x6e\56", "\116\145\x78\164", "\x63\x68\x6f\157\163\145\x2e\x73\x76\x67", 2), $this->tour_template("\164\x61\x62\x2d\143\x75\x73\164\157\x6d\x69\x7a\141\x74\x69\157\156", "\165\160", "\74\x68\x31\x3e\x57\x69\x64\147\145\164\x20\x43\165\x73\x74\157\x6d\151\x7a\x61\x74\151\157\x6e\40\x54\x61\142\74\57\x68\x31\76", "\131\157\x75\x20\143\141\x6e\40\143\x75\x73\164\157\155\x69\x7a\145\x20\171\x6f\x75\162\40\x6c\157\147\151\x6e\40\167\151\144\147\145\x74\40\157\x72\40\x73\x68\157\x72\164\143\x6f\x64\145\x20\x77\x69\x64\x67\x65\164\40\x74\x6f\x20\x79\x6f\165\x72\40\154\151\x6b\x69\156\147\x20\x77\x69\164\150\40\x43\x53\123\40\150\145\162\145\41", "\116\145\170\x74", "\143\150\x6f\x6f\x73\145\x2e\163\166\x67", 2), $this->tour_template("\164\141\142\55\163\151\x67\x6e\x69\156\x73\x65\x74\164\x69\x6e\x67\163", "\x75\x70", "\x3c\150\61\x3e\123\x69\x67\x6e\x20\111\x6e\x20\x53\145\x74\164\151\156\x67\163\x3c\x2f\150\x31\x3e", "\x59\157\x75\x20\x63\x61\x6e\40\146\x69\x6e\x64\x20\x76\x61\x72\x69\157\165\x73\40\123\123\x4f\40\162\145\154\x61\164\x65\x64\40\x63\157\156\146\151\x67\165\162\141\x74\151\157\156\163\x20\163\165\143\x68\x20\141\163\x20\163\150\157\x72\164\143\157\144\145\163\40\x61\156\144\40\x55\163\x65\x72\40\122\x65\147\151\163\164\162\141\164\x69\157\156\40\150\145\162\145\41", "\116\145\x78\x74", "\160\x72\157\146\x69\154\145\56\x73\166\x67", 2), $this->tour_template("\164\141\142\x2d\162\145\161\x75\145\x73\x74\x64\x65\155\157", "\x75\160", "\x3c\150\61\x3e\x52\x65\161\x75\x65\x73\164\x20\x46\x6f\162\40\x44\145\x6d\157\x3c\57\150\x31\76", "\x41\x72\x65\40\x79\x6f\x75\40\154\x6f\157\x6b\x69\156\147\40\146\157\162\40\x70\x72\145\155\151\165\155\x20\x66\x65\141\x74\165\162\145\163\77\40\116\x6f\167\x2c\x20\171\x6f\165\40\143\141\x6e\40\x73\145\x6e\144\40\141\40\162\x65\x71\165\x65\163\x74\x20\164\157\40\x73\145\x74\x75\x70\x20\x61\x20\x64\145\x6d\x6f\x20\157\x66\x20\164\150\145\40\x70\x72\x65\155\x69\x75\x6d\40\x76\x65\162\163\x69\x6f\x6e\x20\171\x6f\165\40\x61\x72\x65\40\151\x6e\x74\x65\162\145\x73\164\145\144\x20\x69\x6e\40\x61\156\x64\40\157\165\162\40\164\x65\x61\155\x20\167\151\154\x6c\x20\163\145\x74\40\x69\x74\40\165\160\40\x66\157\x72\x20\171\157\165\41", "\x4e\145\170\164", "\160\162\x65\x76\151\x65\167\x2e\x73\x76\x67", 2), $this->tour_template("\154\x69\x63\145\x6e\163\151\x6e\x67\137\142\x75\164\x74\157\156\x5f\x69\144", "\x75\x70", "\x3c\150\61\76\x4c\x69\x63\145\x6e\163\151\156\147\40\x50\x6c\x61\x6e\x73\74\57\150\x31\x3e", "\x59\157\x75\x20\x63\141\x6e\x20\143\150\x65\143\x6b\40\x61\x6c\154\x20\x74\x68\145\40\x6c\151\x63\145\x6e\163\x69\x6e\147\x20\160\x6c\x61\156\163\40\x61\x6e\144\40\164\x68\x65\x20\x66\x65\x61\164\165\162\145\x73\40\141\163\40\x77\145\154\154\40\141\163\40\x6f\160\x74\x69\157\156\x73\x20\x74\150\x65\171\x20\157\146\146\145\x72\x2c\40\x68\145\x72\x65\56", "\x4e\145\170\x74", "\x75\x70\x67\x72\x61\x64\145\x2e\163\x76\x67", 2), $this->tour_template("\146\x61\161\x5f\x62\165\164\x74\x6f\156\x5f\151\144", "\165\x70", "\x3c\150\61\76\106\141\143\x69\x6e\x67\x20\x61\40\x70\162\157\x62\154\145\155\77\74\x2f\x68\61\76", "\131\157\165\x20\x63\x61\x6e\x20\x63\x68\145\143\153\x20\x46\101\121\163\56\40\115\157\x73\x74\x20\161\x75\145\163\x74\151\x6f\x6e\163\x20\x63\x61\x6e\40\x62\x65\x20\x73\x6f\x6c\x76\145\144\x20\142\x79\x20\162\x65\141\x64\151\x6e\147\40\x74\x68\x72\157\165\x67\x68\x20\x74\x68\x65\x20\x46\x41\x51\163\x2e\x2e", "\116\145\170\x74", "\146\141\161\x2e\x73\x76\147", 2), $this->tour_template("\x61\143\143\137\163\x65\x74\165\x70\x5f\x62\x75\164\164\x6f\156\x5f\151\144", "\165\x70", "\74\150\x31\x3e\x49\40\x77\141\156\164\x20\x74\157\x20\165\x70\147\x72\141\144\x65\x21\x3c\x2f\x68\x31\76", "\131\x6f\165\40\144\157\40\x6e\x6f\x74\40\x6e\145\x65\144\40\164\157\40\163\145\x74\165\x70\x20\171\x6f\165\162\40\x61\x63\x63\x6f\165\156\164\40\164\157\x20\x75\163\145\x20\x74\150\x65\x20\160\154\x75\x67\151\156\56\40\x49\146\x20\171\x6f\x75\x20\x77\x61\156\x74\x20\164\157\x20\165\x70\147\162\141\144\145\x2c\x20\x79\x6f\165\x20\167\x69\x6c\x6c\40\156\145\145\x64\x20\x61\x20\155\151\156\x69\x4f\x72\141\156\147\145\40\x61\x63\143\x6f\x75\x6e\164\x2e", "\116\145\170\x74", "\160\x6f\160\125\x70\56\x73\x76\x67", 2), $this->tour_template("\x72\145\163\x74\141\x72\x74\x5f\x74\157\165\x72\x5f\142\x75\x74\164\x6f\x6e", "\x72\151\x67\x68\x74", "\x3c\150\x31\76\x52\x65\163\164\x61\x72\x74\x20\124\157\x75\x72\x3c\x2f\x68\61\76", "\111\x66\x20\171\x6f\165\x20\x6e\145\x65\x64\40\x74\x6f\x20\162\145\166\151\163\151\164\x20\x74\150\x65\x20\164\157\165\x72\x2c\40\x79\157\x75\40\143\x61\x6e\x20\165\163\x65\x20\164\x68\151\163\x20\142\165\x74\x74\x6f\x6e\x20\x74\x6f\40\162\145\160\x6c\141\171\40\151\164\40\146\157\x72\x20\164\x68\145\40\143\165\x72\162\x65\156\164\x20\x74\141\142\x21", "\116\x65\170\164", "\162\145\160\x6c\x61\x79\x2e\163\x76\x67", 2));
    }
    private function get_updateui_pointers()
    {
        return array($this->tour_template("\x6d\157\137\x6f\x61\x75\164\150\137\x74\x65\163\164\137\x63\157\x6e\x66\x69\147\165\162\141\x74\x69\157\156", "\154\145\146\164", "\x3c\150\x31\76\124\145\x73\x74\x20\x79\x6f\165\x72\x20\x63\157\x6e\146\151\147\x75\x72\x61\164\x69\x6f\156\x3c\57\150\61\76", "\x43\x6c\151\x63\153\x20\x68\145\x72\145\40\164\x6f\40\x73\x65\145\x20\x74\150\x65\x20\x6c\151\163\164\40\157\x66\40\141\164\x74\x72\151\142\165\x74\x65\x73\x20\160\162\x6f\166\151\144\x65\144\40\x62\171\x20\x79\157\165\162\x20\117\x41\165\x74\x68\40\120\x72\x6f\x76\151\x64\x65\x72\56\x20\111\146\40\x79\x6f\165\40\141\162\145\x20\147\x65\164\164\x69\x6e\147\x20\x61\156\171\x20\x65\162\x72\x6f\162\54\x20\160\x6c\145\x61\163\x65\x20\162\145\x66\x65\162\40\164\150\145\x20\106\101\121\x20\x74\x61\x62\56", "\x4e\x65\x78\164", "\x70\x72\x65\166\x69\x65\167\56\163\166\147", 2), $this->tour_template("\x61\x74\164\x72\x6d\x61\x70\160\151\156\x67", "\x6c\x65\146\x74", "\x3c\x68\x31\76\115\x61\x70\160\x69\x6e\x67\x20\x41\164\x74\x72\151\x62\165\x74\145\163\74\57\150\x31\76", "\105\156\164\145\162\x20\x74\150\x65\40\x61\x70\x70\x72\157\160\x72\x69\x61\x74\x65\40\x76\141\154\x75\x65\x73\x28\x61\x74\164\x72\x69\x62\x75\164\x65\x20\156\141\155\145\x73\51\40\x66\x72\157\x6d\x20\x74\x68\x65\40\124\145\x73\164\40\x43\x6f\156\x66\151\x67\x75\x72\x61\164\x69\157\x6e\40\x74\141\x62\154\145\56", "\116\145\x78\x74", "\x70\162\145\166\151\145\167\x2e\163\x76\x67", 2), $this->tour_template("\162\x6f\154\145\x6d\141\160\x70\x69\156\147", "\154\x65\146\x74", "\74\150\61\x3e\x4d\x61\160\x70\151\156\x67\x20\122\x6f\x6c\x65\x73\x3c\x2f\150\61\x3e", "\105\x6e\164\145\x72\40\x74\x68\145\40\x72\157\x6c\145\40\166\141\x6c\165\x65\163\x20\146\x72\x6f\x6d\x20\x79\x6f\x75\162\x20\x4f\101\x75\164\150\57\x4f\x70\145\156\111\104\40\160\x72\157\x76\151\144\x65\x72\40\x61\x6e\x64\x20\x74\150\x65\x6e\40\x73\x65\x6c\145\143\x74\40\164\150\x65\x20\x57\x6f\162\x64\120\x72\x65\x73\163\x20\122\157\x6c\x65\x20\x74\x68\141\164\x20\171\x6f\165\40\156\145\x65\144\x20\x74\x6f\x20\x61\x73\163\151\147\156\40\164\150\141\164\40\x72\157\154\145\56", "\x66\141\154\x73\145", "\160\162\x65\x76\x69\145\167\x2e\163\166\x67", 2));
    }
    private function get_signinsettings_pointers()
    {
        return array($this->tour_template("\x77\x69\144\x2d\163\x68\x6f\x72\x74\143\157\x64\145", "\154\x65\146\x74", "\74\150\x31\x3e\123\151\x67\156\x20\x49\156\40\117\x70\164\151\x6f\x6e\163\x3c\57\x68\61\76", "\x59\x6f\165\x20\x63\141\156\40\x64\151\163\160\154\x61\x79\40\171\x6f\165\162\40\154\x6f\x67\x69\x6e\x20\x62\x75\x74\164\x6f\x6e\x20\x75\x73\x69\156\x67\40\164\x68\145\163\x65\40\x6d\145\x74\150\157\x64\x73\56", "\x4e\145\x78\x74", "\x70\x72\x65\x76\151\x65\x77\56\x73\166\x67", 2), $this->tour_template("\x61\144\166\141\156\x63\145\144\137\163\145\x74\164\x69\156\x67\163\137\163\x73\x6f", "\x6c\145\x66\164", "\x3c\x68\61\76\x41\x64\166\141\x6e\x63\145\144\x20\x53\145\x74\x74\151\156\147\x73\74\57\150\61\76", "\x59\x6f\x75\40\143\141\156\x20\143\157\x6e\x66\151\147\x75\162\x65\x20\166\x61\x72\151\157\165\163\40\157\x70\164\151\x6f\156\163\x20\x6c\151\x6b\145\40\x43\141\x6c\x6c\142\x61\143\x6b\x20\125\122\x4c\x2c\x20\104\x6f\x6d\x61\151\156\x20\x52\145\163\164\x72\151\x63\x74\x69\157\x6e\54\x20\145\x74\143\x2e\40\x68\145\x72\145\56", "\x66\141\x6c\163\x65", "\160\x72\x65\x76\x69\145\167\x2e\x73\x76\147", 2));
    }
    private function get_applist_pointers()
    {
        return array($this->tour_template("\x6d\x6f\137\x6f\x61\x75\164\x68\x5f\141\x70\x70\x5f\154\x69\163\164", "\x6c\145\x66\x74", "\x3c\150\61\76\x41\x70\160\x20\x4c\151\x73\x74\x3c\57\150\61\x3e", "\103\x6c\151\143\x6b\40\150\145\x72\x65\40\x74\157\x20\125\x70\144\x61\x74\x65\x20\157\x72\x20\104\145\x6c\145\164\x65\40\164\x68\x65\40\141\160\160\154\x69\x63\141\164\x69\x6f\x6e\56", "\146\141\x6c\x73\x65", "\160\162\x65\x76\x69\145\x77\x2e\x73\166\x67", 2));
    }
    private function get_defaultapps_pointers()
    {
        return array($this->tour_template("\x6d\x6f\137\157\141\165\164\x68\137\143\154\x69\145\156\x74\x5f\144\145\x66\x61\165\154\164\x5f\x61\x70\x70\x73\x5f\x63\x6f\x6e\164\x61\x69\156\x65\162", "\x6c\145\146\164", "\74\x68\x31\76\123\x65\x6c\x65\x63\164\40\117\101\165\164\150\40\x50\x72\x6f\166\x69\x64\x65\162\74\57\x68\61\x3e", "\103\150\157\157\x73\145\40\x79\x6f\x75\162\x20\x4f\x41\x75\164\x68\x20\x50\162\x6f\x76\x69\x64\145\162\40\x66\x72\157\x6d\x20\164\x68\145\40\154\151\163\x74\40\x6f\x66\x20\x4f\x41\x75\164\x68\40\120\x72\x6f\166\151\x64\x65\x72\x73", "\146\x61\x6c\x73\145", "\160\x72\x65\x76\151\145\x77\56\163\166\x67", 2));
    }
    private function get_addapp_pointers()
    {
        return array($this->tour_template("\x6d\157\137\x6f\x61\165\x74\150\137\143\157\156\x66\151\147\137\x67\x75\151\x64\x65", "\154\x65\x66\x74", "\x3c\150\x31\76\103\x6f\x6e\146\x69\x67\165\x72\145\40\x59\x6f\x75\x72\x20\101\x70\160\x3c\57\x68\61\76", "\116\145\145\x64\40\150\x65\x6c\160\40\167\x69\x74\x68\x20\x63\157\156\146\151\x67\165\x72\141\x74\151\157\x6e\77\x20\103\154\151\x63\x6b\x20\157\x6e\40\x48\157\x77\x20\164\x6f\x20\x43\x6f\x6e\146\151\147\165\x72\145\77", "\x66\141\x6c\163\145", '', 1));
    }
}