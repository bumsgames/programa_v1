<li class="nav-item active">
	<div class="dropdown">
		<strong><a class="nav-link dropbtn" id="category_btn" style="background-color: rgba(150, 150, 150, 1);"><i id="down_icon" class="fas fa-chevron-down"></i> CATEGORIAS</a></strong>
	</div>
</li>


<script>	
	$("#category_btn").click(function(){
		$('#dropdown-content2').slideToggle([100 ],["linear"]);
	});
</script>