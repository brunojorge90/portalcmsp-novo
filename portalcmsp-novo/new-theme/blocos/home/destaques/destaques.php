<div class="container">
<?php
echo do_shortcode("[destaques]");
?>
</div>
<style>
.destaques-novo img {
    max-width:100%;
    height:auto
}

@media (max-width:768px) {
	.flex-4, .flex-3 {
    	display:grid !important;
        grid-template-columns: repeat(1, 1fr) !important;
    }
    
    .destaques-novo .text-col h3, .destaques-novo .col.col-first .abs-shadow>div h3 {
    	font-size:26px !important;
    }
}
</style>