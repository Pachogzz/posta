<?php 
/**
 * Template part for displaying 9 notes - one at tho sizes - and 1 half page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package postamx
 * 
 */
    $color = get_sub_field('color_del_titulo');
    $tipo = get_sub_field('tipo');
    $tipoTitulo = get_sub_field('titulo_de_seccion');
    $tituloPerso = get_sub_field('titulo_personalizado');
    $mostraDescr = get_sub_field('mostrar_descripcion');

    switch ($tipo) {
        case 'seccion':
            $id = get_sub_field('elegir_seccion');
            $tipo = 'category';
        break;

        case 'tema':
            $id = get_sub_field('elegir_tema');
            $tipo = 'theme';
        break;

        case 'hashtag':
            $id = get_sub_field('elegir_hashtag');
            $tipo = 'post_tag';
        break;
    }

    $categoria = get_term_by('id', $id, $tipo);
    $descripcion = category_description($categoria->term_id);
    $link = get_category_link($categoria->term_id);

?>
<section class="bloque_notas--4_hp_3_4 mb-6">
	<div class="container">
		<div class="row">
			<div class="col-12">
                <div class="encabezado">
                     <h2 class="encabezado-titulo" style="background-color:<?php echo $color; ?>;">
                        <a href="<?php echo $link; ?>">
                            <span class="nombre-sitio">POSTA</span>
                            <?php if($tipoTitulo == 'por_defecto'): ?>
                                <span class="nombre-taxonomia"><?php echo $categoria->name;?></span>
                            <?php else: ?>
                                <span class="nombre-taxonomia"><?php echo $tituloPerso;?></span>
                            <?php endif ?>
                        </a>
                    </h2>
                    <?php if ($mostraDescr): ?>
                        <p class="encabezado-descripcion"><?php echo strip_tags($descripcion); ?></p>
                    <?php endif ?>
                </div>
			</div>
			<div class="col-12 col-lg-9">
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 nota large half-top">
						<div class="row meta">
							<div class="col categoria">
								<small>Categoría</small>
							</div>
							<div class="col hora text-right">
								<small>Hace 1 hora <i class="fas fa-clock"></i></small>
							</div>
						</div>
						<div class="imagen-nota-container">
							<img src="http://fakeimg.pl/550x240/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
							<h5 class="titulo-nota text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 nota">
						<div class="row meta">
							<div class="col categoria">
								<small>Categoría</small>
							</div>
							<div class="col hora text-right">
								<small>Hace 1 hora <i class="fas fa-clock"></i></small>
							</div>
						</div>
						<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
						<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
					</div>
					<div class="col-12 col-md-6 col-lg-4 nota">
						<div class="row meta">
							<div class="col categoria">
								<small>Categoría</small>
							</div>
							<div class="col hora text-right">
								<small>Hace 1 hora <i class="fas fa-clock"></i></small>
							</div>
						</div>
						<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
						<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
					</div>
					<div class="col-12 col-md-6 col-lg-4 nota">
						<div class="row meta">
							<div class="col categoria">
								<small>Categoría</small>
							</div>
							<div class="col hora text-right">
								<small>Hace 1 hora <i class="fas fa-clock"></i></small>
							</div>
						</div>
						<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
						<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
					</div>
					<div class="col-12 col-md-6 col-lg-4 nota">
						<div class="row meta">
							<div class="col categoria">
								<small>Categoría</small>
							</div>
							<div class="col hora text-right">
								<small>Hace 1 hora <i class="fas fa-clock"></i></small>
							</div>
						</div>
						<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
						<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-3 nota">
				<img src="http://fakeimg.pl/300x600/333/ccc/?text=HalfPage" class="img-fluid d-block imagen-nota" alt="Publicidad...">
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 col-lg-3 nota">
				<div class="row meta">
					<div class="col categoria">
						<small>Categoría</small>
					</div>
					<div class="col hora text-right">
						<small>Hace 1 hora <i class="fas fa-clock"></i></small>
					</div>
				</div>
				<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
				<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
			</div>
			<div class="col-12 col-md-6 col-lg-3 nota">
				<div class="row meta">
					<div class="col categoria">
						<small>Categoría</small>
					</div>
					<div class="col hora text-right">
						<small>Hace 1 hora <i class="fas fa-clock"></i></small>
					</div>
				</div>
				<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
				<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
			</div>
			<div class="col-12 col-md-6 col-lg-3 nota">
				<div class="row meta">
					<div class="col categoria">
						<small>Categoría</small>
					</div>
					<div class="col hora text-right">
						<small>Hace 1 hora <i class="fas fa-clock"></i></small>
					</div>
				</div>
				<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
				<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
			</div>
			<div class="col-12 col-md-6 col-lg-3 nota">
				<div class="row meta">
					<div class="col categoria">
						<small>Categoría</small>
					</div>
					<div class="col hora text-right">
						<small>Hace 1 hora <i class="fas fa-clock"></i></small>
					</div>
				</div>
				<img src="http://fakeimg.pl/350x200/ccc/333/?text=placeholder" class="img-fluid d-block imagen-nota" alt="Lorem ipsum dolor sit amet consectetur adipisicing elit.">
				<h5 class="titulo-nota">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
			</div>
		</div>
	</div>
</section>