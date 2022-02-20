<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("category_model","obj_category");
        $this->load->model("courses_model","obj_courses");
        }   
        
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function sitemap()
	{
            //get data courses category
            
            echo "Hola";
            die();
            
             $params_category_videos = array(
                        "select" =>"category_id,
                                    slug,
                                    created_at,
                                    name",
                "where" => "type = 1 and active = 1",
            );
            $obj_category_videos = $this->obj_category->search($params_category_videos);
            //get data catalog category
            $params_category_catalog = array(
                        "select" =>"category_id,
                                    slug,
                                    created_at,
                                    name",
                "where" => "type = 2 and active = 1",
            );
            $obj_category_catalog = $this->obj_category->search($params_category_catalog);
            //get all couses active
            $params = array(
                        "select" =>"videos.video_id,
                                    videos.name,
                                    videos.slug,
                                    category.slug as category_slug,
                                    videos.date",
                "join" => array( 'category, category.category_id = videos.category_id'),
                "where" => "category.type = 1 and videos.active = 1");
            $obj_videos = $this->obj_videos->search($params); 
            //get all catalog active
            $params = array(
                        "select" =>"catalog.catalog_id,
                                    catalog.name,
                                    catalog.slug,
                                    catalog.active,
                                    category.slug as category_slug,
                                    catalog.date",
                "join" => array( 'category, category.category_id = catalog.category_id'),
                "where" => "catalog.active = 1",
                "order" =>  "catalog.catalog_id DESC");
            $obj_catalog = $this->obj_catalog->search($params);  
            
            $codigo='<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
            foreach ($obj_videos as $value) {
                $codigo .='<url>
                <loc>'.site_url()."courses/".$value->category_slug."/".$value->slug;
                $codigo .='</loc>
                <lastmod>'.$value->date.'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.80</priority>
                </url>';
            }
            foreach ($obj_catalog as $value) {
                $codigo .='<url>
                <loc>'.site_url()."catalog/".$value->category_slug."/".$value->slug;
                $codigo .='</loc>
                <lastmod>'.$value->date.'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.80</priority>
                </url>';
            }
            foreach ($obj_category_videos as $value) {
                $codigo .='<url>
                <loc>'.site_url()."courses/".$value->slug;
                $codigo .='</loc>
                <lastmod>'.$value->created_at.'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.80</priority>
                </url>';
            }
            
            foreach ($obj_category_catalog as $value) {
                $codigo .='<url>
                <loc>'.site_url()."catalog/".$value->slug;
                $codigo .='</loc>
                <lastmod>'.$value->created_at.'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.80</priority>
                </url>';
            }
            
            $codigo .='<url>';
            $codigo .='<loc>'. site_url().'</loc>';
            $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
            $codigo .='</url>';
            $codigo .='<url>';
            $codigo .='<loc>'. site_url().'home'.'</loc>';
            $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
            $codigo .='</url>';
            $codigo .='<url>';
            $codigo .='<loc>'. site_url().'courses'.'</loc>';
            $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
            $codigo .='</url>';
            $codigo .='<url>';
            $codigo .='<loc>'. site_url().'catalog'.'</loc>';
            $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
            $codigo .='</url>';
            $codigo .='<url>';
            $codigo .='<loc>'. site_url().'register'.'</loc>';
            $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
            $codigo .='</url>';
            $codigo .='<url>';
            $codigo .='<loc>'. site_url().'contact'.'</loc>';
            $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
            $codigo .='</url>';
            $codigo .='<url>';
            $codigo .='<loc>'. site_url().'login'.'</loc>';
            $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
            $codigo .='</url>';
             $codigo .='<url>';
            $codigo .='<loc>'. site_url().'forget'.'</loc>';
            $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
            $codigo .='</url>';
            $codigo .='</urlset>';
            $path = "sitemap.xml";
            $modo = "w+";

            if ($fp=fopen($path,$modo)){
            fwrite ($fp,$codigo);
                echo "Se realizo con Exito";
            }
            else{
                echo "Error";
            }

	}
}
