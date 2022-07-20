<?php
/* ------------------------------------------------ */
/* Advance Search - Tabs */
/* ------------------------------------------------ */
if (!function_exists('search_paralex_2_new')) {

    function search_paralex_2_new() {
        vc_map(array(
            "name" => esc_html__("Hero section New", 'nokri'),
            "base" => "search_paralex_2_new",
            "category" => esc_html__("Theme Shortcodes", 'nokri'),
            "params" => array(
                array(
                    'group' => esc_html__('Output', 'nokri'),
                    'type' => 'custom_markup',
                    'heading' => esc_html__('Shortcode Output', 'nokri'),
                    'param_name' => 'order_field_key',
                    'description' => nokri_VCImage('nokri_main_section_loc.png') . esc_html__('Ouput of the shortcode will be look like this.', 'nokri'),
                ),
                array(
                    "group" => esc_html__("Basic", "nokri"),
                    "type" => "attach_image",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Background Image", 'nokri'),
                    "param_name" => "search_section_img",
                    "description" => esc_html__('1263 x 147', 'nokri'),
                ),
                array(
                    "group" => esc_html__("Basic", "nokri"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Arrow Icons", 'nokri'),
                    "param_name" => "search_section_arrow_img",
                    'description' => __('Click to explore more icons', 'nokri') . ' ' . nokri_make_link('https://themify.me/themify-icons', __('Get Icons', 'nokri')),
                ),
                array(
                    "group" => esc_html__("Basic", "nokri"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Section Heading", 'nokri'),
                    "param_name" => "section_title",
                ),
                array(
                    "group" => esc_html__("Basic", "nokri"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Section tagline", 'nokri'),
                    "param_name" => "section_tagline",
                ),
                array(
                    "group" => esc_html__("Basic", "nokri"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Keyword title", 'nokri'),
                    "param_name" => "keyword_title",
                ),
                array(
                    "group" => esc_html__("Basic", "nokri"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Country title", 'nokri'),
                    "param_name" => "country_title",
                ),
                array
                    (
                    "group" => esc_html__("Countries", "nokri"),
                    'type' => 'param_group',
                    'heading' => esc_html__('Select Countries ( All or Selective )', 'nokri'),
                    'param_name' => 'countries',
                    'value' => '',
                    'params' => array
                        (
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Select Country", 'nokri'),
                            "param_name" => "country",
                            "admin_label" => true,
                            "value" => nokri_get_all('ad_location', 'yes'),
                        ),
                    )
                ),
                array(
                    "group" => esc_html__("Countries", "nokri"),
                    "type" => "dropdown",
                    "heading" => esc_html__("Do you want to show sub locations", 'nokri'),
                    "param_name" => "want_to_show",
                    "admin_label" => true,
                    "value" => array(
                        esc_html__('yes', 'nokri') => 'yes',
                        esc_html__('no', 'nokri') => 'no',
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    "std" => '',
                ),
                array(
                    "group" => esc_html__("Hot Cats", "nokri"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Section Title", 'nokri'),
                    "param_name" => "hot_title",
                ),
                array
                    (
                    "group" => esc_html__("Hot Cats", "nokri"),
                    'type' => 'param_group',
                    'heading' => esc_html__('Select hot categories', 'nokri'),
                    'param_name' => 'hot_cats',
                    'value' => '',
                    'params' => array
                        (
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Category", 'nokri'),
                            "param_name" => "hot_cat",
                            "admin_label" => true,
                            "value" => nokri_get_parests('job_category', 'no'),
                        ),
                    )
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'search_paralex_2_new');

if (!function_exists('search_paralex_2_new_short_base_func')) {

    function search_paralex_2_new_short_base_func($atts, $content = '') {

        extract(shortcode_atts(array(
            'cats' => '',
            'section_title' => '',
            'section_tagline' => '',
            'countries' => '',
            'keyword_title' => '',
            'country_title' => '',
            'search_section_img' => '',
            'search_section_arrow_img' => '',
            'hot_cats' => '',
            'hot_title' => '',
            'cat_slider' => '',
            'cats_title' => '',
            'cats_link' => '',
            'want_to_show' => '',
                        ), $atts));
        global $nokri;
        //For countries

        if (isset($atts['countries']) && !empty($atts['countries']) != '') {
            $rows_countries = vc_param_group_parse_atts($atts['countries']);
            $year_countries = false;
            $countries_html = '';
            $get_year = '';
            if (count($rows_countries) > 0) {
                $countries_html .= '';
                foreach ($rows_countries as $rows_country) {
                    if (isset($rows_country['country'])) {
                        if ($rows_country['country'] == 'all') {
                            $year_countries = true;
                            $countries_html = '';
                            break;
                        }
                        $get_country = get_term_by('slug', $rows_country['country'], 'ad_location');
                        if (count((array) $get_country) == 0)
                            continue;
                        $countries_html .= '<option value="' . $get_country->term_id . '">' . $get_country->name . '</option>';
                    }
                }
                if ($year_countries) {

                    $all_countries = nokri_get_cats('ad_location', 0);
                    foreach ($all_countries as $all_year) {
                        $countries_html .= '<option value="' . $all_year->term_id . '">' . $all_year->name . '</option>';
                    }
                }
            }
        }
        // countries
        if (isset($atts['countries']) && !empty($atts['countries']) != '') {
            $rows = vc_param_group_parse_atts($atts['countries']);
            $cats = false;
            $countries_html = '';
            if (count($rows) > 0) {
                $countries_html .= '';
                foreach ($rows as $row) {
                    if (isset($row['country'])) {
                        if ($row['country'] == 'all') {
                            $cats = true;
                            $countries_html = '';
                            break;
                        }
                        $category = get_term_by('slug', $row['country'], 'ad_location');
                        if (count($category) == 0)
                            continue;
                        if (isset($want_to_show) && $want_to_show == "yes") {

                            $ad_cats_sub = nokri_get_cats('ad_location', $category->term_id);
                            if (count($ad_cats_sub) > 0) {
                                $countries_html .= '<option value="' . $category->term_id . '" >' . $category->name . '  (' . $category->count . ')';
                                foreach ($ad_cats_sub as $ad_cats_subz) {
                                    $countries_html .= '<option value="' . $ad_cats_subz->term_id . '">' . '&nbsp;&nbsp; - &nbsp;' . $ad_cats_subz->name . '  (' . $ad_cats_subz->count . ') </option>';
                                }
                                $countries_html .= '</option>';
                            } else {
                                $countries_html .= '<option value="' . $category->term_id . '">' . $category->name . '   (' . $category->count . ')</option>';
                            }
                        } else {
                            $countries_html .= '<option value="' . $category->term_id . '">' . $category->name . '   (' . $category->count . ')</option>';
                        }
                    }
                }
                if ($cats) {
                    $ad_cats = nokri_get_cats('ad_location', 0);
                    foreach ($ad_cats as $cat) {
                        if (isset($want_to_show) && $want_to_show == "yes") {
                            //sub cat
                            $ad_sub_cats = nokri_get_cats('ad_location', $cat->term_id);
                            if (count($ad_sub_cats) > 0) {
                                $countries_html .= '<option value="' . $cat->term_id . '" >' . $cat->name . '  (' . $cat->count . ')';
                                foreach ($ad_sub_cats as $sub_cat) {
                                    $countries_html .= '<option value="' . $sub_cat->term_id . '">' . '&nbsp;&nbsp; - &nbsp;' . $sub_cat->name . '  (' . $sub_cat->count . ') </option>';
                                    //sub sub cat
                                    $ad_sub_sub_cats = nokri_get_cats('ad_location', $sub_cat->term_id);
                                    if (count($ad_sub_sub_cats) > 0) {
                                        foreach ($ad_sub_sub_cats as $sub_cat_sub) {
                                            $countries_html .= '<option value="' . $sub_cat_sub->term_id . '">' . '&nbsp;&nbsp; - &nbsp; - &nbsp;' . $sub_cat_sub->name . '  (' . $sub_cat_sub->count . ') </option>';
                                            //sub sub sub cat
                                            $ad_sub_sub_sub_cats = nokri_get_cats('ad_location', $sub_cat_sub->term_id);
                                            if (count($ad_sub_sub_sub_cats) > 0) {
                                                foreach ($ad_sub_sub_sub_cats as $sub_cat) {
                                                    $countries_html .= '<option value="' . $sub_cat->term_id . '">' . '&nbsp;&nbsp; - &nbsp; - &nbsp;- &nbsp;' . $sub_cat->name . '  (' . $sub_cat->count . ') </option>';
                                                }
                                            }
                                        }
                                    }
                                }
                                $countries_html .= '</option>';
                            } else {
                                $countries_html .= '<option value="' . $cat->term_id . '">' . $cat->name . '   (' . $cat->count . ')</option>';
                            }
                        } else {
                            $countries_html .= '<option value="' . $cat->term_id . '">' . $cat->name . '   (' . $cat->count . ')</option>';
                        }
                    }
                }
            }
        }
        // For hot categories
        $hot_cats_html = '';
        if (!empty($atts['hot_cats']) && isset($atts['hot_cats'])) {
            $rows_hot_cats = vc_param_group_parse_atts($atts['hot_cats']);
            $year_countries = false;
            $hot_cats_html = '';
            $get_year = '';
            if (count($rows_hot_cats) > 0) {
                foreach ($rows_hot_cats as $rows_hot_cat) {
                    if (isset($rows_hot_cat['hot_cat'])) {
                        if ($rows_hot_cat['hot_cat'] == 'all') {
                            $year_countries = true;
                            $countries_html = '';
                            break;
                        }
                        $get_hot_cat = get_term_by('slug', $rows_hot_cat['hot_cat'], 'job_category');
                        if (count((array) $get_hot_cat) == 0)
                            continue;
                        $hot_cats_html .= '<a href="' . nokri_cat_link_page($get_hot_cat->term_id) . '">' . $get_hot_cat->name . '</a>';
                    }
                }
            }
        }
        // echo do_shortcode('[user_count]'); 
        // echo do_shortcode('[sbs_posts]'); 
        /* Section Title */
        $main_section_title = (isset($section_title) && $section_title != "") ? ' <h1>' . $section_title . '</h1>' : "";
        /* Section Tagline */
        $main_section_tagline = (isset($section_tagline) && $section_tagline != "") ? ' <p>' . $section_tagline . '</p>' : "";
        /* hot Title */
        $hot_section_title = (isset($hot_title) && $hot_title != "") ? '<span class="n-most-cat-title">' . $hot_title . '</span>' : "";
        /* keyowrd Title */
        $keyword_title = (isset($keyword_title) && $keyword_title != "") ? '<label><i class="ti-search"></i>' . " " . $keyword_title . '</label>' : "";
        /* country Title */
        $country_title = (isset($country_title) && $country_title != "") ? '<label><i class="ti-location-pin"></i>' . " " . $country_title . '</label>' : "";
        /* Background Image */
        $bg_img = '';
        if ($search_section_img != "") {
            $bgImageURL = nokri_returnImgSrc($search_section_img);
            $bg_img = ( $bgImageURL != "" ) ? ' \\s\\t\\y\\l\\e="background:  url(' . $bgImageURL . ') 0 0 no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-position: center center; background-attachment:scroll;"' : "";
        }
        /* Arrow icons */
        $arrow_icon = '';
        if (isset($search_section_arrow_img) && $search_section_arrow_img != '') {
            $arrow_icon = '<div class="move-down">
								<a href="#elegent_catz"><i class="' . esc_attr($search_section_arrow_img) . '"></i></a>
							   </div>';
        }
        return '<section class="n-hero-section-two rebuild" ' . str_replace('\\', "", $bg_img) . '>
         <div class="container">
            <div class="row">
               <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
                  <div class="main-page-site-stats">
                     <p>More than 3000 resumes and more than 10000 visitors to the site this month</p>
         
                  </div>
                  <div class="n-hero-two-box">
                     <div class="n-hero-two-main-text">
					    ' . $main_section_tagline .'
                     	' . $main_section_title . ' 
                     </div>
                     <div class="n-hero-two-form-cat">
                        <div class="n-saech-two-form mp-candidate-search">
                        	<div class="row">    	
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                    <div class="panel-heading active" role="tab">
                                        <a role="button" class="" data-toggle="collapse" href="#search-headline">
                                        Candidate Profession                </a>
                                    </div>
                                    <div id="search-headline" class="panel-collapse collapse in" role="tabpanel">
                                        <div class="panel-body">
                                            <form role="search" class="custom-search-form" method="get" action="https://job.co.zm/candidates/">
                                                <div class="form-group">
                                                <input type="text" id="filter" class="form-control" value="" name="cand-headline" placeholder="e.g Developer...">
                                                <button type="submit" class="btn n-btn-flat btn-mid"><i class="fa fa-search"></i></button>
                                                <ul class="live-filter live-filter-nd">
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=seo">SEO</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=automotive">Automotive</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=consultant">Consultant</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=designer">Designer</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=development">Development</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=developer">Developer</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=css">CSS</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=html">HTML</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=node">Node</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=Fitness+Trainer">Fitness Trainer</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=Food+Service">Food Service</a></li>
                                                    <li><a href="https://job.co.zm/candidates/?cand-headline=Health+and+Care">Health and Care</a></li>
                                                </ul>
												</div>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="n-most-two-cat">
                           <span class="n-most-cat-title">' . $hot_section_title . '</span>
                           <span class="n-most-cat-list">
                           ' . $hot_cats_html . '
                           </span>
                        </div>
                     </div>
                     <div class="home-secion1-slider owl-carousel owl-theme home-moving-phrase"><div class="item"><div class="n-hiring2-bg"><p>Opportunities for Career Progression</p></div></div><div class="item"><div class="n-hiring2-bg"><p>Save Time &amp; Money</p></div></div><div class="item"><div class="n-hiring2-bg"><p>Job &amp; Application Feedback</p></div></div></div>
                  </div>
                  ' . $arrow_icon . '
               </div>
            </div>
         </div>
      </section>';
    }

}
if (function_exists('nokri_add_code')) {
    nokri_add_code('search_paralex_2_new', 'search_paralex_2_new_short_base_func');
}