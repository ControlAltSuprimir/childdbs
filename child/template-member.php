<?php 
//Template Name: Member
get_header(); 

include "connection.php";

$fields = get_fields();

$years=array(2018,2017,2016,2015,2014,2013,2012,2011,2010,2009,2008);
$nombre=$fields['member'];
//$query_member = mysqli_query($mysqli, "SELECT * FROM bad_articles WHERE bad_authors LIKE + '%' + ".$fields['member']." + '%' ");



$pdo = new PDO('mysql:host=192.168.64.2;dbname=db-de-prueba', 'root', '');
$statement = $pdo->prepare('SELECT * FROM bad_articles WHERE bad_authors LIKE ? LIMIT 10');
$statement->execute(
  array(
    '%'.$fields['member'].'%'
  ) 
);

/*
$query_member = mysqli_query($mysqli, "SELECT * FROM bad_articles WHERE bad_authors LIKE `$nombre` ");
*/

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <?php echo "<h2>".$fields['member']."</h2>";?>
    
    <h3>Últimas publicaciones</h3>
    <ol>
    <?php 
        while($result = $statement->fetch()) {
            echo "<tr>
            <li>".$result['bad_authors'].". ".$result['bad_title'].". ".$result['bad_year'].".</li>";
    };?>
    </ol>


    
    </main><!-- #main -->
</div><!-- primary -->

<?php do_action( 'storefront_sidebar' );?>
<?php get_footer(); ?>