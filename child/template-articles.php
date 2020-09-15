<?php 
//Template Name: Artículos
get_header(); 
$fields = get_fields();


$years=array(2018,2017,2016,2015,2014,2013,2012,2011,2010,2009,2008);

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    

        <select class="form-control" name="select-year" id="select-year">
            <option value="">Selecciona un año</option>
            <?php foreach($years as $year){
                echo '<option value="'.$year.'">'.$year.'</option>';
            }?>
        </select>
        
        <div id="articles-this-year" class="row">
        

        </div>
    
    
    
    </main><!-- #main -->
</div><!-- primary -->

<?php do_action( 'storefront_sidebar' );?>
<?php get_footer(); ?>