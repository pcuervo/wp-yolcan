<?php global $current_user;
global $opCliente; ?>
<article class="[ padding--bottom margin-bottom ]">
	<h4>Tu cuenta</h4>

    <p>
        <?php echo "Tu saldo es de <strong>$ ".number_format($opCliente->saldo)." </strong>"; ?>
    </p>

	<a href="<?php echo site_url('nuestros-productos/'); ?>" class="[ btn btn-secondary btn-small ]">agrega saldo a tu cuenta</a>

</article>
<article class="[ padding--bottom border-bottom margin-bottom ]">
	<p>Desea <strong>suspender</strong> sus entregas?</p>
	
    <form method="post" id="contactus_form" action="">
        <div class="[ margin-bottom--small ]">
            <input id="suspender-1" type="radio" class="input-radio" name="suspension" value="1 semana" checked="checked">
            <label for="suspender-1">1 Semana</label>
        </div>
        <div class="[ margin-bottom--small ]">
            <input id="suspender-2" type="radio" class="input-radio" name="suspension" value="2 semanas">
            <label for="suspender-2">2 Semanas</label>
        </div>
        <div class="[ margin-bottom--small ]">
            <input id="suspender-3" type="radio" class="input-radio" name="suspension" value="3 Semanas">
            <label for="suspender-3">3 Semanas</label>
        </div>
        <div class="[ margin-bottom--small ]">
            <input id="suspender-4" type="radio" class="input-radio" name="suspension" value="4 Semanas">
            <label for="suspender-4">4 Semanas</label>
        </div>
        <input type="submit" name="enviar" id="submit" class="[ btn btn-secondary btn-small ][ margin-bottom ]" value="suspender entrega"/>
    </form>
        
    <!-- Reanudar -->
    <?php if ($opCliente->suspendido == 1): ?>
        <p>Tus entregas estan suspendidas por: <strong class="[ color-primary ]"><?php echo $opCliente->id_suspencion; ?></strong></p>
        <p class="[ margin-top--large ]">Desea <strong>renudar</strong> sus entregas?</p>
        <a href="#" class="[ btn btn-secondary btn-small ][ margin-bottom--large ]">Reanudar entregas</a>
    <?php endif ?>
        
</article>

<?php if ($opCliente->saldo > 0) {
    get_template_part('woocommerce/myaccount/templates/canastas-cliente'); 
}