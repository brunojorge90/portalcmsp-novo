<?php
/*
 Template Name: CTI3 DEBUG
*/
?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<div id="main" class="cf" role="main">
			
			<p>CTI3 - DEBUG - CRON</p>
			<?php
				
				$cron_network = get_network_option(get_current_network_id(), 'cron');//Array
				//printa a array completa
				print("<pre>".print_r($cron_network,true)."</pre>");
				print("<br/><hr/><br/>");
				
				$cron_site = get_site_option('cron');//Array
				//printa a array completa
				print("<pre>".print_r($cron_site,true)."</pre>");
				print("<br/><hr/><br/>");
				
				$cron = get_option('cron');//Array
				//printa a array completa
				print("<pre>".print_r($cron,true)."</pre>");
				print("<br/><hr/><br/>");
				
				//eventos a remover do cron
				//print("<pre>".print_r($cron[1705978585],true)."</pre>");
				//print("<pre>".print_r($cron[1708052185],true)."</pre>");
				//unset($cron[1705978585], $cron[1708052185]);
				print("<br/><hr/><br/>");
				
				//printa a array completa
				print("<pre>".print_r($cron,true)."</pre>");
				print("<br/><hr/><br/>");
				
				$ok = update_option('cron', $cron);
				print("<h1>Salvou? ".$ok."</h1>");
				print("<br/><hr/><br/>");
				
				//https://developer.wordpress.org/reference/functions/wp_load_alloptions/
				wp_load_alloptions(true);
				
				
			?>
			<p>CTI3 DEBUG PAGE</p>
			
		</div>
		
	</div>
	
</div>
</main>
<?php get_footer(); ?>